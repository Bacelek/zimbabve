<?php
require_once __DIR__ . "/src/helperFunctions.php";
require_once  __DIR__ . "/header.php";

if (isset($_POST['submit'])) {
    require_once __DIR__ . "/src/export.php";
}
$defaultValue['pathToSave'] = htmlspecialchars($_POST['pathToSave']);
?>
<div class="container">
    <form action="export.php" method="POST">
        <div class="form-group mb-3">
            <label for="pathToSave">Путь сохранения json</label>
            <input value ="<?= $defaultValue['pathToSave'] ?>" type="text" class="form-control" name="pathToSave" id="pathToSave"
                   placeholder="/LR/upload/export.json" required>
        </div>
        <button name="submit" type="submit" class="btn btn-primary">Сохранить</button>
    </form>
    <?php
    if (isset($_POST['submit'])) {
        if (isset($error)) {
            ?>
            <div class="alert alert-danger" role="alert">
                <?= $error ?>
            </div>
            <?php
        } else {
            ?>
            <div class="alert alert-primary" role="alert">
            <?php echo "Файл с данными сохранен на диск по адресу: "; ?><a href="<?php echo htmlspecialchars($_POST['pathToSave']) ?>" download=""><?php echo htmlspecialchars($_POST['pathToSave']) ?></a>
            </div><?php
        }
    }
    ?>
</div>
