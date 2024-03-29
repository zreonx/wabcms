<?php
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'cccwabcms_db');
    define('DB_CHARSET', 'utf8mb4');

    // define('DB_HOST', 'sql.freedb.tech');
    // define('DB_USER', 'freedb_zreonsaiver');
    // define('DB_PASS', 'WBwSC@69pNx82wQ');
    // define('DB_NAME', 'freedb_cccwabcms_db');
    // define('DB_CHARSET', 'utf8mb4');

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
    $report = new Report($conn);

    // Signatory classes
    $signatoryClearance = new SignatoryClearance($conn);

    //Student classes
    $studentClearance = new StudentClearance($conn);
    



   