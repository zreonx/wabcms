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
            if($new_password === $confirm_password) {
                $changeStatus = $users->changePassword($userId, $new_password);
                $result = array(
                    'password_changed' => 'true',
                    'message' => '
                    <div class="alert alert-success mt-3 mx-3" id="error-message">
                        Password has been changed successfully.
                    </div>'
                );

            }else {
                $result = array(
                    'password_changed' => 'cnm',
                    'message' => '
                    <div class="alert alert-danger mt-3 mx-3" id="error-message">
                        Confirm password did not match.
                    </div>'
                );

            }
        }else {
            $result = array(
                'password_changed' => 'olm',
                'message' => '
                <div class="alert alert-danger mt-3 mx-3" id="error-message">
                    The password you entered does not matched to your old password.
                </div>'
            );
            
        }

        echo json_encode($result);
    }
?>