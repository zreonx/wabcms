<?php 
    include_once '../includes/main.header.php';
    require_once '../config/connection.php';
    $result = $clearance->showClearanceRecord();
?>

<div class="panel p-3">
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
                    <td>Student ID</td>
                    <td>First Name</td>
                    <td>Middle Name</td>
                    <td>Last Name</td>
                    <td>Contact Number</td>
                    <td>Email</td>
                    <td>Course</td>
                    <td>Academic Level</td>
                    <td>Strand</td>
                    <td>Year Level</td>
                    <td>Status</td>
                </tr>
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