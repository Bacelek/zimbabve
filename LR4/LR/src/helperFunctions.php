<?php
session_start();
require_once __DIR__ . '/../DBconnect.php';
ini_set('display_errors', 'E_ERROR');
function redirect(string $pageName) {
    header("Location: $pageName");
    die();
}

function addValidationError(string $fieldName, string $errorMessage) {
    $_SESSION['validation'][$fieldName] = $errorMessage;
}
function getValidationMessage(string $fieldName) {
    echo $_SESSION['validation'][$fieldName] ?? '';
}
function clearValidation() {
    $_SESSION['validation'] = [];
}
function addOldValues(string $key, mixed $value) {
    $_SESSION['oldValues'][$key] = $value;
}
function getOldValues(string $key){
    echo $_SESSION['oldValues'][$key] ?? '';
}
function getOldOption(string $key, string $value){
        if ($_SESSION['oldValues'][$key] == $value) {
            return 'selected';
        }
        else{
            return null;
        }
}
function clearOldValues(){
    $_SESSION['oldValues'] = [];
}
function checkEmail(string $email): array|bool{
    $DB = DBconnect();
    $stmt = $DB ->prepare("SELECT * FROM users WHERE email = :email");
    $stmt -> execute(['email' => $email]);
    return $stmt -> fetch();
}
function checkUser(): array|false{
    $DB = DBconnect();
    if (!isset($_SESSION['user'])){
        return false;
    }

    $userID = $_SESSION['user']['id'] ?? null;
    $stmt = $DB ->prepare("SELECT * FROM users WHERE id = :id");
    $stmt -> execute(['id' => $userID]);
    return $stmt -> fetch(PDO::FETCH_ASSOC);
}
function checkAuth(){

    if(!isset($_SESSION['user']['id'])){
        redirect('login.php');
    }
}
function checkGuest(){
    if (isset($_SESSION['user']['id'])){
        redirect('products.php');
    }
}
function authBlock(){
    if (isset($_SESSION['user']['id'])){
        return true;
    }
    else{
        return false;
    }
}

function getImages($dom): array|null{
    $imagesArr = [];
    $images = $dom->getElementsByTagName('img');
    foreach ($images as $image) {
        $temp = $image->getAttribute('src');
        $imagesArr[] = $temp;
    }
    return $imagesArr;
}
function replace($dom){
    $text = $dom->textContent;
    $pattern = ['/!{4,}/','/\?{4,}/','/\.{4,}/'];
    $replacement = ['!!!','???','…'];
    $replacedText = preg_replace($pattern,$replacement,$text);

    if ($replacedText != $text){
        return $replacedText;
    } else{
        return null;
    }
}
function findTables($dom)
{
    $tables = $dom->getElementsByTagName('table');
    $tableIndex = 1;
    $tableContent = [];
    $tablesData = [];
    foreach ($tables as $table) {
        $thElements = $table->getElementsByTagName('th');

        if ($thElements->length > 0) {
            $firstTableElement = $thElements->item(0)->textContent;
        } else {
            $tdElements = $table->getElementsByTagName('td');
            if ($tdElements->length > 0) {
                $firstTableElement = $tdElements->item(0)->textContent;
            }
        }
        $tableHeaders = [];

        $headerRow = $table->getElementsByTagName('tr')->item(0);

        foreach ($headerRow->getElementsByTagName('th') as $headerCell) {
            $tableHeaders[] =  $headerCell->textContent;
        }

        $tableData[] = $tableHeaders;

        foreach ($table->getElementsByTagName('tr') as $row) {
            $rowData = [];
            foreach ($row->getElementsByTagName('td') as $cell) {
                $rowData[] = $cell->textContent;
            }
            $tableData[] = $rowData;
        }
        $tablesData[$tableIndex] = $tableData;

        $tableContent[$tableIndex] = $firstTableElement;
        $table->setAttribute('id', 'table' . $tableIndex);
        $tableIndex++;
    }
    return   ['content' => $tableContent, 'tables' => $tablesData];
}
function replacePick($dom){
    $text = $dom->textContent;
    $arrayWords = ['пух','рот','делать','ехать','около','для',];
    $i = 0;
    foreach ($arrayWords as $patterns){
        $pattern[$i] = "/\b$patterns/ui";
        $replacement[$i] = str_repeat('#',iconv_strlen($patterns));
        $i++;
    }
    return preg_replace($pattern,$replacement,$text);
}