
<?php
session_start();
include '../Models/User.php';

class RegistrationController
{
    private $userModel;
    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }
    public function register()
    {
        try{
                $user=$this->userModel->register();
                header("Location: ../views/Dashboard.php");
        }
        catch(Exception $e)
        {
            header("Location: ../views/Login.php/?error=1");
        } 
    }
}

if(isset($_POST['email']))
{
    $user = new User($_POST['username'], $_POST['email'], $_POST['password']);
    $regController = new RegistrationController($user);
    $regController->register();
}


?>




