<?php 
    if(isset($_GET['clearance_id'])) {

        $clearance_id = $_GET['clearance_id'];

        date_default_timezone_set("Asia/Manila");
        $date_issued = date("Y-m-d h:i:sa");
         

        require_once '../config/connection.php';
        $start_result = $clearance->startClearance($clearance_id, $date_issued);
        if($start_result == true) {

            $account_result = $users->setUserAccount();
            if($account_result == true) {
                 $insertStudentClearaneResult = $clearance->insertStudentClearance($clearance_id);
                 if($insertStudentClearaneResult == true) {
                    echo "The clearance has been started fianlly";
                 }else {
                    echo "There might be a aproblem";
                 }
            }else {
                "Insert Failed";
            }
        }else {
            header('location: ../admin/clearance_record.php?start=failed');
        }


        



    }