<?php

class User{

    private $conn;

    function __construct($conn) {
        $this->conn = $conn;
    }

    function setUserAccount() {
        try {
            $status = "active";

            $signatory_result = $this->getSignatories();
            $student_result = $this->getStudent();

            while($signatories_row = $signatory_result->fetch(PDO::FETCH_ASSOC)) {
                $sql = "INSERT INTO users (user_type, user_id, email, password, status) 
                VALUES (:type, :uid, :email, :password, :status)
                ON DUPLICATE KEY UPDATE status= :status ;";
                $signatory_id = $signatories_row['id'];
                $signatory_email = $signatories_row['email'];
                $user_type = "signatory";
                $password = $this->randomPassword();

                $stmt = $this->conn->prepare($sql);
                $stmt->bindparam(':type', $user_type);
                $stmt->bindparam(':uid', $signatory_id);
                $stmt->bindparam(':email', $signatory_email);
                $stmt->bindparam(':password', $password);
                $stmt->bindparam(':status', $status);
                $stmt->execute();
            }

            while($student_row = $student_result->fetch(PDO::FETCH_ASSOC)) {
                $sql = "INSERT INTO users (user_type, user_id, email, password, status) 
                VALUES (:type, :uid, :email, :password, :status)
                ON DUPLICATE KEY UPDATE status= :status ;";
                $student_id = $student_row['student_id'];
                $student_email = $student_row['email'];
                $user_type = "student";
                $password = $this->randomPassword();

                $stmt = $this->conn->prepare($sql);
                $stmt->bindparam(':type', $user_type);
                $stmt->bindparam(':uid', $student_id);
                $stmt->bindparam(':email', $student_email);
                $stmt->bindparam(':password', $password);   
                $stmt->bindparam(':status', $status);
                $stmt->execute();

            }

            return true;

        }catch (PDOException $e) {

        }
    }
    function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); 
        $alphaLength = strlen($alphabet) - 1; 
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); 
    }

    public function getSignatories() {
        try {

            $sql = "SELECT * FROM signatories";
            $result = $this->conn->query($sql);
            return $result;

        }catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }

    public function getStudent() {
        try {

            $sql = "SELECT * FROM students";
            $result = $this->conn->query($sql);
            return $result;

        }catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }


    //check the email and return the usertype
    public function checkEmail($email) {
        try {
            
            $sql = "SELECT * FROM users WHERE email = :email ;";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindparam(':email', $email);
            $stmt->execute();

            $result = $stmt->fetch();
           
            if(!$result) {
                return false;
            }else {
                return $result['user_type'];
            }

        }catch(PDOException $e) {
            echo "ERROR: " . $e->getMessage();
            return false;
        }
        
    }

    public function loginUser($userType, $email, $password) {
        try {
            $sql = 'SELECT * FROM users WHERE user_type = :type AND email = :email AND password = :password ;';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindparam(':type', $userType);
            $stmt->bindparam(':email', $email);
            $stmt->bindparam(':password', $password);
            $stmt->execute();
            $result = $stmt->fetch();

            return $result;


        }catch(PDOException $e) {
            echo "ERROR: " . $e->getMessage();
            return false;
            
        }
    }

    
    

}