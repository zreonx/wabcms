<?php session_start();  ?>
<div class="cp-header">
    <div class="cp-title"><h1 class="fs-6 pt-1">Change Password</h1></div>
    <div class="cp-close"><i class="fa-solid fa-xmark cp-close-icon" id="cpclose"></i></div>
</div>
<div class="cp-content">
    <div class="pass-col d-flex gap-3">
        <input type="hidden" id="uid" value="<?php echo $_SESSION['user_id']; ?>">
        <input type="hidden" id="user_type" value="<?php echo $_SESSION['user_type']; ?>">
        <input type="password" class="form-control form-control-sm" id="currentPass" placeholder="Old Password">
        <input type="password" class="form-control form-control-sm" id="newPass" placeholder="New Password">
        <input type="password" class="form-control form-control-sm" id="confirmPass" placeholder="Repeat Password">
    </div>
    
    <button class="btn btn-default btn-sm mt-2" id="changePassBtn">Save Password</button>
            
</div>

<script>
     $(document).ready(function(){
        $('#cpclose').click(function() {
            $('#user-page').hide();
        }); 

        $('#changePassBtn').click(function() {
           let cur_pass = $('#currentPass').val();
           let new_pass = $('#newPass').val();
           let con_pass = $('#confirmPass').val();
           let userId = $('#uid').val();
           let userType = $('#user_type').val();

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
                    console.log(result);
                }
            });
        });
    });
</script>

