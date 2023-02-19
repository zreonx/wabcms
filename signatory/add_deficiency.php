<?php 
    include_once '../includes/main.header.php';
    require_once '../config/connection.php';

    $signatory_id = $_SESSION['user_id'];
    $activeClearance = $signatoryClearance->selectActiveClearnace();
  

?>

<div class="panel p-3">
    <h1 class="panel-title">Add Student Deficiency</h1>
    <div class="card min-vh-100 c-scroll">
        <div class="card-body d-flex flex-column">
            <h1>This is adding of student deficiency page</h1>
        </div>
    </div>
    
</div>

<?php include_once '../includes/main.footer.php' ?>