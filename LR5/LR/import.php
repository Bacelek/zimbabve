<?php
require_once __DIR__ . "/src/helperFunctions.php";
require_once  __DIR__ . "/header.php";

if (isset($_POST['submit'])) {
    require_once __DIR__ . "/src/import.php";
}
$defaultValue['pathToImport'] = htmlspecialchars($_POST['pathToImport']);
?>
<div class="container">
    <form action="import.php" method="POST">
        <div class="form-group mb-3">
            <label for="pathToImport">Ссылка для скачивания файла</label>
            <input value ="<?= $defaultValue['pathToImport'] ?>" type="url" class="form-control" name="pathToImport" id="pathToImport"
                   placeholder="https://" required>
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
            <?php echo "Файл с данными получен из " . $defaultValue['pathToImport'] . " и обработан. Создана таблица " . $dbName . " и " . $count . " записей в ней"; ?>
            </div><?php
        }
    }
    ?>
</div>