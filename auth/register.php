<?php include '../utils/base.php' ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/auth.css">
    <title>Регистрация</title>
</head>
<body>
    <?php include '../includes/nav.php'; ?>

    <main class="main">
        <div class="form-wrapper">
            <h1>Регистрация</h1>
            <form action="register-handler.php" method="post">
                <input class="item" name="login" type="text" placeholder="login" value="<?=
                    isset($_GET['login'])? $_GET['login']: '';
                ?>">
                <input class="item" name="password1" type="password" placeholder="password">
                <input class="item" name="password2" type="password" placeholder="confirm password">
                <input type="submit" class="button">
            </form>

            <?php include '../includes/errors.php'; ?>
        </div>
    </main>
</body>
</html>