<?php $applications = include 'applications-handler.php';?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../css/header.css">
    <link rel="stylesheet" href="../../css/applications.css">
    <link rel="stylesheet" href="../../css/add.css">
    <title>Все обьявления</title>
</head>
<body>
    <?php include '../../includes/nav.php' ?>

    <main>
        <div class="container">

            <?php if(isset($_GET['edit'])) { ?>
                <?php include 'add-form.php'; ?>
                <?php $formData = include 'edit-data.php' ?>

                <h2 class="title">Редактировать обьявление</h2>
                <form action="edit-handler.php" method="post" enctype="multipart/form-data">
                    <div class="item">
                        <span>Название</span>
                        <input type="text" name="title" required value="<?= $formData['title'] ?>">
                        <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                    </div>

                    <div class="item">
                        <span>Марка</span>
                        <input type="text" name="brand" required value="<?= $formData['brand_title'] ?>">
                    </div>

                    <div class="item">
                        <span>Цена</span>
                        <input type="text" name="price" required value="<?= $formData['price'] ?>">
                    </div>

                    <div class="item">
                        <span>Год</span>
                        <input type="text" name="year" required value="<?= $formData['year'] ?>">
                    </div>

                    <div class="item">
                        <span>Объем двигателя</span>
                        <input type="text" name="volume" required value="<?= $formData['volume'] ?>">
                    </div>

                    <div class="item selects">
                        <?php include '../../includes/select.php' ?>
                    </div>

                    <div class="item">
                        <span>Пробег, км</span>
                        <input type="text" name="running" required value="<?= $formData['running'] ?>">
                    </div>

                    <div class="item desc">
                        <span>Описание</span>
                        <textarea name="description"><?= $formData['description'] ?></textarea>
                    </div>

                    <div class="item">
                        <input type="submit" value="Редактировать">
                        <a href="applications.php">Отменить</a>
                    </div>
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

            <?php } ?>

            <table class="table">
                <thead>
                <tr>
                    <th>Название</th>
                    <th>Марка</th>
                    <th>Год</th>
                    <th>Цена</th>
                    <th>Статус</th>
                    <th colspan="3">Действия</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach($applications as $application) { ?>
                    <tr>
                        <td>
                            <a href="../user/detail.php?id=<?= $application['id'] ?>"><?= $application['title']?></a>
                        </td>
                        <td><?= $application['brand_title'] ?></td>
                        <td><?= $application['year'] ?></td>
                        <td><?= $application['price'] ?></td>
                        <td><?= $application['book_title'] ?></td>
                        <td><a href="edit-handler.php?id=<?=$application['id']?>">Редактировать</a></td>
                        <td><a href="hide.php?id=<?=$application['id']?>&book=<?= $application['book_title']?>"><?= $application['book_title'] === 'free'? 'Скрыть': 'Показать' ?></a></td>
                        <td><a href="delete.php?id=<?=$application['id']?>">Удалить</a></td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>
        </div>
    </main>

</body>
</html>