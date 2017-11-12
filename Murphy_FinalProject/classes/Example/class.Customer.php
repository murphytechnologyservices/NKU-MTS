<?php

class Customer {
    // Attributes / Properties
    public $customerID;
    private $database;
    private $customername;
    
    function __construct($customerID, $database) {
        // Variables in a method are separate from those of the overall class
        // To access class level variable utilize the $this keyword
        $this->customerID = $customerID;
        $this->database = $database;

        $sql = file_get_contents('sql/getCustomer.sql');
        $params = array(
            'customerid' =>$this->customerID
        );
        $statement = $database->prepare($sql);
        $statement->execute($params);
        $customers = $statement->fetchAll(PDO::FETCH_ASSOC);

        $customer = $customers[0];
        $this->customername = $customer['name'];
        
    }
    
    function getcustomername() {
        return $this->customername;
}
    
}