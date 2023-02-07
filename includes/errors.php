<?php if(isset($_SESSION['errors'])) { ?>
    <ul class="errors">
        <?php foreach($_SESSION['errors'] as $error) { ?>
            <li class="error"><?= $error ?></li>
        <?php } ?>
    </ul>
    <?php unset($_SESSION['errors'])?>
<?php } ?>
