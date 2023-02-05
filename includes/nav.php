<header>
    <div class="container header">
        <a class="logo" href="/applications/catalog.php">Автотека</a>
        <nav class="nav">
            <?php if(isset($_SESSION['auth']['authenticated'])): ?>
                <?php if($_SESSION['auth']['status'] === 'user'): ?>
                    <a class="nav-link" href="/applications/catalog.php">Каталог</a>
                <?php elseif($_SESSION['auth']['status'] === 'admin'): ?>
                    <a class="nav-link" href="/applications/admin/applications.php">База</a>
                    <a class="nav-link" href="/applications/admin/add.php">Добавить</a>
                <? endif; ?>
                <a class="nav-link" href="/applications/response.php"><?= $_SESSION['auth']['status'] === 'admin'? 'Заявки': 'Мои заявки'; ?></a>
                <a class="nav-link" href="/auth/logout.php">Выход</a>
            <?php else: ?>
                <a class="nav-link" href="/auth/login.php">Вход</a>
                <a class="nav-link" href="/auth/register.php">Регистрация</a>
            <?php endif; ?>
        </nav>
    </div>
</header>
