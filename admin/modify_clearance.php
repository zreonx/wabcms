<?php
    include_once '../includes/main.header.php';
    require_once '../config/connection.php';
    $result = $clearance->showClearanceType();
    $beneficiaries = $clearance->showBeneficiaries();
    
    

    if(isset($_GET['id'])) {
        //Clearance ID
        $id = $_GET['id'];
        $selected_clearance = $clearance->getClearance($id);
    }
?>



<div class="panel p-3">
    <h1 class="panel-title">Clearance</h1>  
    <div class="card clearance-card">
        <div class="card-body">
            <form action="../includes/modify_clearance.inc.php" method="get">
                <h1 class="fs-2 card-title mb-4">Create Clearance</h1>
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
                                 <option value="<?php echo $row_beneficiary['id']; ?>" <?php if($row_beneficiary['id'] == $selected_clearance['type']) {echo "selected";} ?>> <?php echo $row_beneficiary['name'] ?></option>
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
                            while ($rows = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                                <option value="<?php echo $rows['id']; ?>" <?php if($rows['id'] == $selected_clearance['id']) {echo "selected";} ?>> <?php echo $rows['name'] ?></option>
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