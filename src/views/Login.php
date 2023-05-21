<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login </title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel ="stylesheet" href ="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel ="stylesheet" href ="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <!--Stylesheet-->
    <link rel="stylesheet" href="../../assets/css/Login.css">
    </style>
</head>
<body>
    <div class="container">
        <div class="wrapper bg-white">
            <div class="text-center">                        
                <img src="../images/logo.png"width="60" height="75" class="d-inline-block align-top" alt="">
                <div class ="h2">
                    Industrial Performance Monitor
                </div>
            </div>
            <div class="h4 text-muted text-center pt-2">Enter your login details</div>
            <form class="pt-3" method="POST" action="../dbconfig.php">
                <div class="form-group py-2">
                    <div class="input-field">
                        <span class="far fa-user p-2"></span>
                        <input type="text" placeholder="Username" name="username" required class="">
                    </div>
                </div>
                <div class="form-group py-1 pb-2">
                    <div class="input-field">
                        <span class="fas fa-lock p-2"></span>
                        <input type="password" placeholder="Enter your Password" name="password" required class="">
                    </div>
                </div>
                <button class="btn btn-block text-center my-3">Log in</button>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>



