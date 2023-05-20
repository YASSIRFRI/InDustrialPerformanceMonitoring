<?php
//session_start();
//if(!($_SESSION['insert']))
//{
    //header("Location: ./Login.php");
//}
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
    public function getInventoryByDate($month, $year)
    {
        global $connexion;
        $sql='SELECT * FROM Flow
        WHERE MONTH(fdate) = :month AND YEAR(fdate) = :year;';
        $stmt = $connexion->prepare($sql);
        $stmt->execute(['month' => $month, 'year' => $year]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $jsonResult = json_encode($result);
        return $jsonResult;
    }

}

$dataController = new DataController();
if(isset($_GET["inventory"]) && isset($_GET["month"]) && isset($_GET["year"]))
{
    $dataController->getInventoryByDate($_GET["month"], $_GET["year"]);
}






?>