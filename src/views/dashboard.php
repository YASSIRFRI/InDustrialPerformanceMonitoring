<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
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
        <div class = "container">
            <div class = "row">
                <div class ="col-9">
                    <div class="d-flex justify-content-center my-4">
                        <button id="showFlowTableBtn" type="button" class="btn btn-success mx-4">Show Flow Table</button>
                        <button id="showEntityTableBtn" type="button" class="btn btn-success mx-4 ">Show Entity Table</button>
                    </div>
                    <div id="flowTableContainer" class="table-container">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Flow Id</th>
                                    <th scope="col">Entity</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Direction</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                try
                                {

                                $connexion= new PDO('mysql:host=localhost;dbname=industrialPerformance', $_SESSION['username'], $_SESSION['password']);
                                }
                                catch (PDOException $e)
                                {
                                echo 'Erreur : '.$e->getMessage();
                                exit();
                                }
                                $query = "SELECT * FROM flow LIMIT 10";
                                $result = $connexion->query($query);
                                $rows = $result->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($rows as $row) { 
                                ?>
                                <tr>
                                    <td><?php echo $row['fid']; ?></td>
                                    <td><?php echo $row['ename']; ?></td>
                                    <td><?php echo $row['pname']; ?></td>
                                    <td><?php echo $row['direction']; ?></td>
                                    <td><?php echo $row['quantity']; ?></td>
                                    <td><a href='$modifyLink' class='btn btn-success btn-sm'><i class='fas fa-edit'></i> Modify</a></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div  id="entityTableContainer" class="table-container" style="display: none;">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Entity</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Group Out</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Site</th>
                                    <th scope="col">Phase</th>
                                    <th scope="col">Nature</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT e.ename, p.pname, g.gname, f.quantity, s.sname, p.phase, p.nature
                                        FROM Flow f
                                        INNER JOIN Entity e ON f.ename = e.ename
                                        INNER JOIN Product p ON f.pname = p.pname
                                        INNER JOIN Site s ON e.sname = s.sname
                                        INNER JOIN `Group` g ON p.gname = g.gname
                                        LIMIT 10";
                                $result = $connexion->query($query);
                                $rows = $result->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($rows as $row) { 
                                ?>
                                <tr>
                                    <td><?php echo $row['ename']; ?></td>
                                    <td><?php echo $row['pname']; ?></td>
                                    <td><?php echo $row['gname']; ?></td>
                                    <td><?php echo $row['quantity']; ?></td>
                                    <td><?php echo $row['sname']; ?></td>
                                    <td><?php echo $row['phase']; ?></td>
                                    <td><?php echo $row['nature']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class = "col-3">
                    <div class="col-lg-3 sidebar align-items-center">
                        <div class="card mb-3" style="width: 18rem;">
                            <div class="card-header center">
                                <ul class="nav nav-pills card-header-pills center">
                                    <li class="nav-item">
                                    <a class="nav-link cardinfo" href="#" onclick="showContent('content1')">Import Data</a>
                                    </li>
                                    <li class="nav-item">
                                    <a class="nav-link cardinfo" href="#" onclick="showContent('content2')">Export Data</a>
                                    </li>
                                </ul>
                            </div>
                            <div id="content1" class="card-body hide" >
                                <p class="card-text">Import Data in Excel Format</p>
                                <form>
                                    <div class="input-group m-1 p-2" id="fileInput">
                                        <div class="input-group-prepend">
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="inputGroupFile01"aria-describedby="inputGroupFileAddon01">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            
                            <div id="content2" class="card-body hide" style="display: none;">
                                <p class="card-text">Export Data</p>
                            </div>
                        </div>
                        <div class="card mb-3" style="width: 18rem;">
                                <div class="card-header center">Entities Inventory</div>
                                <div class="card-body">
                                    <h5 class="card-title"></h5>
                                    <h6 class="card-subtitle mb-2 text-muted">Entity</h6>
                                    <p class="card-text">To add, you need to provide the entity name, product name, and quantity</p>
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addInfoModal">Add Info</button>
                                </div>
                        </div>
                        <div class="card mb-3" style="width: 18rem;">
                                <div class="card-header center">Current Flows </div>
                                <div class="card-body">
                                    <h5 class="card-title"></h5>
                                    <h6 class="card-subtitle mb-2 text-muted">Flows</h6>
                                    <p class="card-text">To add, you need to provide the entity name, product name, quantity and the direction</p>
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">Add Info</button>
                                </div>
                        </div>
                        <div class="modal fade" id="addInfoModal" tabindex="-1"  aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Info</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form" method="DataController.php">
                                        <div class="mb-3 d-flex justify-content-center">
                                            <label class="form-label m-1">
                                            Entity Name:
                                            <input id="entity" class="form-control" name="entity" type="text" required />
                                            </label>
                                            <label class="form-label m-1">
                                            Product Name:
                                            <input id="outgoing_order_product_brand" name="product"class="form-control" type="text" required />
                                            </label>
                                            <label class="form-label m-1">
                                            Quantity:
                                            <input id="outgoing_order_product_quantity" name="quantity" class="form-control" type="number" required />
                                            </label>
                                        </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-success" >Add</button>
                                    </div>
                                    </div>
                            </div>
                        </div>
                        <div class="modal fade" id="addModal" tabindex="-1"  aria-hidden="true">
                            <div class="modal-dialog modal-lg ">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Info</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form">
                                            <div class="mb-3 d-flex justify-content-center">
                                                <label class="form-label m-1">
                                                Entity Name:
                                                <input id="outgoing_order_product_name" class="form-control" type="text" required />
                                                </label>
                                                <label class="form-label m-1">
                                                Product Name:
                                                <input id="outgoing_order_product_brand" class="form-control" type="text" required />
                                                </label>
                                                <label class="form-label m-1">
                                                Quantity:
                                                <input id="outgoing_order_product_quantity" class="form-control" type="number" required />
                                                </label>
                                                <label class="form-label">
                                                    <div class="w-100">
                                                        Direction:
                                                    </div>
                                                    <div class="form-check d-flex ">
                                                        <div class="m-1 px-2">
                                                            <input id="current_order_product_direction_in" class="form-check-input" type="radio" name="direction" value="in" required />
                                                            <label class="form-check-label" for="current_order_product_direction_in">In</label>
                                                        </div>
                                                        <div class="m-1 px-4">
                                                            <input id="current_order_product_direction_out" class="form-check-input" type="radio" name="direction" value="out" require />
                                                            <label class="form-check-label" for="current_order_product_direction_out">Out</label>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-success" onclick="addCurrentInventory()" >Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"crossorigin="anonymous"></script>
    <script>
      function showContent(contentId) {
        // Hide all content divs
        var contentDivs = document.querySelectorAll('.hide');
        contentDivs.forEach(function(div) {
          div.style.display = 'none';
        });
        
        // Show the selected content div
        var selectedContent = document.getElementById(contentId);
        if (selectedContent) {
          selectedContent.style.display = 'block';
        }
      }

        $(document).ready(function() {
        // Button click event for showing Flow Table
        $('#showFlowTableBtn').click(function() {
            $('#flowTableContainer').show();
            $('#entityTableContainer').hide();
        });

        // Button click event for showing Entity Table
        $('#showEntityTableBtn').click(function() {
            $('#flowTableContainer').hide();
            $('#entityTableContainer').show();
        });
        });

    </script>
    </body>
</html>