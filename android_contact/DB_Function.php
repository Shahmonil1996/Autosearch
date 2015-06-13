<?php
 
class DB_Functions {
 
    private $db;
 
    //put your code here
    // constructor
    function __construct() {
        require_once 'DB_Connect.php';
        // connecting to database
        $this->db = new DB_Connect();
        $this->db->connect();
    }
 
    // destructor
    function __destruct() {
         
    }
 
    /**
     * Get user by Phone number
     */
    public function getUserByPhoneNumber($number) {
        $result = mysql_query("SELECT * FROM users WHERE number='$number'") or die(mysql_error());
        // check for result 
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            return true;
            }
         else {
            // user not found
            return false;
        }
    }
 
    
 
}
 
?>