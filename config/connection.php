<?php
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'cccwabcms_db');
    define('DB_CHARSET', 'utf8mb4');

    include_once '../includes/autoloader.inc.php';
    include_once '../includes/session.php';


    
    $db = new DatabaseConnection();
    $conn = $db->Conn();
    $clearance = new Clearance($conn);
    $students = new Student($conn);
    $signatories = new Signatory($conn);
    $errors = new Error();
    $displayPage = new Paging($conn);
    $dashboard = new Dashboard($conn);
    $searchFilter = new SearchFilter($conn);
    $users = new User($conn);

    // Signatory classes
    $signatoryClearance = new SignatoryClearance($conn);



   