<?php 
    include_once '../includes/main.header.php';
    require_once '../config/connection.php';

    
    $page;
    if(isset($_GET['page'])) {
        $page =$_GET['page'];
   }else {
        $page = 1;
   }

?>

<div class="panel p-3">
    <h1 class="panel-title">Signatories</h1>
    <?php if (isset($_GET['setup']) && $_GET['setup'] == "success") { Errormessage::designation_updated(); } ?>
    <div class="d-flex search-bar mb-2">
        <div class="btn-group">
            <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-filter"></i>
                Filter by
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">All Signatories</a></li>
                <li><a class="dropdown-item" href="#">DEPT</a></li>
                <li><a class="dropdown-item" href="#">ORG</a></li>
            </ul>
        </div>
        
        <form class="d-flex" method="get" action="student_record.php">
            <input class="form-control form-control-sm me-2" type="search" name="search" id="search" placeholder="Search" aria-label="Search">
            <div class="list"></div>
            <button class="btn btn-light btn-sm btn-search" name="submitSearch" type="submit">Search</button>
        </form>
        
    </div>

    <?php ?>
    <div class="card c-scroll">
        <div class="card-body d-flex flex-column">
            <table class="default-table table c-scroll text-center">
                <tr>
                    <td>#</td>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Designation</td>
                    <td>Department</td>
                    <td>Organization</td>
                    <td>Action</td>
                </tr>
                <?php
                    $result = $displayPage->selectSignatory();
                    $total_pages = $displayPage->pagination();
                    $displayPage->startingPage($page);
                    $count = 1;
                    while($designation_row = $result->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?php echo $count; $count++ ?></td>
                    <td><?php echo $designation_row['first_name'] . " " . $designation_row['middle_name'] . " " . $designation_row['last_name'] ?></td>
                    <td><?php echo $designation_row['email'] ?></td>
                    <td><?php echo $designation_row['designation'] ?></td>
                    <td><?php echo $designation_row['office_department'] ?></td>
                    <td><?php echo $designation_row['organization'] ?></td>
                    <td>
                        <a href="#" class="btn btn-primary btn-sm" type="submit" name="submitEdit">
                            Edit
                        </a>
                    </td>
                </tr>
                <?php } ?>
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