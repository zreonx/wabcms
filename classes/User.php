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


    public function getUserInfo($user_id) {
        try {

            $sql = "SELECT * FROM students WHERE student_id = '$user_id' ";
            $result = $this->conn->query($sql);
            $resultQuery = $result->fetch(PDO::FETCH_ASSOC);

            return $resultQuery;
        }catch(PDOException $e) {
            echo "ERROR: " . $e->getMessage();
            return false;
            
        }
    }

    public function getAdminInfo($user_id) {
        try {

            $sql = "SELECT * FROM admins WHERE admin_id = '$user_id' ";
            $result = $this->conn->query($sql);
            $resultQuery = $result->fetch(PDO::FETCH_ASSOC);

            return $resultQuery;
        }catch(PDOException $e) {
            echo "ERROR: " . $e->getMessage();
            return false;
            
        }
    }

    public function getSignatoryInfo($user_id) {
        try {

            $sql = "SELECT * FROM signatories WHERE id = $user_id ";
            $result = $this->conn->query($sql);
            $resultQuery = $result->fetch(PDO::FETCH_ASSOC);

            return $resultQuery;
        }catch(PDOException $e) {
            echo "ERROR: " . $e->getMessage();
            return false;
            
        }
    }
    
    public function checkUserType($user_id, $user_type) {
        try {
            $sql = "SELECT * FROM users WHERE user_id = '$user_id' AND user_type = '$user_type' ;";
            $result = $this->conn->query($sql);

            $query = $result->fetch(PDO::FETCH_ASSOC);

            return $query;

        }catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getUserData($user_id, $user_type) {
        try {

            $userData = $this->checkUserType($user_id, $user_type);

            $userId = $userData['user_id'];
            $userType = $userData['user_type'];


            if($userType == 'student') {
                $sql = "SELECT * FROM students WHERE student_id = $user_id ;";
            }else if($userType == 'signatory') {
                $sql = "SELECT * FROM signatories WHERE id = $user_id ;";
            }else if($userType == 'admin') {
                $sql = "SELECT * FROM admins WHERE admin_id = $user_id ;";
            }
           

            $result = $this->conn->query($sql);
            $queryData = $result->fetch(PDO::FETCH_ASSOC);
            return array('userdata' => $queryData, 'old_pass' => $userData['password']) ;

        }catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function changePassword($user_id, $new_password) {
        try {

            $sql = "UPDATE users SET password = :new_password WHERE user_id = :user_id ;";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindparam(':user_id', $user_id);
            $stmt->bindparam(':new_password', $new_password);
            $stmt->execute();
            return true;

        }catch(PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

   
    

}