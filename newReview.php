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


 	<!-- 1. NAVIGATION BAR -->
	<nav class="navbar navbar-default navbar-fixed-top navbar" role="navigation">
		<div class="container">
			<div class="navbar-header page-scroll">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menu-collapse">
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
							if ($yoyo['type'] > 0) {
								echo "
								<li><a href='adminmanage.php'>Admin</a></li>";
							} 
						?>
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

				<div id="navbar-left">
				Submit a new review
				</div>
			</div> <!-- End navbar-header page-scroll -->

			<div class="collapse navbar-collapse navbar-menu-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li class="hidden"><a class="page-scroll" href="#page-top"></a></li>
					<li><a href="main.php">Main</a></li>
					<li><a href="listing.php">Listings</a></li>
					<li><a href="index.php?logout=1">Log Out</a></li>
				</ul>
			</div> <!-- End collapse navbar-collapse navbar-menu-collapse -->
		</div> <!-- End container -->
	</nav>

<div class="container">
			<div id="updateProfile" class="row">
				<div class="col-lg-12">
					<!-- dynamic content will be here -->
					<form name='submitReviewBtn' id='submitReviewBtn' action='submitReview.php' method='post'>
					    <table border='0'>
							<tr>
					            <td>Review House Address: </td>
					            <td><input type='text' name='tAddress' id='tAddress'/></td>
					        </tr>

					        <tr>
					            <td>Comment Text: </td>
					            <td><input type='text' name='tCommentText' id='tComment' size="90%"/></td>
					        </tr>
					        <tr>
					            <td>Rating: </td>
					            <td><input type='text' name='tRate' id='tRate'/></td>
					        </tr>
					        <tr>
					            <td></td>
					            <td>
					                <input type='submit' class="btn btn-success btn-med" name='submitReviewBtn' id='listBtn' value='Confirm'/> 
					            </td>
					        </tr>
					    </table>
					    <p>


					    </p>
					    
					</form>
					<form name='cancel' id='cancel' action='main.php' method='post'>
						<input type="submit" class="btn btn-success btn-med" id="cancelBtn" value="Cancel"/>
					</form>
				</div>	
			</div>
		</div>

	
	</body>
</html>