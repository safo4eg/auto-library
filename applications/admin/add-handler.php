<?php
    include '../../utils/base.php';
    require('../../utils/funcs.php');

    if(!empty($_POST) && isset($_FILES['images'])) {
        $link = mysqli_connect('localhost', 'root', 'QWEasd123', 'mydb');
        if(mysqli_connect_errno()) {
            die('Произошла ошибка соединения'.mysqli_connect_error());
        }
        mysqli_query($link, "SET NAMES'utf8mb4'");

        $relatedTables = ['drive', 'engine', 'transmission', 'body', 'rudder', 'brand'];
        $applicationQuery = "INSERT INTO applications SET";
        foreach($_POST as $key => $value) {
            if(empty($_POST[$key])) {
                if($key === 'description') continue;
                $_SESSION['errors'][] = "Поле $key должно быть заполнено!";
            }
            if(in_array($key, $relatedTables)) {
                $query = "SELECT id FROM $key WHERE title='$value'";
                $result = mysqli_query($link, $query) or die(mysqli_error($link));
                $data = mysqli_fetch_assoc($result);
                $field = $key."_id";
                if(!$data && $key === 'brand') {
                    $query = "INSERT INTO brand SET title='$value'";
                    mysqli_query($link, $query) or die(mysqli_error($link));
                    $brandId = mysqli_insert_id($link);
                    $applicationQuery .= " $field=$brandId,";
                    continue;
                }
                $applicationQuery .= " $field=$data[id],";
                continue;
            }
            $applicationQuery .= " $key='$value',";
        }
        $applicationQuery .= ' book_id=1';

        if(isset($_SESSION['errors'])) {
            header('Location: add.php');die();
        }

        $_FILES['images'] = format_images_array($_FILES['images']);
        $imagesNames = [];
        foreach($_FILES['images'] as $image) {
            $imagesNames[] = upload_image($image, '../../media/uploads');
        }

        mysqli_query($link, $applicationQuery) or die(mysqli_error($link));
        $applicationId = mysqli_insert_id($link);

        foreach($imagesNames as $value) {
            $imageQuery = "INSERT INTO images SET name='$value'";
            mysqli_query($link, $imageQuery) or die(mysqli_error($link));
            $imageId = mysqli_insert_id($link);
            $application_image = "INSERT INTO application_image SET application_id='$applicationId', image_id='$imageId'";
            mysqli_query($link, $application_image) or die(mysqli_error($link));
        }

        header("Location: ../user/detail.php?id=$applicationId");

    } else {
        $_SESSION['errors'][] = 'Все поля должны быть заполнены!';
        header('Location: add.php'); die();
    }
?>
