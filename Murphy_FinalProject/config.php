<?php

//Turns full error reporting on
error_reporting(E_ALL);
ini_set('display_errors',1);

// Connecting to the MySQL database
$user = 'murphyj11';
$password = 'triaprI9';

$database = new PDO('mysql:host=csweb.hh.nku.edu;dbname=db_fall17_murphyj11',$user,$password);
//error handling for db
$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

//Auto load
function my_autoloader($class) {
    include 'classes/class.' . $class . '.php';
}

spl_autoload_register('my_autoloader');  

// Start the session
session_start();

$current_url = basename($_SERVER['REQUEST_URI']);

// if userID is not set in the session and current URL not login.php redirect to login page
if (!isset($_SESSION["userid"]) && $current_url != 'login.php') {
    header("Location: login.php");
}

// Else if session key userID is set get $user from the database
elseif (isset($_SESSION["userid"])) {
    $user = new User($_SESSION["userid"],$database);
}

//Initalize Shoppping Cart
//if(!isset($_SESSION["ShoppingCart"])){
	//$_SESSION["ShoppingCart"] = new ShoppingCart();
//}

//$cart = $_SESSION["ShoppingCart"];