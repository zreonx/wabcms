<?php

class Dashboard {
    private $conn;

    function __construct($conn) {
        $this->conn = $conn;
    }


    public function countAllStudents() {
        try {
            $sql = "SELECT COUNT(*) FROM students";
            $result = $this->conn->query($sql);
            $count = $result->fetchColumn();
            return $count;

        }catch(PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }
    public function countStudCollege() {
        try {
            $sql = "SELECT COUNT(*) FROM students WHERE academic_level = 'College'";
            $result = $this->conn->query($sql);
            $count = $result->fetchColumn();
            return $count;

        }catch(PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }
    
    public function countStudSHS() {
        try {
            $sql = "SELECT COUNT(*) FROM students WHERE academic_level = 'SHS'";
            $result = $this->conn->query($sql);
            $count = $result->fetchColumn();
            return $count;

        }catch(PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }

    public function countSignatories()
    {
        try {
            $sql = "SELECT COUNT(*) FROM signatory_designation";
            $result = $this->conn->query($sql);
            $count = $result->fetchColumn();
            return $count;

        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }

    }

}