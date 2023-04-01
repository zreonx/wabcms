<?php 

if(isset($_GET['clearAllSubmit'])) {

        $clearance_id = $_GET['clearance_id'];
        $signatory_id = $_GET['signatory_id'];
        $signatory= $_GET['signatory'];
        $type = $_GET['type'];
        

       
    if(isset($_GET['clearance_id']) && isset($_GET['def_id'])) {
         //create a column name for signatory based on designation
        $designation =  explode(" ", strtolower($signatory));
        $final_designation = implode("_", $designation);
        $signatory_column = "is_" . $final_designation ."_approval";
        echo $signatory_column;
   
        $student_id = $_GET['students'];
        

        $def_id = $_GET['def_id'];

        //Get the current date
        date_default_timezone_set("Asia/Manila");
        $date_messaged = date("Y-m-d h:i:sa");
        

        require_once('../config/connection.php');

        $countRemove = 0;

        foreach($def_id as $id) {
            $signatoryClearance->updateDeficiency($id);
            $countRemove++;
        }

        foreach($student_id as $id) {
            $approve = $signatoryClearance->approveClearance($signatory_column, $id, $clearance_id);
        }

        if($$countRemove == 0) {
            header("Location: ../signatory/add_deficiency.php?clearance_id=$clearance_id&signatory=$signatory&type=$type&clear=success");
        }else {
            header("Location: ../signatory/add_deficiency.php?clearance_id=$clearance_id&signatory=$signatory&type=$type&clear=cleared");
        }

    }else {
        header("Location: ../signatory/add_deficiency.php?clearance_id=$clearance_id&signatory=$signatory&type=$type");
    }

}else {
  
}