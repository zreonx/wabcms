<?php 
class Clearance  {

    private $conn;

    function __construct($conn){
        $this->conn = $conn;
    }

    public function showClearanceType() {
        try {
            $sql = "SELECT * FROM clearance_type";
            $result = $this->conn->query($sql);
            return $result;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        
    }
    public function createClearance() {
        
    }


}


?>