<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<!--[if IE]> <meta http-equiv="X-UA-Compatible" content="IE=edge"> <![endif]-->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="Raymond Chung">
		<title>Edit Profile</title>

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
	        $query = "SELECT house_ID from Rental_Properties where suppliers='$_SESSION[id]'";
	 
	      
			$stmt = $con->prepare($query);
			// Execute the query
			$stmt->execute();
	 
			// results 
			$result = $stmt->get_result();
			
			// Row data
			//$myrow = $result->fetch_assoc();
			$myrow4 = $result->fetch_assoc();
			
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
	        $query = "SELECT AVG(ratings) as rate FROM Comments where house_ID='$myrow4[house_ID]'";
	 
	      
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
		        $query = "SELECT fName, member_id, email, password, email, type FROM (login NATURAL JOIN QBnB_Service_Member) WHERE member_id=?";
		        // prepare query for execution
		        $stmt = $con->prepare($query);
				
		        // bind the parameters. This is the best way to prevent SQL injection hacks.
		        $stmt->bind_Param("s", $_SESSION['id']);

		        // Execute the query
				$stmt->execute();
		 
				// results 
				$result = $stmt->get_result();
				
				// Row data
				$myrow = $result->fetch_assoc();
				
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
					Welcome  <?php echo $myrow['fName']; ?>!
				</div>
			</div> <!-- End navbar-header page-scroll -->

			<div class="collapse navbar-collapse navbar-menu-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li class="hidden"><a class="page-scroll" href="#page-top"></a></li>
					<?php
						if ($myrow['type'] > 0) {
							echo "
							<li><a href='adminmanage.php'>Admin</a></li>";
						} 
					?>
					<li><a href="main.php">Main</a></li>
					<li><a href="listing.php">Listings</a></li>
					<li><a href="search.php">Search</a></li>
					<li><a href="index.php?logout=1">Log Out</a></li>
				</ul>
			</div> <!-- End collapse navbar-collapse navbar-menu-collapse -->
		</div> <!-- End container -->
	</nav>

	<div class="container">
		<div id='updateProfile' class="row text-center">
			<div class="col-md-4">
		 		<form name='updatePro' id='updateProfileBtn' action='profile.php' method='post'>
		 			<label>Update Your Profile!</label><br>
					<input type="submit" id="updateProfileBtn" class="btn btn-success btn-lg" value="Update Profile"/>
				</form>
			</div>
			<div class="col-md-4">
		 		<form name='manageList' id='urhouseBtn' action='manageListing.php' method='post'>
		 			<label>Manage Your Listings!</label><br>
					<input type="submit" id="urListingBtn" class="btn btn-success btn-lg" value="Modify"/>
				</form>
				<form name='deleteList' id='urhouseBtn' action='viewHouse.php' method='post'>
					<input type="submit" id="urListingBtn" class="btn btn-success btn-lg" value="Delete"/>
				</form>
			</div>
			<div class="col-md-4">
		 		<form name='cancelBook' id='canbookBtn' action='statusBookings.php' method='post'>
		 			<label>Confirm or Reject Bookings!</label><br>
					<input type="submit" id="confirmcanBtn" class="btn btn-success btn-lg" value="Confirm/Reject Bookings"/>
				</form>
			</div>
		</div>
	</div>
	<div class="Container" align="center">

	<p>
		Your House Average Rating: <?php echo $myrow3['rate']; ?>
	</p>

	</div>

	</body>
</html>