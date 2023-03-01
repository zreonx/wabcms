<?php
class StudentClearance {

    private $conn;
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function displayClearance() {
        try {
            $sql = "SELECT c.*, (SELECT clearance_type FROM clearance_type WHERE clearance_type_id = type) as 'type_name' FROM clearance c WHERE status = 'started'";
            $result = $this->conn->query($sql);
            return $result;

        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}