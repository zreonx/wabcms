<?php
    require_once '../config/connection.php';
    $signatoryColumn = $report->getSignatoryColumn();
    $clearance->showClearanceRecord();
    
if(isset($_POST['key'])) {
    $clearanceId = $_POST['clearance_id'];
    $clearanceInfo = $report->getClearanceInfo($clearanceId);
    

    
?>
<div class="reportpage" id="reportPage">                 
<h1 class="fs-3 display-6 text-center">Clearance Summary</h1>
<h3 class="fs-6">Clearance Reference Number: <?php echo $_POST['clearance_id'] ?></h3>
<h3 class="fs-6">: <?php echo $clearanceInfo['clearance_type']; ?> </h3>
<br>Clearance Name

<?php
    for($i = 0; $i < count($signatoryColumn); $i++):
?>
<h3 class="fs-6">Signatory Name: 
    <?php
        $designationInfo = $report->getSignatoryId($signatoryColumn[$i]);
        $designationId = $designationInfo['signatory_id'];
        $signatoryInformation = $report->getSignatoryInfo($designationId);
        echo $signatoryInformation['first_name'] . " " . $signatoryInformation['middle_name'] . " " . $signatoryInformation['last_name'];
    ?>
    </h3>
<h3 class="fs-6">Designation: <?php echo $signatoryColumn[$i] ?></h3>
    <?php
        $designation =  explode(" ", strtolower($signatoryColumn[$i]));
        $final_designation = implode("_", $designation);
        $signatory_column = "is_" . $final_designation ."_approval";
    ?>
<h3 class="fs-6">No. of Cleared: <?php echo $report->countClearedOnSignatories($signatory_column, $clearanceId) ?></h3>
<h3 class="fs-6">No. of Incomplete: <?php echo $report->countIncompleteSignatories($signatory_column, $clearanceId) ?></h3>
<table class="default-table table text-center mb-5">
    <tr>
        <td>Student ID</td>
        <td>Academic Level</td>
        <td>Year Level</td>
        <td>Clearance Status</td>
    </tr>
    <?php

        

        $signatoryClearanceColumn = $report->getClearanceDesignationAll($signatory_column , $clearanceId);
        //print_r($signatoryClearanceColumn);
        while($clearance_row = $signatoryClearanceColumn->fetch(PDO::FETCH_ASSOC)):
    ?>
        <tr>
            <td>
                <?php echo $clearance_row['student_id']; ?>
            </td>
            <td>
                <?php echo $clearance_row['academic_level']; ?>
            </td>
            <td>
                <?php echo $clearance_row['year_level']; ?>
            </td>
            <td>
                <?php echo ($clearance_row['signatory'] == '1') ? 'Cleared' : 'Incomplete'; ?>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<?php endfor; ?>
<div class="overlay"></div> 
<div class="reportBtn position-absolute">
    <div class="print-only">
        <h1 class="fs-3 display-6 d-flex justify-content-center align-items-center "><i class='bx bxs-check-circle text-success px-2'></i> <span>Report is Ready</span> </h1>
    </div>
    
    <button class="btn btn-default print-only" id="printBtn">Print Report</button>
</div>


</div>


<script>
    $('document').ready(function(){
        $('#printBtn').click(function(){
            var printContents = $('#reportPage').html();
            var originalContents = $('body').html();
            $('body').html(printContents);
            window.print();
            $('body').html(originalContents);
            window.location.href = 'clearance_report.php';
        });
    });
</script>

<?php } ?>