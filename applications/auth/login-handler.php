<?php
    include '../../utils/base.php';

    if(!empty($_POST['login']) && !empty($_POST['password'])) {
        $login = $_POST['login'];
        $password = $_POST['password'];

        $link = mysqli_connect('auto-library', 'root', '', 'mydb');
        if(mysqli_connect_errno()) {
            die('Ошибка подключения: ' . mysqli_connect_error());
        }

        $query = "SELECT users.id, users.login, users.password, statuses.name as status FROM users
                    LEFT JOIN statuses ON statuses.id=users.status_id
                    WHERE login='$login'
        ";
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        $user = mysqli_fetch_assoc($result);

        if(!$user) {
            $_SESSION['errors'][] = 'Неверный логин';
            header("Location: login.php?login=$login");
            die();
        }

        $hash = $user['password'];
        if(!password_verify($password, $hash)) {
            $_SESSION['errors'][] = 'Неверный пароль';
            header("Location: login.php?login=$login");
            die();
        }

        $_SESSION['auth']['authenticated'] = true;
        $_SESSION['auth']['id'] = $user['id'];
        $_SESSION['auth']['status'] = $user['status'];
        if($user['status'] === 'admin') header('Location: ../admin/add.php');
        else header('Location: ../user/catalog.php');
    } else {
        $_SESSION['errors'][] = 'Все поля должны быть заполнены!';
        header("Location: login.php?login={$_POST['login']}");
    }
?>