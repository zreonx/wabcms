<?php 


if(isset($_GET['clearance_id'])) {
    $clearance_id = $_GET['clearance_id'];
    date_default_timezone_set("Asia/Manila");
    $date_end = date("Y-m-d h:i:sa");

    require_once '../config/connection.php';

    $clearanceQuery = $clearance->getClearanceByColumn("id" , $clearance_id);

    while($clearance_row = $clearanceQuery->fetch(PDO::FETCH_ASSOC)) {
        $status = $clearance_row['status'];

        if($stauts == "ended") {
            header('location: ../admin/clearance_record.php?start=ended');
        }else {
            $clearanceEnd = $clearance->endClearance($clearance_id, $date_end);
            if($clearanceEnd == true) {
                header('location: ../admin/clearance_record.php?start=end');
            }else {
                header('location: ../admin/clearance_record.php?start=endfail');
            }
        }
    }
}
