<?php
    include '../../utils/base.php';
    $link = mysqli_connect('localhost', 'root', 'QWEasd123', 'mydb');
    if(mysqli_connect_errno()) {
        die('Произошла ошибка соединения'.mysqli_connect_error());
    }
    mysqli_query($link, "SET NAMES 'utf8mb4'");
    if(empty($_SESSION['auth']) || $_SESSION['auth']['status'] === 'user') header('Location: ../user/catalog.php');
    if(!empty($_POST)) {
        $id = $_POST['id'];
        $relatedTables = ['drive', 'engine', 'transmission', 'body', 'rudder', 'brand'];
        $editQuery = "UPDATE applications SET";
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
                    $editQuery .= " $field=$brandId,";
                    continue;
                }
                $editQuery .= " $field=$data[id],";
                continue;
            }
            $editQuery .= " $key='$value',";
        }
        $editQuery = rtrim($editQuery, ',')." WHERE id=$id";

        mysqli_query($link, $editQuery) or die(mysqli_error($link));
        header('Location: applications.php');

    } else {
        if(empty($_GET['id'])) header('Location: applications.php');
        header("Location: applications.php?edit=1&id=$_GET[id]");
    }


?>
