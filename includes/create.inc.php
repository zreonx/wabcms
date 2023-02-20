<?php 

if(isset($_GET['submit'])) {

    $clearance_type = $_GET['clearance_type'];
    $semester = $_GET['semester'];
    $academic_year = $_GET['academic_year'];
    $beneficiaries = $_GET['beneficiaries'];
    date_default_timezone_set("Asia/Manila");
    $date_created = date("Y-m-d h:i:sa");
    $status = "initialized";

    if($clearance_type == 0 && $beneficiaries == 0 && $academic_year == '' && $semester == '') {

        header('location: ../admin/create_clearance.php?input=missing');

    }else {
        require_once '../config/connection.php';
        $result = $clearance->createClearance($clearance_type, $semester, $academic_year, $beneficiaries, $date_created, $status);
        if($result == true) {
            header('location: ../admin/create_clearance.php?create=success');
        }else {
            header('location: ../admin/create_clearance.php?create=failed');
        }
    }

}else {
    header('location: ../login.php');
    exit();
}