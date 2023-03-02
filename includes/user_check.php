<?php

if(!isset($_SESSION['user_id'])){
    http_response_code(404);
    header('location: ../includes/error.php'); // provide your own HTML for the error page
    die();
}