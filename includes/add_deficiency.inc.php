<?php 

if(isset($_GET['submitDeficiency'])) {
    
    $student_id = $_GET['students'];
    $clearance_id = $_GET['clearance_id'];
    $signatory_id = $_GET['signatory_id'];
    $signatory= $_GET['signatory'];
    $message= $_GET['message'];

    $def_id = $_GET['def_id'];



    //Get the current date
    date_default_timezone_set("Asia/Manila");
    $date_messaged = date("Y-m-d h:i:sa");
    
    require_once('../config/connection.php');

    //after migrating to deficency-> delete the list
    foreach($def_id as $id) {
        $delete = $signatoryClearance->deleteTemporaryDeficiency($id);
    }
    header("Location: ../signatory/add_deficiency.php?clearance_id=$clearance_id&signatory=$signatory");

    
   
    // echo $clearance_id . $signatory_id. $signatory . $message;
    // print_r($student_id);


}


?>