<?php
// Check if the username is provided as a GET parameter
session_start();
if(!($_SESSION['admin']))
{
    header('Location: ./Login.php');
}
include "../views/connexion.php";
if (isset($_GET["username"])) {
    // Retrieve the username from the GET parameter
    $usernameToDelete = $_GET["username"];
    try {
        $userExistsSql = "SELECT EXISTS(SELECT 1 FROM mysql.user WHERE User = ?) AS user_exists";
        $userExistsStmt = $connexion->prepare($userExistsSql);
        $userExistsStmt->execute([$usernameToDelete]);
        $userExists = $userExistsStmt->fetchColumn();
        if ($userExists) {
            // User exists, delete the user
            $deleteUserSql = "DROP USER '" . $usernameToDelete . "'@'localhost'";
            $deleteUserStmt = $connexion->prepare($deleteUserSql);
            $deleteUserStmt->execute();
            header("Location: ./Users.php");
        } else {
            echo "User not found.";

        }
    } catch (PDOException $e) {
        try{

                $deleteUserSql = "DROP USER '" . $usernameToDelete . "'@'%'";
                $deleteUserStmt = $connexion->prepare($deleteUserSql);
                $deleteUserStmt->execute();
                header("Location: ./Users.php");
        }
        catch(PDOException $e){
            header("Location: ./Users.php?error=1");
        }
    }
} else {
    // No username provided
    echo "Please provide a username.";
}
?>
