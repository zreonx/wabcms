<?php 
    if(isset($_POST['key'])) {

        $student_id =  $_POST['student_id'];
        $clearance_type = $_POST['clearance_type'];
        $message = $_POST['message'];

        require_once '../config/connection.php';

        $studentData = $users->getUserData($student_id, 'student');
        $studentInfo = $studentData['userdata'];

        date_default_timezone_set("Asia/Manila");
        $date_requested = date("Y-m-d h:i:sa");

        $result = $studentClearance->requestClearance($clearance_type, $student_id, $message, $date_requested);
       if(!$result) {
            $resultMessage = array(
                'res_message' => 'failed',
                'message' => '
                <div class="alert alert-danger mt-2" id="error-message">
                    Clearance Reqeust Failed.
                </div>'
            );
       }else {
            $resultMessage = array(
                'res_message' => 'success',
                'message' => '
                <div class="alert alert-success mt-2" id="error-message">
                    Clearance Request Sent.
                </div>'
            );
            
       }

        $result_data = json_encode($resultMessage);
        echo $result_data;
    }
?>