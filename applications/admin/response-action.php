<?php
    include '../../utils/base.php';

    if(empty($_SESSION['auth']) || $_SESSION['auth']['status'] === 'user') header('Location: ../user/catalog.php');

    if(!empty($_GET)) {
        $data = $_GET['data'];
        $link = mysqli_connect('auto-library', 'root', '', 'mydb');
        if(mysqli_connect_errno()) {
            die('Ошибка подключения: '.mysqli_connect_error());
        }

        if($data['action'] === 'accept') {
            $query = "UPDATE user_application SET status_id=2 WHERE user_id=$data[user_id] AND application_id=$data[app_id]";
            mysqli_query($link, $query) or die(mysqli_error($link));
            $query = "UPDATE applications SET book_id=2 WHERE applications.id=$data[app_id]";
            mysqli_query($link, $query) or die(mysqli_error($link));
        }
        elseif($data['action'] === 'reject') {
            $query = "UPDATE user_application SET status_id=3 WHERE user_id=$data[user_id] AND application_id=$data[app_id]";
            mysqli_query($link, $query) or die(mysqli_error($link));
            $query = "UPDATE applications SET book_id=1 WHERE applications.id=$data[app_id]";
            mysqli_query($link, $query) or die(mysqli_error($link));
        };
        header('Location: ../user/response.php');
    } else header('Location: ../user/response.php');
?>