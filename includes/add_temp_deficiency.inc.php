<?php

if($_SERVER['REQUEST_METHOD'] == 'GET') {

    $clearance_id = $_GET['clearance_id'];
    $signatory = $_GET['signatory'];
    $signatory_id = $_GET['signatory_id'];
    $student_id = $_GET['student_id'];
    $type = $_GET['type'];
    $semester = $_GET['semester'];

    echo $clearance_id . ' ' . $signatory . ' ' . $student_id;
    require_once '../config/connection.php';

    $checkOnList = $signatoryClearance->checkTempList($clearance_id, $student_id, $signatory);
    echo $checkOnList;
    if($checkOnList == false) {
        $addTemp = $signatoryClearance->addTemporaryDeficiency($clearance_id, $signatory_id, $signatory, $student_id);
        if($addTemp == true) {  
            header("Location: ../signatory/add_deficiency.php?clearance_id=$clearance_id&signatory=$signatory&type=$type&semester=$semester");
        } else {
            header("Location: ../signatory/add_deficiency.php?clearance_id=$clearance_id&signatory=$signatory&type=$type&semester=$semester&add_temp=false");
        }
    }else {
        header("Location: ../signatory/add_deficiency.php?clearance_id=$clearance_id&signatory=$signatory&type=$type&semester=$semester&add_temp=duplicate");
}

    

}