<?php
    require_once __DIR__ . '/src/helperFunctions.php';
    checkAuth();
    require_once __DIR__ . '/header.php';
    require_once  __DIR__ . '/logic.php';
    $products = getProductsFromDb();
    $valuesFromGet = getValuesFromGET();
    $brands = getBrandsFromDb();
?>





<div class="main py-3">
    <div class="container text-center">
        <form class=" mb-5" action="products.php" method="get">
            <div class="mb-3">
                <label for="inputName" class="form-label">Название</label>
                <input value="<?= $valuesFromGet['name']?>" name="name" type="text" class="form-control" id="inputName">
            </div>
            <div class="mb-3">
                <label for="inputSelect" class="form-label">Брэнд</label>
                <select name="id_brand" id="inputSelect" class="form-select">
                    <option <?= empty($_GET['id_brand']) ? 'selected' : '' ?> value="">Не выбрано</option>
                    <?php foreach ($brands as $brand): ?>
                        <?php if ($brand['id'] == $_GET['id_brand']): ?>
                            <option selected value="<?=htmlspecialchars($brand['id'])?>">
                                <?=htmlspecialchars($brand['name'])?>
                            </option>
                        <?php else: ?>
                            <option value="<?=htmlspecialchars($brand['id'])?>">
                                <?=htmlspecialchars($brand['name'])?>
                            </option>
                        <?php endif ?>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="mb-3">
                <label for="inputPersonal" class="form-label">Описание</label>
                <textarea name="description" type="text" class="form-control" id="inputPersonal"><?=$valuesFromGet['description']?></textarea>
            </div>
            <div class="mb-3">
                <label for="inputCost" class="form-label">Цена</label>
                <input value="<?= $valuesFromGet['cost']?>" name="cost" type="number" min="0" max="10000000" class="form-control" id="inputCost">
            </div>
            <div class="">
                <button type="submit" class="btn btn-primary me-3">Применить фильтры</button>
                <a href="products.php" class="btn btn-danger">Сбросить фильтры</a>
            </div>
        </form>
        <table class="table table-hover">
            <thead>
            <tr class="row">
                <th scope="col" class="col-2">Фото</th>
                <th scope="col" class="col-3">Название</th>
                <th scope="col" class="col-2">Брэнд</th>
                <th scope="col" class="col-3">Описание</th>
                <th scope="col" class="col-2">Цена</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product):?>
                    <tr class="row">
                        <td class="col-2 d-block text-center">
                            <img height="100" src="catalog_images/<?=htmlspecialchars($product['img_path'])?>">
                        </td>
                        <td class="col-3"><?=htmlspecialchars($product['name'])?></td>
                        <td class="col-2"><?=htmlspecialchars($product['brand'])?></td>
                        <td class="col-3"><?=htmlspecialchars($product['description'])?></td>
                        <td class="col-2"><?=htmlspecialchars($product['cost'])?></td>
                    </tr>
                <?php endforeach?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once __DIR__ . '/footer.php' ?>


</body>
</html>