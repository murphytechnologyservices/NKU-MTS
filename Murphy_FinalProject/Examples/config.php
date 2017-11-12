<?php

// Connecting to the MySQL database
$user = 'murphyj11';
$password = 'triaprI9';

$database = new PDO('mysql:host=csweb.hh.nku.edu;dbname=db_fall17_murphyj11',$user,$password);

// Start the session
session_start();

$current_url = basename($_SERVER['REQUEST_URI']);

function my_autoloader($class) {
    include 'classes/class.' . $class . '.php';
}

spl_autoload_register('my_autoloader');  

// if customerID is not set in the session and current URL not login.php redirect to login page
if (!isset($_SESSION["customerID"]) && $current_url != 'login.php') {
    header("Location: login.php");
}

// Else if session key customerID is set get $customer from the database
elseif (isset($_SESSION["customerID"])) {
    $customer = new Customer($_SESSION["customerID"],$database);
    
}