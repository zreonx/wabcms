<?php  include_once 'session.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WABCMS</title>
    <link rel="icon" href="../images/ccc_logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/sidemain.css?v=1.2">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
</head>
<body>
<div class="container-fluid p-0">   
    <div class="content">
        <div class="sidebar-back" id="sideplaceholder">
            <div class="sidebar">
                <div class="side-img">
                    <img src="../images/ccc_logo.png" class="logo" alt="">
                </div>
                <?php 
                    
                    if(isset($_SESSION['user_type']) and $_SESSION['user_type'] == 'admin' ) {
                        include_once 'users/admin_sidebar.php';
                    }else if (isset($_SESSION['user_type']) and $_SESSION['user_type'] == 'signatory') {
                        include_once 'users/signatory_sidebar.php';
                    }else if(isset($_SESSION['user_type']) and $_SESSION['user_type'] == 'student'){
                        include_once 'users/student_sidebar.php';
                    }
                ?>
                <!-- Admin SideBar -->

            </div>
        </div>
        <div class="main-content">
            <div class="header d-flex align-items-center">
                <a href="#" class="menu-toggle-open default-hover"><i class="fa-solid fa-bars"></i></a>
                <!-- <button class="menu-toggle-open" onclick="openSideBar()"> <i class="fa-solid fa-bars"></i></button>
                <button class="menu-toggle-close"  onclick="closeSidebar()"><i class="fa-solid fa-bars"></i></button> -->
                <h3 class="m-0">CCCWABCMS</h3>
                <?php
                     $user_data = $_SESSION['user_data'];
                 ?>
                <div class="ms-auto rounded profile-page" id="profileBtn">
                    <img class="rounded-circle profile-image shadow-default" src="https://cdn-icons-png.flaticon.com/512/1077/1077012.png" alt="profile">
                    <h1 class="fs-6 p-0 m-0">Profile</h1>
                </div>
                
            </div>
            <div class="rounded profile-container" id="profile-menu">
                <ul class="profile-menu">
                    <li class="profile-link"><a href="#"><i class="fa-solid fa-address-card p-icon"></i> Profile</a></li>
                    <li class="profile-link"><a href="#" id="change_pass"><i class="fa-solid fa-sliders p-icon"></i> Change Password</a></li>
                    <li class="profile-link"><a href="../logout.php"><i class="fa-solid fa-right-from-bracket p-icon"></i> Logout</a></li>
                </ul> 
            </div>

            <script>
                $(document).ready(function() {
                    $('#profileBtn').click(function(e) {
                        e.stopPropagation();
                        $('#profile-menu').toggleClass('active-profile');
                    });

                    $('body').click(function() {
                        $('#profile-menu').removeClass('active-profile');
                    });

                    $('#profile-menu').click(function(e) {
                        e.stopPropagation();
                    });
                    $('#user-page').load('../includes/change_password_interface.php');
                });
            </script>

            <div class="rounded user-page" id="user-page">
                
            </div>

            <script type="text/javascript">
              
              $(document).ready(function(){
                  $('#change_pass').click(function(){
                        
                        //$('#user-page').toggleClass('cp-show');
                        $('#user-page').fadeIn();
                  });
              });
          </script>
            
            
            <div class="my-content">

            

           


