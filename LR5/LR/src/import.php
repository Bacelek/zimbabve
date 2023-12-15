<?php
require_once __DIR__ . "/helperFunctions.php";
require_once __DIR__ . "/../DBconnect.php";

$from = $_POST['pathToImport'];
$to = __DIR__ . '/../import/file.json';
$ch = curl_init($from);
$fp = fopen($to, 'w+');
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_exec($ch);
curl_close($ch);
fclose($fp);

//if (mime_content_type(__DIR__ . '/../import/file.json') === 'application/json'){
    $file = fopen(__DIR__ . '/../upload/12345.json', 'r');
    $jsonFile = fread($file, filesize(__DIR__ . '/../upload/12345.json'));
    fclose($file);
    $data = json_decode($jsonFile, true);
    $firstElement = reset($data);
try {
    $DB = DBconnect();
    $dbName = "products_" . time() . "_imported";
    $createTable = "CREATE TABLE $dbName (idInDB INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY";
    foreach ($firstElement as $key => $value){
        if(is_numeric($value)){
            $createTable .= ", " . $key . " INT(11)";
        }
        else{
            $createTable .= ", " . $key . " VARCHAR(255)";
        }
    }
    $createTable .= ")";
    $DB -> exec($createTable);

    $sql = "INSERT INTO $dbName (";
    foreach ($firstElement as $key => $value){
        $sql .= "" . $key . ",";
    }
    $sql = substr($sql,0,-1);
    $sql .= ") VALUES (";
    foreach ($firstElement as $key => $value){
        $sql .=":" . $key . ",";
    }
    $sql = substr($sql,0,-1);
    $sql .= ")";
    $stmt = $DB->prepare($sql);
    $count = 0;
    foreach ($data as $item) {
        foreach ($item as $key => $value) {
            $key = ":$key";
        }
        if ($stmt->execute($item)){
            $count ++;
        }
    }
} catch(PDOException $e) {
    echo $e -> getMessage();
}
//}
//else{
//    $error = "Неверный тип файла";
//    unlink(__DIR__ . '/../import/file.json');
//}