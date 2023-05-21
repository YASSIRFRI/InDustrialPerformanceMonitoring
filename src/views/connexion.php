<?php

$dsn = 'mysql:host=localhost;dbname=industrialperformance';
$user= $_SESSION['username'];
$pass= $_SESSION['password'];
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false,
  ];

try {
    $connexion = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>