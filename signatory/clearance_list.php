<?php 
    include_once '../includes/main.header.php';
    require_once '../config/connection.php';

    $signatory_id = $_SESSION['user_id'];
    $activeClearance = $signatoryClearance->selectActiveClearnace();
  

?>

<div class="panel p-3">
    <h1 class="panel-title">Designations</h1>
    <div class="min-vh-100 c-scroll">
        <div class="card-body d-flex flex-column">
            <div class="designee-list-grid">

            <?php while($active_rows = $activeClearance->fetch(PDO::FETCH_ASSOC)): ?>

                <?php 
                    $designationResult = $signatoryClearance->getDesignationStudents($signatory_id);
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
                                    

                                    <?php  $resultType =  $signatoryClearance->selectClearanceType($active_rows['type']); ?>
                                    <h3 class="fs-5"><?php echo $resultType['clearance_type'] ?><span class="float-end badge bg-success"># <?php echo $active_rows['id'] ?></span></h3>
                                    <h3 class="fs-5 display-5"><?php echo $designationRow['designation'] ?></h3>
                                </div>
                                <div class="designee-body mb-2">
                                    <div class="progress ">
                                        <div class="progress-bar theme-orange" style="width:70%">70%</div>
                                    </div>
                                    <div class="mt-1">
                                        <i class="fa-solid fa-user"></i><span> 80/200</span>
                                    </div>
                                    
                                </div>
                                
                                <div class="designee-footer d-flex justify-content-between">
                                    <a href="student_clearance_record.php?designation=<?php echo $designationRow['designation'] ?>&designation_column=<?php echo $signatory_column ?>&clearance_id=<?php echo $active_rows['id'] ?>" class="btn btn-primary btn-sm align-self-center btn-default default-hover ">View Designation</a>
                                    
                                    <!-- <a class="btn btn-sm rounded-circle circle-btn btn-default " class="btn btn-primary" data-bs-toggle="tooltip" title="Add Deficiency" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" href="../includes/add_deficiency.inc.php?clearance_id=<?php //echo $active_rows['id'] ?>&signatory=<?php //echo $designationRow['designation'] ?>">
                                        <i class="fa-solid fa-person-circle-exclamation"></i>
                                    </a> -->

                                    <a class="btn btn-sm rounded-circle circle-btn btn-default " class="btn btn-primary" data-bs-toggle="tooltip" title="Add Deficiency" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" href="add_deficiency.php?clearance_id=<?php echo $active_rows['id'] ?>&signatory=<?php echo $designationRow['designation'] ?>&type=<?php echo $active_rows['type_name'] ?>&semester=<?php echo $active_rows['semester']?>">
                                        <i class="fa-solid fa-person-circle-exclamation"></i>
                                    </a>
                                    
                                </div>
                            </div>
                            
                        </div>
                    </div>
                <?php endwhile ?>

            <?php endwhile ?>

            </div>
        </div>
    </div>
    
</div>

<?php include_once '../includes/main.footer.php' ?>