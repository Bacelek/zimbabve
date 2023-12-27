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