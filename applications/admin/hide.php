<?php
    include '../../utils/base.php';
    $link = mysqli_connect('localhost', 'root', 'QWEasd123', 'mydb');
    if(mysqli_connect_errno()) {
        die('Произошла ошибка соединения'.mysqli_connect_error());
    }
    mysqli_query($link, "SET NAMES 'utf-8mb4'");
    if(empty($_SESSION['auth']) || $_SESSION['auth']['status'] === 'user') header('Location: ../user/catalog.php');
    if(empty($_GET['id']) && empty($_GET['book']) ) header('Location: applications.php');

    $id = $_GET['id'];
    $book = $_GET['book'];

    $query = "UPDATE applications SET book_id=";
    $query .= $book == 'free'? "'2' ": "'1' ";
    $query .= "WHERE id=$id";

    mysqli_query($link, $query) or die(mysqli_error($link));
    header('Location: applications.php');
?>