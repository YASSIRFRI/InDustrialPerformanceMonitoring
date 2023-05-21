<?php
include_once("connexion.php");

$sql_query = "SELECT * FROM flow";
$records = array();

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