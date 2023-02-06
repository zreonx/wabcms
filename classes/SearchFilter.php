<?php 

class SearchFilter {
    private $conn;
    
    function __construct($conn) {
        $this->conn = $conn;
    }

    public function searchStudent($search, $table_name) {
        try {
            $sql = "SELECT * FROM $table_name WHERE id LIKE '%$search%' OR student_id LIKE '%$search%' OR first_name LIKE '%$search%' OR last_name LIKE '%$search%' OR middle_name LIKE '%$search%' OR email LIKE '%$search%' OR program_course LIKE '%$search%' OR academic_level LIKE '%$search%' OR strand LIKE '%$search%' OR year_level LIKE '%$search%' OR status LIKE '%$search%' ;";
            $result = $this->conn->query($sql);
            return $result;
        }catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }
}