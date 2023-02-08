<?php

class Paging extends DatabaseTable{
    private $conn;
    private $page = 12;

    private $startingPage;
    private $total_row;

    private $totalPage;

    function __construct($conn) {
        $this->conn = $conn;
    }

    public function rowCount($table_name) {
        $sql = "SELECT COUNT(*) FROM $table_name";
        $result = $this->conn->query($sql);

        $count = $result->fetchColumn();
        $this->total_row = $count;
        return $this->total_row;
    }

    public function pagination() {
        $totalPage = ceil($this->total_row / $this->page);
        $this->totalPage = $totalPage;
        return $totalPage;
    }
    
    public function startingPage($page) {
        $startingPage = (($page - 1) * $this->page);
        $this->startingPage = $startingPage;
        return $startingPage;
    }
    

    public function setPage($table_name) {
        try {
            $sql = "SELECT * FROM $table_name";
            $result = $this->conn->query($sql);

            $this->total_row;

            $sqlPage = "SELECT * FROM $table_name LIMIT $this->startingPage,  $this->page";

            $result = $this->conn->query($sqlPage);
            
            return $result;

        }catch(PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }
   


    //Page for student clearance

    public function getClearancePage() {
        try {
            $sql = "SELECT * FROM clearance c INNER JOIN clearance_type ct ON c.type = ct.clearance_type_id INNER JOIN beneficiary_type bt ON c.beneficiaries = bt.beneficiary_id ORDER BY c.id LIMIT $this->startingPage ,$this->page";
        $result = $this->conn->query($sql);
        return $result;

        }catch(PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        return false;
        }
    }

    public function getUsers() {
        try {
            $sql = "SELECT * FROM users WHERE user_type != 'admin' LIMIT $this->startingPage ,$this->page";
            $result = $this->conn->query($sql);
            return $result;
        }catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }

    public function countSearchedStudent($search, $table_name) {
        try {
            $sql = "SELECT COUNT(*) FROM $table_name WHERE id LIKE '%$search%' OR student_id LIKE '%$search%' OR first_name LIKE '%$search%' OR last_name LIKE '%$search%' OR middle_name LIKE '%$search%' OR email LIKE '%$search%' OR program_course LIKE '%$search%' OR academic_level LIKE '%$search%' OR strand LIKE '%$search%' OR year_level LIKE '%$search%' OR status LIKE '%$search%' ;";
            $result = $this->conn->query($sql);
            $count = $result->fetchColumn();
            $this->total_row = $count;
            return $count;
        }catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }

   

}