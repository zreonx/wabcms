<?php 
class Clearance  {

    private $conn;

    function __construct($conn){
        $this->conn = $conn;
    }

    public function showClearanceType() {
        try {
            $sql = "SELECT * FROM clearance_type;";
            $result = $this->conn->query($sql);
            return $result;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        
    }

    public function showBeneficiaries() {
        try {
            $sql = "SELECT * FROM beneficiary_type;";
            $result = $this->conn->query($sql);
            return $result;
        }catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }

    public function showClearanceRecord() {
        try {
            $sql = "SELECT * FROM clearance c INNER JOIN clearance_type ct ON c.type = ct.clearance_type_id INNER JOIN beneficiary_type bt ON c.beneficiaries = bt.beneficiary_id ORDER BY c.id";
            $result = $this->conn->query($sql);
            return $result;

        }catch(PDOException $e) {
            echo "ERROR: " . $e->getMessage();
            return false;
        }
    }

    public function getClearance($id) {
        try {

            $sql = "SELECT * FROM clearance WHERE id=:id ;";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindparam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
        }catch(PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }

    public function createClearance($type, $semester, $academic_year, $beneficiaries, $date_created, $status) {
        try{
            $sql = "INSERT INTO clearance(type, semester, academic_year, beneficiaries, date_created, status) VALUES (:type, :semester, :academic_year, :beneficiaries, :date_created, :status);";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindparam(':type', $type);
            $stmt->bindparam(':semester', $semester);
            $stmt->bindparam(':academic_year', $academic_year);
            $stmt->bindparam(':beneficiaries', $beneficiaries);
            $stmt->bindparam(':date_created', $date_created);
            $stmt->bindparam(':status', $status);
            $stmt->execute();
            return true;
        
        }catch(PDOException $e){
            echo "ERROR: " . $e->getMessage();
            return false;
        }
    }

    public function modifyClearance($type, $sem, $ay, $beneficiaries, $id) {
        try {
            $sql = "UPDATE clearance SET type = :type, semester = :semester, academic_year = :academic_year, beneficiaries = :beneficiaries WHERE id = :id ;";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindparam(':type', $type);
            $stmt->bindparam(':semester', $sem);
            $stmt->bindparam(':academic_year', $ay);
            $stmt->bindparam(':beneficiaries', $beneficiaries);
            $stmt->bindparam(':id', $id);
            $stmt->execute();
            return true;

        }catch(PDOException $e) {
            echo "ERROR: " . $e->getMessage();
            return false;
        }
    }

}


?>