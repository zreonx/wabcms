<?php 
    include_once '../includes/main.header.php';
    require_once '../config/connection.php';
    $studentTable = Paging::getClearanceTable();
    $numOfRow = $displayPage->rowCount($studentTable);
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
    <?php if (isset($_GET['modify']) && $_GET['modify'] == "success") { Errormessage::clearance_update_success(); } ?>
    <?php if (isset($_GET['modify']) && $_GET['modify'] == "failed") { Errormessage::clearance_update_success(); } ?>
    <?php if (isset($_GET['start']) && $_GET['start'] == "started") { Errormessage::clearance_started(); } ?>
    <?php if (isset($_GET['start']) && $_GET['start'] == "failed") { Errormessage::clearance_failed(); } ?>
    <?php if (isset($_GET['start']) && $_GET['start'] == "success") { Errormessage::clearance_start(); } ?>
    <?php if (isset($_GET['start']) && $_GET['start'] == "ended") { Errormessage::clearance_ended(); } ?>
    <?php if (isset($_GET['start']) && $_GET['start'] == "endfail") { Errormessage::clearance_end_fail(); } ?>
    <?php if (isset($_GET['start']) && $_GET['start'] == "end") { Errormessage::clearance_end(); } ?>
    <h1 class="panel-title">Clearance</h1>
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
    <div class="card c-scroll">
        <div class="card-body d-flex flex-column">
            <table class="default-table table text-center">
                <tr>
                    <td>#</td>
                    <td>Type</td>
                    <td>Semester</td>
                    <td>Academic Year</td>
                    <td>Beneficiaries</td>
                    <td>Date Created</td>
                    <td>Date Start</td>
                    <td>Date End</td>
                    <td>Status</td>
                    <td>Action</td>
                </tr>

                <?php $count = 1; while($row = $result->fetch(PDO::FETCH_ASSOC)):  ?>

                <tr>
                    <td><?php echo $count; $count++ ?></td>
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
                            echo ($row['beneficiaries'] == '1') ? "All Student" : $row['beneficiaries'] ;
                        ?>
                    </td>
                    <td><?php echo $row['date_created']; ?></td>
                    <td><?php echo $row['date_issued']; ?></td>
                    <td><?php echo $row['end_date']; ?></td>
                    <td><?php echo ucfirst($row['status']);  ?></td>  
                    <td>
                        <a href="modify_clearance.php?id=<?php echo $row['id'] ?>" class="btn btn-wrap btn-primary btn-sm" type="submit" name="submitEdit">Edit</a>
                        <a href="../includes/start_clearance.inc.php?clearance_id=<?php echo $row['id'] ?>" class="btn btn-wrap btn-success btn-sm" type="submit" name="submitStart">Start</a>
                        <a href="../includes/end_clearance.inc.php?clearance_id=<?php echo $row['id'] ?>" class="btn btn-wrap btn-danger btn-sm"  name="SubmitEnd">End</a>
                    </td>
                </tr>
                <?php endwhile ?>
            </table> 
        </div>
    </div>
    <div class="mt-auto">
        <nav aria-label="Page navigation example">
            <ul class="pagination pagination-sm justify-content-end mt-2">
                <li class="page-item"><a class="page-link" href="clearance_record.php?page=1">First</a></li>
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item"><a class="page-link" href="clearance_record.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                <?php endfor ?>
                <li class="page-item"><a class="page-link" href="clearance_record.php?page=<?php echo $total_pages ?>">Last</a></li>
            </ul>
        </nav>
    </div>
    
</div>

<?php include_once '../includes/main.footer.php' ?>