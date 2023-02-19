<?php 
    include_once '../includes/main.header.php';
    require_once '../config/connection.php';
    
    $signatoryStudentResult = $displayPage->getSignatoryStudent($_GET['clearance_id']);
    $total_pages = $displayPage->pagination();

    $page;
    if(isset($_GET['page'])) {
        $page =$_GET['page'];
   }else {
        $page = 1;
   }
    $displayPage->startingPage($page);
    $result = $displayPage->getClearancePage();
?>

<div class="panel p-3">
<?php if (isset($_GET['approve']) && $_GET['approve'] == "true") { Errormessage::approve_success(); } ?>
<?php if (isset($_GET['approve']) && $_GET['approve'] == "failed") { Errormessage::approve_failed(); } ?>
    <h1 class="panel-title"><?php echo isset($_GET['designation']) ? $_GET['designation'] : ""; ?></h1>
    <div class="d-flex search-bar mb-2">
        <div class="btn-group">
            <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-filter"></i>
                Filter by
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">All Clearance</a></li>
                <li><a class="dropdown-item" href="#">Semester</a></li>
                <li><a class="dropdown-item" href="#">Year</a></li>
                <li><a class="dropdown-item" href="#">Type</a></li>
                <li><a class="dropdown-item" href="#">College</a></li>
            </ul>
        </div>
        <form class="d-flex">
            <input class="form-control form-control-sm me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-light btn-sm btn-search" onclick="this.blur();" type="submit">Search</button>
        </form>
    </div>
    <div class="card min-vh-100 c-scroll">
        <div class="card-body d-flex flex-column">
            <table class="default-table table text-center">
                <tr>
                    <td>#</td>
                    <td>Clearance Type</td>
                    <td>Student ID</td>
                    <td>Student Name</td>
                    <td>Academic Level</td>
                    <td>Year Level</td>
                    <td>Status</td>
                    <td>Action</td>
                </tr>

                <?php while($row = $signatoryStudentResult['query']->fetch(PDO::FETCH_ASSOC)):  ?>

                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td>
                        <!-- Clearance type -->
                        <?php 
                             echo $row['clearance_id'];
                        ?>
                    </td>
                    <td><?php echo $row['student_id']; ?></td>
                    <td><?php echo $row['last_name'] . " " . $row['first_name'] . " " . $row['middle_name']; ?></td>
                    <td><?php echo $row['academic_level']; ?></td>
                    <td>
                        <?php 
                            echo $row['year_level'];
                        ?>
                    </td>
                    <td><?php echo ucfirst($row[$_GET['designation_column']]);  ?></td>  
                    <td>
                        <a href="../includes/signatory_approve_clearance.inc.php?student_id=<?php echo $row['student_id'] ?>&designation_column=<?php echo isset($_GET['designation_column']) ? $_GET['designation_column'] : ""; ?>&designation=<?php echo isset($_GET['designation']) ? $_GET['designation'] : ""; ?>&clearance_id=<?php echo isset($_GET['clearance_id']) ? $_GET['clearance_id'] : ""; ?>" class="btn btn-success btn-sm" type="submit" name="submitStart">Approve</a>
                    </td>
                </tr>
                <?php endwhile ?>
            </table> 
        </div>
    </div>
    <div class="mt-auto">
        <nav aria-label="Page navigation example">
            <ul class="pagination pagination-sm justify-content-end mt-2">
                <li class="page-item"><a class="page-link" href="student_clearance_record.php?page=1">First</a></li>
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item"><a class="page-link" href="tudent_clearance_record.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                <?php endfor ?>
                <li class="page-item"><a class="page-link" href="tudent_clearance_record.php?page=<?php echo $total_pages ?>">Last</a></li>
            </ul>
        </nav>
    </div>
</div>

<?php include_once '../includes/main.footer.php' ?>