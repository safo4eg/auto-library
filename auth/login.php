<?php
    include '../utils/base.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/auth.css">
    <title>Вход</title>
</head>
<body>
    <?php include '../includes/nav.php'; ?>

    <main class="main">
        <div class="form-wrapper">
            <h1>Авторизация</h1>
            <form action="login-handler.php" method="post">
                <input class="item" type="text" name="login" placeholder="login" value="<?= !empty($_GET['login'])? $_GET['login']: ''?>">
                <input class="item" type="password" name="password" placeholder="password">
                <input class="button" type="submit">
            </form>
            <?php include '../includes/errors.php'; ?>
        </div>
    </main>
</body>
</html>
