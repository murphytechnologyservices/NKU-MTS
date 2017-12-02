<?php

// Create and include a configuration file with the database connection
include('config.php');

// Include functions for application
//include('functions.php');

// Get search term from URL using the get function
$term = get('search-term');
$services = searchServices($term, $database);

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<img src="Images/MTS_Logo.JPG" width=180px height=150px style="float:left">
    <title>Technology Services</title>
	<meta name="description" content="The HTML5 Herald">
	<meta name="author" content="SitePoint">

	<link rel="stylesheet" href="css/style.css">
    <!--[if lt IE 9]>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  	<![endif]-->
</head>
<body>
	<div class="page">
		<h1>Technology Services</h1>
		<form method="GET">
			<input type="text" name="search-term" placeholder="Search..." id="search" />
			<input type="submit" value="Search for Services" id="submit"/>
            <p><a href="form.php?action=add">Add a New Service</a></p>
            <p><a href="myservices.php?action=edit&userid=<?php echo $user->getuserid() ?>">View My Services</a></p>
        </form>

        <table style="width:100%">
            <tr>
                <th class="absorbing-column">Service Name</th>
                <th class="absorbing-column">Service Description</th>
                <th class="absorbing-column">Service Price</th>
                <th class="absorbing-column">Edit</th>
                <th class="absorbing-column">View</th>
                <th class="absorbing-column">Add for Me</th>
            </tr>
            <?php foreach($services as $service) : ?>
                <p>
                    <tr>
                        <td><?php echo $service['service_name']; ?></td>
                        <td><?php echo $service['service_desc']; ?></td>
                        <td><?php echo formatDollars($service['service_price']); ?></td>
                        <td><a href="form.php?action=edit&service_name=<?php echo $service['service_name'] ?>">Edit Service</a></td>
                        <td><a href="services.php?service_name=<?php echo $service['service_name'] ?>">View Service</a></td>
                        <td><a href="myservices.php?action=edit&service_name=<?php echo $service['service_name'] ?>&userid=<?php echo $user->getuserid() ?>">Add Service</a></td>
                    </tr>                    
                </p>
            <?php endforeach; ?>
        </table>    		
	</div>
</body>
<footer>
        <!-- print currently accessed by the current username -->
            <p>Currently logged in as: <?php echo $user->getusername(); ?></p>

        <!-- A link to the logout.php file -->
            <p>
                <a href="logout.php">Log Out</a>
            </p>
</footer>
</html>