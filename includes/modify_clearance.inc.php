<?php

if(isset($_GET['submit'])) {
    $id = $_GET['id'];
    $clearance_type = $_GET['clearance_type'];
    $semester = $_GET['semester'];
    $academic_year = $_GET['academic_year'];
    $beneficiaries = $_GET['beneficiaries'];

    require_once '../config/connection.php';

    $result = $clearance->modifyClearance($clearance_type, $semester, $academic_year, $beneficiaries, $id);

    //var_dump($clearance->modifyClearance($id, $clearance_type, $semester, $academic_year, $beneficiaries));
    if($result == true) {
        header('location: ../admin/clearance_record.php?modification=success');
    }else {
        header('location: ../admin/clearance_record.php?modification=error');
    }
}else {
    header('location: ../login.php');
    exit();
}   