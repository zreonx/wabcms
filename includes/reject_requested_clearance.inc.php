<?php 
    if(isset($_POST['key'])) {
        require_once '../config/connection.php';
        $clearance->rejectRequestedClearance($_POST['request_id']);
        echo "request_list.php?message=rejected";
    }
?>