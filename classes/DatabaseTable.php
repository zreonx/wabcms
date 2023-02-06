<?php 

class DatabaseTable {
    private static array $table_list = [
        "students" => "students",
        "clearance" => "clearance"
    ];
    
    public static function getStudentTable() {
        return self::$table_list['students'];
    }

    public static function getClearanceTable() {
        return self::$table_list['clearance'];
    }
}