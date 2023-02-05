<?php 

    class StudentClearance {
        private $conn;

        function __construct($conn) {
            $this->conn = $conn;
        }

        public function importStudent ($columns = array()) {
            try {
                $status = "imported";
                //Get an associative array column associates
                $column_name = implode(', ', array_keys($columns));
                $column_value = implode("', '", $columns) . "', 'imported'";
                $sql_column = "($column_name, status)";

                $sql = "INSERT INTO students $sql_column VALUES ('$column_value)";

                $this->conn->exec($sql);
                //print_r($sql);
                return true;
                
            }catch(PDOException $e){
                echo "ERROR: " . $e->getMessage();
                return false;
            }
            
        }
    }
