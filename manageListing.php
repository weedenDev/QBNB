<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<!--[if IE]> <meta http-equiv="X-UA-Compatible" content="IE=edge"> <![endif]-->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="Raymond Chung">
		<title>QBnB</title>

		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="css/animate.min.css">
		<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="css/main.css">

		<!-- Favicon -->
		<link rel="shortcut icon" href="img/favicon.png">
	</head>
	<body>
		<?php
		  //Create a user session or resume an existing one
		 session_start();
		?>
		<?php
			if(isset($_SESSION['id'])){
			   // include database connection
			    include_once 'config/connection.php'; 
				
				// SELECT query
					$currentID = $_SESSION['id'];
			        $query = "SELECT type FROM QBnB_Service_Member WHERE member_ID='$currentID'";
			        // prepare query for execution
			        $stmt = $con->prepare($query);
			        // bind the parameters. This is the best way to prevent SQL injection hacks.
			        //$stmt->bind_Param("s", $_SESSION['id']);
			        // Execute the quer;y
					$stmt->execute();
					// results 
					$result = $stmt->get_result();
					// Row data
					$yoyo = $result->fetch_assoc();
					
			} else {
				//User is not logged in. Redirect the browser to the login index.php page and kill this page.
				header("Location: index.php");
				exit();
				//die();
			}
		?>

		<?php
			if(isset($_SESSION['id'])){
			   // include database connection
			    include_once 'config/connection.php'; 
				$currentID = $_SESSION['id'];
				// SELECT query
			        $query = "SELECT house_ID, suppliers, address, city, postal_code, type, features, price, district_name FROM (Rental_Properties NATURAL JOIN City_Districts) WHERE suppliers='$currentID'";
			        // prepare query for execution
			        $stmt = $con->prepare($query);
			        // bind the parameters. This is the best way to prevent SQL injection hacks.
			        //$stmt->bind_Param("s", $_SESSION['id']);
			        // Execute the quer;y
					$stmt->execute();
					// results 
					$result = $stmt->get_result();
					// Row data
					//$myrow = $result->fetch_assoc();
					
			} else {
				//User is not logged in. Redirect the browser to the login index.php page and kill this page.
				header("Location: index.php");
				exit();
				//die();
			}
		?>

		<!-- 1. NAVIGATION BAR -->
		<nav class="navbar navbar-default navbar-fixed-top navbar" role="navigation">
			<div class="container">
				<div class="navbar-header page-scroll">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menu-collapse">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

					<div id="navbar-left">
						<p>Book today!</p>
					</div>
				</div> <!-- End navbar-header page-scroll -->

				<div class="collapse navbar-collapse navbar-menu-collapse">
					<ul class="nav navbar-nav navbar-right">
						<li class="hidden"><a class="page-scroll" href="#page-top"></a></li>
						<?php
							if ($yoyo['type'] > 0) {
								echo "
								<li><a href='adminmanage.php'>Admin</a></li>";
							} 
						?>
						<li><a href="manage.php">Dashboard</a></li>
						<li><a href="main.php">Main</a></li>
						<li><a href="search.php">Search</a></li>
						<li><a href="index.php?logout=1">Log Out</a></li>
					</ul>
				</div> <!-- End collapse navbar-collapse navbar-menu-collapse -->
			</div> <!-- End container -->
		</nav>

		<div class="container">
			<div id='updateProfile' class="row">
				<div class="col-md-12">
					<table class="listingHouses text-center" border="2">
					<?php
						echo "<tr class='heading'>"."<td>Supplier</td>"."<td>Address</td>"."<td>City</td>"."<td>Postal Code</td>"."<td>District</td>"."<td>Room</td>"."<td>Features</td>"."<td>Price</td>"."<td>Delete</td>"."</tr>";
						while($myrow = $result->fetch_assoc()) {
							echo "<form name='deleteHouse' id='deleteHouse' action='modifyListing.php' method='post'><tr>"."<td>".$myrow['suppliers']."</td>"."<td>".$myrow['address']."</td>"."<td>".$myrow['city']."</td>"."<td>".$myrow['postal_code']."</td>"."<td>".$myrow['district_name']."</td>"."<td>".$myrow['type']."</td>"."<td>".$myrow['features']."</td>"."<td>".$myrow['price']."</td>"."<td><input type='submit' id='modifyBtn' name='modifyBtn' value='Modify'/></td><input class='dontshow' type='text' id='addressB' name='addressB' value='".$myrow['address']."'/><input class='dontshow' type='text' id='cityB' name='cityB' value='".$myrow['city']."'/><input class='dontshow' type='text' id='postal' name='postal' value='".$myrow['postal_code']."'/><input class='dontshow' type='text' id='typeB' name='typeB' value='".$myrow['type']."'/><input class='dontshow' type='text' id='featuresB' name='featuresB' value='".$myrow['features']."'/><input class='dontshow' type='text' id='priceB' name='priceB' value='".$myrow['price']."'/><input class='dontshow' type='text' id='houseB' name='houseB' value='".$myrow['house_ID']."'/><input class='dontshow' type='text' id='supplierB' name='supplierB' value='".$myrow['suppliers']."'/></form>"."</tr>"."<br>";
						}
					?>
					</table>
					<div class="col-md-4">
				 		<form name='manageList' id='backtoMainBtn' action='main.php' method='post'>
							<br><input type="submit" id="backtoMainBtn" class="btn btn-success btn-lg" value="Return to Main"/>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>