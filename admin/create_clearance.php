<?php
    include_once '../includes/main.header.php';
    require_once '../config/connection.php';
    $result = $clearance->showClearanceType();
?>

<div class="panel p-3">
    <h1 class="panel-title">Clearance</h1>
    <div class="card clearance-card">
        <div class="card-body">
            <form action="../includes/create.inc.php" method="get">
                <h1 class="fs-2 card-title mb-4">Create Clearance</h1>
                <div class="row mb-2">
                    <div class="col-md-2 flex-shrink-1 bd-highlight">
                        <label class="form-label">Clearance Beneficiaries</label>
                    </div>
                    <div class="col-md-2 ">
                        <select name="beneficiaries" class="form-select sm-in">
                            <option value="0">Select</option>
                            <option value="all">All Student</option>
                            <option value="specific">Specific</option>
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
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['name'] ?></option>
                        <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-2 flex-shrink-1 bd-highlight">
                        <label class="form-label">Academic Year</label>
                    </div>
                    <div class="col-md-2 ">
                        <input type="text" class="form-control" name="academic_year">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-2 flex-shrink-1 bd-highlight">
                        <label class="form-label">Semester</label>
                    </div>
                    <div class="col-md-2 ">
                        <input type="text" class="form-control" name="semester">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-2 ">
                        <button class="btn btn-success" type="submit" name="submit">Create</button>
                    </div>
                </div>
            </form>
        </div>
       
        </div>
    </div>
    
</div>

<?php include_once '../includes/main.footer.php' ?>