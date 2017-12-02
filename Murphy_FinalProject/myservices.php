<?php

// Create and include a configuration file with the database connection
include('config.php');

// Include functions for application
//include('functions.php');

// Get type of form either add or edit from the URL (ex. form.php?action=add) using the newly written get function
$action = $_GET['action'];

// Get the $service_name from the URL if it exists using the newly written get function
$service_name = get('service_name');
$userid = get('userid');

// Initially set $service to null;
$dbservice = null;

if(!empty($service_name)) {
	$sql = file_get_contents('sql/deleteMyServices.sql');
	$params = array(
		'userid' => $userid,
        'service_name' => $service_name
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);

    $sql = file_get_contents('sql/setMyServices.sql');
	$params = array(
		'userid' => $userid,
        'service_name' => $service_name
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);

    if($action == 'delete') {
        $sql = file_get_contents('sql/deleteMyServices.sql');
        $params = array(
            'userid' => $userid,
            'service_name' => $service_name
        );
        $statement = $database->prepare($sql);
        $statement->execute($params);
    }
    }

// If $dbservice is not empty, get service_name record into $dbservice variable from the database
//     Set $dbservice equal to the first service in $dbservices
if(!empty($userid)) {
	$sql = file_get_contents('sql/getMyServices.sql');
	$params = array(
		'userid' => $userid
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$dbservices = $statement->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<img src="Images/MTS_Logo.JPG" width=180px height=150px style="float:left">
  	<title>Manage Services</title>
	<meta name="description" content="The HTML5 Herald">
	<meta name="author" content="SitePoint">

	<link rel="stylesheet" href="css/style.css">

	<!--[if lt IE 9]>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  	<![endif]-->
</head>
<body>
	<div class="page">
		<h1>Manage Services</h1>
		<form action="" method="POST">
        <table style="width:100%">
            <tr>
                <th class="absorbing-column">Service Name</th>
                <th class="absorbing-column">User Name</th>
                <th class="absorbing-column">Remove Service</th>
            </tr>
            <?php foreach($dbservices as $dbservice) : ?>
                <p>
                    <tr>
                        <td><div class="form-element"><?php echo $dbservice['service_name']; ?></div></td>
                        <td><div class="form-element"><?php echo $dbservice['name']; ?></div></td>
                        <td><a href="myservices.php?action=delete&service_name=<?php echo $dbservice['service_name'] ?>&userid=<?php echo $user->getuserid() ?>">Remove Service</a></td>
                    </tr>                    
                </p>
            <?php endforeach; ?>
        </table>  
        </form>
	</div>

    </body>
<footer>
    <p>
        <a href="index.php">Home</a>
    </p>
    
    <!-- print currently accessed by the current username -->
        <p>Currently logged in as: <?php echo $user->getusername(); ?></p>

    <!-- A link to the logout.php file -->
        <p>
            <a href="logout.php">Log Out</a>
        </p>
</footer>
</html>