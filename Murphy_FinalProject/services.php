<?php

// Create and include a configuration file with the database connection
include('config.php');

// Include functions for application
//include('functions.php');

// Get the $service_name from the URL if it exists using the newly written get function
$service_name = get('service_name');

// Initially set $service to null;
$dbservice = null;

// If $dbservice is not empty, get service_name record into $dbservice variable from the database
//     Set $dbservice equal to the first service in $dbservices
if(!empty($service_name)) {
	$sql = file_get_contents('sql/getServiceName.sql');
	$params = array(
		'service_name' => $service_name
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$dbservices = $statement->fetchAll(PDO::FETCH_ASSOC);
	
	$dbservice = $dbservices[0];
}

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<img src="Images/MTS_Logo.JPG" width=180px height=150px style="float:left">
  	<title>Service Details</title>
	<meta name="description" content="The HTML5 Herald">
	<meta name="author" content="SitePoint">

	<link rel="stylesheet" href="css/style.css">

	<!--[if lt IE 9]>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  	<![endif]-->
</head>
<body>
	<div class="page">
		<h1><?php echo $dbservice['service_name'] ?></h1>
		<p>
			<?php echo $dbservice['service_desc']; ?><br /><br />
			<?php echo formatDollars($dbservice['service_price']); ?><br />
		</p>
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