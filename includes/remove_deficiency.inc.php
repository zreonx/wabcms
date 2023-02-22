<?php 

if($_SERVER['REQUEST_METHOD'] == "GET"){ 
    $clearance_id = $_GET['clearance_id'];
    $student_id = $_GET['student_id'];
    $signatory_id = $_GET['signatory_id'];
    $signatory = $_GET['signatory'];
    $id = $_GET['id'];
    
    require_once '../config/connection.php';

    if(($signatoryClearance->updateDeficiency($id)) == true) {  
        header("Location: ../signatory/add_deficiency.php?clearance_id=$clearance_id&signatory=$signatory");
    } else {
        header("Location: ../signatory/add_deficiency.php?clearance_id=$clearance_id&signatory=$signatory&remove_deficiency=failed");
    }
    
}