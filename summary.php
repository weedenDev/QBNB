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
		
		// SELECT query
	        $query = "SELECT AVG(price) as priceAverage FROM rental_properties";
	 
	      
			$stmt = $con->prepare($query);
			// Execute the query
			$stmt->execute();
	 
			// results 
			$result = $stmt->get_result();
			
			// Row data
			//$myrow = $result->fetch_assoc();
			$myrow = $result->fetch_assoc();
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
		
		// SELECT query
	        $query = "SELECT COUNT(member_ID) as avgM FROM QBnB_Service_Member";
	 
	      
			$stmt = $con->prepare($query);
			// Execute the query
			$stmt->execute();
	 
			// results 
			$result = $stmt->get_result();
			
			// Row data
			//$myrow = $result->fetch_assoc();
			$myrow1 = $result->fetch_assoc();
			}	
			
		else {
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
		
		// SELECT query
	        $query = "SELECT AVG(ratings) as rate FROM Comments";
	 
	      
			$stmt = $con->prepare($query);
			// Execute the query
			$stmt->execute();
	 
			// results 
			$result = $stmt->get_result();
			
			// Row data
			//$myrow = $result->fetch_assoc();
			$myrow3 = $result->fetch_assoc();
			
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
		
		// SELECT query
	        $query = "SELECT consumer, COUNT(status) as bookAct FROM Bookings WHERE status = 'Confirmed' GROUP BY consumer";
	 
	      
			$stmt = $con->prepare($query);
			// Execute the query
			$stmt->execute();
	 
			// results 
			$resu = $stmt->get_result();
			
			// Row data
			//$myrow = $result->fetch_assoc();
			//$myrow3 = $result->fetch_assoc();
			
	}
	?>

	<?php
	if(isset($_SESSION['id'])){
	   // include database connection
	    include_once 'config/connection.php'; 
		
		// SELECT query
	        $query = "SELECT house_ID, AVG(ratings) as yoRate, COUNT(status) as bookAct FROM (Bookings NATURAL JOIN Comments)GROUP BY house_ID";
	 
	      
			$stmt = $con->prepare($query);
			// Execute the query
			$stmt->execute();
	 
			// results 
			$resu2 = $stmt->get_result();
			
			// Row data
			//$myrow = $result->fetch_assoc();
			//$myrow3 = $result->fetch_assoc();
			
	}
	?>

	<?php
	if(isset($_SESSION['id'])){
	   // include database connection
	    include_once 'config/connection.php'; 
		
		// SELECT query
	        $query = "SELECT owner_ID, AVG(ratings) as yoRate, COUNT(status) as bookAct FROM (Bookings NATURAL JOIN Comments)GROUP BY owner_ID";
	 
	      
			$stmt = $con->prepare($query);
			// Execute the query
			$stmt->execute();
	 
			// results 
			$resu1 = $stmt->get_result();
			
			// Row data
			//$myrow = $result->fetch_assoc();
			//$myrow3 = $result->fetch_assoc();
			
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
						<p>Summary Page</p>
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
						<li><a href="adminmanage.php">Dashboard</a></li>
						<li><a href="adminmain.php">Main</a></li>
						<li><a href="search.php">Search</a></li>
						<li><a href="index.php?logout=1">Log Out</a></li>
					</ul>
				</div> <!-- End collapse navbar-collapse navbar-menu-collapse -->
			</div> <!-- End container -->
		</nav>

		<div class="container">
			<div id='updateProfile' class="row">
				<div class='col-lg-12'>
	 				<table border='0'>
						<tr>
				            <td>Average Renting Price: </td>
				            <td><?php echo $myrow['priceAverage'];?></td>
				        </tr>
				        <tr>
				            <td>Number of Members: </td>
				            <td><?php echo $myrow1['avgM'];?></td>
				        </tr>
				         <tr>
				            <td>Average Rating per consumer: </td>
				            <td><?php echo $myrow3['rate'];?></td>
				        </tr>
				    </table>
				    <table class="listingHouses text-center" border="2">
					<?php
						echo "Successful Bookings Per Consumer:";
						echo "<tr class='heading'>"."<td>House ID</td>"."<td>Booking Per Consumer</td>"."</tr>";
						while($booky = $resu->fetch_assoc()) {
							echo "<tr>"."<td>".$booky['consumer']."</td>"."<td>".$booky['bookAct']."</td>"."</tr>"."<br>";
						}
					?>
					</table>
					<table class="listingHouses text-center" border="2">
					<?php
						echo "Bookings & Ratings Per Suppliers:";
						echo "<tr class='heading'>"."<td>Suppliers</td>"."<td>Booking Per Consumer</td>"."<td>Avg Ratings</td>"."</tr>";
						while($booky2 = $resu1->fetch_assoc()) {
							echo "<tr>"."<td>".$booky2['owner_ID']."</td>"."<td>".$booky2['bookAct']."</td>"."<td>".$booky2['yoRate']."</td>"."</tr>"."<br>";
						}
					?>
					</table>
					<table class="listingHouses text-center" border="2">
					<?php
						echo "Bookings & Ratings Per Accomodation:";
						echo "<tr class='heading'>"."<td>Accomodation</td>"."<td>Booking Per Consumer</td>"."<td>Avg Ratings</td>"."</tr>";
						while($booky3 = $resu2->fetch_assoc()) {
							echo "<tr>"."<td>".$booky3['house_ID']."</td>"."<td>".$booky3['bookAct']."</td>"."<td>".$booky3['yoRate']."</td>"."</tr>"."<br>";
						}
					?>
					</table>
				</div>
			</div>
			<div class="col-md-4">
		 		<form name='manageList' id='backtoMainBtn' action='adminmanage.php' method='post'>
					<br><input type="submit" id="backtoMainBtn" class="btn btn-success btn-lg" value="Return to Admin Dashboard"/>
				</form>
			</div>
		</div>
	</body>
</html>