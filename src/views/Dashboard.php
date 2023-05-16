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
    <link rel="stylesheet" href="main.css" />
  </head>

  <body>
    <header>
      <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
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
                 <a class="nav-link" href="#">Logout</a>
                  </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <main>
      <div class="container">
        <div class="heading">
          <h1>
            Industrial Performance Monitor
          </h1>
        </div>
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
    </main>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
      crossorigin="anonymous"
    ></script>
<script>
  var toggleButton = document.getElementById("toggleFileInput");
  var fileInput = document.getElementById("fileInput");
  toggleButton.addEventListener("click", function() {
    fileInput.style.display = fileInput.style.display === "none" ? "block" : "none";
  });
</script>
  </body>
</html>