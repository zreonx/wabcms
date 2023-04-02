<?php

class Report {
    private $conn;

    function __construct($conn) {
        $this->conn = $conn;
    }

    public function getSignatoryColumn() {
        try {
            $sql = "SELECT * FROM signatory_designation";
            $result = $this->conn->query($sql);

            $designations = array();
            $count = 0;

           while($row_data = $result->fetch(PDO::FETCH_ASSOC)){

                // $designation =  explode(" ", strtolower($row_data['designation']));
                // $final_designation = implode("_", $designation);
                // $signatory_column = "is_" . $final_designation ."_approval";
                // $designations[$count] = $signatory_column;
                $designations[$count] = $row_data['designation'];

                $count++;
           }

           return $designations;

        }catch(PDOException $e){
            echo "Error:" . $e->getMessage();
        }
    }

  public function getSignatoryId($designation) {
    try {

        $sql = "SELECT * FROM signatory_designation WHERE designation = '$designation'";
        $result = $this->conn->query($sql);

        $resultQuery = $result->fetch(PDO::FETCH_ASSOC);

        return $resultQuery;

    }catch(PDOException $e){
        echo "Error:" . $e->getMessage();
    }
  }

  public function getSignatoryInfo($id) {
    try {

        $sql = "SELECT * FROM signatories WHERE id = '$id'";
        $result = $this->conn->query($sql);

        $resultQuery = $result->fetch(PDO::FETCH_ASSOC);

        return $resultQuery;

    }catch(PDOException $e){
        echo "Error:" . $e->getMessage();
    }
  }



    public function getSignatories() {
        try {
            $sql = "SELECT * FROM signatory_designation";
            $result = $this->conn->query($sql);

           return $result;

        }catch(PDOException $e){
            echo "Error:" . $e->getMessage();
        }
    }

    public function getClearanceInfo($clearanceId) {
        try {
            $sql = "SELECT * FROM clearance c INNER JOIN clearance_type ct ON c.type = ct.clearance_type_id INNER JOIN beneficiary_type bt ON c.beneficiaries = bt.beneficiary_id  WHERE c.id = $clearanceId ; ";
            $result = $this->conn->query($sql);
            $resultQuery = $result->fetch(PDO::FETCH_ASSOC);
            
            return $resultQuery;
            
        }catch(PDOException $e){
            echo "Error:" . $e->getMessage();
        }
    }

    public function getClearanceDesignationAll($signatoryColumn, $clearanceId) {
        try {
            $sql = "SELECT sc.student_id, $signatoryColumn as 'signatory', s.* FROM student_clearance sc INNER JOIN students s ON sc.student_id = s.student_id WHERE sc.clearance_id = $clearanceId";
            $result = $this->conn->query($sql);
            
            return $result;
            
        }catch(PDOException $e){
            echo "Error:" . $e->getMessage();
        }
    }

    public function countClearedOnSignatories($signatoryColumn, $clearanceId) {
        try {
            $sql = "SELECT student_id, $signatoryColumn as 'signatory' FROM student_clearance WHERE clearance_id = $clearanceId AND $signatoryColumn = '1'";
            $result = $this->conn->query($sql);
            $resultCount = $result->rowCount();

            return $resultCount;
            
        }catch(PDOException $e){
            echo "Error:" . $e->getMessage();
        }
    }
    public function countIncompleteSignatories($signatoryColumn, $clearanceId) {
        try {
            $sql = "SELECT student_id, $signatoryColumn as 'signatory' FROM student_clearance WHERE clearance_id = $clearanceId AND $signatoryColumn IS NULL";
            $result = $this->conn->query($sql);
            $resultCount = $result->rowCount();

            return $resultCount;
            
        }catch(PDOException $e){
            echo "Error:" . $e->getMessage();
        }
    }
 
}