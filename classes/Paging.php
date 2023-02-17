<?php
class Paging extends DatabaseTable{
    private $conn;
    private $page = 12;

    private $startingPage;
    private $total_row;

    private $totalPage;

    function __construct($conn) {
        $this->conn = $conn;
    }

    public function rowCount($table_name) {
        $sql = "SELECT COUNT(*) FROM $table_name";
        $result = $this->conn->query($sql);

        $count = $result->fetchColumn();
        $this->total_row = $count;
        return $this->total_row;
    }

    public function pagination() {
        $totalPage = ceil($this->total_row / $this->page);
        $this->totalPage = $totalPage;
        return $totalPage;
    }
    
    public function startingPage($page) {
        $startingPage = (($page - 1) * $this->page);
        $this->startingPage = $startingPage;
        return $startingPage;
    }
    

    public function setPage($table_name) {
        try {
            $sql = "SELECT * FROM $table_name";
            $result = $this->conn->query($sql);

            $this->total_row;

            $sqlPage = "SELECT * FROM $table_name LIMIT $this->startingPage,  $this->page";

            $result = $this->conn->query($sqlPage);
            
            return $result;

        }catch(PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }
   


    //Page for student clearance

    public function getClearancePage() {
        try {
            $sql = "SELECT * FROM clearance c INNER JOIN clearance_type ct ON c.type = ct.clearance_type_id INNER JOIN beneficiary_type bt ON c.beneficiaries = bt.beneficiary_id ORDER BY c.id LIMIT $this->startingPage ,$this->page";
        $result = $this->conn->query($sql);
        return $result;

        }catch(PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        return false;
        }
    }

    public function getUsers() {
        try {
            $sql = "SELECT * FROM users WHERE user_type != 'admin' LIMIT $this->startingPage ,$this->page";
            $result = $this->conn->query($sql);
            return $result;
        }catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }

    public function countSearchedStudent($search, $table_name) {
        try {
            $sql = "SELECT COUNT(*) FROM $table_name WHERE id LIKE '%$search%' OR student_id LIKE '%$search%' OR first_name LIKE '%$search%' OR last_name LIKE '%$search%' OR middle_name LIKE '%$search%' OR email LIKE '%$search%' OR program_course LIKE '%$search%' OR academic_level LIKE '%$search%' OR strand LIKE '%$search%' OR year_level LIKE '%$search%' OR status LIKE '%$search%' ;";
            $result = $this->conn->query($sql);
            $count = $result->fetchColumn();
            $this->total_row = $count;
            return $count;
        }catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }

    public function getSignatory() {
        try {
            $selectQuery = "SELECT sd.id, sd.designation as 'sd_designation', sd.signatory_id as 'sd_id', s.first_name, s.middle_name, s.last_name, s.email, s.office_department, (SELECT org_name FROM organizations WHERE id = s.organization) as 'organization', s.status FROM signatory_designation sd INNER JOIN signatories s ON sd.signatory_id = s.id;";
            $countQuery = "SELECT COUNT(*) FROM signatory_designation sd INNER JOIN signatories s ON sd.signatory_id = s.id;";
            $result_select = $this->conn->query($selectQuery);
            $result_count = $this->conn->query($countQuery);

            $count = $result_count->fetchColumn();

            $this->total_row = $count;

            $result = array("count" => $count, "signatory_query" => $result_select);

            return $result;
        }catch(PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }

//Get all signatory designations of the students
public function getStudentClearance($id=null) {
    try{
        $sql = "SELECT * FROM student_clearance";
        $sqlCountQuery = "SELECT count(*) FROM student_clearance";
        $resultSql =  $this->conn->query($sql);
        $resultCount = $this->conn->query($sqlCountQuery);
        $row_count = $resultCount->fetchColumn();
        $this->total_row = $row_count;
        $count = $resultSql->columnCount();
        $result = array("row_count" => $row_count, "count_column" => $count, "sc_query" => $resultSql);
        return $result;
        
    }catch(PDOException $e) {
        echo "ERROR: " . $e->getMessage();
    }

}


    /*======== SIGNATORY PAGINATION ==========*/
    

    
    //Select all the column of designation of for approvals
    public function getSignatoryStudent() {
        try{
            $sql = "SELECT * FROM students s INNER JOIN student_clearance sc ON sc.student_id = s.student_id";
            $sqlCount = "SELECT COUNT(*) FROM students s INNER JOIN student_clearance sc ON sc.student_id = s.student_id";
            $resultCount = $this->conn->query($sqlCount);

            $count = $resultCount->fetchColumn();
            $result = $this->conn->query($sql);

            $this->total_row = $count;
            
            return array("count" => $count, "query" => $result);
        }catch(PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }

}