<?php
class StudentClearance {

    private $conn;
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function displayClearance() {
        try {
            $sql = "SELECT c.*, (SELECT clearance_type FROM clearance_type WHERE clearance_type_id = type) as 'type_name' FROM clearance c WHERE status = 'started' AND beneficiaries = '1'";
            $result = $this->conn->query($sql);
            return $result;

        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function displayRequestedClearance($student_id) {
        try {
            $sql = "SELECT c.*, (SELECT clearance_type FROM clearance_type WHERE clearance_type_id = type) as 'type_name' FROM clearance c WHERE status = 'started' AND beneficiaries = '$student_id'";
            $result = $this->conn->query($sql);
            return $result;

        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }


    //This will get all the column name of the student_clearance

    public function getColumnName() {
        try {

            $sql = "DESCRIBE student_clearance";
            $result = $this->conn->query($sql);
            
            $designations = array();

            $table_count = 0;
            $des_count = 0;

            while($designation_row = $result->fetch(PDO::FETCH_ASSOC)) {
                if($table_count < 3){
                    $table_count++;
                    continue;
                }else {
                    $designations[$des_count] = $designation_row['Field'];
                    $table_count++;
                    $des_count++;
                }
                    
            }

            return $designations;

        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function getSignatoryClearance($clearance_id, $student_id) {
        try{

           $designations = $this->getColumnName(); 
           $designation_text  = implode(', ', $designations);
           $sql = "SELECT $designation_text FROM student_clearance WHERE student_id = '$student_id' AND clearance_id = $clearance_id;";

           $result = $this->conn->query($sql);
           
           return $result;
           
        }catch(PDOException $e){
           echo $e->getMessage();
        }
   }

   //Get signatory information and check if they are program head or not
    public function getDesignationId($designation) {
        try{

            $sql = "SELECT * FROM signatory_designation WHERE designation = '$designation'";
            $result = $this->conn->query($sql);

            while($des_row = $result->fetch(PDO::FETCH_ASSOC)) {
               return $this->desInfo($des_row['signatory_id']);
            }

        
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function desInfo($id) {
        try{

            $sql = "SELECT * FROM signatories WHERE id = $id";
            $result = $this->conn->query($sql);

            return $result->fetch(PDO::FETCH_ASSOC);
        
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function getOrg() {
        try{
            $sql = "SELECT * FROM clearance_type";
            $result = $this->conn->query($sql);

            return $result;
        
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function requestClearance($cid, $sid, $message, $date_requested) {
        try {
            $status = "pending";
            $sql = "INSERT INTO clearance_request (clearance_type_id, student_id, reason_of_request, date_requested, status) values (:ct_id, :sid, :message, :date_requested, :status) ;";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindparam(':ct_id', $cid);
            $stmt->bindparam(':sid', $sid);
            $stmt->bindparam(':message', $message);
            $stmt->bindparam(':date_requested', $date_requested);
            $stmt->bindparam(':status', $status);

            $stmt->execute();

            return true;
            
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function getRequest($student_id) {
        try{
            $sql = "SELECT * FROM clearance_request cr INNER JOIN clearance_type ct ON cr.clearance_type_id = ct.clearance_type_id WHERE cr.student_id = '$student_id' AND cr.status IN ('pending','issued'); ";
            $result = $this->conn->query($sql);

            return $result;
        
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function cancelRequest($student_id, $request_id) {
        try{
            $sql = "UPDATE clearance_request SET status = 'cancelled' WHERE student_id = '$student_id' AND id = '$request_id'; ";
            $result = $this->conn->query($sql);

            return true;
        
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

}