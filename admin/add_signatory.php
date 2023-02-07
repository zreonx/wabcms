<?php
    include_once '../includes/main.header.php';
    require_once '../config/connection.php';
    $clearance_type = $clearance->showClearanceType();
?>

<div class="panel p-3">
<?php if (isset($_GET['error']) == "true") { Errormessage::clearance_create_failed(); } ?>
    <h1 class="panel-title">Signatory</h1>
    <div class="card clearance-card">
        <div class="card-body">
            <form action="" method="post">
                <h1 class="fs-2 card-title mb-4">Add Signatory</h1>
                <div id="dynamic-field">
                
                <div class="row mb-2">
                    <div class="col-lg-2 flex-shrink-1 bd-highlight">
                        <label class="form-label">Firstname</label>
                    </div>
                    <div class="col-lg-2 ">
                        <input type="text" value="<?php echo (isset($_POST['firstname']) ? $_POST['firstname'] : "") ?>" class="form-control" placeholder="Firstname" name="firstname">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-lg-2 flex-shrink-1 bd-highlight">
                        <label class="form-label">Middle Name</label>
                    </div>
                    <div class="col-lg-2 ">
                        <input type="text" class="form-control" value="<?php echo (isset($_POST['middlename']) ? $_POST['middlename'] : "") ?>" placeholder="Middle Name" name="middlename">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-lg-2 flex-shrink-1 bd-highlight">
                        <label class="form-label">Last Name</label>
                    </div>
                    <div class="col-lg-2 ">
                        <input type="text" class="form-control" value="<?php echo (isset($_POST['lastname']) ? $_POST['lastname'] : "") ?>" placeholder="Lastname" name="lastname">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-lg-2 flex-shrink-1 bd-highlight">
                        <label class="form-label">Email</label>
                    </div>
                    <div class="col-lg-2 ">
                        <input type="email" class="form-control"  value="<?php echo (isset($_POST['email']) ? $_POST['email'] : "") ?>" placeholder="Email" name="email">
                    </div>
                </div>
                <div class="row mb-2 align-items-center" id="dynamic-field">
                    <div class="col-lg-2 flex-shrink-1 bd-highlight">
                        <label class="form-label">Designation</label>
                    </div>
                    <div class="col-lg-2 ">
                        <input type="text" name="designation[]" placeholder="Designation" class="form-control" />
                    </div>
                    <div class="col-lg-2">
                        <button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
                    </div>

                </div>
                
                </div>
                <div class="row mb-2">
                    <div class="col-lg-2 ">
                        <button class="btn btn-success" type="submit" name="submit">Add Signatory</button>
                    </div>
                </div>
            </form>
            <script>
                let i = 0;
                $(document).ready(function(){
                    $("#add").click(function(){
                        i++;
                        $("#dynamic-field").append("<div class='row mb-2' id='row"+i+"'><div class='col-lg-2'></div><div class='col-lg-2'><input type='text' name='designation[]' placeholder='Designation' class='form-control' /></div><div class='col-lg-2'><button type='button' name='remove' id='row"+i+"' class='btn btn-danger btn_remove'><i class='fa-solid fa-trash'></i></button></div></div>");
                        
                    });
                    $(document).on('click', '.btn_remove', function(){
                        var button_id = $(this).attr("id"); 
                        $('#'+button_id+'').remove();
                        });
                });
            </script>

        </div>
       
        </div>
    </div>
    
</div>

<?php include_once '../includes/main.footer.php' ?>