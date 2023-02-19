<?php 

if($_SERVER['REQUEST_METHOD'] == "GET") {

    $designation_column = $_GET['designation_column'];
    $student_id = $_GET['student_id'];
    $clearance_id = $_GET['clearance_id'];
    $designation = $_GET['designation'];
    
    require_once '../config/connection.php';

    $approve = $signatoryClearance->approveClearance($designation_column, $student_id, $clearance_id);

    if($approve == true) {
        header("location: ../signatory/student_clearance_record.php?approve=true&designation_column=$designation_column&designation=$designation&clearance_id=$clearance_id");
        exit();
    }else {
        header("location: ../signatory/student_clearance_record.php?approve=false");
        exit();
    }

}else {
    header("location: ../signatory/student_clearance_record.php");
    exit();
}