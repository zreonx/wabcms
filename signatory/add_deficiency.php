<?php 
    include_once '../includes/main.header.php';
    require_once '../config/connection.php';

    $signatory_id = $_SESSION['user_id'];
    $signatory = $_GET['signatory'];
    $notInDeficiency = $signatoryClearance->showStudents($_GET['clearance_id'], $signatory);
    $showWithDeficiency = $signatoryClearance->showDeficiencyList($_GET['clearance_id'], $signatory);
    $inTempList = $signatoryClearance->showTemporaryDeficiency($_GET['clearance_id'], $signatory);
?>

<div class="panel p-3">
    <?php if(isset($_GET['start']) && $_GET['start'] == "end") { Errormessage::clearance_end(); } ?>
    <?php  if(isset($_GET['insert']) && $_GET['insert'] == "success"){ Errormessage::deficiency_added(); } ?>
    <?php  if(isset($_GET['insert']) && $_GET['insert'] == "failed"){ Errormessage::add_deficiency_fail(); } ?>
    <h1 class="panel-title">Deficiency</h1>
    <div class="card min-vh-100 c-scroll">
        <div class="card-body d-flex flex-column">
           <div>
                <div class="">
                    <div class="d-flex justify-content-between mb-2">
                        <h3 class="fs-5">Clearance # <?php echo $_GET['clearance_id'] ?></h3>
                        <h3 class="fs-5 "><mark><?php echo $_GET['signatory'] ?></mark></h3>
                        <h3 class="fs-5 ">1st Semester</h3>
                    </div>
                    
                    <div class="d-flex gap-3 bd-highlight justify-content-between deficiency-body">
                        <div class="card w-100 card-def">
                            <div class="card-body">
                                <h1 class="fs-5">List of Students</h1>
                                <form class="d-flex w-50">
                                    <input class="form-control form-control-sm me-2" type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-light btn-sm btn-search" onclick="this.blur();" type="submit">Search</button>
                                </form>
                                    <div class="deficiency-card">
                                        <table class="table table-deficiency text-center">
                                            <tr>
                                                <td>#</td>
                                                <td>Student ID</td>
                                                <td>Action</td>
                                            </tr>
                                            <?php while($row_students = $notInDeficiency->fetch(PDO::FETCH_ASSOC)): ?>
                                            <tr>
                                                <td><?php echo $row_students['counter'] ?></td>
                                                <td><?php echo $row_students['student_id'] ?></td>
                                                <td><a href="../includes/add_temp_deficiency.inc.php?clearance_id=<?php echo $_GET['clearance_id'] ?>&signatory_id=<?php echo $signatory_id ?>&signatory=<?php echo $signatory ?>&student_id=<?php echo $row_students['student_id'] ?>" class="btn btn-sm btn-primary btn-add">Select</a></td>
                                            </tr>
                                            <?php endwhile ?>
                                        </table>
                                        
                                    </div>
                                </div>
                                
                        </div>
                        <div class="card border-0 w-100 flex-fill">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active rounded-0" data-bs-toggle="tab" href="#home">Add Deficiency</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link rounded-0" data-bs-toggle="tab" href="#menu1">Deficient Students</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane container active" id="home">
                                <div class="card-body d-flex flex-column">
                                    <div class="add-deficiency-table">
                                        <form action="../includes/add_deficiency.inc.php" method="GET">
                                            <table class="table text-center table-light" id="add-deficiency">
                                                <tr>
                                                    <td>#</td>
                                                    <td>Student ID</td>
                                                    <td>Action</td>
                                                </tr>

                                                
                                                <?php while($row_temp_student = $inTempList->fetch(PDO::FETCH_ASSOC)): ?>
                                                <tr>
                                                    <td><?php echo $row_temp_student['counter'] ?></td>
                                                    <td><?php echo $row_temp_student['student_id'] ?></td>
                                                    <td><a href="../includes/delete_temporary_deficiency.inc.php? clearance_id=<?php echo $_GET['clearance_id'] ?>&signatory_id=<?php echo $signatory_id ?>&signatory=<?php echo $signatory ?>&student_id=<?php echo $row_temp_student['student_id'] ?>&temp_id=<?php echo $row_temp_student['id'] ?>" class="btn btn-sm btn-danger rounded-circle"><i class="fa-sharp fa-solid fa-minus"></i></a></td>  
                                                    
                                                    <input type="hidden" name="students[]" value="<?php echo $row_temp_student['student_id'] ?>">
                                                    <input type="hidden" name="def_id[]" value="<?php echo $row_temp_student['id'] ?>">
                                                <?php endwhile ?>                
                                            </table>
                                        </div>
                                        
                                        <div class="form-outline">
                                            <input type="hidden" name="signatory_id" value="<?php echo $signatory_id ?>">
                                            <input type="hidden" name="signatory" value="<?php echo $signatory ?>">
                                            <input type="hidden" name="clearance_id" value="<?php echo $_GET['clearance_id'] ?>">
                                            
                                            <label class="form-label" >Message</label>
                                            <textarea class="form-control" name="message" rows="4" style="resize: none;"></textarea>
                                            <div class="m-0 p-0">
                                                <button type="submit" name="submitDeficiency" class="mt-3 btn btn-success">Submit Deficiency</button>
                                            </div>   
                                        </form>                          
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane container fade" id="menu1">
                                <div class="card-body d-flex flex-column justify-content-between ">
                                        <div>
                                            <table class="table text-center table-light">
                                                <tr>
                                                    <td>#</td>
                                                    <td>Student ID</td>
                                                    <td>Action</td>
                                                </tr>
                                                 
                                            <?php while($row_def_student = $showWithDeficiency->fetch(PDO::FETCH_ASSOC)): ?>
                                            <tr>
                                                <td><?php echo $row_def_student['counter'] ?></td>
                                                <td><?php echo $row_def_student['student_id'] ?></td>
                                                
                                                <td>
                                                    <a class="btn btn-sm btn-success rounded-circle"><i class="fa-solid fa-check"></i></a>
                                                    <a href="../includes/delete_temporary_deficiency.inc.php?clearance_id=<?php echo $_GET['clearance_id'] ?>&signatory_id=<?php echo $signatory_id ?>&signatory=<?php echo $signatory ?>&student_id=<?php echo $row_temp_student['student_id'] ?>&temp_id=<?php echo $row_temp_student['id'] ?>" class="btn btn-sm btn-primary rounded-circle"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                                </td>
                                            <?php endwhile ?>       
                                                
                                                
                                            </table>
                                        </div>
                                        <div class="form-outline">
                                            <div class="m-0 p-0">
                                                <button class="mt-3 btn btn-success">Clear All</button>
                                            </div>                             
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </div>

    
</div>

<?php include_once '../includes/main.footer.php' ?>