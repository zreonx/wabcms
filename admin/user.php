<?php 
    include_once '../includes/main.header.php';
    require_once '../config/connection.php';
    $userTable = Paging::getUsersTable();
    $numOfRow = $displayPage->rowCount($userTable);
    $total_pages = $displayPage->pagination();
    $page;
    if(isset($_GET['page'])) {
        $page =$_GET['page'];
   }else {
        $page = 1;
   }
    $displayPage->startingPage($page);
    $result = $displayPage->getUsers();
?>

<div class="panel p-3">
    <?php if (isset($_GET['create']) && $_GET['create'] == "success") { Errormessage::clearance_create_success(); } ?>
    <?php if (isset($_GET['create']) && $_GET['create'] == "failed") { Errormessage::clearance_create_failed(); } ?>
    <?php if (isset($_GET['modify']) && $_GET['modify'] == "success") { Errormessage::clearance_update_success(); } ?>
    <?php if (isset($_GET['modify']) && $_GET['modify'] == "failed") { Errormessage::clearance_update_success(); } ?>
    <?php if (isset($_GET['setup']) && $_GET['setup'] == "success") { Errormessage::account_updated(); } ?>
    <h1 class="panel-title">User Accounts</h1>
    <div class="d-flex search-bar mb-2">
        <div class="btn-group">
            <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-filter"></i>
                Filter by
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">All Users</a></li>
                <li><a class="dropdown-item" href="#">Signatory</a></li>
                <li><a class="dropdown-item" href="#">Student</a></li>
            </ul>
        </div>
        <form class="d-flex">
            <input class="form-control form-control-sm me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-light btn-sm btn-search" onclick="this.blur();" type="submit">Search</button>
        </form>
    </div>
    <div class="card min-vh-100 c-scroll">
        <div class="card-body d-flex flex-column">
            <table class="default-table table text-center">
                <tr>
                    <td>#</td>
                    <td>User Type</td>
                    <td>User ID</td>
                    <td>Email</td>
                    <td>Password</td>
                    <td>Status</td>
                    <td>Action</td>
                </tr>

                <?php while($row = $result->fetch(PDO::FETCH_ASSOC)):  ?>

                <tr>
                    <td><?php echo $row['counter']; ?></td>
                    <td>
                        <!-- Clearance type -->
                        <?php 
                             echo $row['user_type'];
                        ?>
                    </td>
                    <td><?php echo $row['user_id']; ?></td>
                    <td><?php echo $row['email']; ?></td>

                        <!-- Beneficiaries -->
                    <td>
                        <?php 
                            echo $row['password'];
                        ?>
                    </td>
                    <td><?php echo $row['status']; ?></td>
                    
                    <td>
                        <a href="#modify_clearance.php?id=<?php //echo $row['id'] ?>" class="btn btn-primary btn-sm" type="submit" name="submitEdit">Edit</a>
                        <a href="#start_clearance.php?id=<?php //echo $row['id'] ?>" class="btn btn-danger btn-sm" type="submit" name="submitStart">Delete</a>
                    </td>
                </tr>
                <?php endwhile ?>
            </table> 
            
        </div>
   
    </div>
    <div class="mt-auto">
        <nav aria-label="Page navigation example">
            <ul class="pagination pagination-sm justify-content-end mt-2">
                <li class="page-item"><a class="page-link" href="user.php?page=1">First</a></li>
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item"><a class="page-link" href="user.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                <?php endfor ?>
                <li class="page-item"><a class="page-link" href="user.php?page=<?php echo $total_pages ?>">Last</a></li>
            </ul>
        </nav>
    
    </div>
    
</div>

<?php include_once '../includes/main.footer.php' ?>