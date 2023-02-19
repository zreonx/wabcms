<?php 

    require_once '../config/connection.php';

    $removeSignatory = $clearance->removeSignatoryColumns();

    $setupSignatory = $clearance->addSignatoryColumn();

    if($removeSignatory == true) {
        header('location: ../admin/signatory_record.php?setup=success');
        exit();
    }else{
        header('location: ../admin/signatory_record.php?setup=updated');
        exit();
    }

?>