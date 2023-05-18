<?php
session_start();
if(!($_SESSION['insert']))
{
    header("Location: ./Login.php");
}
include "../views/connexion.php";
class DataController 
{
    public function __construct()
    {
        
    }

    public function insertInventory($entity,$product,$quantity)
    {
        global $connexion;
        try{
            $sql="INSERT INTO Entity (name) VALUES ('$entity')";
        }
        catch(PDOException $e){
            $sql = "INSERT INTO entity_product (entity, product, quantity) VALUES ('$entity','$product','$quantity')";
            $stmt = $connexion->prepare($sql);
            $stmt->execute();
        }
    }

}






?>