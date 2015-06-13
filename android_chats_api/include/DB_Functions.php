<?php
 
class DB_Functions {
 
    private $db;
 
    //put your code here
    // constructor
    function __construct() {
        require_once 'DB_Connect.php';
        // connecting to database
        $con->db = new DB_Connect();
        $con->db->connect();
    }
 
    // destructor
    function __destruct() {
         
    }
 
    /**
     * Storing new user
     * returns user details
     */
    public function addChat($send, $receive,$time,$amount,$description,$chattag) {
        
        $result = mysql_query("INSERT INTO chats(send, receive,time,amount,description,chattag) VALUES('$send',' $receive','$time','$amount','$description','$chattag')");
        // check for successful store
        if ($result) {
           return true;
        } else {
            return false;
        }
    }
     /**
     * Get Chat by Receive number
     */
    public function checkbyReceive($receive) {
        $result = mysql_query("SELECT * FROM chats WHERE receive LIKE '%$receive%' ") or die(mysql_error());
        // check for result 
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
           return mysql_fetch_array($result);
            
            }
         else {
            // user not found
            return false;
        }
    }
    public function deletebyId($id){
$query="DELETE FROM chats WHERE id=$id";
mysql_query($query);
}
   }
 
?>
