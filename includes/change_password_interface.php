<?php session_start();  ?>
<div class="cp-header">
    <div class="cp-title"><h1 class="fs-6 pt-1">Change Password</h1></div>
    <div class="cp-close"><i class="fa-solid fa-xmark cp-close-icon" id="cpclose"></i></div>
</div>
<div class="cp-content">
    <div class="pass-col d-flex gap-3">
        <input type="hidden" id="uid" value="<?php echo $_SESSION['user_id']; ?>">
        <input type="hidden" id="user_type" value="<?php echo $_SESSION['user_type']; ?>">
        <input type="password" class="form-control form-control-sm" id="currentPass" placeholder="Old Password" required>
        <input type="password" class="form-control form-control-sm" id="newPass" placeholder="New Password" required>
        <input type="password" class="form-control form-control-sm" id="confirmPass" placeholder="Repeat Password" required>
    </div>
    
    <button class="btn btn-default btn-sm mt-2" id="changePassBtn">Save Password</button>
            
</div>

<script>
    $(document).ready(function(){
        $('#cpclose').click(function() {
            $('#user-page').fadeOut();
            $('input[type=password]').each(function(){
                $(this).val('');
            });
            $('.alert').each(function(){
                $(this).remove();
            });
        }); 

        $('#changePassBtn').click(function(event) {
           
           let cur_pass = $('#currentPass').val();
           let new_pass = $('#newPass').val();
           let con_pass = $('#confirmPass').val();
           let userId = $('#uid').val();
           let userType = $('#user_type').val();

           if(cur_pass.length != 0 && new_pass.length != 0 && con_pass.length != 0) {
                $.ajax({
                    method: 'POST',
                    url: '../includes/change_password.inc.php',
                    data: {
                        key: "cp",
                        current_password: cur_pass,
                        new_password: new_pass,
                        confirm_password: con_pass,
                        user_id: userId,
                        user_type: userType
                    },
                    success: function(result){
                        try{
                            let responseJson = JSON.parse(result);
                            if(responseJson.password_changed == 'true') {
                                $('input[type=password]').each(function(){
                                    $(this).val('');
                                });
                                $('#user-page').hide();
                                $('.alert').each(function(){
                                    $(this).remove();
                                });
                                $('#user-page').after(responseJson.message);
                                setTimeout(function(){
                                    $('#error-message').remove();
                                }, 3000);

                                }else if(responseJson.password_changed == 'olm') {
                                    $('#error-message').remove();
                                    $('#user-page').before(responseJson.message);
                                }else if(responseJson.password_changed == 'cnm') {
                                    $('#error-message').remove();
                                    $('#user-page').before(responseJson.message);
                                }
                            }catch(e) {

                        }
                    }
                });
            }else {
                $('#user-page').before('<div class="alert alert-warning mt-3 mx-3" id="error-message"> There was a missing input</div>');
                setTimeout(function(){
                    $('#error-message').remove();
                }, 3000);
            }
            
        });
    });
</script>

