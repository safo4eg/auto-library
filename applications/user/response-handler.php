<?php
    include '../../utils/base.php';
    if(empty($_SESSION['auth'])) {
        header('Location: catalog.php');
        die();
    }

    $link = mysqli_connect('localhost', 'u1933874_default', '1T543Z6NGfAyqcCd', 'u1933874_default');
    if(mysqli_connect_errno()) {
        die('Произошла ошибка соединения'.mysqli_connect_error());
    }
    mysqli_query($link, "SET NAMES 'utf-8mb4'");

    if(isset($_GET['application'])) {
        $userId = $_SESSION['auth']['id'];
        $applicationId = $_GET['application'];

        $query = "SELECT * FROM user_application WHERE user_id=$userId AND application_id=$applicationId";
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        $data = mysqli_fetch_assoc($result);

        if($data) {
            header('Location: response.php');
            die();
        }

        $query = "INSERT INTO user_application SET user_id=$userId, application_id=$applicationId, status_id=1";
        mysqli_query($link, $query) or die(mysqli_error($link));
        header('Location: response.php');
        die();
    }

    $userId = $_SESSION['auth']['id'];
    $query = "SELECT applications.title, applications.year, applications.price, brand.title as brand, rstatuses.title as status, users.login as user_login,
                        applications.id, users.id as user_id
                FROM user_application
                LEFT JOIN applications ON user_application.application_id=applications.id
                LEFT JOIN response_statuses as rstatuses ON user_application.status_id=rstatuses.id
                LEFT JOIN users ON user_application.user_id=users.id
                LEFT JOIN brand ON applications.brand_id=brand.id
    ";

    if($_SESSION['auth']['status'] === 'user') $query .= " WHERE user_application.user_id=$userId";

    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    for($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
    return $data;

?>
