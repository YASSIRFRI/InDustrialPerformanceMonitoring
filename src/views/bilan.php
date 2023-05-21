
    <?php
    session_start();
    $submittedEntity = $_POST['entity'];
    $submittedMonth = $_POST['selectedMonth'];

    $responseData = array();

    $sortBy = $_POST['sortby'];
    if ($sortBy == 'product_name_asc'){
        $orderby = 'f.pname ASC';
    } elseif ($sortBy == 'product_name_desc'){
        $orderby = 'f.pname DESC';
    } elseif ($sortBy == 'total_quantity_asc'){
        $orderby = 'total_quantity ASC';
    } else {
        $orderby = 'total_quantity DESC';
    }
    

    function treatment($submittedMonth, $cons, $prod, $tableData){
        global $pdo, $responseData, $submittedEntity, $orderby;
        $monthStmt = $pdo->prepare("SELECT * FROM Operation WHERE DATE_FORMAT(Operation.opdate, '%Y-%m') = :submittedMonth");
        $monthStmt->bindParam(':submittedMonth', $submittedMonth);
        $monthStmt->execute();
    
        if ($monthStmt->rowCount() == 0) {
            $responseData[$cons] = 'There is no data available for the selected date.';
            $responseData[$prod] = 'There is no data available for the selected date.';
            $responseData[$tableData] = 'There is no data available for the selected date.';
        }
        else {
            $query = "SELECT
                            f.pname,
                            ROUND(SUM(
                                CASE
                                    WHEN f.direction = 'IN' THEN f.quantity
                                    WHEN f.direction = 'OUT' THEN -f.quantity
                                    ELSE 0
                                END
                            ), 2) AS total_quantity
                        FROM
                            Operation o
                            JOIN Operation_flow ofl ON o.opid = ofl.opid
                            JOIN Flow f ON ofl.fid = f.fid
                        WHERE
                            DATE_FORMAT(o.opdate, '%Y-%m') = '" . $submittedMonth . "'
                        AND 
                            f.ename = '" . $submittedEntity . "'
                        GROUP BY
                            DATE_FORMAT(o.opdate, '%Y-%m'),
                            o.opid,
                            f.ename,
                            f.pname
                        ";
                        

            $prodQuery = "SELECT
                                    subquery.pname,
                                    subquery.total_quantity
                                FROM
                                    (
                                        " . $query . ") AS subquery
                                WHERE
                                    subquery.total_quantity = (
                                        SELECT MAX(total_quantity)
                                        FROM
                                            (
                                        " . $query . ") AS subquery2
                                        WHERE total_quantity > 0
                                            );
                                ";

            $consQuery = "SELECT
                                    subquery.pname,
                                    subquery.total_quantity
                                FROM
                                    (
                                        " . $query . ") AS subquery
                                WHERE
                                    subquery.total_quantity = (
                                        SELECT MIN(total_quantity)
                                        FROM
                                            (
                                        " . $query . ") AS subquery2
                                        WHERE total_quantity < 0
                                            );
                                ";



            $query .= "ORDER BY
                " . $orderby . ";";

            $statement = $pdo->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            $prodStmt = $pdo->prepare($prodQuery);
            $prodStmt->execute();
            $prodResult = $prodStmt->fetchAll(PDO::FETCH_ASSOC);

            $consStmt = $pdo->prepare($consQuery);
            $consStmt->execute();
            $consResult = $consStmt->fetchAll(PDO::FETCH_ASSOC);

            $tableMarkup = '
            <h5 class="text-success">List of all products with their total quantity</h5>

            <table class ="table table-striped">
            <thead>
                <tr>
                <th class ="text text-success">Product Name</th>
                <th class ="text text-success">Total Quantity</th>
                </tr>
            </thead>
            <tbody>';
        
            $prodTable = '
            <h5 class ="text-success">Most produced product(s)</h5>
            <table class ="table table-striped">
            <thead>
                <tr>
                <th class ="text text-success">Product Name</th>
                <th class ="text text-success">Total Quantity</th>
                </tr>
            </thead>
            <tbody>';
            $consTable =
            '
            <h5 class ="text-success">Most consumed product(s)</h5>
            <table class ="table table-striped">
            <thead>
                <tr>
                <th class ="text text-success">Product Name</th>
                <th class ="text text-success">Total Quantity</th>
                </tr>
            </thead>
            <tbody>'
            ;


        foreach ($consResult as $row) {
            $consTable .= '
                <tr>
                <td>'.$row['pname'].'</td>
                <td>'.$row['total_quantity'].'</td>
                </tr>';
        }

        foreach ($prodResult as $row) {
            $prodTable .= '
                <tr>
                <td>'.$row['pname'].'</td>
                <td>'.$row['total_quantity'].'</td>
                </tr>';
        }

        foreach ($result as $row) {
            $tableMarkup .= '
                <tr>
                <td>'.$row['pname'].'</td>
                <td>'.$row['total_quantity'].'</td>
                </tr>';
        }
        
        $tableMarkup .= '
            </tbody>
            </table>';

        $prodTable .= '
        </tbody>
        </table>';

        $consTable .= '
        </tbody>
        </table>';

        $responseData[$tableData] = $tableMarkup;


        if ($consStmt->rowCount() == 0){
            $responseData[$cons] = '          <h5 class ="text-success">Most consumed product(s)</h5>
            No product has been consumed.';
        }
        else{
            $responseData[$cons] = $consTable;
        }

        if ($prodStmt->rowCount() == 0){
            $responseData[$prod] = '          <h5 class ="text-success">Most produced product(s)</h5>
            No product has been produced.';
        }
        else{
            $responseData[$prod] = $prodTable;
        }

        }
    }
    
    $entityStmt = $pdo->prepare("SELECT * FROM Entity WHERE Entity.ename = :submittedEntity");
    $entityStmt->bindParam(':submittedEntity', $submittedEntity);
    $entityStmt->execute();

    if ($entityStmt->rowCount() == 0) {
        $responseData['cons'] = 'The Entity does not exist in the database.';
        $responseData['prod'] = 'The Entity does not exist in the database.';
        $responseData['tableData'] = 'The Entity does not exist in the database.';

        $responseData['consComp'] = '';
        $responseData['prodComp'] = '';
        $responseData['tableDataComp'] = '';
    }
    else {
        if (isset($_POST['compareMonth'])){
            $compMonth = $_POST['compareMonth'];
            treatment($submittedMonth, 'cons', 'prod', 'tableData');
            treatment($compMonth, 'consComp', 'prodComp', 'tableDataComp');
        }
        else{
            treatment($submittedMonth, 'cons', 'prod', 'tableData');
            $responseData['consComp'] = '';
            $responseData['prodComp'] = '';
            $responseData['tableDataComp'] = '';
        }
    }

    $responseJson = json_encode($responseData);

    header('Content-Type: application/json');
    echo $responseJson;




    


    
    ?>
    
