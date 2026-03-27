<?php
$dsn = "mysql:host=localhost;dbname=webmarket;charset=utf8mb4";
$username = "root";
$password = "";

try {
    $pdo = new PDO($dsn, $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

} catch (PDOException $e){
    die("Ошибка подключения : " . $e->getMessage());
}
?>