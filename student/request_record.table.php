<?php
    $user_id = $_POST['student_id'];
    require_once '../config/connection.php';
    $studentRequest = $studentClearance->getRequest($user_id);
    
 ?>

            <h1 class="fs-5 display-6">Request Record</h1>
            <table class="default-table table text-center">
                <tr>
                    <td>#</td>
                    <td>Clearance Type</td>
                    <td>Date Requested</td>
                    <td>Status</td>
                    <td>Action</td>
                </tr>
                <?php $count = 1; while($request_row = $studentRequest->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $request_row['clearance_type']; ?></td>
                        <td><?php echo $request_row['date_requested']; ?></td>
                        <td>
                            <?php
                                echo ($request_row['status'] == "pending") ? '<span class="badge bg-warning">Pending</span>' : '<span class="badge bg-success">Issued</span>';
                            ?>
                        <td>
                            <button data-array='["<?php echo $request_row["id"] ?>", "<?php echo $request_row["clearance_type"] ?>", "<?php echo $request_row["date_requested"] ?>", "<?php echo $request_row["reason_of_request"] ?>", "<?php echo $request_row["status"] ?>"]' class="btn btn-view btn-primary btn-sm btn-wrap" data-bs-toggle="modal" data-bs-target="#request_modal"><i class="fa-solid fa-envelope-open"></i></button>
                            <button data-id="<?php echo $request_row['id'] ?>" class="btn btn-cancel btn-danger btn-sm btn-wrap" <?php if($request_row['status'] == 'cancelled' || $request_row['status'] == 'issued'){ echo 'disabled'; } ?>><i class="fa-solid fa-ban"></i></button>
                        </td>
                    </tr>
                <?php $count++; endwhile; ?>
            </table><!-- Button trigger modal -->

            <script>
                    $('.btn-view').click(function(){
                        let requestData = $(this).data('array');
                        $('#clearance-type').text(requestData[1]);
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
                        
                        let datetime = requestData[2];;
                        let formattedDate = $.format.date(datetime, 'MMMM d, yyyy');
                        let formattedTime = $.format.date(datetime, 'h:mm:ss a');
                        $('#date-message').text(formattedDate + " at " + formattedTime);
                        $('#modal-message').text(requestData[3]);
                       
                    });
                    $('.btn-cancel').click(function(){
                        let request_id = $(this).attr('data-id');
                        $.ajax({
                            method: "POST",
                            url: "../includes/cancel_request.inc.php",
                            data: {
                                key: "request",
                                student_id: "<?php echo $_SESSION['user_id']; ?>",
                                request_id : request_id,
                            },
                            success: function(result) {
                                console.log(result);
                            }
                        });
                    });

            </script>
        