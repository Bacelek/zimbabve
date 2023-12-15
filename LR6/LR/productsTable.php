<?php
require_once __DIR__ . '/src/helperFunctions.php';
require_once __DIR__ . '/DBconnect.php';
require_once __DIR__ . '/header.php';
require_once __DIR__ . '/src/tableModule.php';

$db = DBconnect();
$product = new tableModule($db);
$products = $product->getAllProducts();
?>
<div class="container text-center">
    <div class="table-responsive">
        <div>
            <a href="productAdd.php" class="btn btn-success">Добавить</a>
        </div>
        <table class="table table-stripped">
            <thead>
                <tr>
                    <td>Id</td>
                    <td>фото</td>
                    <td>имя</td>
                    <td>брэнд</td>
                    <td>описание</td>
                    <td>цена</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product1): ?>
                    <tr>
                        <td><?= $product1['idp']; ?></td>
                        <td>
                            <img src="catalog_images/<?= $product1['img_path'] ?>" alt="" width="100">
                        </td>
                        <td><?= $product1['name']; ?></td>
                        <td><?= $product1['brand']; ?></td>
                        <td><?= $product1['description']; ?></td>
                        <td><?= $product1['cost']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>