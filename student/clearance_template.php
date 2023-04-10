<?php 
    require_once '../config/connection.php';
    $student_id = $_SESSION['user_id'];
    $clearance_id = $_GET['clearance_id'];
    $user_data = $_SESSION['user_data'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clerance</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WABCMS</title>
    <link rel="icon" href="../images/ccc_logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/sidemain.css?v=1.2">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-dateFormat/1.0/jquery.dateFormat.min.js"></script>

<body>
    <h1 class="text-center">Clerance</h1>
    <div class="card-body d-flex flex-column" id="clearanceContent">
            <div class="student-clearance-grid" >

                <!-- Show All Program Head -->
                <?php
                    $student_clearance = $studentClearance->getSignatoryClearance($clearance_id, $student_id);
                    $signatory_designation = $studentClearance->getColumnName();
                     while($des_row = $student_clearance->fetch(PDO::FETCH_ASSOC)): ?>
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
    
</body>
</html>