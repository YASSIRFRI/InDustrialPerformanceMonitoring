<?php
session_start();
if(!($_SESSION['admin']))
{
    header("Location: ./Login.php");
}
include "./connexion.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel = "stylesheet" href="../../assets/css/Dashboard.css">
    <title>Users</title>
</head>
<body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light ">
                <div class="container">
                    <a class="navbar-brand" href="#">
                        <img src="../images/logo.png"width="45" height="50" class="d-inline-block align-top" alt="">
                    </a>
                    <a class="navbar-brand text12">Industrial Performance Monitor</a>
                    <div class="collapse navbar-collapse" id="navbarText">
                        <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="./AdminDashboard.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="bilan.php">Summary</a>
                        </li>
                        </ul>
                    </div>
                    <div class="modal bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                        </div>
                    </div>
                </div>
            </nav>
        </header>


<?php
try {
    // Retrieve all users
    $usersSql = "SELECT user, host FROM mysql.user WHERE user != '' and user NOT LIKE 'mysql.%'";
    $usersStmt = $connexion->prepare($usersSql);
    $usersStmt->execute();
    $users = $usersStmt->fetchAll(PDO::FETCH_ASSOC);
    $tables = ['Entity', 'Flow', 'Product', 'Entity_Product'];

    // Display the users and their privileges
    echo "<div class='container'>";
    echo "<h2 class='mb-4 p-3 text-success'>Users and Privileges</h2>";
    echo "<table class='table table-striped border border-2'>";
    echo "<thead class='thead-light'><tr><th scope = 'col'>Username</th>";
    foreach ($tables as $table) {
        echo "<th scope = 'col'>$table</th>";
    }
    echo "<th scope = 'col'>Action</th></tr></thead><tbody>";

    foreach ($users as $user) {
        $username = $user['user'];
        $host = $user['host'];

        $grantsSql = "SHOW GRANTS FOR '$username'@'$host'";
        $grantsStmt = $connexion->prepare($grantsSql);
        $grantsStmt->execute();
        $grantsResult = $grantsStmt->fetchAll(PDO::FETCH_ASSOC);
        $privileges = array();
        foreach ($grantsResult as $grant) {
            if (strpos($grant['Grants for '."$username".'@'."$host"],'*.*') !== false) {
                // User has privileges on all tables
                foreach ($tables as $table) {
                    $privileges[$table] = true;
                }
                break; // Exit the loop since all tables have privileges
            } else {
                foreach ($tables as $table) {
                    if (isset($grant['Grants for '."$username".'@'."$host"]) && strpos($grant['Grants for '."$username".'@'."$host"], "`$table`") !== false) {
                        $privileges[$table] = true;
                    }
                }
            }
        }
        echo "<tr><td>$username</td>";
        foreach ($tables as $table) {
            $privilege = isset($privileges[$table]) ? 'Yes' : 'None';
            echo "<td>$privilege</td>";
        }
        $modifyLink = "AddUser.php?username={$user['user']}";
        echo "<td><a href='$modifyLink' class='btn btn-success btn-sm'><i class='fas fa-edit'></i> Modify</a></td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
    echo "<a href='AddUser.php' class='btn btn-danger btn-sm'><i class='fas fa-plus'></i> Add a New User</a>";
    echo "</div>";
} catch (PDOException $e) {
    echo "Error retrieving users and privileges: " . $e->getMessage();
}
?>
</body>
</html>