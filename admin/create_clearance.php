<?php include_once '../includes/main.header.php' ?>

<div class="panel p-3">
    <h1 class="panel-title">Clearance</h1>
    <div class="card">
        <div class="card-body">
        <h1 class="fs-6 card-title">Create Clearance</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-6">
                        <label class="form-label">Clearance Beneficiaries</label>
                            <select id="disabledSelect" class="form-select">
                                <option>Select</option>
                                <option>All Student</option>
                                <option>Specific</option>
                            </select>
                        </div>
                        <div class="col-md-6 d-none">
                        <label class="form-label">Search Student </label>
                            <input type="text" class="form-control" name="search_clearance" placeholder="Search" >
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Clearance Type</label>
                    <select id="disabledSelect" class="form-select">
                        <option>Select</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Academic Year</label>
                    <input type="text" class="form-control" name="academic_year">
                </div>
                <div class="mb-3">
                    <label class="form-label">Semester</label>
                    <select id="disabledSelect" class="form-select">
                        <option>Select</option>
                        <option>1</option>
                        <option>2</option>
                    </select>
                </div>
            </div>
        </div>
       
        </div>
    </div>
    
</div>

<?php include_once '../includes/main.footer.php' ?>