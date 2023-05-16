<?php
$dsn = 'mysql:host=localhost;dbname=industrialPerformance';
$user = 'yassir';
$pass = 'password';
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
?>