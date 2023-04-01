<?php 
    include_once '../includes/main.header.php';
    require_once '../config/connection.php';

    $signatory_id = $_SESSION['user_id'];
    $signatory = $_GET['signatory'];
    $clearance_id = $_GET['clearance_id'];
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
                    <div class="d-flex justify-content-between mb-2 title-signatory-def">
                        <h3 class="fs-5 bg-default "><?php echo $_GET['signatory'] ?></h3>
                        <h3 class="fs-5 display-6">1st Semester | <?php echo $_GET['type']?> #<?php echo $_GET['clearance_id']?></h3>
                    </div>
                    
                    <div class="deficiency-body">
                        <div class="card w-100">
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
                                            <td><a href="../includes/add_temp_deficiency.inc.php?clearance_id=<?php echo $_GET['clearance_id'] ?>&signatory_id=<?php echo $signatory_id ?>&signatory=<?php echo $signatory ?>&student_id=<?php echo $row_students['student_id'] ?>&type=<?php echo $_GET['type'] ?>" class="btn btn-sm btn-primary btn-add">Select</a></td>
                                        </tr>
                                        <?php endwhile ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card border-0 w-100">
                            <ul class="nav nav-tabs tab-nav" id="myTab">
                                <li class="nav-item">
                                    <a class="nav-link active rounded-0" data-value="1" id="swap1" href="#menu1" data-bs-toggle="tab" href="#home">Add Deficiency</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link rounded-0" data-bs-toggle="tab" id="swap2" href="#menu2" data-value="2" href="#menu1">Deficient Students</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane container active" id="menu1">
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
                                                        <td><a href="../includes/delete_temporary_deficiency.inc.php? clearance_id=<?php echo $_GET['clearance_id'] ?>&signatory_id=<?php echo $signatory_id ?>&signatory=<?php echo $signatory ?>&student_id=<?php echo $row_temp_student['student_id'] ?>&temp_id=<?php echo $row_temp_student['id'] ?>&type=<?php echo $_GET['type']?>" class="btn btn-sm btn-danger rounded-circle"><i class="fa-sharp fa-solid fa-minus"></i></a></td>  
                                                        
                                                        <input type="hidden" name="students[]" value="<?php echo $row_temp_student['student_id'] ?>">
                                                        <input type="hidden" name="def_id[]" value="<?php echo $row_temp_student['id'] ?>">
                                                        <input type="hidden" name="type" value="<?php echo $_GET['type'] ?>">
                                                    <?php endwhile ?>                
                                                </table>
                                            </div>
                                            
                                            <div class="form-outline">
                                                <input type="hidden" name="signatory_id" value="<?php echo $signatory_id ?>">
                                                <input type="hidden" name="signatory" value="<?php echo $signatory ?>">
                                                <input type="hidden" name="clearance_id" value="<?php echo $_GET['clearance_id'] ?>">
                                                <input type="hidden" name="type" value="<?php echo $_GET['type'] ?>">

                                                <label class="form-label" >Message</label>
                                                <textarea class="form-control" name="message" rows="4" style="resize: none;"></textarea>
                                                <div class="m-0 p-0">
                                                    <button type="submit" name="submitDeficiency" class="mt-3 btn btn-success">Submit Deficiency</button>
                                                </div>   
                                            </form>                          
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane container fade active" id="menu2">
                                    <div class="card-body d-flex flex-column justify-content-between ">
                                        <div>
                                            <form action="../includes/clear_all_deficiency.inc.php" method="GET">
                                                <table class="table text-center table-light">
                                                    <tr>
                                                        <td>#</td>
                                                        <td>Student ID</td>
                                                        <td>Action</td>
                                                    </tr>
                                                <input type="hidden" name="type" value="<?php echo $_GET['type'] ?>">
                                                <?php while($row_def_student = $showWithDeficiency->fetch(PDO::FETCH_ASSOC)): ?>
                                                <tr>
                                                    <td><?php echo $row_def_student['counter'] ?></td>
                                                    <td><?php echo $row_def_student['student_id'] ?></td>
                                                    
                                                    <td>
                                                        <a href="../includes/remove_deficiency.inc.php?clearance_id=<?php echo $_GET['clearance_id']?>&signatory_id=<?php echo $signatory_id ?>&signatory=<?php echo $signatory?>&student_id=<?php echo $row_def_student['student_id'] ?>&id=<?php echo $row_def_student['id'] ?>&type=<?php echo $_GET['type']?>" class="btn btn-sm btn-success rounded-circle"><i class="fa-solid fa-check"></i></a>
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal<?php echo $row_def_student['id'] ?>">
                                                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                                        </button>
                                                        <div class="modal fade" id="myModal<?php echo $row_def_student['id'] ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">

                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title fs-5 display-5">Deficiency Details</h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>

                                                            <!-- Modal body -->
                                                            <div class="modal-body text-start align-items-center">
                                                                <div class="form-group d-flex ">
                                                                    <label class="form-label flex-1">Student ID: </label>
                                                                    <label class="form-label ms-2"><?php echo $row_def_student['student_id'];?></label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="form-label">Message</label>
                                                                    <textarea class="form-control" name="message" rows="3" style="height: 121px;"><?php echo $row_def_student['message'];?></textarea>
                                                                </div>
                                                            </div>

                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                                            </div>

                                                            </div>
                                                        </div>
                                                        </div>
                                                    </td>

                                                    <input type="hidden" name="students[]" value="<?php echo $row_def_student['student_id'] ?>">
                                                    <input type="hidden" name="def_id[]" value="<?php echo $row_def_student['id'] ?>">
                                                    <input type="hidden" name="type" value="<?php echo $_GET['type'] ?>">
                                                    <?php endwhile ?>       
                                                            
                                                </table>

                                                <input type="hidden" name="signatory_id" value="<?php echo $signatory_id ?>">
                                                <input type="hidden" name="signatory" value="<?php echo $signatory ?>">
                                                <input type="hidden" name="clearance_id" value="<?php echo $clearance_id?>">
                                                <input type="hidden" name="type" value="<?php echo $_GET['type'] ?>">
                                        
                                                <div class="form-outline">
                                                    <div class="m-0 p-0">
                                                        <button type="submit" name="clearAllSubmit" class="mt-3 btn btn-success">Clear All</button>
                                                    </div>  
                                                </div>   
                                            </form>                        
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