<?php
    include_once '../includes/main.header.php';
    require_once '../config/connection.php';
    $clearance_type = $clearance->showClearanceType();
    $beneficiaries = $clearance->showBeneficiaries();
   

    if(isset($_GET['id'])) {
        //Clearance ID
        $id = $_GET['id'];
        $selected_clearance = $clearance->getClearance($id);

    }
?>

<div class="panel p-3">
    <?php if (isset($_GET['error']) == "true") { Errormessage::clearance_update_failed(); } ?>
    <h1 class="panel-title">Clearance</h1>
    <div class="card clearance-card">
        <div class="card-body">
            <form action="../includes/modify_clearance.inc.php" method="get">
                <h1 class="fs-2 card-title mb-4">Modify Clearance</h1>
                <input type="hidden" value="<?php if(isset($_GET['id'])){echo $_GET['id'];} ?>" name="id">
                <div class="row mb-2">
                    <div class="col-md-2 flex-shrink-1 bd-highlight">
                        <label class="form-label">Clearance Beneficiaries</label>
                    </div>
                    <div class="col-md-2 ">
                        <select name="beneficiaries" class="form-select sm-in">
                            <option value="0">Select</option>
                            <?php
                            while ($row_beneficiary = $beneficiaries->fetch(PDO::FETCH_ASSOC)) { ?>
                                 <option value="<?php echo $row_beneficiary['beneficiary_id']; ?>" <?php if ($row_beneficiary['beneficiary_id'] == $selected_clearance['beneficiaries']) {
                                        echo "selected";} ?> > <?php echo $row_beneficiary['beneficiary_type'] ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-2 flex-shrink-1 bd-highlight">
                        <label class="form-label">Clearance Type</label>
                    </div>
                    <div class="col-md-2 ">
                        <select id="disabledSelect" name="clearance_type" class="form-select">
                            <option value="0">Select</option>
                            <?php
                            while ($clearance_row = $clearance_type->fetch(PDO::FETCH_ASSOC)) { ?>
                                <option value="<?php echo $clearance_row['clearance_type_id']; ?>"  <?php if($clearance_row['clearance_type_id'] == $selected_clearance['type']) { echo "selected";} ?>><?php echo $clearance_row['clearance_type'] ?></option>
                               
                            <?php } 
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-2 flex-shrink-1 bd-highlight">
                        <label class="form-label">Academic Year</label>
                    </div>
                    <div class="col-md-2 ">
                        <input type="text" value="<?php echo $selected_clearance['academic_year'] ?>" class="form-control" name="academic_year">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-2 flex-shrink-1 bd-highlight">
                        <label class="form-label">Semester</label>
                    </div>
                    <div class="col-md-2 ">
                        <input type="text" value="<?php echo $selected_clearance['semester'] ?>" class="form-control" name="semester">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-2 ">
                        <button class="btn btn-success" type="submit" name="submit">Update Changes</button>
                    </div>
                </div>
            </form>
        </div>
       
        </div>
    </div>
   
</div>


<?php include_once '../includes/main.footer.php' ?>