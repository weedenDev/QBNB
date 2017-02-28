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

	<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
		<?php
		  //Create a user session or resume an existing one
		 session_start();
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
							<li><a href='manage.php'>Dashboard</a></li>
							<li><a href='main.php'>Main</a></li>
							<li><a href='search.php'>Search</a></li>
							<li><a href='index.php?logout=1'>Log Out</a></li>
					</ul>
				</div> <!-- End collapse navbar-collapse navbar-menu-collapse -->
			</div> <!-- End container -->
		</nav>

		<div class="container">
			<div class="row">
				<div id="updateProfile" class="col-sm-4 projects-item">
					<a href="listing.php">
						<img src="img/portfolio/book.jpg" class="img-responsive" alt="">
					</a>
				</div> <!-- End column -->
				<div id="updateProfile" class="col-sm-4 projects-item">
					<a href="viewBookings.php">
						<img src="img/portfolio/cancel.jpg" class="img-responsive" alt="">
					</a>
				</div> <!-- End column -->
				<div id="updateProfile" class="col-sm-4 projects-item">
					<a href="listYourHouse.php">
						<img src="img/portfolio/list.jpg" class="img-responsive" alt="">
					</a>
				</div> <!-- End column -->
			</div>
		</div>

		<!-- SCRIPTS -->
		<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/jquery.easing.min.js"></script>
	    <script type="text/javascript" src="js/jqBootstrapValidation.js"></script>
    	<script type="text/javascript" src="js/contact_me.js"></script>
		<script type="text/javascript" src="js/home.js"></script>
	</body>
</html>