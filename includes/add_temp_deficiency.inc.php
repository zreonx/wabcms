<?php

if($_SERVER['REQUEST_METHOD'] == 'GET') {

    $clearance_id = $_GET['clearance_id'];
    $signatory = $_GET['signatory'];
    $signatory_id = $_GET['signatory_id'];
    $student_id = $_GET['student_id'];

    echo $clearance_id . ' ' . $signatory . ' ' . $student_id;
    require_once '../config/connection.php';

    $checkOnList = $signatoryClearance->checkTempList($student_id, $signatory);
    echo $checkOnList;
    if($checkOnList == false) {
        $addTemp = $signatoryClearance->addTemporaryDeficiency($clearance_id, $signatory_id, $signatory, $student_id);
        if($addTemp == true) {  
            header("Location: ../signatory/add_deficiency.php?clearance_id=$clearance_id&signatory=$signatory");
        } else {
            header("Location: ../signatory/add_deficiency.php?clearance_id=$clearance_id&signatory=$signatory&add_temp=false");
        }
    }else {
        header("Location: ../signatory/add_deficiency.php?clearance_id=$clearance_id&signatory=$signatory&add_temp=duplicate");
}

    

}