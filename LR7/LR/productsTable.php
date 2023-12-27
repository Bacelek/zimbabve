<?php
require_once __DIR__ . '/src/helperFunctions.php';
require_once __DIR__ . '/DBconnect.php';
require_once __DIR__ . '/src/tableModule.php';

$db = DBconnect();
$product = new tableModule($db);
$products = $product->getAllProducts();
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (isset($_POST['delete'])){
        $alert = '';
        $id = $_POST['id'];
        try {
            $productAssoc = $product->deleteProduct($id);
            var_dump($productAssoc);
            unlink(__DIR__ . '/catalog_images/' . $productAssoc['img_path']);
            $alert = "Продукт номер $id удален";
        } catch (Exception $e){
            $alert = $e->getMessage();
        }
        header('Location: productsTable.php' . ($alert ? '?alert='.urlencode($alert) : ''));
    }
    if (isset($_POST['edit'])){
        $id = $_POST['id'];
        $productByID = $product->getProductByID($id);
        //var_dump($productByID);
        header('Location: editProduct.php' . "?name=".urlencode($productByID['name'])."&id=".urlencode($productByID['id'])."&description=".urlencode($productByID['description'])."&id_brand=".urlencode($productByID['id_brand'])."&cost=".urlencode($productByID['cost']));
    }

}
require_once __DIR__ . '/header.php';
?>
<div class="container text-center">
    <div class="table-responsive">
        <?php if (isset($_GET['alert'])): ?>
            <div class="alert alert-success">
                <?php echo $_GET['alert']; ?>
            </div>
        <?php endif; ?>
        <div>
            <a href="productAdd.php" class="btn btn-success">Добавить</a><br>
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
                    <td>действия</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product1): ?>
                    <tr>
                        <td><?= $product1['idp']; ; ?></td>)
                        <td>
                            <img src="catalog_images/<?= $product1['img_path']; ?>" alt="photo" width="100">
                        </td>
                        <td><?= htmlspecialchars($product1['name']); ?></td>
                        <td><?= $product1['brand']; ?></td>
                        <td><?= htmlspecialchars($product1['description']); ?></td>
                        <td><?= htmlspecialchars($product1['cost']); ?></td>
                        <td>
                            <form action="" method="POST">
                                <input type="hidden" name="id" value="<?= $product1['idp']; ?>">
                                <button class="btn btn-danger" name="delete">удалить</button>
                                <button class="btn btn-primary" name="edit">редактировать</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>