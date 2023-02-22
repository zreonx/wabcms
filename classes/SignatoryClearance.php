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


    //Select the active clearance
    public function selectActiveClearnace() { 
        try{ 
            $sql = "SELECT * FROM clearance WHERE status = 'started' ";
            $result = $this->conn->query($sql);
            return $result;
        }catch(PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }

    //Select the clearance type
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

    //Display all student for deficiency
    public function showStudents($clearance_id, $signatory) {
        try {
            $sqlCounter = "
            SET @counter := 0 ; ";
            $stmt = $this->conn->prepare($sqlCounter);
            $stmt->execute();

            $sql = "SELECT (@counter := @counter + 1) AS 'counter' , sc.*
            FROM student_clearance sc
            WHERE student_id NOT IN
                (SELECT student_id 
                 FROM deficiency WHERE signatory = '$signatory' AND clearance_id = $clearance_id AND status != 'cleared') 
                 AND student_id NOT IN (SELECT student_id 
                 FROM temp_deficiency WHERE signatory = '$signatory' AND clearance_id = $clearance_id AND status != 'cleared')
                AND clearance_id = $clearance_id 
            ";

            $result = $this->conn->query($sql);
            return $result;

        }catch(PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }

    //Display all student with deficiency
    public function showDeficiencyList($clearance_id, $signatory) {
        try {

            $sqlCounter = "
            SET @counter := 0 ; ";
            $stmt = $this->conn->prepare($sqlCounter);
            $stmt->execute();

            $sql = "SELECT (@counter := @counter + 1) AS 'counter', d.*
            FROM deficiency d
            WHERE clearance_id = $clearance_id
            AND signatory = '$signatory' 
            AND status = 'deficient'";

            $result = $this->conn->query($sql);
            return $result;

        }catch(PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }
    //Display all student with temporary deficiency or in a list
    public function showTemporaryDeficiency($clearance_id, $signatory) {
        try {
            $sqlCounter = "
            SET @counter := 0 ; ";
            $stmt = $this->conn->prepare($sqlCounter);
            $stmt->execute();

            $sql = "SELECT (@counter := @counter + 1) AS 'counter', td.*
            FROM temp_deficiency td
            WHERE clearance_id = $clearance_id
            AND signatory = '$signatory'
            ";

            $result = $this->conn->query($sql);
            return $result;

        }catch(PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }

    // Check if student is already have a deficiencies with signatory

    public function checkTempList($clearance_id, $student_id, $signatory){
        try {
            $sql = "SELECT COUNT(*)
            FROM temp_deficiency
            WHERE signatory = '$signatory'
            AND student_id = '$student_id' 
            AND clearance_id = $clearance_id; ";
            
            $result = $this->conn->query($sql);

            $count = $result->fetchColumn();
            
            if($count == 0) {
                return false;
            }
            else {
                return true;
            }

        }catch(PDOException $e) {
                echo "ERROR: ". $e->getMessage();
            }
    }
// Add Student on the list to be restricted
    public function addTemporaryDeficiency($clearance_id, $signatory_id, $signatory, $student_id) {
        
        try{
            $status = "listed";

            $sql = "INSERT INTO temp_deficiency (clearance_id, signatory_id, signatory, student_id, status) VALUES (:clearance_id, :signatory_id, :signatory, :student_id, :status);";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':clearance_id', $clearance_id);
            $stmt->bindParam(':signatory_id', $signatory_id);
            $stmt->bindParam(':signatory', $signatory);
            $stmt->bindParam(':student_id', $student_id);
            $stmt->bindParam(':status', $status);
            $stmt->execute();

            return true;

        }catch(PDOException $e) { 
            echo "ERROR: ". $e->getMessage();
            return false;
        }

    }

    // Delete from temporary list
    public function deleteTemporaryDeficiency($temp_id) { 
        try {
            $sql = "DELETE FROM temp_deficiency WHERE id = :temp_id ;";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':temp_id', $temp_id);
            $stmt->execute();
            return true;

        }catch(PDOException $e) {
            echo "ERROR: ". $e->getMessage();
        }

    }

    //Add student deficiency
    public function inputDeficiency($clearance_id, $signatory, $student_id, $message, $date_messaged) {
        try {
            $status = 'deficient';
            $sql = "INSERT INTO deficiency (clearance_id, signatory, student_id, message, date, status) VALUES (:clearance_id, :signatory, :student_id, :message, :date, :status)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':clearance_id', $clearance_id);
            $stmt->bindParam(':signatory', $signatory);
            $stmt->bindParam(':student_id', $student_id);
            $stmt->bindParam(':message', $message);
            $stmt->bindParam(':date', $date_messaged);
            $stmt->bindParam(':status', $status);
            $stmt->execute();
            
            return true;
            
        }catch(PDOException $e) {
            echo "ERROR: ". $e->getMessage();
        }
    }

    //Update deficiencies
    public function updateDeficiency($id) {
        try{
            
            $sql = "UPDATE deficiency SET status = 'cleared' WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;

        }catch(PDOException $e){
            echo "ERROR: ". $e->getMessage();
        }
    }

}