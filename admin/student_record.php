<?php 
    include_once '../includes/main.header.php';
    require_once '../config/connection.php';

    $numOfRow = $displayPage->rowCount("students");
    $total_pages = $displayPage->pagination();
    $page;
    if(isset($_GET['page'])) {
        $page =$_GET['page'];
   }else {
        $page = 1;
   }
    $displayPage->startingPage($page);
    $myResult = $displayPage->setPage("students");
    
?>

<div class="panel p-3">
    <h1 class="panel-title">Student</h1>
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
        <form class="d-flex">
            <input class="form-control form-control-sm me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-light btn-sm btn-search" onclick="this.blur();" type="submit">Search</button>
        </form>
    </div>
    <div class="card min-vh-100 c-scroll">
        <div class="card-body d-flex flex-column">
            <table class="default-table table c-scroll text-center">
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
                    <td>Action</td>
                </tr>

                <?php  while($student_row = $myResult->fetch(PDO::FETCH_ASSOC)) : ?>
                    <tr>
                        <td><?php echo $student_row['id'] ?></td>
                        <td><?php echo $student_row['student_id'] ?></td>
                        <td><?php echo $student_row['first_name'] ?></td>
                        <td><?php echo $student_row['middle_name'] ?></td>
                        <td><?php echo $student_row['last_name'] ?></td>
                        <td><?php echo $student_row['contact_number'] ?></td>
                        <td><?php echo $student_row['email'] ?></td>
                        <td><?php echo $student_row['program_course'] ?></td>
                        <td><?php echo $student_row['academic_level'] ?></td>
                        <td><?php echo $student_row['strand'] ?></td>
                        <td><?php echo $student_row['year_level'] ?></td>
                        <td><?php echo $student_row['status'] ?></td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm" type="submit" name="submitEdit">
                                Edit
                            </a>
                        </td>
                    </tr>
                <?php endwhile ?>
                
            </table>
        </div>
    </div>
    <div class="mt-auto">
        <nav aria-label="Page navigation example">
            <ul class="pagination pagination-sm justify-content-end mt-2">
                <li class="page-item"><a class="page-link" href="student_record.php?page=1">First</a></li>
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item"><a class="page-link" href="student_record.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                <?php endfor ?>
                <li class="page-item"><a class="page-link" href="student_record.php?page=<?php echo $total_pages ?>">Last</a></li>
            </ul>
        </nav>
    </div>
    
</div>

<?php include_once '../includes/main.footer.php' ?>