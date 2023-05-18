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

try {
    $connexion = new PDO($dsn, $user, $pass, $options);

    if($_SESSION['username'] == 'yassir'){
        header("Location: views/dashboard.php");
    }
    else{
        $username = $_SESSION['username']; 
        $query = "SHOW GRANTS FOR '$username'@'%'";
        $stmt = $connexion->query($query);

        if ($stmt) {
            $privileges = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $grants = $row["Grants for $username@%"]; // Adjust the column name based on the actual output
                $privileges[] = $grants;
            }
            
            $_SESSION["user_privileges"] = $privileges;
            var_dump($_SESSION["user_privileges"]);
        } else {
            echo "Error retrieving user privileges: " . $connexion->errorInfo()[2];
        }
        header("Location: views/UserDashboard.php");
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>