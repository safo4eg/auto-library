<?php
    include_once '../../utils/base.php';

    $link = mysqli_connect('localhost', 'root', 'QWEasd123', 'mydb');
    if(mysqli_connect_errno()) {
        die('Произошла ошибка соединения'.mysqli_connect_error());
    }
    mysqli_query($link, "SET NAMES'utf8mb4'");

    $tables = ['Привод' => 'drive', 'Двигатель' => 'engine', 'Коробка передачь' => 'transmission', 'Кузов' => 'body', 'Руль' => 'rudder'];
    foreach($tables as $key => $table) {
        $field = $table.'_title';
        $query = "SELECT $table.title as $field FROM $table";
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        for($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
        $_SESSION['form'][$table][] = $key;
        foreach($data as $value) {
            foreach($value as $v) {
                $_SESSION['form'][$table][] = $v;
            }
        }
    }
?>