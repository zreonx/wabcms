<?php 
    
    require_once '../config/connection.php';
    $account_result = $users->setUserAccount();
    if($account_result == true) {
        header('location: ../admin/user.php?setup=success');
        exit();
    }else {
        header('location: ../admin/user.php?setup=failed');
        exit();
    }
    

?>