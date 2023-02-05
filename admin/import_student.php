<?php
    include_once '../includes/main.header.php';
    require_once '../config/connection.php';
?>

<div class="panel p-3">
    <?php 
        if (isset($_GET['import']) && $_GET['import'] == "success") { Errormessage::import_success(); }
        if (isset($_GET['error']) && $_GET['error'] == "true") { Errormessage::import_failed(); } 
        if (isset($_GET['import']) && $_GET['import'] == "empty") { Errormessage::import_empty(); } 
        if (isset($_GET['import']) && $_GET['import'] == "invalid") { Errormessage::import_invalid(); }
    ?>
    <h1 class="panel-title">Student</h1>
    <div class="card clearance-card">
        <div class="card-body">
            <form action="../includes/import.inc.php" method="post" enctype="multipart/form-data">
                <h1 class="fs-2 card-title mb-4">Import Student</h1>  
                <div class="row mb-3">
                    <div class="col-md-12">
                        <input type="file" accept=".csv" class="form-control" name="csvfile">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-default" name="submit">Import</button>
                    </div>
                </div>
            </form>
        </div>
       
        </div>
    </div>
    
</div>

<?php include_once '../includes/main.footer.php' ?>