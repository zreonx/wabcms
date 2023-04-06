<?php 
    include_once '../includes/main.header.php';
    require_once '../config/connection.php';

    $student_id = $_SESSION['user_id'];
    $clearance_id = $_GET['clearance_id'];

    $student_clearance = $studentClearance->getSignatoryClearance($clearance_id, $student_id);
    $signatory_designation = $studentClearance->getColumnName();

    $user_data = $_SESSION['user_data'];

?>

<div class="panel p-3">
    <h1 class="panel-title">Clearance</h1>
    <div class="min-vh-100 c-scroll">
        <div class="card-body d-flex flex-column">
            <div class="student-clearance-grid">

                <!-- Show All Program Head -->
                <?php while($des_row = $student_clearance->fetch(PDO::FETCH_ASSOC)): ?>
                    <?php for($i = 0;$i < count($signatory_designation); $i++): 
                        $designee = ucwords(str_replace("_", " ",substr($signatory_designation[$i], 3, -9))); 
                        $signatory_ph_info = $studentClearance->getDesignationId($designee);
                        if($signatory_ph_info['is_program_head'] == '1' AND $signatory_ph_info['office_department'] == $user_data['program_course'] ):
                    ?>    

                                <div class="card stclearance-card">
                                    <div class="card-body">
                                        <span class="d-flex justify-content-center"><?php echo ($des_row[$signatory_designation[$i]] == 1) ? "<i class='fa-solid text-default fa-check fs-4'></i>" : "<i class='fa-solid fs-4 text-default fa-check invisible'></i>";  ?></span>
                                        <hr class="p-0 m-2">
                                        <h3 class="fs-6 display-6 text-center"><?php echo $designee; //echo $signatory_ph_info['last_name'] ?></h3>
                                    </div>
                                </div>
                    <?php          
                             endif;        
                        endfor;      
                    ?>   
                    <!-- Select all signatories except for program -->
                    <?php 
                        for($i = 0;$i < count($signatory_designation); $i++): 
                            $designee = ucwords(str_replace("_", " ",substr($signatory_designation[$i], 3, -9))); 
                            $signatory_ph_info = $studentClearance->getDesignationId($designee);
                            if($signatory_ph_info['is_program_head'] != '1'):
                    ?>    
                                <div class="card stclearance-card">
                                    <div class="card-body">
                                        <span class="d-flex justify-content-center"><?php echo ($des_row[$signatory_designation[$i]] == 1) ? "<i class='fa-solid text-default fa-check fs-4'></i>" : "<i class='fa-solid fs-4 text-default fa-check invisible'></i>";  ?></span>
                                        <hr class="p-0 m-2">
                                        <h3 class="fs-6 display-6 text-center"><?php echo $designee; //echo $signatory_ph_info['last_name'] ?></h3>
                                    </div>
                                </div>
                            <?php 
                            //GET THE ANOTHER DESIGNATION OF SIGNATORY WHETHER THEYRE NOT PROGRAM HEAD BUT ORG
                                elseif($signatory_ph_info['is_program_head'] == '1' AND $signatory_ph_info['is_org'] == '1' AND $signatory_ph_info['office_department'] != $user_data['program_course']):
                            ?>
                            <!-- Patch codes goes here -->
                                
                    <?php          
                            endif;        
                        endfor;      
                    ?>
                    
                <?php endwhile; ?>

                
            </div>
        </div>
    </div>
    
</div>

<?php include_once '../includes/main.footer.php' ?>