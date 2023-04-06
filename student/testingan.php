<?php
require_once '../config/connection.php';

$col = $studentClearance->getColumnName();

$result = $studentClearance->getSignatoryClearance(1, '20-02858');

$count = 0;

while($row = $result->fetch(PDO::FETCH_ASSOC)) {
   for($i = 0; $i < count($col); $i++) {
        $designee = ucwords(str_replace("_", " ",substr($col[$i], 3, -9))); 
       
        $studentClearance->getDesignationId($designee);
        
   }    
   
}
