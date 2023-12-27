<?php
require_once __DIR__ . '/helperFunctions.php';
require_once __DIR__ . '/../DBconnect.php';
require_once __DIR__ . '/tableModule.php';

$name = $_POST['name'];
$id_brand = (int)$_POST['brand'];
$description = $_POST['description'];
$cost = $_POST['cost'];
$image = $_FILES['image']['name'];
$imageName = time() . '_' . $image;
$errors = [];
$db = DBconnect();
if (empty($name)){
    $errors['name'] = 'Имя не должно быть пустым';
}
if (empty($cost)){
    $errors['cost'] = 'Цена не должна быть пустой';
}
if (!is_numeric($cost)){
    $errors['costInt'] = 'Цена должна быть цифрой';
}
if ($_FILES['image']['type'] === 'image/jpeg' || $_FILES['image']['type'] === 'image/png'){
    if ($_FILES['image']['size'] < 3*1024*1024){
        $addProduct = new tableModule($db);
        $product = $addProduct->addProduct($name,$id_brand,$description,$cost,$imageName);
        if(empty($product)){
            move_uploaded_file($_FILES['image']['tmp_name'], __DIR__. '/../catalog_images/' . $imageName );
        }
    } else{
        $errors['size'] = 'Размер файла должен быть меньше 3 МБ';
    }
} else{
    $errors['type'] = 'Формат файла должен быть jpg или png';
}

