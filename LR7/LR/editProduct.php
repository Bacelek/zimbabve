<?php
require_once __DIR__ . '/src/helperFunctions.php';
require_once __DIR__ . '/DBconnect.php';
require_once __DIR__ . '/src/tableModule.php';
if (isset($_POST['submit'])){
    require_once __DIR__ . '/src/editProduct.php';
    if(empty($errors)){
        redirect('productsTable.php');
    }
}
require_once __DIR__ . '/header.php';
?>
<div class="container text-center">
    <h2>изменить продукт</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group pb-4">
            <label for="name" class="form-label">Имя</label>
            <input type="text" name="name" value="<?= $_GET['name'] ?>" id="name" placeholder="Светильник" class="form-control mt-2">
        </div>
        <div class="form-group pb-4">
            <label for="description" class="form-label">Описание</label>
            <input type="text" name="description" value="<?= $_GET['description'] ?>" id="description" placeholder="Информация" class="form-control mt-2">
        </div>
        <div class="form-group pb-4">
            <label for="cost" class="form-label">цена</label>
            <input type="text" name="cost" id="cost" value="<?= $_GET['cost'] ?>" placeholder="сколько то" class="form-control mt-2">
        </div>
        <div class="form-group pb-4">
            <label for="brand" class="form-label mt-2">Брэнд</label>
            <select class="form-select" name="brand" id="brand">
                <option value="1" <?= (isset($_GET['id_brand']) && $_GET['id_brand'] == "1") ? " selected" : "" ?>>Jinbei</option>
                <option value="2" <?= (isset($_GET['id_brand']) && $_GET['id_brand'] == "2") ? " selected" : "" ?>>Falcon</option>
                <option value="3" <?= (isset($_GET['id_brand']) && $_GET['id_brand'] == "3") ? " selected" : "" ?>>FST</option>
            </select>
        </div>
        <div class="form-group pb-4">
            <label for="name">Фото</label>
            <input type="file" name="image" id="image" class="form-control mt-2">
        </div>
        <div>
            <button type="submit" name="submit" class="btn btn-success">Изменить продукт</button>
        </div>
    </form>
    <?php
    if (isset($_POST['submit'])) {
        if (!empty($errors)) {
            foreach ($errors as $key => $value): ?>
                <div class="alert alert-danger"><?= $value; ?></div>
            <?php endforeach;
        }
    } ?>
</div>
