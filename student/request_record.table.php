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
                            <button data-id="<?php echo $request_row['id'] ?>" class="btn btn-view btn-primary btn-sm btn-wrap"><i class="fa-solid fa-envelope-open"></i></button>
                            <button data-id="<?php echo $request_row['id'] ?>" class="btn btn-cancel btn-danger btn-sm btn-wrap"><i class="fa-solid fa-ban"></i></button>
                        </td>
                    </tr>
                <?php $count++; endwhile; ?>
            </table>

            <script>
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
        