<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="../../assets/js/Dashboard.js"></script>
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
        <!-- <div class="container-fluid">
          <a class="navbar-brand" href="#">Industrial Performance Monitor</a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                  <li class="nav-item">
                 <a class="nav-link" href="../controllers/LoginController.php?logout=ok">Logout</a>
                  </li>
            </ul>
          </div>
        </div> -->
        <!-- <div class = "container">
          <a class="navbar-brand text12" href="#">
            <img src="../images/logo.png"width="45" height="50" class="d-inline-block align-top" alt="">
           
          </a>
          <a class="navbar-brand text12">Industrial Performance Monitor</a>
          
        </div> -->


        <nav class="navbar navbar-expand-lg navbar-light bg-light ">
          <div class="container">
            <a class="navbar-brand" href="#">
            <img src="../images/logo.png"width="45" height="50" class="d-inline-block align-top" alt="">
          </a>
          <a class="navbar-brand text12">Industrial Performance Monitor</a>
          <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">View users</a>
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
                <div class="modal-footer"><a href="login.php" class="btn btn-success btn-block">Logout</a></div>
              </div>
            </div>
          </div>
          </div>
        </nav>
    </header>
    <main>
      <div class = "row">
        <div class ="col-18">
        <div class="container-fluid">
      <div class="row">
        <div class="col-lg-9">
          <div class="container">
        <div class="tabs">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button
                class="nav-link active"
                id="home-tab"
                data-bs-toggle="tab"
                data-bs-target="#home-tab-pane"
                type="button"
                role="tab"
                aria-controls="home-tab-pane"
                aria-selected="true"
              >
               Flows
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button
                class="nav-link"
                id="contact-tab"
                data-bs-toggle="tab"
                data-bs-target="#contact-tab-pane"
                type="button"
                role="tab"
                aria-controls="contact-tab-pane"
                aria-selected="false"
              >
              Entities
              </button>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div
              class="tab-pane fade show active"
              id="home-tab-pane"
              role="tabpanel"
              aria-labelledby="home-tab"
              tabindex="0"
            >
              <div class="heading">
                <h4>Current Flows</h4>
              </div>
              <div class="add-item">
  <form class="form">
    <div class="mb-3 d-flex justify-content-around">
      <label class="form-label">
        Entity Name:
        <input id="current_order_product_name" class="form-control" type="text" required />
      </label>
      <label class="form-label">
        Product Name:
        <input id="current_order_product_brand" class="form-control" type="text" required />
      </label>
      <label class="form-label">
        Quantity:
        <input id="current_order_product_quantity" class="form-control" type="number" required />
      </label>
      <label class="form-label">
        <div class="w-100">
            Direction:
        </div>
        <div class="form-check d-flex ">
            <div class="m-1 px-2">
          <input
            id="current_order_product_direction_in"
            class="form-check-input"
            type="radio"
            name="direction"
            value="in"
            required
          />
          <label class="form-check-label" for="current_order_product_direction_in">In</label>
            </div>
            <div class="m-1 px-4">
          <input
            id="current_order_product_direction_out"
            class="form-check-input"
            type="radio"
            name="direction"
            value="out"
            required
          />
          <label class="form-check-label" for="current_order_product_direction_out">Out</label>
        </div>
        </div>
      </label>
    </div>
    <div class="mb-3">
      <button class="btn btn-success" onclick="addCurrentInventory()" type="button">Add</button>
    </div>
  </form>
