<?php
include('functions.php');
class User {

    // Attributes / Properties
    private $username;
    private $userid;
    private $database;
    
   public function __construct($userid, $database) {
        $this->userid = $userid;
        $this->database = $database;
        $this->getFromDatabase();
    }
    
    private function getFromDatabase(){
		$users = getUser($this->userid,$this->database);
		$this->username = $users[0]['username'];
	}
    
   public function getusername() {
        return $this->username;
}
 
    public function getuserid() {
        return $this->userid;
}
}

?>