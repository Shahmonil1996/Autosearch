<?php
 
/**
 * File to handle all API requests
 * Accepts GET and POST
 * 
 * Each request will be identified by TAG
 * Response will be JSON data
 
  /**
 * check for POST request 
 */
if (isset($_POST['tag']) && $_POST['tag'] != '') {
    // get tag
    $tag = $_POST['tag'];
 
    // include db handler
    require_once 'include/DB_Functions.php';
    $db = new DB_Functions();
 
    // response Array
    $response = array("tag" => $tag, "error" => FALSE);
 
    // check for tag type
    if ($tag == 'chat_add') {
        // Request type is check Chat_Add
        $send = $_POST['send'];
        $receive = $_POST['receive'];
	$time=$_POST['time'];
	$amount=$_POST['amount'];
	$description=$_POST['description'];
	$chattag=$_POST['chattag'];
 
        // add chat
        $user = $db->addChat($send,$receive,$time,$amount,$description,$chattag);
if($user==FALSE){
            $response["error"] =TRUE ;
            }
	else{
	$response["error"]=FALSE;
	}
            echo json_encode($response);

    }
//check for chat_req tag
      else if ($tag == 'chat_req') {
        // Request type is chat check
         $receive=$_POST['receive'];
 
        // check for user
        $user = $db->checkbyReceive($receive);
        if ($user != false) {
            // user found
            $response["error"] = FALSE;
            $response["user"]["amount"] = $user["amount"];
                $response["user"]["id"] = $user["id"];
                $response["user"]["description"] = $user["description"];
                $response["user"]["send"] = $user["send"];
                $response["user"]["time"] = $user["time"];
                $response["user"]["chattag"] = $user["chattag"];
            echo json_encode($response);
          $db->deletebyId($user["id"]);
        }



 else {
            // user not found
            // echo json with error = 1
            $response["error"] = TRUE;
            $response["error_msg"] = "No Chat Found!";
            echo json_encode($response);
        }
    } 
}
 else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameter 'tag' is missing!";
    echo json_encode($response);
}
?>