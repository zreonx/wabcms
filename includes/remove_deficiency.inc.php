<?php 

if($_SERVER['REQUEST_METHOD'] == "GET"){ 
    $clearance_id = $_GET['clearance_id'];
    $student_id = $_GET['student_id'];
    $signatory_id = $_GET['signatory_id'];
    $signatory = $_GET['signatory'];
    $type = $_GET['type'];
    $semester = $_GET['semester'];


     //create a column name for signatory based on designation
     $designation =  explode(" ", strtolower($signatory));
     $final_designation = implode("_", $designation);
     $signatory_column = "is_" . $final_designation ."_approval";

     echo $signatory_column;
    
    $id = $_GET['id'];
    
    require_once '../config/connection.php';

    if(($signatoryClearance->updateDeficiency($id)) == true) {  
        //Approve student clearance 
        $approve = $signatoryClearance->approveClearance($signatory_column, $student_id, $clearance_id);
        header("Location: ../signatory/add_deficiency.php?clearance_id=$clearance_id&signatory=$signatory&type=$type&semester=$semester");
    } else {
        header("Location: ../signatory/add_deficiency.php?clearance_id=$clearance_id&signatory=$signatory&type=$type&semester=$semester&remove_deficiency=failed");
    }
    
}