<?php 
class Errormessage {

    //login error message

    public static function input_empty () {
      echo 
  "<div class='alert alert-danger mb-0'>
     Input was empty.
    </div>";
  }
  public static function email_exist() {
    echo 
"<div class='alert alert-danger mb-0'>
   Account does not exist.
  </div>";
}

public static function login_failed() {
  echo 
"<div class='alert alert-danger mb-0'>
 Invalid username or password.
</div>";
}

public static function account_updated() {
  echo 
"<div class='alert alert-success alert-dismissible'>
  <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
 User accounts has been updated
</div>";
}

  

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

    public static function clearance_create_missing() {
      echo 
  "<div class='alert alert-danger alert-dismissible'>
      <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
      There was missing in inputs.
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

    //Clearance error message
    public static function clearance_start()
    {
        echo
            "<div class='alert alert-success alert-dismissible'>
              <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
             The clearance has been started.
            </div>";
    }
    public static function clearance_end()
    {
        echo
            "<div class='alert alert-success alert-dismissible'>
              <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
              The clearance has been ended.
            </div>";
    }
    public static function clearance_started()
    {
        echo
            "<div class='alert alert-warning alert-dismissible'>
              <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
              The clearance has been started already.
            </div>";
    }
    public static function clearance_failed()
    {
        echo
            "<div class='alert alert-danger alert-dismissible'>
              <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
              There was a problem starting the clearance.
            </div>";
    }
    public static function clearance_end_fail()
    {
        echo
            "<div class='alert alert-danger alert-dismissible'>
              <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
              There was a problem ending the clearance.
            </div>";
    }
    public static function clearance_ended()
    {
        echo
            "<div class='alert alert-danger alert-dismissible'>
              <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
              There was a problem in ending the clearance.
            </div>";
    }
    public static function clearance_end_success()
    {
        echo
            "<div class='alert alert-success alert-dismissible'>
              <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
              The clearance has been ended successfully.
            </div>";
    }


    //Import error message 
    public static function import_empty()
    {
        echo
            "<div class='alert alert-danger alert-dismissible'>
              <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
              Please select a CSV file.
            </div>";
    }
    public static function import_success()
    {
        echo
            "<div class='alert alert-success alert-dismissible'>
              <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
              Import success.
            </div>";
    }
    public static function import_failed()
    {
        echo
            "<div class='alert alert-danger alert-dismissible'>
              <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
              There was an error in imoporting the file.
            </div>";
    }
    public static function import_invalid()
    {
        echo
            "<div class='alert alert-danger alert-dismissible'>
              <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
              Invalid file format please select a CSV file.
            </div>";
    }
    public static function import_column_match()
    {
        echo
            "<div class='alert alert-danger alert-dismissible'>
              <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
              CSV file columns does not match.
            </div>";
    }


    /* ======SIGNATORY APPROVAL ERROR MESSAGE ======= */

    public static function designation_updated() {
      echo 
          "<div class='alert alert-success alert-dismissible'>
              <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
            Signatory designations has been updated.
            </div>";
    }

    public static function approve_success () {
      echo 
          "<div class='alert alert-success alert-dismissible'>
              <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
            Student Clearance has been approved.
            </div>";
   }

   public static function approve_failed () {
      echo 
          "<div class='alert alert-danger alert-dismissible'>
              <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
            There was an error approving student clearance.
            </div>";
  }

  public static function deficiency_added() {
    echo 
        "<div class='alert alert-success alert-dismissible'>
            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
          The student has been successfully added to the list.
          </div>";
 }

 public static function add_deficiency_fail() {
  echo 
      "<div class='alert alert-danger alert-dismissible'>
          <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
        There was an error in adding student deficiency.
        </div>";
}


//add signatory


public static function add_signatory_message() {
  echo 
      "<div class='alert alert-success alert-dismissible'>
          <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
        Signatory has been added.
        </div>";
}
    
}


?>