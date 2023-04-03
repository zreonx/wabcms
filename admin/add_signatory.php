<?php
    include_once '../includes/main.header.php';
    require_once '../config/connection.php';

    $organizations = $signatories->orgList();
    
?>

<div class="panel p-3">
<?php if (isset($_GET['error']) == "true") { Errormessage::clearance_create_failed(); } ?>
<?php if (isset($_GET['register']) && $_GET['register'] == "success") { Errormessage::add_signatory_message(); } ?>
    <h1 class="panel-title">Signatory</h1>
    <div class="card clearance-card">
        <div class="card-body">
            <form action="../includes/add_signatory.inc.php" method="post">
                <h1 class="fs-2 card-title mb-4">Add Signatory</h1>
                <div id="dynamic-field">
                
                <div class="row mb-2">
                    <div class="col-lg-2 flex-shrink-1 bd-highlight">
                        <label class="form-label">Firstname</label>
                    </div>
                    <div class="col-lg-2 ">
                        <input type="text" value="<?php echo (isset($_POST['firstname']) ? $_POST['firstname'] : "") ?>" class="form-control" placeholder="Firstname" name="firstname" required>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-lg-2 flex-shrink-1 bd-highlight">
                        <label class="form-label">Middle Name</label>
                    </div>
                    <div class="col-lg-2 ">
                        <input type="text" class="form-control" value="<?php echo (isset($_POST['middlename']) ? $_POST['middlename'] : "") ?>" placeholder="Middle Name" name="middlename" required>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-lg-2 flex-shrink-1 bd-highlight">
                        <label class="form-label">Last Name</label>
                    </div>
                    <div class="col-lg-2 ">
                        <input type="text" class="form-control" value="<?php echo (isset($_POST['lastname']) ? $_POST['lastname'] : "") ?>" placeholder="Lastname" name="lastname" required>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-lg-2 flex-shrink-1 bd-highlight">
                        <label class="form-label">Office - Department</label>
                    </div>
                    <div class="col-lg-2 ">
                        <input type="text" class="form-control" value="<?php echo (isset($_POST['department']) ? $_POST['department'] : "") ?>" placeholder="Department" name="department" required>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-lg-2 flex-shrink-1 bd-highlight">
                        <label class="form-label">Signatory of organizaitons?</label>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-check">
                            <input class="form-check-input" value="1" type="radio" name="is_org" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Yes
                            </label>
                            </div>
                        <div class="form-check">
                            <input class="form-check-input" value="0" type="radio" name="is_org" id="flexRadioDefault2" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                No
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row mb-2 orgs" id="orgs1" style="display: none;">
                    <div class="col-lg-2 flex-shrink-1 bd-highlight">
                        <label class="form-label">Organization</label>
                    </div>
                    <div class="col-lg-2 ">
                        <select id="disabledSelect" name="organization" class="form-select">
                            <option value="0">Select</option>
                            <?php
                            while ($org_row = $organizations->fetch(PDO::FETCH_ASSOC)) { ?>
                                <option value="<?php echo $org_row['id']; ?>" ><?php echo $org_row['org_name'] ?></option>
                               
                            <?php } 
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-lg-2 flex-shrink-1 bd-highlight">
                        <label class="form-label">Email</label>
                    </div>
                    <div class="col-lg-2 ">
                        <input type="email" class="form-control"  value="<?php echo (isset($_POST['email']) ? $_POST['email'] : "") ?>" placeholder="Email" name="email" required>
                    </div>
                </div>
                <div class="row mb-2 align-items-center" id="dynamic-field">
                    <div class="col-lg-2 flex-shrink-1 bd-highlight">
                        <label class="form-label">Designation</label>
                    </div>
                    <div class="col-lg-2 ">
                        <input type="text" name="designation[]" placeholder="Designation" class="form-control" required />
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
                let x = 0;
                    $(document).ready(function(){
                        $("#add").click(function(){
                        x++;
                        $("#dynamic-field").append("<div class='row mb-2' id='row"+x+"'><div class='col-lg-2'></div><div class='col-lg-2'><input type='text' name='designation[]' value='<?php echo (isset($_POST['designation']) ? $_POST['desination'] : '') ?>' placeholder='Designation' class='form-control' /></div><div class='col-lg-2'><button type='button' name='remove' id='row"+x+"' class='btn btn-danger btn_remove'><i class='fa-solid fa-trash'></i></button></div></div>");
                        });
                        $(document).on('click', '.btn_remove', function(){
                        let button_id = $(this).attr("id"); 
                        $('#'+button_id+'').remove();
                        });

                        $("input[name$='is_org']").click(function() {
                        var test = $(this).val();

                        $(".orgs").hide();
                        $("#orgs" + test).show();
                        });
                    });
            </script>
            
        </div>
       
        </div>
    </div>
    
</div>

<?php include_once '../includes/main.footer.php' ?>