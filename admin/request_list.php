<?php 
    include_once '../includes/main.header.php';
    require_once '../config/connection.php';
    $userTable = Paging::getRequestClearanceTable();
    $numOfRow = $displayPage->rowCount($userTable);
    $total_pages = $displayPage->pagination();
    $page;
    if(isset($_GET['page'])) {
        $page =$_GET['page'];
   }else {
        $page = 1;
   }

    $displayPage->startingPage($page);
    $request_list = $displayPage->getAllRequest();
    

    
?>

<div class="panel p-3">
    <h1 class="panel-title">Clearance Request List</h1>
    <div class="d-flex search-bar mb-2">
    </div>
    <div class="card c-scroll">
        <div class="card-body d-flex flex-column">
            <table class="default-table table text-center">
                <tr>
                    <td>#</td>
                    <td>Requested Clearance</td>
                    <td>Student Id</td>
                    <td>Year Level</td>
                    <td>Program / Course</td>
                    <td>Date Requested</td>
                    <td>status</td>
                    <td>Action</td>
                </tr>
                <?php $count = 1; while($rc_row = $request_list->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo $count ?></td>
                        <td><?php echo $rc_row['clearance_type_name']; ?></td>
                        <td><?php echo $rc_row['student_id']; ?></td>
                        <td><?php echo $rc_row['year_level']; ?></td>
                        <td><?php echo $rc_row['program_course']; ?></td>
                        <td><?php echo $rc_row['date_requested']; ?></td>
                        <td><?php echo ($rc_row['cr_status'] == "issued") ? '<span class="badge bg-success">Issued</span>' : (($rc_row['cr_status'] == "pending") ? '<span class="badge bg-warning">Pending</span>' : '<span class="badge bg-danger">Cancelled</span>'); ?></td>
                        <td>
                            <button data-id="<?php echo $rc_row['id']; ?>" class="btn btn-view btn-primary btn-sm btn-wrap">View</button>
                            <button data-id="<?php echo $rc_row['id']; ?>" class="btn btn-issue btn-default btn-sm btn-wrap">Issue Clearance</button>
                            <button data-id="<?php echo $rc_row['id']; ?>" class="btn btn-reject btn-danger btn-sm btn-wrap">Reject</button>
                        </td>
                    </tr>
                <?php $count++; endwhile ?>
            </table>
           
        </div>
    </div>
    <div class="mt-auto">
        <nav aria-label="Page navigation example">
            <ul class="pagination pagination-sm justify-content-end mt-2">
                <li class="page-item"><a class="page-link" href="request_list.php?page=1">First</a></li>
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item"><a class="page-link" href="request_list.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                <?php endfor ?>
                <li class="page-item"><a class="page-link" href="request_list.php?page=<?php echo $total_pages ?>">Last</a></li>
            </ul>
        </nav>
    
    </div>
    
</div>

<?php include_once '../includes/main.footer.php' ?>