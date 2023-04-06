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

}