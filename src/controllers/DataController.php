<?php
session_start();
if(!($_SESSION['username']))
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
    public function getInventoryByDate($month, $year)
    {
        global $connexion;
        $sql='SELECT * FROM Flow
        WHERE MONTH(fdate) = :month AND YEAR(fdate) = :year LIMIT 20 ;';
        $stmt = $connexion->prepare($sql);
        $stmt->execute(['month' => $month, 'year' => $year]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $jsonResult = json_encode($result);
        return $jsonResult;
    }

    public function getFlowByDate($month, $year)
{
    global $connexion;
    $sql = 'SELECT * FROM Flow
            WHERE MONTH(fdate) = :month AND YEAR(fdate) = :year LIMIT 20';
    $stmt = $connexion->prepare($sql);
    $stmt->execute(['month' => $month, 'year' => $year]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Generate the HTML table markup
    $html="";
    foreach ($result as $row) {
        $html .= '<tr>';
        $html .= '<td>' . $row['fid'] . '</td>';
        $html .= '<td>' . $row['quantity'] . '</td>';
        $html .= '<td>' . $row['direction'] . '</td>';
        $html .= '<td>' . $row['Indicator'] . '</td>';
        $html .= '<td>' . $row['ename'] . '</td>';
        $html .= '<td>' . $row['pname'] . '</td>';
        $html .= '</tr>';
    }
    header('Content-Type: text/html');
    echo $html;
}






}

$dataController = new DataController();
if (isset($_GET["item"]) && isset($_GET["month"]) && isset($_GET["year"]) && $_GET["item"] == 1) {
    global $connexion;
    $sortColumn = $_GET["sort"];
    
    $sql = "SELECT * FROM Flow
            WHERE MONTH(fdate) = :month AND YEAR(fdate) = :year
            ORDER BY " . $sortColumn . " LIMIT 20";
    
    $stmt = $connexion->prepare($sql);
    $stmt->execute(['month' => $_GET["month"], 'year' => $_GET["year"]]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $html = '<thead>
        <tr>
            <th scope="col">Flow Id</th>
            <th scope="col">Quantity</th>
            <th scope="col">Direction</th>
            <th scope="col">Indicator</th>
            <th scope="col">Entity</th>
            <th scope="col">Product</th>
            <th scope="col">Edit</th>
        </tr>
    </thead>';
    
    foreach ($result as $row) {
        $html .= '<tr>';
        $html .= '<td>' . $row['fid'] . '</td>';
        $html .= '<td>' . $row['quantity'] . '</td>';
        $html .= '<td>' . $row['direction'] . '</td>';
        $html .= '<td>' . $row['Indicator'] . '</td>';
        $html .= '<td>' . $row['ename'] . '</td>';
        $html .= '<td>' . $row['pname'] . '</td>';
        $html .= '<td><a href=\'$modifyLink\' class=\'btn btn-success btn-sm\'><i class=\'fas fa-edit\'></i> Modify</a></td>';
        $html .= '</tr>';
    }
    
    header('Content-Type: text/html');
    echo $html;
}else 
if (isset($_GET["item"]) && isset($_GET["month"]) && isset($_GET["year"]) && $_GET["item"] == 2) {
    global $connexion;
    $sortColumn = $_GET["sort"];
    
    $query = "SELECT e.ename, p.pname, g.gname, f.quantity, s.sname, p.phase, p.nature
              FROM entity_product f 
              INNER JOIN Entity e ON f.ename = e.ename
              INNER JOIN Product p ON f.pname = p.pname
              INNER JOIN Site s ON e.sname = s.sname
              INNER JOIN `Group` g ON p.gname = g.gname
              WHERE MONTH(f.idate) = :month AND YEAR(f.idate) = :year
              ORDER BY " . $sortColumn . " LIMIT 20";
    
    $result = $connexion->prepare($query);
    $result->execute(['month' => $_GET["month"], 'year' => $_GET["year"]]);
    $rows = $result->fetchAll(PDO::FETCH_ASSOC);
    
    $html = '<thead>
        <tr>
            <th scope="col">Entity</th>
            <th scope="col">Product</th>
            <th scope="col">Group Out</th>
            <th scope="col">Quantity</th>
            <th scope="col">Site</th>
            <th scope="col">Phase</th>
            <th scope="col">Nature</th>
            <th scope="col">Edit</th>
        </tr>
    </thead>';
    
    foreach ($rows as $row) {
        $html .= '<tr>';
        $html .= '<td>' . $row['ename'] . '</td>';
        $html .= '<td>' . $row['pname'] . '</td>';
        $html .= '<td>' . $row['gname'] . '</td>';
        $html .= '<td>' . $row['quantity'] . '</td>';
        $html .= '<td>' . $row['sname'] . '</td>';
        $html .= '<td>' . $row['phase'] . '</td>';
        $html .= '<td>' . $row['nature'] . '</td>';
        $html .= '<td><a href=\'$modifyLink\' class=\'btn btn-success btn-sm\'><i class=\'fas fa-edit\'></i> Modify</a></td>';
        $html .= '</tr>';
    }
    
    header('Content-Type: text/html');
    echo $html;
}



?>