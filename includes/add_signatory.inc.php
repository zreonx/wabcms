<?php

    if(isset($_POST['submit'])) {
        $designation = $_POST['designation'];
        $firstname = $_POST['firstname'];
        $middlename = $_POST['middlename'];
        $lastname = $_POST['lastname'];
        $department = $_POST['department'];
        $is_org = $_POST['is_org'];
        $organization = $_POST['organization'];
        $email = $_POST['email'];
        $is_ph = $_POST['is_program_head'];
        
        require_once '../config/connection.php';

        $result = $signatories->createSignatory($designation, $firstname, $middlename, $lastname, $department, $is_ph, $is_org, $organization ,$email);

        if($result == true) {
            header("location: ../admin/add_signatory.php?register=success");
        }else {
            header("location: ../admin/add_signatory.php?register=failed");
        }

        //print_r($designation);
    }