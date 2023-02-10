<?php 
    include_once '../includes/main.header.php';
    require_once '../config/connection.php';

    $studentTable = Paging::getStudentTable();
    $student_clearance = $displayPage->getStudentClearance();
    $signatoryColumn = $displayPage->getStudentClearance();
    $keys = array_keys($signatoryColumn['sc_query']->fetch(PDO::FETCH_ASSOC));
    $total_pages = $displayPage->pagination();

    if(isset($_GET['page'])) {
        $page =$_GET['page'];
   }else {
        $page = 1;
   }yyh  
?>

<div class="panel p-3">
    <h1 class="panel-title">Student Clearance</h1>
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
        <form class="d-flex" method="get" action="student_record.php">
            <input class="form-control form-control-sm me-2" type="search" name="search" id="search" placeholder="Search" aria-label="Search">
            <div class="list"></div>
            <button class="btn btn-light btn-sm btn-search" name="submitSearch" type="submit">Search</button>
        </form>
    </div>

    <?php ?>
    <div class="card min-vh-100 c-scroll">
        <div class="card-body d-flex flex-column">
            <table class="default-table table c-scroll text-center">
                <tr>
                    <td>#</td>
                    <td>Student ID</td>
                    <td>Clearance ID</td>

                    <?php 
                            $signatory_column;
                        for($i = 6; $i < $student_clearance['count_column']; $i++) {
                            $signatory_column [] = $keys[$i];
                        }

                        foreach($signatory_column as $designee) {
                            // remove is_ and _approval and _
                            $designee = ucwords(str_replace("_", " ",substr($designee, 3, -9)));

                            echo "<td>$designee </td>";
                           
                        }
                    
                    ?>
                </tr>

                <?php while($rows_sc = $student_clearance['sc_query']->fetch(PDO::FETCH_ASSOC)): ?>

                <tr>
                    <td><?php echo $rows_sc['id'] ?></td>
                    <td><?php echo $rows_sc['student_id'] ?></td>
                    <td><?php echo $rows_sc['clearance_id'] ?></td>
                    <?php
                    
                    foreach($signatory_column as $designee) {
                        // remove is_ and _approval and _
                        echo "<td> " . $rows_sc[$designee]. "</td>";
                       
                    }
                    
                    ?>
                    
                </tr>
                <?php endwhile ?>
            </table>
        </div>
    </div>
    <div class="mt-auto">
        <nav aria-label="Page navigation example">
            <ul class="pagination pagination-sm justify-content-end mt-2">
                <li class="page-item"><a class="page-link" href="student_clearance_record.php?page=1">First</a></li>
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item"><a class="page-link" href="student_clearance_record.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                <?php endfor ?>
                <li class="page-item"><a class="page-link" href="student_clearance_ecord.php?page=<?php echo $total_pages ?>">Last</a></li>
            </ul>
        </nav>
    </div>
    
</div>
<!-- <script>
    $(document).ready(function(){
        $('#search').keyup(function(){
            var query = $(this).val();
            if(query != '') {
                $.ajax({
                    url: "search.php",
                    method: "POST",
                    data: {query:query},
                    success: function(data) {
                        $('#list').fadeIn();
                        $('#list').html(data);
                    }
                });
            }
        });
    });
</script> -->

<?php include_once '../includes/main.footer.php' ?>