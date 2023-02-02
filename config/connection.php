<?php
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'cccwabcms_db');
    define('DB_CHARSET', 'utf8mb4');


   // $dsn = "mysql:host=$server;dbname=$dbname;charset=$charset;";

    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;

    try {
        $conn = new PDO($dsn, DB_USER, DB_PASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connection established";
    } catch(PDOException $e){
        throw new PDOException($e->getMessage());
    }

    require_once 'classes/Clearance.php';
    $clearance = new Clearance($conn);
    


?>