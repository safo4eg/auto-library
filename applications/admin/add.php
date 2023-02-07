<?php include 'add-form.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../css/header.css">
    <link rel="stylesheet" href="../../css/add.css">
    <title>Добавить</title>
</head>
<body>
    <?php
        include '../../includes/nav.php';
        if(empty($_SESSION['auth']) || $_SESSION['auth']['status'] === 'user') header('Location: /applications/catalog.php');
    ?>
<main>
    <div class="container">
        <h2 class="title">Новое обьявление</h2>
        <form action="add-handler.php" method="post" enctype="multipart/form-data">
            <div class="item">
                <span>Название</span>
                <input type="text" name="title" required>
            </div>

            <div class="item">
                <span>Марка</span>
                <input type="text" name="brand" required>
            </div>

            <div class="item">
                <span>Цена</span>
                <input type="text" name="price" required>
            </div>

            <div class="item">
                <span>Год</span>
                <input type="text" name="year" required>
            </div>

            <div class="item">
                <span>Объем двигателя</span>
                <input type="text" name="volume" required>
            </div>

            <div class="item selects">
                <?php include '../../includes/select.php' ?>
            </div>

            <div class="item">
                <span>Пробег, км</span>
                <input type="text" name="running" required>
            </div>

            <div class="item">
                <span>Фотографии</span>
                <input type="file" name="images[]" multiple>
            </div>

            <div class="item desc">
                <span>Описание</span>
                <textarea name="description"></textarea>
            </div>

            <input type="submit">
            <?php unset($_SESSION['form']) ?>
        </form>

        <?php if(isset($_SESSION['errors'])) { ?>
            <ul class="errors">
                <?php foreach($_SESSION['errors'] as $error) { ?>
                    <li class="error"><?= $error ?></li>
                <?php } ?>
            </ul>
            <?php unset($_SESSION['errors'])?>
        <?php } ?>
    </div>
</main>
</body>
</html>