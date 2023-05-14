<?php
session_start();
require '../models/User.php';
require '../../dbconfig.php';
class LoginController
{
    public function login()
    {
    }
}
$loginController = new LoginController($user);
if(isset($_POST['email']))
{
    $loginController->login();
}
else
{
    if(isset($_GET['logout']))
    {
        session_destroy();
        header('Location: /src/views/Login.php');
    }
}





