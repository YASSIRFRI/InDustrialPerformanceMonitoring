<?php
// Check if the username is provided as a GET parameter
session_start();
var_dump($_SESSION['admin']);
if(!($_SESSION['admin']))
{
    //header('Location: ./Login.php');
}
include "../views/connexion.php";
if (isset($_GET["username"])) {
    // Retrieve the username from the GET parameter
    $usernameToDelete = $_GET["username"];
    //try {
        $userExistsSql = "SELECT EXISTS(SELECT 1 FROM mysql.user WHERE User = ?) AS user_exists";
        $userExistsStmt = $connexion->prepare($userExistsSql);
        $userExistsStmt->execute([$usernameToDelete]);
        $userExists = $userExistsStmt->fetchColumn();
        if ($userExists) {
            // User exists, delete the user
            $deleteUserSql = "DROP USER ?@'localhost'";
            $deleteUserStmt = $connexion->prepare($deleteUserSql);
            $deleteUserStmt->execute([$usernameToDelete]);
            echo "User deleted successfully!";
        } else {
            echo "User not found.";
        }
    //} catch (PDOException $e) {
        header("Location: ./Users.php?error=1");
    //}
} else {
    // No username provided
    echo "Please provide a username.";
}
?>