</div>
<table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Flow Id</th>
                    <th scope="col">Entity</th>
                    <th scope="col">Product</th>
                    <th scope="col">Direction</th>
                    <th scope="col">Quantity</th>
                  </tr>
                </thead>
                <tbody id="current_inventory_list">
                  <tr>
                  </tr>
                  <tr>
                  </tr>
                  <tr>
                  </tr>
                </tbody>
              </table>
              </div>
           
            </div>
            <div
              class="tab-pane fade"
              id="contact-tab-pane"
              role="tabpanel"
              aria-labelledby="contact-tab"
              tabindex="0"
            >
              <div class="heading">
                <h4>Entities Inventory</h4>
              </div>
              <div class="add-item">
  <form class="form">
    <div class="mb-3 d-flex justify-content-center">
      <label class="form-label m-1">
        Entity Name:
        <input
          id="outgoing_order_product_name"
          class="form-control"
          type="text"
          required
        />
      </label>
      <label class="form-label m-1">
        Product Name:
        <input
          id="outgoing_order_product_brand"
          class="form-control"
          type="text"
          required
        />
      </label>
      <label class="form-label m-1 ">
        Quantity:
        <input
          id="outgoing_order_product_quantity"
          class="form-control"
          type="number"
          required
        />
      </label>
    </div>
    <div class="mb-3 d-flex justify-content-center">
      <button class="btn btn-success" onclick="addOutgoingOrder()" type="button">Add</button>
    </div>
  </form>
</div>
                <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Entity</th>
                    <th scope="col">Product</th>
                    <th scope="col">Group Out</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Site</th>
                    <th scope="col">Phase</th>
                    <th scope="col">Nature</th>
                  </tr>
                </thead>
                <tbody id="outgoing_inventory_list">
                  <tr>
                  </tr>
                  <tr>
                  </tr>
                  <tr>
                  </tr>
                </tbody>
              </table>
              </div>
             
            </div>
          </div>
        </div>
      </div>
        </div>
        </div>

      </div>
      <div>
        
      </div>
      <div>
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
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addInfoModal">Add Info</button>

          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addInfoModal" tabindex="-1"  aria-hidden="true">
          <div class="modal-dialog">
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
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save Changes</button>
              </div>
            </div>
          </div>
        </div>

      </div>
      <!-- First Modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal1">Open Modal 1</button>

<div class="modal fade" id="modal1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal 1 Title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>This is the content of Modal 1.</p>
        <p>You can add any HTML content, forms, images, etc., inside this modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Second Modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal2">Open Modal 2</button>

<div class="modal fade" id="modal2">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal 2 Title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>This is the content of Modal 2.</p>
        <p>You can customize this modal with different content and styles.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

        </div>
        </div>
        </div>
      </div>
      </div>
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
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addInfoModal">Add Info</button>

          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addInfoModal" tabindex="-1"  aria-hidden="true">
          <div class="modal-dialog">
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
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save Changes</button>
              </div>
            </div>
          </div>
        </div>

      </div>
      <!-- First Modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal1">Open Modal 1</button>

<div class="modal fade" id="modal1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal 1 Title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>This is the content of Modal 1.</p>
        <p>You can add any HTML content, forms, images, etc., inside this modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Second Modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal2">Open Modal 2</button>

<div class="modal fade" id="modal2">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal 2 Title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>This is the content of Modal 2.</p>
        <p>You can customize this modal with different content and styles.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

        </div>
        </div>
        </div>
      </div>
    </div>
      <!-- <div class="container">
        <div class="tabs">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button
                class="nav-link active"
                id="home-tab"
                data-bs-toggle="tab"
                data-bs-target="#home-tab-pane"
                type="button"
                role="tab"
                aria-controls="home-tab-pane"
                aria-selected="true"
              >
               Flows
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button
                class="nav-link"
                id="contact-tab"
                data-bs-toggle="tab"
                data-bs-target="#contact-tab-pane"
                type="button"
                role="tab"
                aria-controls="contact-tab-pane"
                aria-selected="false"
              >
              Entities
              </button>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div
              class="tab-pane fade show active"
              id="home-tab-pane"
              role="tabpanel"
              aria-labelledby="home-tab"
              tabindex="0"
            >
              <div class="heading">
                <h4>Current Flows</h4>
              </div>
              <div class="add-item">
  <form class="form">
    <div class="mb-3 d-flex justify-content-around">
      <label class="form-label">
        Entity Name:
        <input id="current_order_product_name" class="form-control" type="text" required />
      </label>
      <label class="form-label">
        Product Name:
        <input id="current_order_product_brand" class="form-control" type="text" required />
      </label>
      <label class="form-label">
        Quantity:
        <input id="current_order_product_quantity" class="form-control" type="number" required />
      </label>
      <label class="form-label">
        <div class="w-100">
            Direction:
        </div>
        <div class="form-check d-flex ">
            <div class="m-1 px-2">
          <input
            id="current_order_product_direction_in"
            class="form-check-input"
            type="radio"
            name="direction"
            value="in"
            required
          />
          <label class="form-check-label" for="current_order_product_direction_in">In</label>
            </div>
            <div class="m-1 px-4">
          <input
            id="current_order_product_direction_out"
            class="form-check-input"
            type="radio"
            name="direction"
            value="out"
            required
          />
          <label class="form-check-label" for="current_order_product_direction_out">Out</label>
        </div>
        </div>
      </label>
    </div>
    <div class="mb-3">
      <button class="btn btn-success" onclick="addCurrentInventory()" type="button">Add</button>
    </div>
  </form>
