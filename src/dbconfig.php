<?php


$dsn = 'mysql:host=localhost;dbname=industrialPerformance';
$user = $_POST["username"];
$pass = $_POST["password"];
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false,
  ];
try {
    $connexion = new PDO($dsn, $user, $pass, $options);
    header("Location: ./views/LoginController.php");
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>