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

    public function getSignatoryClearance($clearance_id, $student_id) {
         try{

            $sql = "SELECT * FROM student_clearance WHERE student_id = '$student_id' AND clearance_id = $clearance_id;";
            $result = $this->conn->query($sql);
            $count = $result->columnCount();
            
            return array('count' => $count, 'result' => $result);

         }catch(PDOException $e){
            echo $e->getMessage();
         }
    }
}