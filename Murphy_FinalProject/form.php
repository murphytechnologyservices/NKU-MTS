<?php

// Create and include a configuration file with the database connection
include('config.php');

// Include functions for application
//include('functions.php');

// Get type of form either add or edit from the URL (ex. form.php?action=add) using the newly written get function
$action = $_GET['action'];

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

// If form submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$service_name = $_POST['service_name'];
	$service_desc = $_POST['service_desc'];
	$service_price = $_POST['service_price'];
	
	if($action == 'add') {
		// Insert Service
		$sql = file_get_contents('sql/insertService.sql');
		$params = array(
			'service_name' => $service_name,
			'service_desc' => $service_desc,
			'service_price' => $service_price
		);
	
		$statement = $database->prepare($sql);
		$statement->execute($params);
		
	}
	
	elseif ($action == 'edit') {
		$sql = file_get_contents('sql/updateService.sql');
        $params = array( 
			'service_name' => $service_name,
			'service_desc' => $service_desc,
			'service_price' => $service_price
        );
        
        $statement = $database->prepare($sql);
        $statement->execute($params);
        
	}
	
	// Redirect to Service listing page
	header('location: index.php');
}

// In the HTML, if an edit form:
// Populate textboxes with current data of Service selected 
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
			<div class="form-element">
				<label>Service Name:</label>
				<?php if($action == 'add') : ?>
					<input type="text" name="service_name" class="textbox" value="<?php echo $dbservice['service_name'] ?>" />
				<?php else : ?>
					<input readonly type="text" name="service_name" class="textbox" value="<?php echo $dbservice['service_name'] ?>" />
				<?php endif; ?>
			</div>
			<div class="form-element">
				<label>Service Description:</label>
				<input type="text" name="service_desc" class="textbox" value="<?php echo $dbservice['service_desc'] ?>" />
			</div>
			<div class="form-element">
				<label>Service Price:</label>
				<input type="number" step="any" name="service_price" class="textbox" value="<?php echo $dbservice['service_price'] ?>" />
			</div>
			<div class="form-element">
				<input type="submit" class="button" value="Submit Changes" id="submit"/>&nbsp;
			</div>
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