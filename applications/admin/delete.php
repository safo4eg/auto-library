<?php
    include '../../utils/base.php';
    $link = mysqli_connect('auto-library', 'root', '', 'mydb');
    if(mysqli_connect_errno()) {
        die('Произошла ошибка соединения'.mysqli_connect_error());
    }
    if(empty($_SESSION['auth']) || $_SESSION['auth']['status'] === 'user') header('Location: /applications/catalog.php');
    if(empty($_GET['id'])) header('Location: /applications/admin/applications.php');

    $id = $_GET['id'];

    $query = "SELECT applications.brand_id FROM applications";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    $brandId = mysqli_fetch_assoc($result)['brand_id'];

    $query = "SELECT COUNT(*) as count FROM applications WHERE brand_id=$brandId";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    $count = mysqli_fetch_assoc($result)['count'];
    if($count == 1) {
        echo 'sss';
        $query = "DELETE FROM brand WHERE id=$brandId";
        mysqli_query($link, $query) or die(mysqli_error($link));
    }
    $query = "DELETE FROM applications WHERE id=$id";
    mysqli_query($link, $query) or die(mysqli_error($link));
    header('Location: /applications/admin/applications.php');
?>