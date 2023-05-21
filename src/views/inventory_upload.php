<?php

session_start();
include "./connexion.php";

$desc = "description";
$valid_file = 1;

if (isset($_POST["submit"])) {
    $file_name = $_FILES["file_inventory"]["name"];
    $file_temp = $_FILES["file_inventory"]["tmp_name"];
    
    if ($file_temp) {
        $file = fopen($file_temp, "r"); 
        $row = 0;
        while (($data = fgetcsv($file)) !== FALSE) {
            if(count($data) != 8){
                echo "Please enter inventory csv file.";
                $valid_file = 0;
                break;
            }
            $row++;
            if($row == 1) continue;
            $entity = $data[0];
            $site = $data[1];
            $group = $data[2];
            $product = $data[3];
            $phase = $data[4];
            $location = $data[5];
            $nature = $data[6];
            $quantity = $data[7];
            $sql_group = "INSERT INTO `group` (gname, description) 
                          VALUES ('$group', '$desc')";

            $sql = "INSERT INTO product (pname, nature, phase, gname) 
                    VALUES ('$product', '$nature', '$phase', '$group')";

            $sql_site = "INSERT INTO site (sname, location) 
                        VALUES ('$site', '$location')";


            $sql_entity = "INSERT INTO entity (ename, sname)
                           VALUES ('$entity', '$site')";

            $sql_entity_product = "INSERT INTO entity_product (ename, pname, quantity)
                                   VALUES ('$entity' , '$product', '$quantity')";

            if ($connexion->query($sql_group) === TRUE) {
                echo "Record inserted successfully";
            }
            if ($connexion->query($sql) === TRUE) {
                echo "Record inserted successfully";
            }

            if ($connexion->query($sql_site) === TRUE) {
                echo "Record inserted successfully";
            }


            if ($connexion->query($sql_entity) === TRUE) {
                echo "Record inserted successfully";
            }

            if ($connexion->query($sql_entity_product) === TRUE) {
                echo "Record inserted successfully";
            }
        }

        fclose($file);
        
        if($valid_file != 0){
            echo "File uploaded and data imported successfully.";
        }
    } else {
        echo "Failed to upload file.";
    }
}
?>