</div>
<table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Flow Id</th>
                    <th scope="col">Entity</th>
                    <th scope="col">Product</th>
                    <th scope="col">Direction</th>
                    <th scope="col">Quantity</th>
                  </tr>
                </thead>
                <tbody id="current_inventory_list">
                  <tr>
                  </tr>
                  <tr>
                  </tr>
                  <tr>
                  </tr>
                </tbody>
              </table>
              </div>
           
            </div>
            <div
              class="tab-pane fade"
              id="contact-tab-pane"
              role="tabpanel"
              aria-labelledby="contact-tab"
              tabindex="0"
            >
              <div class="heading">
                <h4>Entities Inventory</h4>
              </div>
              <div class="add-item">
  <form class="form">
    <div class="mb-3 d-flex justify-content-center">
      <label class="form-label m-1">
        Entity Name:
        <input
          id="outgoing_order_product_name"
          class="form-control"
          type="text"
          required
        />
      </label>
      <label class="form-label m-1">
        Product Name:
        <input
          id="outgoing_order_product_brand"
          class="form-control"
          type="text"
          required
        />
      </label>
      <label class="form-label m-1 ">
        Quantity:
        <input
          id="outgoing_order_product_quantity"
          class="form-control"
          type="number"
          required
        />
      </label>
    </div>
    <div class="mb-3 d-flex justify-content-center">
      <button class="btn btn-success" onclick="addOutgoingOrder()" type="button">Add</button>
    </div>
  </form>
</div>
                <form>

                    <button class="btn btn-danger" type="button" id="toggleFileInput">Import Data in Excel Format</button>
                    <div class="input-group m-1 p-2" id="fileInput">
  <div class="input-group-prepend">
  </div>
  <div class="custom-file">
    <input type="file" class="custom-file-input" id="inputGroupFile01"
      aria-describedby="inputGroupFileAddon01">
  </div>
</div>
                </form>
                <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Entity</th>
                    <th scope="col">Product</th>
                    <th scope="col">Group Out</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Site</th>
                    <th scope="col">Phase</th>
                    <th scope="col">Nature</th>
                  </tr>
                </thead>
                <tbody id="outgoing_inventory_list">
                  <tr>
                  </tr>
                  <tr>
                  </tr>
                  <tr>
                  </tr>
                </tbody>
              </table>
              </div>
             
            </div>
          </div>
        </div>
      </div> -->
    </main>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
      crossorigin="anonymous"
    ></script>
    <!-- <script>
      var toggleButton = document.getElementById("toggleFileInput");
      var fileInput = document.getElementById("fileInput");
      toggleButton.addEventListener("click", function() {
        fileInput.style.display = fileInput.style.display === "none" ? "block" : "none";
      });
    </script> -->
    
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
      
    </script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  </body>
</html>