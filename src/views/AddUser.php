<?php
session_start();
include "./connexion.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    try {

        // Create the SQL statement to create a user
        $createUserSql = "CREATE USER :username@'localhost' IDENTIFIED BY :password";
        $createUserStmt = $connexion->prepare($createUserSql);
        $createUserStmt->execute(['username' => $username, 'password' => $password]);

        // Loop through each table and grant privileges
        $tables = array("entity", "flow", "product", "entity_product");
        foreach ($tables as $table) {
            $privilege = $_POST["privilege_" . $table];
            switch ($privilege) {
                case "insert":
                    $grantSql = "GRANT INSERT ON industrialPerformance." . $table . " TO :username";
                    break;
                case "select":
                    $grantSql = "GRANT SELECT ON industrialPerformance." . $table . " TO :username";
                    break;
                case "delete":
                    $grantSql = "GRANT DELETE ON industrialPerformance." . $table . " TO :username";
                    break;
                default:
                    $grantSql = "";
            }
            if (!empty($grantSql)) {
                $grantStmt = $connexion->prepare($grantSql);
                $grantStmt->bindParam(':username', $username);
                $grantStmt->execute();
            }
        }

        // Display success message
        echo "User created successfully!";
    } catch (PDOException $e) {
        echo "Error creating user: " . $e->getMessage();
    }
}
?>
<!-- HTML form -->
<!DOCTYPE html>
<html>
    <head>
        <title>Table Privileges Form</title>
        <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Inventory Management</title>
        <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
        crossorigin="anonymous"
        />
        <link rel="stylesheet" href="../../assets/css/Dashboard.css" />
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
                            <a class="nav-link" href="./dashboard.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./Users.php">View users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Summary</a>
                        </li>
                        </ul>
                    </div>
                    <button class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-sm">Logout</button>
                    <div class="modal bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header"><h4>Logout <i class="fa fa-lock"></i></h4></div>
                            <div class="modal-body"><i class="fa fa-question-circle"></i> Are you sure you want to log-off?</div>
                            <div class="modal-footer"><a href="login.php" class="btn btn-danger btn-block">Logout</a></div>
                        </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <div class="container">
                <h2 class='p-3 text-success'>Table Privileges Form</h2>
                <form method="POST" action="addUser.php">
                    <div class="form-group w-25 ">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" name="username"
                        <?php 
                        if (isset($_GET["username"]))
                        {
                            echo "value=".$_GET["username"];
                        }
                        else echo "value=''";
                        ; ?>
                        id="username" required>
                    </div>
                    <div class="form-group w-25">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <table class="table table-striped w-75 p-3">
                        <thead>
                            <tr>
                                <th>Table</th>
                                <th>Privilege</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Entity</td>
                                <td>
                                    <select class="form-control w-50" name="privilege_entity" required>
                                        <option value="">Select privilege</option>
                                        <option value="insert">Insert</option>
                                        <option value="select">Select</option>
                                        <option value="delete">Delete</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Flow</td>
                                <td>
                                    <select class="form-control w-50" name="privilege_flow" required>
                                        <option value="">Select privilege</option>
                                        <option value="insert">Insert</option>
                                        <option value="select">Select</option>
                                        <option value="delete">Delete</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Product</td>
                                <td>
                                    <select class="form-control w-50" name="privilege_product" required>
                                        <option value="">Select privilege</option>
                                        <option value="insert">Insert</option>
                                        <option value="select">Select</option>
                                        <option value="delete">Delete</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Entity_Product</td>
                                <td>
                                    <select class="form-control w-50" name="privilege_entity_product" required>
                                        <option value="">Select privilege</option>
                                        <option value="insert">Insert</option>
                                        <option value="select">Select</option>
                                        <option value="delete">Delete</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-success">Create User</button>
                </form>
            </div>
            </main>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
