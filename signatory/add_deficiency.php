<?php 
    include_once '../includes/main.header.php';
    require_once '../config/connection.php';

    $signatory_id = $_SESSION['user_id'];
    $activeClearance = $signatoryClearance->selectActiveClearnace();
  

?>

<div class="panel p-3">
    <h1 class="panel-title">Add Student Deficiency</h1>
    <div class="card min-vh-100 c-scroll">
        <div class="card-body d-flex flex-column">
           <div>
                <div class="">
                    <div class="d-flex justify-content-between">
                        <h3 class="fs-5">Clearance ID: Test</h3>
                        <h3 class="fs-5">1st Semester</h3>
                    </div>
                    
                    <div class="d-flex gap-3">
                        <div class="card w-100">
                            <div class="card-body">
                                <h1 class="fs-5">Students</h1>
                                <form class="d-flex w-50">
                                    <input class="form-control form-control-sm me-2" type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-light btn-sm btn-search" onclick="this.blur();" type="submit">Search</button>
                                </form>
                                <table class="table text-center">
                                    <tr>
                                        <td>#</td>
                                        <td>Student ID</td>
                                        <td>Action</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>20-02858</td>
                                        <td><a href="#" class="btn btn-sm btn-primary">Select</a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="card w-100">
                            <div class="card-body">
                            <h1 class="fs-5">Students Deficiency</h1>
                                <table class="table text-center">
                                    <tr>
                                        <td>#</td>
                                        <td>Student ID</td>
                                        <td>Action</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>20-02858</td>
                                        <td><a href="#" class="btn btn-sm btn-danger">Remove</a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="mt-3 btn btn-success">Submit Deficiency</button>
                    </div>
                </div>
                    
           </div>
        </div>
    </div>
    
</div>

<?php include_once '../includes/main.footer.php' ?>