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

    public function approveClearance($signatory_column, $student_id) {
        try {
            $sql = "UPDATE student_clearance SET $signatory_column = '1' WHERE student_id = :student_id ; ";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindparam('student_id', $student_id);
            $stmt->execute();

            return true;

        }catch(PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }

    

}