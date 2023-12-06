<?php
//print_r($_POST);
require_once __DIR__ . '/helperFunctions.php';

require_once __DIR__ . '/../DBconnect.php';

$email = $_POST['email'];
$birthDate = $_POST['birthDate'];
$address = $_POST['address'];
$interests = $_POST['interests'];
$linkVK = $_POST['linkVK'];
$password = $_POST['password'];
$passwordConfirm = $_POST['passwordConfirm'];
$gender = $_POST['gender'];
$bloodType = $_POST['bloodType'];
$RHfactor = $_POST['RHfactor'];

$_SESSION['validation'] = [];



if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    addValidationError('email','Неправильный формат');
}
if (checkEmail($email)){
    addValidationError('email', 'Данный email уже используется');
}
if (empty($birthDate)) {
    addValidationError('birthDate','Пункт не заполнен');
}
if (empty($address)) {
    addValidationError('address','Пункт не заполнен');
}
if (empty($interests)) {
    addValidationError('interests','Пункт не заполнен');
}
if (!filter_var($linkVK, FILTER_VALIDATE_URL)) {
    addValidationError('linkVK','Неправильный формат');
}
if (empty($password)) {
    addValidationError('password','Пункт не заполнен');
}
if ($password != $passwordConfirm){
    addValidationError('password','Пароли не совпадают');
}
$regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()+,])(?=.*[-])(?=.*[_])(?=.*[ ])[a-zA-Z\d!@#$%^&*()+,\-_\s]{6,}$/';

if (!preg_match($regex, $password)){
    addValidationError('password','Пароль должен быть длиннее 6 символов, иметь хотя бы 1 большую латинскую бувку, хотя бы 1 маленькую, спецсимвол, пробел, дефис, хотя бы 1 цифру');
}
//print_r($_SESSION['validation']);
//print_r($_SESSION['oldValues']);
if (!empty($_SESSION['validation'])) {
    addOldValues('email',$email);
    addOldValues('birthDate',$birthDate);
    addOldValues('address',$address);
    addOldValues('interests',$interests);
    addOldValues('linkVK',$linkVK);
    addOldValues('gender',$gender);
    addOldValues('bloodType',$bloodType);
    addOldValues('RHfactor',$RHfactor);
    redirect('../register.php');
}

clearOldValues();
clearValidation();
$DB = DBconnect();
$query = "INSERT INTO users (email, birthDate, address, gender, interests, linkVK, bloodType, RHfactor, password) VALUES (:email, :birthDate, :address, :gender, :interests, :linkVK, :bloodType, :RHfactor, :password)";
$params = [
    'email' =>$email,
    'birthDate' => $birthDate,
    'address' => $address,
    'gender' => $gender,
    'interests' =>$interests,
    'linkVK' => $linkVK,
    'bloodType' => $bloodType,
    'RHfactor' => $RHfactor,
    'password' => password_hash($password,PASSWORD_DEFAULT)
];
$stmt = $DB ->prepare($query);
try {
    $stmt -> execute($params);
} catch (\Exception $e){
    die($e->getMessage());
}

redirect('../login.php');