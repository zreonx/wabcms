<?php 

if(isset($_GET['submit'])) {

    $clearance_type = $_GET['clearance_type'];
    $semester = $_GET['semester'];
    $academic_year = $_GET['academic_year'];
    $beneficiaries = $_GET['beneficiaries'];
    date_default_timezone_set("Asia/Manila");
    $date_issued = date("Y-m-d h:i:sa");
    $status = "active";

    require_once '../config/connection.php';
    $result = $clearance->createClearance($clearance_type, $semester, $academic_year, $beneficiaries, $date_issued, $status);
    if($result == true) {
        header('location: ../admin/create_clearance.php?success=true');
    }else {
        header('location: ../admin/create_clearance.php?error=true');
    }
}else {
    header('location: ../login.php');
    exit();
}