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
                            <button data-array='["<?php echo $rc_row["id"] ?>", "<?php echo $rc_row["clearance_type_name"] ?>", "<?php echo $rc_row["date_requested"] ?>", "<?php echo $rc_row["reason_of_request"] ?>", "<?php echo $rc_row["cr_status"] ?>", "<?php echo $rc_row["last_name"] ?>, <?php echo $rc_row["first_name"] ?>, <?php echo substr($rc_row["middle_name"], 0, 1) ?>. ", "<?php echo $rc_row["year_level"] ?>", "<?php echo $rc_row["program_course"] ?>"]' class="btn btn-view btn-primary btn-sm btn-wrap" data-bs-toggle="modal" data-bs-target="#request_modal"><i class="fa-solid fa-envelope-open"></i></button>
                            <button data-id="<?php echo $rc_row['id']; ?>" class="btn btn-reject btn-danger btn-sm btn-wrap"><i class="fa-solid fa-ban"></i></button>
                        </td>
                    </tr>
                <?php $count++; endwhile ?>
            </table>

            <!-- Modal -->
            <div class="modal fade" id="request_modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Request Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ">
                        <div class="d-flex justify-content-between">
                            <div class="order-1">
                                <h1 class="fs-6 display-6">Clearance Requesting</h1>
                                <h1 class="fs-6" id="clearance-type"></h1>
                            </div>
                            <div class="order-0">
                                 <h1 class="fs-6 display-6">Status</h1>
                                <h1 class="fs-6" id="clearance-status"></h1>
                            </div>
                            <div class="order-3">
                                <h1 class="fs-6 display-6">Date Requested</h1>
                                <h1 class="fs-6" id="date-message"></h1>
                            </div>
                        </div>
                        <hr class="p-0 m-0 mb-2">
                        <div>
                            <div class="d-flex">
                                <h1 class="fs-6 display-6">Full Name: </h1>
                                <h1 class="fs-6 px-2" id="fullname"></h1>
                            </div>
                            <div class="d-flex">
                                <h1 class="fs-6 display-6">Program / Course: </h1>
                                <h1 class="fs-6 px-2" id="course_modal"></h1>
                            </div>
                            <div class="d-flex">
                                <h1 class="fs-6 display-6">Year Level: </h1>
                                <h1 class="fs-6 px-2" id="year_level_modal"></h1>
                            </div>
                        </div>
                        <div><h1 class="display-6 fs-6">Messages</h1></div>
                        <div> <textarea class="form-control" id="modal-message" style="height: 100px; resize: none;" disabled></textarea></div>
                        
                    </div>
                    <div class="modal-footer">
                        <button data-id="<?php echo $rc_row['id']; ?>" class="btn btn-issue btn-success btn-wrap"><i class="fa-solid fa-pen-to-square"></i> Issue Clearance</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>

            <script>
                $(document).ready(function(){
                    $('.btn-view').click( function() {
                        const requestData = $(this).data('array')
                        console.log(requestData)
                        $('#clearance-type').text(requestData[1])
                        let status = requestData[4];
                        if(status == "pending") {
                            $('#clearance-status').html('<span class="badge bg-warning">Pending</span>');
                        }else if(status == "cancelled") {
                            $('#clearance-status').html('<span class="badge bg-danger">Cancelled</span>');
                        }else if(status == "rejected") {
                            $('#clearance-status').html('<span class="badge bg-default">Rejected</span>');
                        }else {
                            $('#clearance-status').html('<span class="badge bg-success">Issued</span>');
                        }
                        
                        let datetime = requestData[2];
                        let formattedDate = $.format.date(datetime, 'MMMM d, yyyy');
                        let formattedTime = $.format.date(datetime, 'h:mm:ss a');

                        $('#fullname').text(requestData[5]);
                        $('#course_modal').text(requestData[7]);
                        $('#year_level_modal').text(requestData[6]);
                        $('#date-message').text(formattedDate + " at " + formattedTime);
                        $('#modal-message').text(requestData[3]);

                    })
                })
            </script>
           
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