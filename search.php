<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<!--[if IE]> <meta http-equiv="X-UA-Compatible" content="IE=edge"> <![endif]-->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="Cody Weeden">
		<title>Search</title>

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
			        $query = "SELECT type FROM (QBnB_Service_Member NATURAL JOIN City_Districts) WHERE member_ID='$currentID'";
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
		<h3 id='searchImg'>
			<img src="img/bg1.jpg" width='100%' height='400px'>
		</h3>

				<!-- Navbar -->
				<nav class="navbar navbar-default navbar-fixed-top navbar" role="navigation">
			<div class="container">
				<div class="navbar-header page-scroll">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menu-collapse">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

<!-- 					<div id="navbar-left">
						Welcome  <?php echo $myrow['fName']; ?>!
					</div> -->

					<div id="navbar-left">
						Search a house or a district or a street!
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
						<li><a href="listYourHouse.php">List Your House!</a></li>
						<li><a href="search.php">Search</a></li>
						<li><a href="index.php?logout=1">Log Out</a></li>
					</ul>
				</div> <!-- End collapse navbar-collapse navbar-menu-collapse -->
			</div> <!-- End container -->
		</nav>

	<div class="container" >
		<div id="updateProfile" class="row">
			<div align="center">

		<form method="post" action="search.php?go" id="searchform">
		<input type="text"  name="name">
		<input type="submit" name="searchBtn" value="Search">
	</form>

</div>
</div>
</div>

<div class="container">
			<div class="row">
				<div id="search results" class="col-sm-4 projects-item" align="right">

<?php

	if(isset($_SESSION['id'])){
		if(isset($_POST['searchBtn'])){
	   // include database connection
	    include_once 'config/connection.php'; 

		$name=$_POST['name'];
		// SELECT query
	        $query = "SELECT member_ID, email, phone_number, fName, lName, year, faculty FROM QBnB_Service_Member WHERE fName LIKE '%$name%' OR lName LIKE '%$name%' OR faculty LIKE '%$name%' OR year = '$name' OR phone_number = '$name'";
	 
	        // prepare query for execution
	        $stmt = $con->prepare($query);
			
	        // bind the parameters. This is the best way to prevent SQL injection hacks.
	      //  $stmt->bind_Param("s", $_SESSION['id']);

	        // Execute the query
			$stmt->execute();
	 
			// results 
			$result = $stmt->get_result();

				echo "Users that contains ".$name;
				echo "<table class='listingHouses text-center' border='2'>";
				while($myrow = $result->fetch_assoc()){
					echo "<tr class='heading'>"."<td>First Name</td>"."<td>Last Name</td>"."<td>Year</td>"."<td>Faculty</td>"."</tr>";
					echo "<tr>"."<td>".$myrow['fName']."</td>"."<td>".$myrow['lName']."</td>"."<td>".$myrow['year']."</td>"."<td>".$myrow['faculty']."</td>"."</tr>"."<br>";
				}
				echo "</table>";

				?>
				<br>
				<?php

			$name=$_POST['name'];
		// SELECT query
	        $query = "SELECT * FROM (Rental_Properties NATURAL JOIN City_Districts) WHERE `Rental_Properties`.`city` LIKE '%$name%' OR address LIKE '%$name%' OR district_name LIKE '%$name%'";
	 
	        // prepare query for execution
	        $stmt = $con->prepare($query);
			
	        // bind the parameters. This is the best way to prevent SQL injection hacks.
	      //  $stmt->bind_Param("s", $_SESSION['id']);

	        // Execute the query
			$stmt->execute();
	 
			// results 
			$result = $stmt->get_result();

				echo "Listings that contains ".$name;
				echo "<table class='listingHouses text-center' border='2'>";
				while($myrow = $result->fetch_assoc()){
					echo "<tr class='heading'>"."<td>House ID</td>"."<td>Suppliers</td>"."<td>address</td>"."<td>City</td>"."<td>District</td>"."<td>POI</td>"."<td>price</td>";
					echo "<tr>"."<td>".$myrow['house_ID']."</td>"."<td>".$myrow['suppliers']."</td>"."<td>".$myrow['address']."</td>"."<td>".$myrow['city']."</td>"."<td>".$myrow['district_name']."<td>".$myrow['points_of_interest']."</td>"."</td>"."<td>".$myrow['price']."</td>"."</tr>"."<br>";
				}
				echo "</table>";
		}
	} else {
		//User is not logged in. Redirect the browser to the login index.php page and kill this page.
		header("Location: index.php");
		exit();
	    //die();
	}

	?><!-- end php -->
				</div> <!-- End column -->
			</div>
		</div>
	</body>
</html>