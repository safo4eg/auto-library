<?php $data = include 'catalog-handler.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../css/header.css">
    <link rel="stylesheet" href="../../css/catalog.css">
    <script defer src="../../js/card.js"></script>
    <title>Catalog</title>
</head>
<body>
    <?php include '../../includes/nav.php' ;?>

    <main class="main">
        <div class="container">
            <div class="main-filter">
                <h2>Поиск обьявлений</h2>
                <div class="filter-wrapper">
                    <?php foreach($data['brands'] as $brand) { ?>
                        <a class="filter-item" href="catalog.php?brand=<?= $brand['id'] ?>"><?= $brand['title'] ?></a>
                    <?php } ?>
                </div>
            </div> <!-- main-filter -->

            <div class="main-content">
                <div class="content-title">
                    <h2><?=count($data['applications'])?> ОБЪЯВЛЕНИЙ </h2>
                </div>

                <div class="card-wrapper">
                <?php foreach($data['applications'] as $application) { ?>
                        <a class="card-outer" href="detail.php?<?= "id=$application[id]" ?>">
                            <div class="card-inner">
                                <div class="card-left">
                                    <img src="../../media/uploads/<?= $application['image'] ?>" alt="/">
                                </div>

                                <div class="card-middle">
                                    <h2 class="card-title"><?= "$application[brand_title] $application[title], $application[year]"?></h2>
                                    <section class="card-info">
                                        <p><?= "$application[volume], $application[engine_title], 
                                                    $application[transmission_title], $application[drive_title], $application[running]" ?>
                                        </p>
                                    </section>
                                </div>

                                <div class="card-right">
                                    <p class="card-price"><?= $application['price'] ?></p>
                                </div>
                            </div>
                        </a>
                <?php } ?>
                </div> <!-- card-wrapper -->
            </div> <!-- main-content -->
        </div> <!-- container -->
    </main>
</body>
</html>
