<?php 

if(isset($_POST['submit'])) {

    $csv = $_FILES['csvfile']['tmp_name'];

    // $lines = file($csv, FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);

    // //var_dump($csv);
    if ($_FILES['csvfile']['size'] > 0) {
        $file = fopen($csv, "r");

        $row = 0;
        $col = count(fgetcsv($file));
        while (($column = fgetcsv($file, 0, ",")) !== false) {
            // $row++;
            // if ($row == 1) {
            //      continue;
            // }

            for ($i = 0; $i < $col; $i++) {
                echo $column[$i] . " ";
            }
            echo "<br>";

        }

        //     // while(($column = fgetcsv($file, 10000, ","))) {

        //     //     $sqlInsert = "INSERT INTO data (name, type) VALUES ('" .  $column[0] . "', '". $column[1] ."')";
        //     //     $result = mysqli_query($conn, $sqlInsert); 

        //     //     if(!empty($result)) {
        //     //         echo "Data has been inserted successfully";
        //     //     }else {
        //     //         echo "Data insertion is unsuccessful";
        //     //     }
        //     // }
        // }
    }
    
    }
    

?>
