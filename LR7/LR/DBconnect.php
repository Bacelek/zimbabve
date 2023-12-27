<?php
function DBconnect(): PDO
{
    try {
        return new PDO('mysql:host=localhost;dbname=products', 'root');
    } catch (PDOException $e) {
        echo $e->getMessage();
        die;
    }
}