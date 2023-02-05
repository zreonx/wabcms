<?php

class Paging {
    private $conn;
    private $page = 12;

    private $startingPage;
    private $total_row;

    private $totalPage;

    function __construct($conn) {
        $this->conn = $conn;
    }


    public function rowCount($table_name) {
        $sql = "SELECT * FROM $table_name";
        $result = $this->conn->query($sql);

        $count = $result->rowCount();
        $this->total_row = $count;
        return $this->total_row;
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


}