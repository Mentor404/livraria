<?php

$localhost = "localhost";
$user = "root";
$pass = "mentor";
$dbname = "livrariaV2";
$port = 3306;

try {
    $pdo = new PDO("mysql:host=$localhost;port=$port;dbname=". $dbname, $user, $pass);
//    echo "Connected to database successfully";
} catch (PDOException $e) {
    echo $e->getMessage();
}