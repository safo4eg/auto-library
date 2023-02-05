<?php
    $application = include 'detail-handler.php';
    $info = $application['info'];
    $images = $application['images'];

    $arr = [
            'Двигатель' => 'engine_title',
            'Коробка передач' => 'transmission_title',
            'Привод' => 'drive_title',
            'Тип кузова' => 'body_title',
            'Пробег, км' => 'running',
            'Руль' => 'rudder_title',
            'Описание' => 'description'
    ];
    $infoProperty = [];
    foreach($arr as $key => $value) {

        $infoProperty[$key] = $value === 'engine_title'? "$info[$value], $info[volume]л": $info[$value];;
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/detail.css">
    <script defer src="/js/images-viewing.js"></script>
    <title><?= "$info[brand_title] $info[title] $info[year]" ?></title>
</head>
<body>
    <?php include '../includes/nav.php'; ?>
    <main>
        <div class="container">
            <h1><?= "$info[brand_title] $info[title], $info[year]" ?></h1>
            <div class="detail-wrapper">
                <div class="detail-left">
                    <div class="main-img">
                        <img src="<?= "/media/uploads/$images[0]" ?>" alt="/">
                        <span class="arrow right hidden">&#x3E;</span>
                        <span class="arrow left hidden">&#x3C;</span>
                    </div>
                    <div class="others-imgs">
                        <?php foreach($images as $img): ?>
                            <div class="image-wrapper">
                                <img src="<?= "/media/uploads/$img" ?>" alt="/">
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="links">
                        <div class="link response">
                            <?php if($_SESSION['auth']['status'] === 'user'): ?>
                                <a href="/applications/response.php?application=<?= $info['id'] ?>">&#x2709;Откликнуться</a>
                            <?php endif;?>
                        </div>
                    </div>
                </div> <!-- detail-left -->

                <div class="detail-right">
                    <h2 class="price"><?= $info['price'] ?>Р</h2>
                    <div class="info">
                        <?php foreach($infoProperty as $key => $value): ?>
                            <div class="item">
                                <?php if($key === 'Описание'): ?>
                                    <p class="message">
                                        <span class="title">Дополнительно</span>
                                        <?= $value ?>
                                    </p>
                                <? else: ?>
                                    <p class="title"><?= $key ?></p>
                                    <p class="desc"><?= $value ?></p>
                                <? endif; ?>
                            </div>
                        <? endforeach; ?>
                    </div>
                </div>
            </div> <!-- detail-wrapper -->
        </div> <!-- container -->
    </main>

</body>
</html>
