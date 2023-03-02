<?php 
    include_once '../includes/main.header.php';
    require_once '../config/connection.php';
    require_once '../includes/user_check.php';

    $signatory_id = $_SESSION['user_id'];
    $activeClearance = $studentClearance->displayClearance();
  

?>

<div class="panel p-3">
    <h1 class="panel-title">Clearance</h1>
    <div class="min-vh-100 c-scroll">
        <div class="card-body d-flex flex-column">
            <div class="student-clearance-grid">

            <?php while($active_clearance = $activeClearance->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="card stclearance-card">
                    <div class="card-body">
                        <h3 class="fs-5 display-6"><?php echo $active_clearance['type_name'] ?> <span class="float-end badge bg-success">#<?php echo $active_clearance['id'] ?></span></h3>
                        <h3 class="fs-6 display-6"><?php echo $active_clearance['academic_year'] ?></h3>
                        <h3 class="fs-6 display-6"><?php echo $active_clearance['semester'] ?>st Semester</h3>
                        <a href="clearance.php?clearance_id=<?php echo $active_clearance['id'] ?>" class="btn btn-default-orange default-hover">View Clearance</a>
                    </div>
                </div>
            <?php endwhile; ?>    
           
            </div>
        </div>
    </div>
    
</div>

<?php include_once '../includes/main.footer.php' ?>