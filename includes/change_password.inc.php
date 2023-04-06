<?php 
    
    //$users->getUserData('20-02858');
    
    if(isset($_POST['key'])) {
        require_once '../config/connection.php';

        $userId = $_POST['user_id'];
        $user_type = $_POST['user_type'];
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        $result = $users->getUserData($userId, $user_type);
        

        if($current_password === $result['old_pass']) {
            echo "Current password matched.";
            if($new_password === $confirm_password) {
                echo "Password changed.";
            }else {
                echo "Confirm password does not matched.";
            }
        }else {
            echo "Current password does not matched.";
        }
    }
?>