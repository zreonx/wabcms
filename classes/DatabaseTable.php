<?php 

class DatabaseTable {
    private static array $table_list = [
        "students" => "students",
        "clearance" => "clearance",
        "users" => "users",
        "signatories" => "signatories",
        "signatory_designation" => "signatory_designation",
        "clearance_request" => "clearance_request"
    ];
    
    public static function getStudentTable() {
        return self::$table_list['students'];
    }

    public static function getClearanceTable() {
        return self::$table_list['clearance'];
    }

    public static function getUsersTable() {
        return self::$table_list['users'];
    }

    public static function getSignatoryTable() {
        return self::$table_list['signatory_designation'];
    }

    public static function getSignatoryDesgination() {
        return self::$table_list['signatory_designation'];
    }

    public static function getRequestClearanceTable() {
        return self::$table_list['clearance_request'];
    }
}