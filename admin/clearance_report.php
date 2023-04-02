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

    $clearanceRecord = $clearance->showClearanceRecord();
?>

<div class="panel p-3">
    <h1 class="panel-title">Clearance Report</h1>
    <div class="d-flex search-bar mb-2">
        <!-- <div class="btn-group">
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
        </div> -->
    </div>
    <div class="card min-vh-100 c-scroll">
        <div class="card-body d-flex flex-column">
        <div class="card mb-2">
            <div class="card-body">
                <h1 class="fs-3 display-6">Generate Report</h1>
                <div class="row">
                <div class="col-md-3 mb-2">
                        <div class="custom-select" >
                            <div class="select-btn">
                                <span class="sbtn-text" id="clearanceID">Clearance Reference Number</span>
                                <i class="bx bx-chevron-down"></i>
                            </div>
                            <ul class="select-options my-list" id="yearLevelSelect">
                                <?php while($clearance_row = $clearanceRecord->fetch(PDO::FETCH_ASSOC)): ?>
                                    <li class="option">
                                        <span class="option-text"><?php echo $clearance_row['id']?></span>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 mb-2">
                        <div class="custom-select">
                            <div class="select-btn">
                                <span class="sbtn-text" id="yearLevelBtn">Year Level</span>
                                <i class="bx bx-chevron-down"></i>
                            </div>
                            <ul class="select-options my-list" id="yearLevelSelect">
                                <li class="option">
                                    <span class="option-text">College</span>
                                </li>
                                <li class="option">
                                    <span class="option-text">1</span>
                                </li>
                                <li class="option">
                                    <span class="option-text">2</span>
                                </li>
                                <li class="option">
                                    <span class="option-text">3</span>
                                </li>
                                <li class="option">
                                    <span class="option-text">4</span>
                                </li>
                                <li class="option">
                                    <span class="option-text">SHS</span>
                                </li>
                                <li class="option">
                                    <span class="option-text">11</span>
                                </li>
                                <li class="option">
                                    <span class="option-text">12</span>
                                </li>
                            </ul>
                        
                        </div>
                    </div>
                    <div class="col-sm-3 mb-2">
                        <div class="custom-select">
                            <div class="select-btn">
                                <span class="sbtn-text" id="clearanceStatus">Clearance Status</span>
                                <i class="bx bx-chevron-down"></i>
                            </div>
                            <ul class="select-options my-list">
                                <li class="option">
                                    <span class="option-text">Cleared</span>
                                </li>
                                <li class="option">
                                    <span class="option-text">Incomplete</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row mt-1">
                    <div class="col-sm-3">
                        <button class="btn btn-default" id="generateBtn">Generate Report</button>
                    </div>
                </div>
            </div>
        </div>
        
            <script>

                 // Get all select elements on the page
                const selectMenus = document.querySelectorAll('.custom-select');

                selectMenus.forEach((optionMenu) => {
                    const selectBtn = optionMenu.querySelector('.select-btn');
                    const menuOptions = optionMenu.querySelectorAll('.option');
                    const sBtnText = optionMenu.querySelector('.sbtn-text');

                    selectBtn.addEventListener('click', () => {
                        // Toggle the active-select class only for the current select menu
                        optionMenu.classList.toggle('active-select');
                    });

                    menuOptions.forEach((option) => {
                        option.addEventListener('click', () => {

                        const prevActive = optionMenu.querySelector('.active');
                        if (prevActive) {
                            prevActive.classList.remove('active');
                        }
                        let selectedOption = option.querySelector('.option-text').innerText;
                        //option.classList.add('active');
                        sBtnText.innerText = selectedOption;

                        // Remove the active-select class only for the current select menu
                        optionMenu.classList.remove('active-select');

                        });
                    });
                    

                    document.addEventListener('click', function (event) {
                        // If the click is not inside the select button or the options menu, remove the active-select class
                        if (!event.target.matches('.select-btn') && !event.target.closest('.custom-select')) {
                        optionMenu.classList.remove('active-select');
                        }
                    });

                    
            
                });
   
            </script>

            <div class="card mb-3 " id="reportCard">
                <div class="card-body" >
                    <div id="tableReport">

                    </div>
                    
                    <script>
                        $(document).ready(function(){
                            $('#generateBtn').click(function(){

                                let yearlevel = $('#yearLevelBtn').html();
                                let clearanceStatus = $('#clearanceStatus').html();
                                let clearanceId = $('#clearanceID').html();


                                var spinner = '<div class="spinner"><div class="spinner-border spinner-border-sm" role="status"><span class="visually-hidden">Loading...</span></div> <span>Please wait</span></div>';
                                $('#generateBtn').html(spinner);
                                $.ajax({
                                    type: 'POST',
                                    url: 'report_page.php',
                                    data: {
                                        key: 'report',
                                        clearance_id: clearanceId,
                                        year_level: yearlevel,
                                        clearance_status: clearanceStatus,
                                    },
                                    success: function(response){
                                        setTimeout(function(){
                                            $('#reportCard').show();
                                            $('#generateBtn').html('Generate Report');
                                            $('#tableReport').html(response);
                                        }, 1000);
                                      
                                    },
                                });
                                $(this).prop("disabled", true);

                                setTimeout(function() {
                                $("#generateBtn").prop("disabled", false);
                                }, 5000);
                                });

                                
                                //$('#table').load('report_page.php');
                            });


                    </script>
                </div>
            </div>
            
            <!-- <table class="default-table table text-center">
                <tr>
                    <td>#</td>
                    <td>Type</td>
                    <td>Semester</td>
                    <td>Academic Year</td>
                    <td>Beneficiaries</td>
                    <td>Status</td>
                    <td>Action</td>
                </tr>
            </table>  -->

            <div class="card">
                <div class="card-body">
                    <h1 class="display-6 fs-3">Reports Record</h1>
                    <table class="default-table table text-center">
                        <tr>
                            <td>Report #</td>
                            <td>Academic Year</td>
                            <td>Date Generated</td>
                            <td></td>
                        </tr>
                        
                    </table>
                </div>
            </div>
            
           
        </div>
    </div>
    
</div>

<?php include_once '../includes/main.footer.php' ?>