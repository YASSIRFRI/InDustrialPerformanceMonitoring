<?php
session_start();
$dsn = 'mysql:host=localhost;dbname=industrialPerformance';


$user = $_POST['username'];
$pass = $_POST['password'];
$_SESSION['username'] = $user;
$_SESSION['password'] = $pass;
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false,
  ];
  $connexion = new PDO($dsn, $user, $pass, $options);
// try {
   
//     header("Location: dashboard.php");
// } catch (PDOException $e) {
//     echo "Connection failed: " . $e->getMessage();
// }
?>