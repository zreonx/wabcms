<?php 
    if(isset($_POST['key'])) {
       $request_id =  $_POST['request_id'];
       $student_id =  $_POST['student_id'];
       require_once '../config/connection.php';
       $cancel_request = $studentClearance->cancelRequest($student_id, $request_id);


       if(!$cancel_request) {
        echo "failed";
       }else {
        echo "success";
       }
    }
?>