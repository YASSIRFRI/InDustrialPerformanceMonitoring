<?php

session_start();
include "./connexion.php";
$desc = "description";
$valid_file_flow = 1;

if (isset($_POST["submit_flow"])) {
    $file_name = $_FILES["file_flow"]["name"];
    $file_temp = $_FILES["file_flow"]["tmp_name"];
    
    if ($file_temp) {
        $file = fopen($file_temp, "r"); 
        $row = 0;
        while (($data = fgetcsv($file)) !== FALSE) {
            if(count($data) != 13){
                echo "Please enter flow csv file.";
                $valid_file_flow = 0;
                break;
            }
            $row++;
            if($row === 1) continue;
            $year = $data[0];
            $month = $data[1];
            $direction = $data[2];
            $entity = $data[3];
            $site = $data[4];
            $product = $data[5];
            $flow = $data[6];
            $entity2 = $data[7];
            $product2 = $data[8];
            $groupout = $data[9];
            $groupin = $data[10];
            $indicator = $data[11];
            $quantity = $data[12];

            $sql = "INSERT INTO flow (quantity, direction, `Indicator`, ename, pname) 
                    VALUES ('$quantity', '$direction', '$indicator', '$entity', '$product')";
            $connexion->beginTransaction();
            if ($connexion->query($sql) === TRUE) {
                echo "Record inserted successfully";
            }
            $connexion->commit();
        }

        fclose($file);

        if($valid_file_flow != 0){
            echo "File uploaded and data imported successfully.";
        }
    } else {
        echo "Failed to upload file.";
    }
}
?>