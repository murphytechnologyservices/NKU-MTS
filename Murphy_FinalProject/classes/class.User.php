<?php

class User {
    // Attributes / Properties
    public $userID;
    private $database;
    private $username;
    
    function __construct($userID, $database) {
        $this->userID = $userID;
        $this->database = $database;

        $sql = file_get_contents('sql/getUser.sql');
        $params = array(
            'userid' =>$this->userID
        );
        $statement = $database->prepare($sql);
        $statement->execute($params);
        $users = $statement->fetchAll(PDO::FETCH_ASSOC);

        $user = $users[0];
        $this->username = $user['name'];
        
    }
    
    function getusername() {
        return $this->username;
}
    
}