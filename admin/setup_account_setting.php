<?php
    include_once '../includes/main.header.php';
    require_once '../config/connection.php';
?>

<div class="panel p-3">

    <h1 class="panel-title">Settings</h1>
    <hr>

    <div class="card settings border-0">
        <div class="card-body p-0">
            <div class="mb-4">
                <h3 class="fs-5" > Setup User Accounts</h3>
                <p class="fs-6 dispay-1 mb-2">Set up signatory and student accounts</p>
                <a class="btn btn-sm btn-default" href="../includes/setup_accounts.inc.php">
                        Setup User Accounts
                </a>
            </div>
            
            <div class="">
                <h3 class="fs-5" > Setup Signatory Designation</h3>
                <p class="fs-6 dispay-1 mb-2">Set up signatory designations</p>
                <a class="btn btn-sm btn-default" href="../includes/setup_signatory.inc.php">
                Setup Designation
                </a>
            </div>
        </div>
    </div>
    
</div>

<?php include_once '../includes/main.footer.php' ?>