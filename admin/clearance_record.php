<?php 
    include_once '../includes/main.header.php';
    require_once '../config/connection.php';
    $result = $clearance->showClearanceRecord();
?>

<div class="panel p-3">
    <?php if (isset($_GET['create']) == "success") { Errormessage::clearance_create_success(); } ?>
    <?php if (isset($_GET['modify']) == "success") { Errormessage::clearance_update_success(); } ?>
    <h1 class="panel-title">Clearance</h1>
    <div class="card min-vh-100 c-scroll">
        <div class="card-body d-flex flex-column">
            <div class="d-flex search-bar">
                <div class="btn-group">
                    <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-filter"></i>
                        Filter by
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Course</a></li>
                        <li><a class="dropdown-item" href="#">Strand</a></li>
                        <li><a class="dropdown-item" href="#">SHS</a></li>
                        <li><a class="dropdown-item" href="#">College</a></li>
                    </ul>
                </div>
                <form class="d-flex">
                    <input class="form-control form-control-sm me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-light btn-sm btn-search" onclick="this.blur();" type="submit">Search</button>
                </form>
            </div>
           
            <table class="default-table table c-scroll">
                <tr>
                    <td>#</td>
                    <td>Type</td>
                    <td>Semester</td>
                    <td>Academic Year</td>
                    <td>Beneficiaries</td>
                    <td>Date Start</td>
                    <td>Date End</td>
                    <td>Status</td>
                    <td>Action</td>
                </tr>

                <?php while($row = $result->fetch(PDO::FETCH_ASSOC)):  ?>

                <tr>
                    <td><?php echo $row['id']; ?></td>
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
                            echo $row['beneficiary_type'];
                        ?>
                    </td>
                    <td><?php echo $row['date_issued']; ?></td>
                    <td><?php echo $row['end_date']; ?></td>
                    <td><?php echo $row['status']; ?></td>  
                    <td>
                        <a href="modify_clearance.php?id=<?php echo $row['id'] ?>" class="btn btn-primary btn-sm" type="submit" name="submitEdit">Edit</a>
                        <button class="btn btn-success btn-sm" type="submit" name="submitActivate">Activate</button>
                        <button class="btn btn-danger btn-sm" type="submit" name="submitDeactivate">Deactivate</button>
                    </td>
                </tr>
                <?php endwhile ?>
            </table>
            <div class="mt-auto">
                <nav aria-label="Page navigation example">
                    <ul class="pagination pagination-sm justify-content-end">
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    
</div>

<?php include_once '../includes/main.footer.php' ?>