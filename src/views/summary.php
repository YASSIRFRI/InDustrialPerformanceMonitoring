<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bilan</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="../../assets/css/Dashboard.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
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
                            <a class="nav-link" href="./Users.php">View users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Monthly report</a>
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
          <form id="bilan" method="POST" action="bilan.php">
          <h3 class="text-center text-success">Monthly report</h3>
          <div class="m-2">
              <label for="entity" class ="col-1">Entity name</label>
              <input type="text" name="entity" placeholder="Entity" required>
          </div>
          <div class="m-2">
            <label for="selectedMonth" class ="col-1">Date</label>
            <input name="selectedMonth" type="month" min="2022-01" max="<?php echo date('Y-m'); ?>" required>
          </div>
          <div class="m-2">
            <label for="sortby" class ="col-1">Sort By:</label>
            <select name="sortby" id="sortby">
                <option value="product_name_asc">By Product Name ASC</option>
                <option value="product_name_desc">By Product Name DESC</option>
                <option value="total_quantity_asc">By Total Quantity ASC</option>
                <option value="total_quantity_desc">By Total Quantity DESC</option>
            </select>
          </div>
            <button type="submit"class ="btn btn-success">Monthly report</button>
            <div class="m-2">
              <input type="checkbox" name="compare" id="compare" onchange="toggleInput()">
              <label for="compare" class ="col-1">Compare with: </label>
              <input name="compareMonth" id="compareMonth" type="month" min="2022-01" max="<?php echo date('Y-m'); ?>" disabled>
            </div>
          </form>
        <script>
            function toggleInput() {
            var checkbox = document.getElementById('compare');
            var input = document.getElementById('compareMonth');

            if (checkbox.checked) {
                input.disabled = false;
                input.required = true;
            } else {
                input.disabled = true;
                input.required = false;
            }
            }
        </script>

          <div class="container">

          <div class="d-flex">
              <div style="width:400px;margin-right: 10px;"   id="consumedProduct"></div>
              <div  style="width:400px;" id="consumedProductComp"></div>
          </div>


          
                <div class="d-flex">
                      <div style="width:400px;margin-right: 10px;" id="producedProduct"></div>
                      <div style="width:400px;"  id="producedProductComp"></div>
              </div>
                     
                <div class="d-flex">
                      <div style="width:400px; margin-right: 10px;"   id="tableContainer"></div>
                      <div style="width:400px;" id="tableContainerComp"></div>
              </div>
              
        </div>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


          <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
          <script>
              $(document).ready(function() {
                  $('#bilan').submit(function(event) {
                      event.preventDefault(); 
                      
                      var formData = $(this).serialize();

                      $.ajax({
                      url: 'bilan.php',
                      type: 'POST',
                      data: formData,
                      dataType: 'json',
                      success: function(response) {
                          $('#tableContainer').html(response.tableData);
                          $('#consumedProduct').html(response.cons);
                          $('#producedProduct').html(response.prod);

                          $('#tableContainerComp').html(response.tableDataComp);
                          $('#consumedProductComp').html(response.consComp);
                          $('#producedProductComp').html(response.prodComp);
                      }
                      });
                  });
                  });
          </script>
        </div>
    </main>
</body>
</html>