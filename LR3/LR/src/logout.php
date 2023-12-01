<?php
require_once __DIR__ . '/helperFunctions.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    unset($_SESSION['user']['id']);
    redirect('../login.php');
}
else{
    redirect('../login.php');
}
