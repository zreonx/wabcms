<?php
    include_once 'session.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CCCWABCMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/main.css?v=1.1">
</head>
<body>
    <?php
       if(isset($_SESSION['user_id'])){
            if($_SESSION['user_type'] === "admin"){
    ?>
    <div class="main-container d-flex">
        <div class="sidebar" id="side_nav">
            <button class="btn close text-light"><i class="text-light close-icon fa-solid fa-circle-xmark"></i></button>
            
            <div class="header-box px-3 pt-0 pb-4">
                <h1 class="fs-4 d-flex align-items-center justify-content-center gap-2"><img src="../images/ccc_logo.png" class="logo" alt=""></h1>
            </div>
            <ul class="col-ul list-unstyled px-2 text-light ">
                <li class="<?php echo isset($_SESSION['dashboard']) ? 'active' : '';?> px-2"><a class="text-decoration-none py-2 d-block" href="../admin/dashboard.php"><i class="fa-solid fa-house space"></i>Dashboard</a></li>
                <!-- Student Collapse -->
                <li class="px-2 ">
                    <div class="link-collapse py-2" data-bs-toggle="collapse" href="#collapseOne">
                        <i class="fa-solid fa-users space"></i>
                        <span>Student</span>
                        <i class="caret fa-solid fa-regular fa-angle-down"></i>
                    </div>
                </li>
                <div class="px-2 collapse collapse-design" id="collapseOne" data-bs-parent="#acordion">
                    <ul class="list-unstyled">
                        <li><i class="space fa-solid fa-clipboard-user"></i></i><a href="#">Student Record</a></li>
                        <li><i class="space fa-solid fa-user-pen"></i><a href="#">Modify Student</a></li>
                        <li><i class="space fa-solid fa-cloud-arrow-up"></i><a href="#">Import Student</a></li>
                    </ul>
                </div>
                <!-- Signatory Collapse -->
                <li class="px-2 ">
                    <div class="link-collapse py-2" data-bs-toggle="collapse" href="#collapseTwo">
                        <i class="fa-solid fa-person-circle-check space"></i>
                        <span>Signatory</span>
                        <i class="caret fa-solid fa-regular fa-angle-down"></i>
                    </div>
                </li>
                <div class="px-2 collapse collapse-design" id="collapseTwo">
                    <ul class="list-unstyled">
                        <li><i class="space fa-solid fa-file-contract"></i><a href="#"></a>Signatory Record</li>
                        <li><i class="space fa-solid fa-plus"></i><a href="#">Add Signatory</a></li>
                        <li><i class="space fa-solid fa-user-pen"></i><a href="#">Modify Signatory</a></li>
                    </ul>
                </div>
                 <!-- Clearance Collapse -->
                <li class="px-2 ">
                    <div class="link-collapse py-2" data-bs-toggle="collapse" href="#collapseThree">
                        <i class="fa-solid fa-file-circle-check space"></i>
                        <span>Clearance</span>
                        <i class="caret fa-solid fa-regular fa-angle-down"></i>
                    </div>
                </li>
                <div class="px-2 collapse collapse-design" id="collapseThree">
                    <ul class="list-unstyled">
                        <li><i class="space fa-solid fa-file-lines"></i><a href="../admin/clearance_record.php">Clearance Record</a></li>
                        <li><i class="space fa-solid fa-file-circle-plus"></i><a href="#">Create Clearance</a></li>
                        <li><i class="space fa-solid fa-pen-to-square"></i><a href="#">Modify Clearance</a></li>
                    </ul>
                </div>
                <!-- Reports -->
                <li class="px-2 ">
                    <div class="link-collapse py-2" data-bs-toggle="collapse" href="#collapseFour">
                        <i class="fa-solid fa-square-poll-vertical space"></i>
                        <span>Reports</span>
                        <i class="caret fa-solid fa-regular fa-angle-down"></i>
                    </div>
                </li>
                <div class="px-2 collapse collapse-design" id="collapseFour">
                    <ul class="list-unstyled">
                        <li><i class="space fa-sharp fa-solid fa-file"></i><a href="#">Clearance Report</a></li>
                        <li><i class="space fa-sharp fa-solid fa-file"></i><a href="#">Signatory Report</a></li>
                    </ul>
                </div>
            </ul>
            <hr class="hr-color mx-3">
            <ul class="list-unstyled px-2 col-ul">
                <li class="px-2"><a class="text-decoration-none py-2 d-block" href="#"><i class="fa-solid fa-gear space"></i>Settings</a></li>
                <li class="px-2"><a class="text-decoration-none py-2 d-block" href="../logout.php"><i class="fa-solid fa-right-from-bracket space"></i>Logout</a></li>
            </ul>
        </div>
        <div class="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="d-flex align-items-center">
                <a class="navbar-brand fs-4 order-2" href="#">CCCWABCMS</a>
                <button class="btn open-btn text-dark btn-open"><i class="fa-sharp fa-solid fa-bars-staggered"></i></button>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Profile</a>
                    </li>
                </ul>
            </div>
        </div>
        </nav>
        <?php 
                }else if ($_SESSION['user_type'] === "signatory") {
        ?>
        <div class="main-container d-flex">
        <div class="sidebar" id="side_nav">
            <button class="btn close text-light"><i class="text-light close-icon fa-solid fa-circle-xmark"></i></button>
            
            <div class="header-box px-3 pt-0 pb-4">
                <h1 class="fs-4 d-flex align-items-center justify-content-center gap-2"><img src="../images/ccc_logo.png" class="logo" alt=""></h1>
            </div>
            <ul class="col-ul list-unstyled px-2 text-light ">
                <li class="active px-2"><a class="text-decoration-none py-2 d-block" href="../signatory/dashboard.php"><i class="fa-solid fa-house space"></i>Dashboard</a></li>
                <!-- Student Collapse -->
                <li class="px-2 ">
                    <div class="link-collapse py-2" data-bs-toggle="collapse" href="#collapseOne">
                        <i class="fa-solid fa-users space"></i>
                        <span>Student</span>
                        <i class="caret fa-solid fa-regular fa-angle-down"></i>
                    </div>
                </li>
                <div class="px-2 collapse collapse-design" id="collapseOne" data-bs-parent="#acordion">
                    <ul class="list-unstyled">
                        <li><i class="space fa-solid fa-clipboard-user"></i></i><a href="#">Student Record</a></li>
                    </ul>
                </div>
                 <!-- Clearance Collapse -->
                <li class="px-2 ">
                    <div class="link-collapse py-2" data-bs-toggle="collapse" href="#collapseThree">
                        <i class="fa-solid fa-file-circle-check space"></i>
                        <span>Clearance</span>
                        <i class="caret fa-solid fa-regular fa-angle-down"></i>
                    </div>
                </li>
                <div class="px-2 collapse collapse-design" id="collapseThree" data-bs-parent="#acordion">
                    <ul class="list-unstyled">
                        <li><i class="space fa-solid fa-file-lines"></i><a href="#">Clearance Record</a></li>
                    </ul>
                </div>
                 <!-- Insert Deficiency Collapse -->
                 <li class="px-2 ">
                    <div class="link-collapse py-2" data-bs-toggle="collapse" href="#collapseThreeOne">
                        <i class="fa-solid fa-person-circle-exclamation space"></i>
                        <span>Deficiency</span>
                        <i class="caret fa-solid fa-regular fa-angle-down"></i>
                    </div>
                </li>
                <div class="px-2 collapse collapse-design" id="collapseThreeOne" data-bs-parent="#acordion">
                    <ul class="list-unstyled">
                        <li><i class="space fa-solid fa-file-circle-minus"></i><a href="#">Add Deficiency</a></li>
                    </ul>
                </div>
                <!-- Reports -->
                <li class="px-2 ">
                    <div class="link-collapse py-2" data-bs-toggle="collapse" href="#collapseFour">
                        <i class="fa-solid fa-square-poll-vertical space"></i>
                        <span>Reports</span>
                        <i class="caret fa-solid fa-regular fa-angle-down"></i>
                    </div>
                </li>
                <div class="px-2 collapse collapse-design" id="collapseFour" data-bs-parent="#acordion">
                    <ul class="list-unstyled">
                        <li><i class="space fa-sharp fa-solid fa-file"></i><a href="#">Clearance Report</a></li>
                    </ul>
                </div>
            </ul>
            <hr class="hr-color mx-3">
            <ul class="list-unstyled px-2 col-ul">
                <li class="px-2"><a class="text-decoration-none py-2 d-block" href="#"><i class="fa-solid fa-gear space"></i>Settings</a></li>
                <li class="px-2"><a class="text-decoration-none py-2 d-block" href="../logout.php"><i class="fa-solid fa-right-from-bracket space"></i>Logout</a></li>
            </ul>
        </div>
        <div class="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="d-flex align-items-center">
                <a class="navbar-brand fs-4 order-2" href="#">CCCWABCMS</a>
                <button class="btn open-btn text-dark btn-open"><i class="fa-sharp fa-solid fa-bars-staggered"></i></button>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Profile</a>
                    </li>
                </ul>
            </div>
        </div>
        </nav>
        <?php            
                }
            }else {
                header("location: ../login.php");
                exit();
            }
        ?>
        
        
            
        