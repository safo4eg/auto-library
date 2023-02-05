<?php
    $applications = include 'response-handler.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/applications.css">
    <title><?= $_SESSION['auth']['status'] === 'admin'? 'Заявки': 'Мои заявки'; ?></title>
</head>
<body>
    <?php include '../includes/nav.php'?>

    <main>
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <?php if($_SESSION['auth']['status'] === 'admin'): ?>
                            <th>Пользователь</th>
                        <?php endif; ?>
                        <th>Название</th>
                        <th>Марка</th>
                        <th>Год</th>
                        <th>Цена</th>
                        <th>Статус</th>
                        <?php if($_SESSION['auth']['status'] === 'admin'): ?>
                            <th colspan="2">Действия</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($applications as $application): ?>
                        <tr>
                            <?php if($_SESSION['auth']['status'] === 'admin'): ?>
                                <th><?= $application['user_login'] ?></th>
                            <?php endif; ?>
                            <td>
                                <a href="/applications/detail.php?id=<?= $application['id'] ?>"><?= $application['title']?></a>
                            </td>
                            <td><?= $application['brand'] ?></td>
                            <td><?= $application['year'] ?></td>
                            <td><?= $application['price'] ?></td>
                            <td><?= $application['status'] ?></td>
                            <?php if($_SESSION['auth']['status'] === 'admin'): ?>
                                <td><a href="/applications/admin/response-action.php?data[action]=accept&data[user_id]=<?=$application['user_id']?>&data[app_id]=<?=$application['id']?>">Принять</a></td>
                                <td><a href="/applications/admin/response-action.php?data[action]=reject&data[user_id]=<?=$application['user_id']?>&data[app_id]=<?=$application['id']?>">Отклонить</a></td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>