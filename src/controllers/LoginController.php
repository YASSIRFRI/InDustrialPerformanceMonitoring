<?php
session_start();
require '../models/User.php';
require '../dbconfig.php';
class LoginController
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function login()
    {
        if($this->user->isAuthenticated())
        {
            $_SESSION['username'] = $this->user->getUsername();
            header('Location: ../views/Dashboard.php');
        }
        else
        {
            header('Location: ../views/Login.php?error=1');
        }

    }
}
$user = new User($_POST['email'], $_POST['password']);
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





