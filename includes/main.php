<?php include_once 'main.header.php' ?>

<div class="content">
    <div class="header">
        <a class="menu-toggle" onclick="openSidebar();" href="javascript:void(0)"><i class="fa-solid fa-bars"></i></a>
    </div>
    <div class="sidebar">
        <div class="side-img">
            <img src="../images/ccc_logo.png" class="logo" alt="">
        </div>
        <!-- Admin SideBar -->
        <?php include_once 'users/admin_sidebar.php' ?>

    </div>
    <div class="main-content">

    </div>
</div>

<?php include_once 'main.footer.php' ?>