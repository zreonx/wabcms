<?php 

if($_SERVER['REQUEST_METHOD'] == "GET") {

    $designation_column = $_GET['designation_column'];
    $student_id = $_GET['student_id'];
    $designation = $_GET['designation'];

    require_once '../config/connection.php';

    $approve = $signatoryClearance->approveClearance($designation_column, $student_id);

    if($approve == true) {
        header("location: ../signatory/student_clearance_record.php?approve=true&designation_column=$designation_column&designation=$designation");
        exit();
    }else {
        header("location: ../signatory/student_clearance_record.php?approve=false");
        exit();
    }

}else {
    header("location: ../signatory/student_clearance_record.php");
    exit();
}