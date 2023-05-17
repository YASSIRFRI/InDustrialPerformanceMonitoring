<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    try {
        // Create the SQL statement to create a user
        $createUserSql = "CREATE USER :username IDENTIFIED BY :password";
        $createUserStmt = $connexion->prepare($createUserSql);
        $createUserStmt->bindParam(':username', $username);
        $createUserStmt->bindParam(':password', $password);
        $createUserStmt->execute();

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
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Table Privileges Form</h2>
        <form method="POST" action="addUser.php">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" name="username" id="username" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>

            <table class="table">
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
                            <select class="form-control" name="privilege_entity" required>
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
                            <select class="form-control" name="privilege_flow" required>
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
                            <select class="form-control" name="privilege_product" required>
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
                            <select class="form-control" name="privilege_entity_product" required>
                                <option value="">Select privilege</option>
                                <option value="insert">Insert</option>
                                <option value="select">Select</option>
                                <option value="delete">Delete</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>

            <button type="submit" class="btn btn-primary">Create User</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
