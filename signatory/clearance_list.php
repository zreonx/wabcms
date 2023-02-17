<?php 
    include_once '../includes/main.header.php';
    require_once '../config/connection.php';

    $signatory_id = $_SESSION['user_id'];
    $designationResult = $signatoryClearance->getDesignationStudents($signatory_id);

?>

<div class="panel p-3">
    <h1 class="panel-title">Desinations</h1>
    <div class="card min-vh-100 c-scroll">
        <div class="card-body d-flex flex-column">
            <div class="designee-list-grid">

            <?php 
                while($designationRow = $designationResult->fetch(PDO::FETCH_ASSOC)):

                //create a column name for signatory based on designation
                $designation =  explode(" ", strtolower($designationRow['designation']));
                $final_designation = implode("_", $designation);
                $signatory_column = "is_" . $final_designation ."_approval";
            ?>
                <div class="card card-designee shadow-drop-br">
                    <div class="card-body p-2">
                        <div class="designation d-flex justify-content-center flex-column">
                            <div class="title">
                                <h3 class="fs-5 "><?php echo $designationRow['designation'] ?></h3>
                            </div>
                            <div class="designee-body mb-2">
                                <div class="progress ">
                                    <div class="progress-bar theme-orange" style="width:70%">70%</div>
                                </div>
                                <div class="mt-1">
                                    <i class="fa-solid fa-user"></i><span> 80/200</span>
                                </div>
                                
                            </div>
                            
                            <div class="designee-footer">
                                <a href="student_clearance_record.php?designation=<?php echo $designationRow['designation'] ?>&designation_column=<?php echo $signatory_column ?>" class="btn btn-primary btn-sm btn-default default-hover">View Designation</a>
                            </div>
                        </div>
                        
                    </div>
                </div>
            <?php endwhile ?>

            </div>
        </div>
    </div>
    
</div>

<?php include_once '../includes/main.footer.php' ?>