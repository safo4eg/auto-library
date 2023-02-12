<?php
    include '../../utils/base.php';
    require('../../utils/funcs.php');

    if(empty($_SESSION['auth']) || $_SESSION['auth']['status'] === 'user') header('Location: /applications/catalog.php');

    $link = mysqli_connect('localhost', 'root', 'QWEasd123', 'mydb');
    if(mysqli_connect_errno()) {
        die('Произошла ошибка соединения'.mysqli_connect_error());
    }
    mysqli_query($link, "SET NAMES 'utf8mb4'");

    $query = create_query_related(['brand_id', 'book_id']);
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    for($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
    return $data;
?>
