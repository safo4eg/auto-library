<?php
    include '../../utils/base.php';
    require('../../utils/funcs.php');

    $link = mysqli_connect('localhost', 'root', 'QWEasd123', 'mydb');
    if(mysqli_connect_errno()) {
        die('Произошла ошибка соединения'.mysqli_connect_error());
    }
    mysqli_query($link, "SET NAMES 'utf8mb4'");
    $brands = get_rows($link, 'brand');
    $applications = get_rows($link,'applications', '0','0','1');
    $fields = array_keys($applications[0]);
    if(isset($_GET['brand'])) {
        $brandId = $_GET['brand'];
        $query = create_query_related($fields, "book_id=1 AND brand_id=$brandId");
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        for($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);

        foreach($data as $key => $elem) {
            $data[$key]['image'] = get_applcation_image($link, $data[$key]['id']);
        }
        return ['brands' => $brands, 'applications' => $data];
    } else {
        $query = create_query_related($fields, 'book_id=1');
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        for($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);

        foreach($data as $key => $elem) {
            $data[$key]['image'] = get_applcation_image($link, $data[$key]['id']);
        }

        return ['brands' => $brands, 'applications' => $data];
    }

?>

