<?php
    include_once '../includes/main.header.php';
    require_once '../config/connection.php';
    $clearance_type = $clearance->showClearanceType();
    $beneficiaries = $clearance->showBeneficiaries();
?>

<div class="panel p-3">
    <?php if (isset($_GET['input']) && isset($_GET['input']) == "missing") { Errormessage::clearance_create_missing(); } ?>
    <?php if (isset($_GET['create']) && $_GET['create'] == "success") { Errormessage::clearance_create_success(); } ?>
    <?php if (isset($_GET['create']) && $_GET['create'] == "failed") { Errormessage::clearance_create_failed(); } ?>
    <h1 class="panel-title">Clearance</h1>
    <div class="card clearance-card">
        <div class="card-body">
            <form action="../includes/create.inc.php" method="get">
                <h1 class="fs-2 card-title mb-4">Create Clearance</h1>
                <div class="row mb-2">
                    <div class="col-lg-2 flex-shrink-1 bd-highlight">
                        <label class="form-label">Clearance Beneficiaries</label>
                    </div>
                    <div class="col-lg-2 ">
                        <select name="beneficiaries" class="form-select sm-in">
                            <option value="0">Select</option>
                            <?php
                            while ($row_beneficiary = $beneficiaries->fetch(PDO::FETCH_ASSOC)) { ?>
                                <option value="<?php echo $row_beneficiary['beneficiary_id']; ?>"><?php echo $row_beneficiary['beneficiary_type'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-lg-2 flex-shrink-1 bd-highlight">
                        <label class="form-label">Clearance Type</label>
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
                    <div class="col-lg-2 flex-shrink-1 bd-highlight">
                        <label class="form-label">Academic Year</label>
                    </div>
                    <div class="col-lg-2 ">
                        <input type="text" class="form-control" placeholder="2022-2023" name="academic_year" required>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-lg-2 flex-shrink-1 bd-highlight">
                        <label class="form-label">Semester</label>
                    </div>
                    <div class="col-lg-2 ">
                        <input type="text" class="form-control" placeholder="1-2" name="semester" required>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-lg-2 ">
                        <button class="btn btn-success" type="submit" name="submit">Create</button>
                    </div>
                </div>
            </form>
        </div>
       
        </div>
    </div>
    
</div>

<?php include_once '../includes/main.footer.php' ?>