<?php 
    include_once '../includes/main.header.php';
    require_once '../config/connection.php';

    $signatoryTable = Paging::getSignatoryTable();
    $sdTable = Paging::getSignatoryDesgination();
    
    $page;
    if(isset($_GET['page'])) {
        $page =$_GET['page'];
   }else {
        $page = 1;
   }
?>

<div class="panel p-3">
    <h1 class="panel-title">Signatories</h1>
    <div class="d-flex search-bar mb-2">
        <div class="btn-group">
            <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-filter"></i>
                Filter by
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">All Student</a></li>
                <li><a class="dropdown-item" href="#">Course</a></li>
                <li><a class="dropdown-item" href="#">Strand</a></li>
                <li><a class="dropdown-item" href="#">SHS</a></li>
                <li><a class="dropdown-item" href="#">College</a></li>
            </ul>
        </div>
        <form class="d-flex" method="get" action="student_record.php">
            <input class="form-control form-control-sm me-2" type="search" name="search" id="search" placeholder="Search" aria-label="Search">
            <div class="list"></div>
            <button class="btn btn-light btn-sm btn-search" name="submitSearch" type="submit">Search</button>
        </form>
    </div>

    <?php ?>
    <div class="card min-vh-100 c-scroll">
        <div class="card-body d-flex flex-column">
            <table class="default-table table c-scroll text-center">
                <tr>
                    <td>#</td>
                    <td>Signatory ID</td>
                    <td>Name</td>
                    <td>Designation</td>
                    <td>Action</td>
      
                </tr>
                <?php
                    $result = $displayPage->getSignatory();
                    $total_pages = $displayPage->pagination();
                    $displayPage->startingPage($page);
                    $count = 1;
                    while($designation_row = $result['signatory_query']->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?php echo $count; $count++ ?></td>
                    <td><?php echo $designation_row['sd_id'] ?></td>
                    <td><?php echo $designation_row['first_name'] . " " . $designation_row['middle_name'] . " " . $designation_row['last_name'] ?></td>
                    <td><?php echo $designation_row['sd_designation'] ?></td>
                    <td>
                        <a href="#" class="btn btn-primary btn-sm" type="submit" name="submitEdit">
                            Edit
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
    <div class="mt-auto">
        <nav aria-label="Page navigation example">
            <ul class="pagination pagination-sm justify-content-end mt-2">
                <li class="page-item"><a class="page-link" href="student_clearance_record.php?page=1">First</a></li>
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item"><a class="page-link" href="student_clearance_record.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                <?php endfor ?>
                <li class="page-item"><a class="page-link" href="student_clearance_ecord.php?page=<?php echo $total_pages ?>">Last</a></li>
            </ul>
        </nav>
    </div>
</div>

<?php include_once '../includes/main.footer.php' ?>