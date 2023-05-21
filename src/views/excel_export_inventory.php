<?php
require("../dbconfig.php");
require("connexion.php");

$sql_query="SELECT e.ename, p.pname, g.gname, f.quantity, s.sname, p.phase, p.nature
            FROM entity_product f 
            INNER JOIN Entity e ON f.ename = e.ename
            INNER JOIN Product p ON f.pname = p.pname
            INNER JOIN Site s ON e.sname = s.sname
            INNER JOIN `Group` g ON p.gname = g.gname
            WHERE MONTH(f.idate) = :month AND YEAR(f.idate) = :year";

$resultset = $connexion->query($sql_query);
while( $rows = $resultset->fetchAll(PDO::FETCH_ASSOC) ) {
  $records[] = $rows;
}


$filename = "flow_data".date('Ymd') . ".xls";     
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$filename\"");
ExportFile($records);

function ExportFile($records) {
  $heading = false;
    if(!empty($records))
      foreach($records as $row) {
      if(!$heading) {
        echo implode("\t", array_keys($row)) . "\n";
        $heading = true;
      }
      echo implode("\t", array_values($row)) . "\n";
      }
    exit;
}
?>