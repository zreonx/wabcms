<?php 
    if(isset($_GET['clearance_id'])) {

        $clearance_id = $_GET['clearance_id'];

        date_default_timezone_set("Asia/Manila");
        $date_issued = date("Y-m-d h:i:sa");

         
        require_once '../config/connection.php';

        $clearanceQuery = $clearance->getClearanceByColumn("id" , $clearance_id);

        while($clearance_row = $clearanceQuery->fetch(PDO::FETCH_ASSOC)) {
            $status = $clearance_row['status'];

            if($status == "started") {
                header('location: ../admin/clearance_record.php?start=started');
            }else {
                $start_result = $clearance->startClearance($clearance_id, $date_issued);
                if($start_result == true) {
                    if($clearance_row['beneficiaries'] == '1') {
                        //Add students to the clearance records 
                         $insertStudentClearaneResult = $clearance->insertStudentClearance($clearance_id);
                         if($insertStudentClearaneResult == true) {
                            header('location: ../admin/clearance_record.php?start=success');
                         }else {
                            header('location: ../admin/clearance_record.php?start=failed');
                         }
                    }else {
                        $clearance->insertStudentRequestedClearance($clearance_id, $clearance_row['beneficiaries']);
                        header('location: ../admin/clearance_record.php?start=success');
                        echo $request_id;
                    }
                        
                        
                }else {
                    header('location: ../admin/clearance_record.php?start=failed');
                }
            }
        }

    }