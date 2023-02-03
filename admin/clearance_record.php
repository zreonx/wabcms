<?php 
    include_once '../includes/main.header.php';
    require_once '../config/connection.php';
    $result = $clearance->showClearanceRecord();
?>

<div class="panel p-3">
    <?php if (isset($_GET['success']) == "true") { Errormessage::clearance_create_success(); } ?>
    <h1 class="panel-title">Clearance</h1>
    <div class="card c-scroll">
        <div class="card-body">
           
            <table class="clearance-table table c-scroll">
                <tr>
                    <td>#</td>
                    <td>Type</td>
                    <td>Semester</td>
                    <td>Academic Year</td>
                    <td>Beneficiaries</td>
                    <td>Date Start</td>
                    <td>Date End</td>
                    <td>Status</td>
                    <td>Action</td>
                </tr>

                <?php while($row = $result->fetch(PDO::FETCH_ASSOC)):  ?>
                    
                    
                
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td>
                        <!-- Clearance type -->
                        <?php 
                             echo $row['clearance_type'];
                        ?>
                    </td>
                    <td><?php echo $row['semester']; ?></td>
                    <td><?php echo $row['academic_year']; ?></td>

                        <!-- Beneficiaries -->
                    <td>
                        <?php 
                            echo $row['beneficiary_type'];
                        ?>
                    </td>
                    <td><?php echo $row['date_issued']; ?></td>
                    <td><?php echo $row['end_date']; ?></td>
                    <td><?php echo $row['status']; ?></td>  
                    <td>
                        <a href="modify_clearance.php?id=<?php echo $row['id'] ?>" class="btn btn-primary" type="submit" name="submitEdit">Edit</a>
                        <button class="btn btn-success" type="submit" name="submitActivate">Activate</button>
                        <button class="btn btn-danger" type="submit" name="submitDeactivate">Deactivate</button>
                    </td>
                </tr>
                <?php endwhile ?>
            </table>
        </div>
    </div>
    
</div>

<?php include_once '../includes/main.footer.php' ?>