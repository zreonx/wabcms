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
            <form action="../includes/create.inc.php" method="get">
                <h1 class="fs-2 card-title mb-4">Add Signatory</h1>
                <div class="row mb-2">
                    <div class="col-lg-2 flex-shrink-1 bd-highlight">
                        <label class="form-label">Firstname</label>
                    </div>
                    <div class="col-lg-2 ">
                        <input type="text" class="form-control" placeholder="Firstname" name="firstname">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-lg-2 flex-shrink-1 bd-highlight">
                        <label class="form-label">Middle Name</label>
                    </div>
                    <div class="col-lg-2 ">
                        <input type="text" class="form-control" placeholder="Middle Name" name="middlename">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-lg-2 flex-shrink-1 bd-highlight">
                        <label class="form-label">Last Name</label>
                    </div>
                    <div class="col-lg-2 ">
                        <input type="text" class="form-control" placeholder="Lastname" name="lastname">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-lg-2 flex-shrink-1 bd-highlight">
                        <label class="form-label">Email</label>
                    </div>
                    <div class="col-lg-2 ">
                        <input type="email" class="form-control" placeholder="Email" name="organization">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-lg-2 flex-shrink-1 bd-highlight">
                        <label class="form-label">Department</label>
                    </div>
                    <div class="col-lg-2 ">
                        <input type="text" class="form-control" placeholder="Department" name="department">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-lg-2 flex-shrink-1 bd-highlight">
                        <label class="form-label">Departmental Position</label>
                    </div>
                    <div class="col-lg-2 ">
                        <input type="text" class="form-control" placeholder="Position" name="postition">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-lg-2 flex-shrink-1 bd-highlight">
                        <label class="form-label">Organization</label>
                    </div>
                    <div class="col-lg-2 ">
                        <input type="email" class="form-control" placeholder="Organization" name="organization">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-lg-2 flex-shrink-1 bd-highlight">
                        <label class="form-label">Organization Postion</label>
                    </div>
                    <div class="col-lg-2 ">
                        <input type="email" class="form-control" placeholder="Organization Position" name="orgpos">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-lg-2 flex-shrink-1 bd-highlight">
                        <label class="form-label">Assigned Clearance</label>
                    </div>
                    <div class="col-lg-2 ">
                        <select id="disabledSelect" name="clearance_type" class="form-select">
                            <option value="0">Select</option>
                            <?php
                            while ($clearance_row = $clearance_type->fetch(PDO::FETCH_ASSOC)) { ?>
                                <option value="<?php echo $clearance_row['clearance_type_id']; ?>" ><?php echo $clearance_row['clearance_type'] ?></option>
                               
                            <?php } 
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-lg-2 ">
                        <button class="btn btn-success" type="submit" name="submit">Add Signatory</button>
                    </div>
                </div>
            </form>
        </div>
       
        </div>
    </div>
    
</div>

<?php include_once '../includes/main.footer.php' ?>