<?php
require_once __DIR__ . "/helperFunctions.php";
require_once __DIR__ . "/../DBconnect.php";

$from = $_POST['pathToImport'];
$to = __DIR__ . '/../import/file.json';
$ch = curl_init($from);
$fp = fopen($to, 'w+');
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_exec($ch);
curl_close($ch);
fclose($fp);

if (mime_content_type(__DIR__ . '/../import/file.json') === 'application/json'){
    $file = fopen(__DIR__ . '/../import/file.json', 'r');
    $jsonFile = fread($file, filesize(__DIR__ . '/../import/file.json'));
    fclose($file);
    $data = json_decode($jsonFile, true);
    $correctKeys = ["id" =>'id',
                    "img_path"=>'img_path',
                    "name"=>'name',
                    "id_brand"=>'id_brand',
                    "description"=>'description',
                    "cost"=>'cost'];
    $errorsJson = 0;
    foreach ($data as $item){
        foreach ($item as $key=>$value){
            if (!isset($correctKeys[$key])){
                $errorsJson++;
            }
        }
    }
    //echo $errorsJson;
    if ($errorsJson == 0){
        try {
            $DB = DBconnect();
            $dbName = "products_" . time() . "_imported";
            $createTable = "CREATE TABLE $dbName (idInDB INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, id INT(11), img_path VARCHAR(255), name VARCHAR(255), id_brand INT(11), description VARCHAR(255), cost INT(11))";
            $DB -> exec($createTable);

            $sql = "INSERT INTO $dbName (id, img_path, name, id_brand, description, cost) VALUES (:id, :img_path, :name, :id_brand, :description, :cost)";
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
        unlink(__DIR__ . '/../import/file.json');
    } else{
        $error = "Неверный формат json файла";
    }
}
else{
    $error = "Неверный тип файла";
    unlink(__DIR__ . '/../import/file.json');
}