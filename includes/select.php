<?php if(isset($_SESSION['form'])): ?>
    <?php foreach($_SESSION['form'] as $title => $values): ?>
        <select name="<?= $title ?>" required>
            <?php for($i = 0; $i < count($values); $i++): ?>
                <?php if(isset($_GET['edit'])): ?>
                    <?php
                        if($i === 0) continue;
                        $name = $title.'_title';
                    ?>
                    <option <?= $formData[$name] === $values[$i]? 'selected': '';  ?>><?= $values[$i] ?></option>
                <?php else: ?>
                    <option <?= $i === 0? 'disabled selected value=""': '' ?>><?= $values[$i] ?></option>
                <? endif; ?>
            <? endfor; ?>
        </select>
    <?php endforeach; ?>
<?php endif; ?>
