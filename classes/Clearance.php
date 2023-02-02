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
    public function createClearance($type, $semester, $academic_year, $beneficiaries, $date_issued, $status) {
        try{
            $sql = "INSERT INTO clearance (type, semester, academic_year, beneficiaries, date_issued, status) VALUES (:type, :semester, :academic_year, :beneficiaries, :date_issued, :status);";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindparam(':type', $type);
            $stmt->bindparam(':semester', $semester);
            $stmt->bindparam(':academic_year', $academic_year);
            $stmt->bindparam(':beneficiaries', $beneficiaries);
            $stmt->bindparam(':date_issued', $date_issued);
            $stmt->bindparam(':status', $status);
            $stmt->execute();
            return true;
        
        }catch(PDOException $e){
            echo "ERROR: " . $e->getMessage();
            return false;
        }
    }


}


?>