<?php

class Signatory {
    private $conn;

    function __construct($conn) {
        $this->conn = $conn;
    }


    public function orgList() {
        try{
            $sql = "SELECT * FROM organizations";

            $result = $this->conn->query($sql);
            return $result;

        }catch(PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }
    public function createSignatory($designation=array(), $firstname, $middlename, $lastname, $dept, $is_org, $organization, $email) {
        try {
            $signatory_type = implode(", ", $designation);
            $status = "active";

            $sql = "INSERT INTO signatories (designation, first_name, middle_name, last_name, office_department, is_org, organization, email, status)
            VALUES (:designation, :fname, :mname, :lname, :dept, :is_org, :organization, :email, :status); ";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindparam(':designation', $signatory_type);
            $stmt->bindparam(':fname', $firstname);
            $stmt->bindparam(':mname', $middlename);
            $stmt->bindparam(':lname', $lastname);
            $stmt->bindparam(':dept', $dept);
            $stmt->bindparam(':is_org', $is_org);
            $stmt->bindparam(':organization', $organization);
            $stmt->bindparam(':email', $email);
            $stmt->bindparam(':status', $status);
            $stmt->execute();

            $this->addSignatoryAssignement($email);

            return true;
        }catch(PDOException $e) {
            echo "ERROR: " . $e->getMessage();
            return false;
        }
    }

    protected function addSignatoryAssignement($email) {
        try {

            $selectSignatory = "SELECT * FROM signatories WHERE email = :email";

            $stmt = $this->conn->prepare($selectSignatory);
            $stmt->bindparam(':email', $email);
            $stmt->execute();

            $result = $stmt->fetch();

            $signatory_id = $result['id'];
            $designation = explode(", ", $result['designation']);

            for ($i = 0; $i < count($designation); $i++) {
                $sql = "INSERT INTO signatory_designation (signatory_id ,designation) VALUES (:id, :designation);";

                $statement = $this->conn->prepare($sql);
                $statement->bindparam(':id', $signatory_id);
                $statement->bindparam(':designation', $designation[$i]);
                $statement->execute();

            }
        }catch(PDOException $e)  {
            echo "ERROR: " . $e->getMessage();
        }

    }


}