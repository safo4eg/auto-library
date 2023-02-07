<?php
    $link = mysqli_connect('localhost', 'u1933874_default', '1T543Z6NGfAyqcCd', 'u1933874_default');
    if(mysqli_connect_errno()) {
        die('Произошла ошибка соединения'.mysqli_connect_error());
    }
    mysqli_query($link, "SET NAMES 'utf8mb4'");
    $id = $_GET['id'];
    $query = create_query_related(['brand_id', 'engine_id', 'drive_id', 'transmission_id', 'body_id', 'rudder_id'],"id='$id'");
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    return mysqli_fetch_assoc($result);
?>
