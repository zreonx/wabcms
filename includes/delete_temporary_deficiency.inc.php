<?php

if($_SERVER['REQUEST_METHOD'] == "GET") {
    $clearance_id = $_GET['clearance_id'];
    $signatory = $_GET['signatory'];
    $signatory_id = $_GET['signatory_id'];
    $student_id = $_GET['student_id'];
    $temp_id = $_GET['temp_id'];

    echo $clearance_id;
    echo $signatory;
    echo $signatory_id;
    echo $student_id;
    
    require_once '../config/connection.php';

    $delete_result = $signatoryClearance->deleteTemporaryDeficiency($temp_id);

    if($delete_result == true) {  
        header("Location: ../signatory/add_deficiency.php?clearance_id=$clearance_id&signatory=$signatory");
    } else {
        header("Location: ../signatory/add_deficiency.php?clearance_id=$clearance_id&signatory=$signatory&remove_temp=false");
    }
}