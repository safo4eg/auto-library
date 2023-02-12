<?php
    if(!isset($_GET['id'])) {
        header('Location: catalog.php');die();
    }
    include '../../utils/base.php';

    $id = $_GET['id'];
    $link = mysqli_connect('localhost', 'root', 'QWEasd123', 'mydb');
    if(mysqli_connect_errno()) {
        die('Произошла ошибка соединения'.mysqli_connect_error());
    }
    mysqli_query($link, "SET NAMES 'utf8mb4'");
    $applicationQuery = "SELECT applications.* FROM applications WHERE id=$id";
    $result = mysqli_query($link, $applicationQuery) or die(mysqli_error($link));
    $fields = array_keys(mysqli_fetch_assoc($result));

    $query = "SELECT ";
    $tables = [];
    foreach($fields as $field) {
        $i = strpos($field, '_id');
        if($i) {
            $table = substr($field, 0, $i);
            $tables[] = $table;
            $query .= "$table.title as {$table}_title, ";
        } else $query .= "applications.$field, ";
    }
    $query = rtrim($query, ', ' ).' FROM applications ';

    foreach($tables as $table) {
        $query .= "LEFT JOIN $table ON $table.id=applications.{$table}_id ";
    }
    $query .= "WHERE applications.id=$id";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    $info = mysqli_fetch_assoc($result);

    $query = "SELECT images.name FROM applications
                LEFT JOIN application_image ON application_image.application_id=applications.id
                LEFT JOIN images ON application_image.image_id=images.id
                WHERE applications.id=$id
";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    for($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
    $images = [];
    foreach($data as $arr) {
        $images[] = $arr['name'];
    }

    return ['info' => $info, 'images' => $images];
?>
