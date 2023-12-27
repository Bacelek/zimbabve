<?php
require_once __DIR__ . '/helperFunctions.php';
require_once __DIR__ . '/../DBconnect.php';
require_once __DIR__ . '/tableModule.php';

$id = $_GET['id'];
$name = $_POST['name'];
$id_brand = (int)$_POST['brand'];
$description = $_POST['description'];
$cost = $_POST['cost'];
$image = $_FILES['image']['name'];
//var_dump($image);
//echo empty($image);
$imageName = '';
if (!empty($image)){
    $imageName = time() . '_' . $image;
}
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
if (!empty($image)){
    if ($_FILES['image']['type'] === 'image/jpeg' || $_FILES['image']['type'] === 'image/png'){
        if ($_FILES['image']['size'] < 3*1024*1024){
            $product = new tableModule($db);
            try {
                $updateProduct = $product->updateProduct($id,$name,$id_brand,$description,$cost,$imageName);
            } catch (Exception $e){
                echo $e->getMessage();
            }
            if(empty($e)){
                move_uploaded_file($_FILES['image']['tmp_name'], __DIR__. '/../catalog_images/' . $imageName );
                unlink(__DIR__ . '/../catalog_images/' . $updateProduct['img_path']);
            }
        } else{
            $errors['size'] = 'Размер файла должен быть меньше 3 МБ';
        }
    } else{
        $errors['type'] = 'Формат файла должен быть jpg или png';
    }
} else {
    $product = new tableModule($db);
    try {
        $updateProduct = $product->updateProduct($id,$name,$id_brand,$description,$cost,$imageName);
    } catch (Exception $e){
        echo $e->getMessage();
    }
}



