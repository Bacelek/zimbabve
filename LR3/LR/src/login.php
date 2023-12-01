<?php
require_once __DIR__ . '/helperFunctions.php';
require_once __DIR__ . '/../DBconnect.php';

$email = $_POST['email'];
$password = $_POST['password'];

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
    addValidationError('email', 'Неправильный формат');
    redirect('../login.php');
}

$user = checkEmail($email);

if (!$user){
    addValidationError('email','Пользователь не обнаружен');
}

if ($user && !password_verify($password,$user['password'])){
    addValidationError('password','Неверный пароль');
}
if (!empty($_SESSION['validation'])){
    addOldValues('email',$email);
    redirect('../login.php');
}
clearOldValues();
clearValidation();

$_SESSION['user']['id'] = $user['id'];

redirect('../products.php');