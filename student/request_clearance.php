<?php 
    include_once '../includes/main.header.php';
    require_once '../config/connection.php';
    require_once '../includes/user_check.php';

    $user_id = $_SESSION['user_id'];

    $user_data = $_SESSION['user_data'];
    $ctData = $studentClearance->getOrg();
?>

<div class="panel p-3">
    <h1 class="panel-title">Request Clearance</h1>
    <div class="c-scroll rc-page">
        <div class="card-body d-flex rc-page-body pt-0">
            <div class="w-50 rc-col-1">
                <div class="form-group mb-2">
                    <label class="form-label">Clearance Type</label>
                    <div class="custom-select">
                        <div class="select-btn">
                            <span class="d-none" id="selectedValue">
                                <?php 
                                ?>
                            </span>
                            <span class="sbtn-text" id="clearance_type">Select</span>
                            <i class="bx bx-chevron-down"></i>
                        </div>
                        <ul class="select-options my-list">
                            <?php while($ct_row = $ctData->fetch(PDO::FETCH_ASSOC)): ?>
                                <?php 
                                    if($ct_row['clearance_type_id'] == 1|| $ct_row['clearance_type_id'] == 4) {
                                        continue;
                                    }else {
                                ?>
                                    <li class="option">
                                        <span class="option-text"><?php echo $ct_row['clearance_type'] ?></span>
                                    </li>
                                <?php } ?>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Reason of request</label>
                    <textarea class="form-control" name="message" id="message" cols="30" rows="10"></textarea>
                </div>
                <button class="btn btn-default px-3" id="sendBtn">Send Request</button>
            </div>
            <div class="w-100 ps-3" id="rcCard">
                <div class="card sr-card">
                    <div class="card-body" id="rcRecord">

                    </div>
                </div>
            </div>
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
                            <div>
                                <h1 class="fs-6" id="clearance-type">test</h1>
                            </div>
                            <div>
                                <h1 class="fs-6" id="clearance-status"></h1>
                            </div>
                            <div>
                                <h1 class="fs-6" id="date-message"></h1>
                            </div>
                        </div>
                        <div><h1 class="display-6 fs-6">Messages</h1></div>
                        <div> <textarea class="form-control" id="modal-message" style="height: 100px; resize: none;" disabled></textarea></div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/custom_select.js"></script>
    <script>
        $(document).ready(function(){
            let student_id = '<?php echo $_SESSION['user_id'] ?>' ;
            $('#sendBtn').click(function(){
                let clearanceType = $('#clearance_type').text();
                let message = $('#message').val();

                let realCt = 0;

                let ct_id = {
                    'Finals Clearance' : 1,
                    'Transfering Clearance' : 2,
                    'Graduates Clearance' : 3,
                    'SAS Clearance' : 4
                }

                for(let key in ct_id) {
                    if(key === clearanceType){
                        realCt = ct_id[key];
                        break;
                    }
                }

                if(clearanceType != 'Select' && message.length !== 0){
                    $.ajax({
                        method: 'POST',
                        url: '../includes/request_clearance.inc.php',
                        data: {
                            key: "sent",
                            clearance_type: realCt,
                            message: message,
                            student_id: "<?php echo $user_id; ?>",
                        },
                        success: function(result){
                            try{
                                let responseJson = JSON.parse(result);
                                $('.alert').each(function(){
                                    $(this).remove();
                                });

                                if(responseJson.res_message == 'success') {                             
                                    $('.panel-title').before(responseJson.message);
                                }else if(responseJson.res_message == 'failed') {
                                    $('.panel-title').before(responseJson.message);
                                }
                                setTimeout(function(){
                                    $('#error-message').remove();
                                }, 10000);
                            }catch(e) {
                               
                            }
                             $('#clearance_type').text('Select');
                             $('#message').val('');
                        },
                    });
                }else {
                    $('.panel-title').before('<div class="alert alert-warning mt-2" id="error-message">There was missing inputs.</div>');
                    setTimeout(function(){
                        $('#error-message').remove();
                    }, 5000);
                }
            });

            setInterval(function() {
                $.ajax({
                    method: 'POST',
                    url: 'request_record.table.php',
                    data: {
                        student_id: student_id
                    },
                    success: function(result){
                        $('#rcRecord').html(result);
                    },
                });

            }, 1000);
        });
    </script>
</div>

<?php include_once '../includes/main.footer.php' ?>