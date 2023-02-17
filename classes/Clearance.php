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

    public function startClearance($id, $date_issued) {
        try {
            $status = "started";
            $sql = "UPDATE clearance SET date_issued = :date_issued, status = :status WHERE id = :id ;";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindparam(':date_issued', $date_issued);
            $stmt->bindparam(':status', $status);
            $stmt->bindparam(':id', $id);
            $stmt->execute();

            return true;

        }catch(PDOException $e) {
            echo "ERROR: " . $e->getMessage();
            return false;
        }
    }
    public function addSignatoryColumn() {
        try{
            $sql = "SELECT * FROM signatory_designation";
            $result = $this->conn->query($sql);

            while($signatory_result = $result->fetch(PDO::FETCH_ASSOC)) {

                //create a column name for signatory based on designation
                $designation =  explode(" ", strtolower($signatory_result['designation']));
                $final_designation = implode("_", $designation);
                $signatory_column = "is_" . $final_designation ."_approval";

                echo $signatory_column;

                $addColumn = "ALTER TABLE student_clearance ADD $signatory_column VARCHAR(255);";
                $stmt = $this->conn->prepare($addColumn);
                $stmt->execute();
            }

            return true;

        }catch(PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }


    //Fetch all the desingations and set to the student clearance
    public function getDesignationColumn() {
        try{
            $sql = "SELECT * FROM signatory_designation";
            $result = $this->conn->query($sql);

            $designationColumnCount = 0;
            $designation_column = array();

            while($signatory_result = $result->fetch(PDO::FETCH_ASSOC)) {

                //create a column name for signatory based on designation
                $designation =  explode(" ", strtolower($signatory_result['designation']));
                $final_designation = implode("_", $designation);
                $signatory_column = "is_" . $final_designation ."_approval";

                $designation_column[$designationColumnCount] = $signatory_column;
                $designationColumnCount++;
             
            }

            return array('count' => $designationColumnCount, 'designations' => $designation_column);
            
        }catch(PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }

    public function removeSignatoryColumns(){
        try{
            
           //Get all the column of student clearance
            $getSignatoryColumn = "DESCRIBE student_clearance";
            $countSignatory = "DESCRIBE COUNT(Field) student_clearance";

            $rsc = $this->conn->query($getSignatoryColumn);
            
            //Store the signatory columns in the array
            $signatoryColumnCount= 0;
            $student_clearance_column = array();
            while($row_count = $rsc->fetch(PDO::FETCH_ASSOC)) {
                $student_clearance_column[$signatoryColumnCount] = $row_count['Field'];
                $signatoryColumnCount++;
            }

            $designationColumn = $this->getDesignationColumn();
            
            //check if the column signatory is in the student clearance, if not it will be replaced
            foreach($student_clearance_column as $designee) {
                if(in_array($designee, $designationColumn['designations'])){
                    //print_r($signatory_result['designation']);
                    $replaceColumn = "ALTER TABLE student_clearance DROP $designee;";
                    $result = $this->conn->query($replaceColumn);
                }

            }

            return true;

        }catch(PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }

    }
   

    public function insertStudentClearance($clearance_id) {
        try{
            $sql = "SELECT * FROM users WHERE user_type = 'student'";
            $result = $this->conn->query($sql);

            while($student_user = $result->fetch(PDO::FETCH_ASSOC)) {
                $id = $student_user['user_id'];

                $insertQuery = "INSERT INTO student_clearance (student_id, clearance_id) VALUES (:stud_id, :clearance_id);";
                $stmt = $this->conn->prepare($insertQuery);

                $stmt->bindparam(':stud_id', $id);
                $stmt->bindparam(':clearance_id', $clearance_id);
                $stmt->execute();

            }
            return true;

        }catch(PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }

    public function getClearanceByColumn($column_name, $variable) {
        try{
            $sql = "SELECT * FROM clearance WHERE $column_name = $variable; ";

            $result = $this->conn->query($sql);

            return $result;

        }catch(PDOException $e) {
            echo "ERROR: ". $e->getMessage();
        }
    }

    public function endClearance($id, $date_end) {
        try {
            $status = "ended";
            $sql = "UPDATE clearance SET end_date = :date_end, status = :status WHERE id = :id ;";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindparam(':date_end', $date_end);
            $stmt->bindparam(':status', $status);
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