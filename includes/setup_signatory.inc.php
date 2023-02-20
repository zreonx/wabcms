<?php 

    require_once '../config/connection.php';

    $setupSignatory = $clearance->addSignatoryColumn();
    //$setupSignatory = $clearance->addSignatoryColumn();

    if($setupSignatory == true) {
        header('location: ../admin/signatory_record.php?setup=success');
        exit();
    }else{
        header('location: ../admin/signatory_record.php?setup=updated');
        exit();
    }

?>