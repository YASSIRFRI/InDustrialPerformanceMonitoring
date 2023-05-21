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
$envFilePath = __DIR__ . '/.env';
$envContents = file_get_contents($envFilePath);
$lines = explode("\n", $envContents);
$adminUsername = null;

foreach ($lines as $line) {
    $line = trim($line);
    if (!empty($line) && strpos($line, 'adminuser=') === 0) {
        $adminUsername = substr($line, strlen('adminuser='));
        break;
    }
}
try {
    $connexion = new PDO($dsn, $user, $pass, $options);
    if ($_SESSION['username'] == $adminUsername) {
        $_SESSION['admin'] = true;
        header("Location: views/AdminDashboard.php");
    } else {
        try{

            $query = "SHOW GRANTS FOR '$user'@'localhost'";
            $stmt = $connexion->query($query);
        } catch (PDOException $e) {
            $query = "SHOW GRANTS FOR '$user'@'%'";
            $stmt = $connexion->query($query);
        }
        if ($stmt) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                $grants = $row["Grants for $user@%"]; // Adjust the column name based on the actual output
                $keywords = ['delete', 'insert', 'select'];
                foreach ($keywords as $keyword) {
                    if (stripos(strtolower($grants), $keyword) !== false) {
                        $_SESSION[$keyword] = true;
                    } else {
                        $_SESSION[$keyword] = false;
                    }
                }
            }  
        }
        header("Location: views/UserDashboard.php");
    }
} catch (PDOException $e) {
    session_destroy();
    echo "Connection failed: " . $e->getMessage();
    header("Location: ./views/Login.php");
}

?>
