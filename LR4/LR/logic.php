<?php
require_once __DIR__ . '/DBconnect.php';
function getProductsFromDb(): array {
    $db = DBconnect();
    $sql =
        'SELECT products.name as name,
        brands.name as brand,
        products.img_path,
        products.description,
        products.cost FROM products
        INNER JOIN brands ON products.id_brand = brands.id WHERE 1=1';
    $arBinds = [];
    if (count($_GET) > 0) {
        if(!empty($_GET['id_brand']) && intval($_GET['id_brand'])) {
            $sql .= " AND products.id_brand = :id_brand";
            $arBinds['id_brand'] = $_GET['id_brand'];
        }
        if(!empty($_GET['name'])) {
            $sql .= " AND products.name LIKE :name";
            $arBinds['name'] = '%' . $_GET['name'] . '%';
        }
        if(!empty($_GET['cost']) && intval($_GET['cost'])) {
            $sql .= " AND cost = :cost";
            $arBinds['cost'] = $_GET['cost'];
        }
        if(!empty($_GET['description'])) {
            $sql .= " AND description LIKE :description";
            $arBinds['description'] = '%' . $_GET['description'] . '%';
        }
    }
    $sql .= ' ORDER BY products.id';
    $stmt = $db->prepare($sql);
    $stmt->execute($arBinds);
    return $stmt->fetchAll();
}
function getBrandsFromDb(): array {
    $db = DBconnect();
    $sql = 'SELECT * FROM brands';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $brands = $stmt->fetchAll();
    return $brands;
}
function getValuesFromGET(): array
{
    $defaultValues = [
        'cost' => '',
        'name' => '',
        'description' => ''
    ];
    foreach ($_GET as $key => $value) {
        $defaultValues[$key] = htmlspecialchars($value);
    }
    return $defaultValues;
}