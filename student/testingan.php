<?php
require_once '../config/connection.php';

$result = $studentClearance->getSignatoryClearance(5 ,'20-02858');

print_r($result);