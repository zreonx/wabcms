<?php 
    include_once '../includes/main.header.php';
    require_once '../config/connection.php';

    $student_id = $_SESSION['user_id'];
    $clearance_id = $_GET['clearance_id'];
    $clearanceData = $studentClearance->getSignatoryClearance($clearance_id, $student_id);
    $keys = $clearanceData['columns'];

?>

<div class="panel p-3">
    <h1 class="panel-title">Clearance</h1>
    <div class="min-vh-100 c-scroll">
        <div class="card-body d-flex flex-column">
            <div class="student-clearance-grid">
        
            <?php while($student_clearance = $clearanceData['result']->fetch(PDO::FETCH_ASSOC)): ?>
                <?php 
                $signatory_column = array();
                for($i = 3; $i < $clearanceData['count']; $i++ ) {
                    $signatory_column [] = $keys[$i];
                }?>
                <?php for($i = 0; $i < count($signatory_column); $i++ ):
                    $designee = ucwords(str_replace("_", " ",substr($signatory_column[$i], 3, -9))); 
                ?>   
                    <div class="card stclearance-card">
                        <div class="card-body">
                            <span class="d-flex justify-content-center"><?php echo ($student_clearance[$signatory_column[$i]] == 1) ? "<i class='fa-solid text-default fa-check fs-4'></i>" : "<i class='fa-solid fs-4 text-default fa-check invisible'></i>";  ?></span>
                            <hr class="p-0 m-2">
                            <h3 class="fs-6 display-6 text-center"><?php echo $designee; //echo $clearance['signatory'][$i] ?></h3>
   
                        </div>
                    </div>
                <?php endfor; ?>

            <?php endwhile; ?>    
           
            </div>
        </div>
    </div>
    
</div>

<?php include_once '../includes/main.footer.php' ?>