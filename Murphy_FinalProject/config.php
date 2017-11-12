<?php

// Connecting to the MySQL database
$user = 'murphyj11';
$password = 'triaprI9';

$database = new PDO('mysql:host=csweb.hh.nku.edu;dbname=db_fall17_murphyj11',$user,$password);
$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

// Start the session
session_start();

$current_url = basename($_SERVER['REQUEST_URI']);

function my_autoloader($class) {
    include 'classes/class.' . $class . '.php';
}

spl_autoload_register('my_autoloader');  

// if UserID is not set in the session and current URL not login.php redirect to login page
if (!isset($_SESSION["userID"]) && $current_url != 'login.php') {
    header("Location: login.php");
}

// Else if session key userID is set get $user from the database
elseif (isset($_SESSION["userID"])) {
    $user = new User($_SESSION["userID"],$database);
    
}