<?php 
class SignatoryClearance {
    private $conn;

    function __construct($conn) {
        $this->conn = $conn;
    }

    //Get all designation of the signatory
    function getDesignationStudents($signatoryId){

        try{
            $getSignatoryColumnQuery = "SELECT * FROM signatory_designation WHERE signatory_id = '$signatoryId';";
            $designtaionList = $this->conn->query($getSignatoryColumnQuery);
            return $designtaionList;
        }catch(PDOException $e) {
            echo "ERROR: " .  $e->getMessage();
        }

    }

    //Approve student clearance

    public function approveClearance($signatory_column, $student_id, $clearance_id) {
        try {
            $sql = "UPDATE student_clearance SET $signatory_column = '1' WHERE student_id = :student_id AND clearance_id = :clearance_id ; ";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindparam('student_id', $student_id);
            $stmt->bindparam('clearance_id', $clearance_id);
            $stmt->execute();

            return true;

        }catch(PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }


    public function selectActiveClearnace() { 
        try{ 
            $sql = "SELECT * FROM clearance WHERE status = 'started' ";
            $result = $this->conn->query($sql);
            return $result;
        }catch(PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }

    public function selectClearanceType($type_id) {
        try {
            $sql = "SELECT * FROM clearance_type WHERE clearance_type_id = $type_id ;";

            $stmt = $this->conn->query($sql);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $result;

        }catch(PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }

    

}