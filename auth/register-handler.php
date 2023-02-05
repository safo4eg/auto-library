<?php
    include '../utils/base.php';

    if(!empty($_POST['login']) && !empty($_POST['password1']) && !empty($_POST['password2'])) {
        $login = $_POST['login'];
        $pass1 = $_POST['password1'];
        $pass2 = $_POST['password2'];

        $host = 'auto-library';
        $user = 'root';
        $pass = '';
        $db = 'mydb';

        $link = mysqli_connect($host, $user, $pass, $db);
        if(mysqli_connect_errno()) {
            die('Ошибка подключения: ' . mysqli_connect_error());
        }

        $query = "SELECT * from users WHERE login='$login'";
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        $data = mysqli_fetch_assoc($result);

        if($data) {
            $_SESSION['errors'][] = 'Такой пользователь уже существует';
        }

        if($pass1 !== $pass2) {
            $_SESSION['errors'][] = 'Пароли не совпадают';
        }

        if(isset($_SESSION['errors'])) {
            header("Location: register.php?login=$login");
            die();
        };

        $password = password_hash($pass1, PASSWORD_DEFAULT);

        $query = "INSERT INTO users SET login='$login', password='$password', status_id=1";
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        $id = mysqli_insert_id($link);

        $query = "SELECT users.id, statuses.name as status FROM users
                    LEFT JOIN statuses ON statuses.id=users.status_id
                    WHERE users.id=$id
        ";
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        $user = mysqli_fetch_assoc($result);
        $_SESSION['auth']['authenticated'] = true;
        $_SESSION['auth']['id'] = $user['id'];
        $_SESSION['auth']['status'] = $user['status'];
        header('Location: /applications/catalog.php');
    }


?>