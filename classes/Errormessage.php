<?php 
class Errormessage {


    //Create Clearance Error Messages
    public static function clearance_create_failed () {
        echo 
    "<div class='alert alert-danger alert-dismissible'>
        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
       Failed to create a clearance.
      </div>";
    }
    public static function clearance_create_success () {
        echo 
    "<div class='alert alert-success alert-dismissible'>
        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
        Clearance has been created successfully.
      </div>";
    }

    //Create Clearance Error Messages
    public static function clearance_update_failed()
    {
        echo
            "<div class='alert alert-danger alert-dismissible'>
        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
        Failed to update a clearance.
      </div>";
    }
    public static function clearance_update_success () {
        echo 
    "<div class='alert alert-success alert-dismissible'>
        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
        Clearance has been updated  successfully.
      </div>";
    }
}


?>