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
            $sqlColumns = "SELECT * FROM student_clearance WHERE student_id = '$student_id' AND clearance_id = $clearance_id;";
            $result = $this->conn->query($sql);
            $resultColumns = $this->conn->query($sqlColumns);

            $columns = array();

            $numColumns = $resultColumns->columnCount();
            for ($i = 0; $i < $numColumns; $i++) {
                $meta = $resultColumns->getColumnMeta($i);
                $columns[$i] = $meta['name'];
            }

            $count = $result->columnCount();
            
            return array('count' => $count, 'result' => $result, 'columns' => $columns);

            
         }catch(PDOException $e){
            echo $e->getMessage();
         }
    }
}