<?php
require_once __DIR__ . "/helperFunctions.php";
require_once __DIR__ . "/../DBconnect.php";

$db = DBconnect();
if(preg_match('/^\/LR\/upload\/.*\.json$/',$_POST['pathToSave']) && !str_contains($_POST['pathToSave'],'..')){

    $sql = "SELECT * FROM products";
    $stmt = $db->query($sql);
    $data = $stmt->fetchALL(PDO::FETCH_ASSOC);
    $json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
    var_dump($json);
    file_put_contents("upload/".basename($_POST['pathToSave']),$json);

}
else{
    $error = "Введена неправильная ссылка2";
}
