<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/sidemain.css?v=1.1">
</head>
<body>
<div class="content">
    <div class="sidebar">
        <div class="side-img">
            <img src="../images/ccc_logo.png" class="logo" alt="">
        </div>
        <!-- Admin SideBar -->
        <?php include_once 'users/admin_sidebar.php' ?>
    
    </div>
    <div class="main-content">
        <div class="header d-flex align-items-center">
            <a class="menu-toggle" onclick="openSidebar();" href="javascript:void(0)"><i class="fa-solid fa-bars"></i></a>
            <h3 class="m-0">CCCWABCMS</h3>
        </div>
        <div class="my-content">


