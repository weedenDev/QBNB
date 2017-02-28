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
	 $current = $_SESSION['id'];
	 if(isset($_POST['updateBtn']) && isset($_SESSION['id'])){
	  // include database connection
	    include_once 'config/connection.php'; 
		
		$query = "UPDATE QBnB_Service_Member SET email=?,phone_number=?,fName=?,lName=?,year=?,faculty=? WHERE member_ID=?";
	 
		$stmt = $con->prepare($query);	$stmt->bind_param('sssssss', $_POST['email'], $_POST['fName'], $_POST['lName'], $_POST['phone_number'], $_POST['year'], $_POST['faculty'], $_SESSION['id']);
		// Execute the query
	        if($stmt->execute()){
	            echo "Record was updated. <br/>";
	        }else{
	            echo 'Unable to update record. Please try again. <br/>';
	        }
	 }
	 
	 ?>
	 
	 <?php
	if(isset($_SESSION['id'])){
	   // include database connection
	    include_once 'config/connection.php'; 
		
		// SELECT query
	        $query = "SELECT member_ID, email, phone_number, fName, lName, year, faculty FROM QBnB_Service_Member WHERE member_ID=?";
	 
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
						<li><a href="main.php">Main</a></li>
						<li><a href="listing.php">Listings</a></li>
						<li><a href="search.php">Search</a></li>
						<li><a href="index.php?logout=1">Log Out</a></li>
					</ul>
				</div> <!-- End collapse navbar-collapse navbar-menu-collapse -->
			</div> <!-- End container -->
		</nav>

		<div class="container">
			<div id="updateProfile" class="row">
				<div class="col-md-6">
					<!-- dynamic content will be here -->
					<form name='editProfile' id='editProfile' action='profile.php' method='post'>
					    <table border='0'>
							<tr>
					            <td>Email: </td>
					            <td><input type='text' name='email' id='email'  value="<?php echo $myrow['email']; ?>" /></td>
					        </tr>
					        <tr>
					            <td>First Name: </td>
					            <td><input type='text' name='fName' id='fName' value="<?php echo $myrow['fName']; ?>"  /></td>
					        </tr>
					        <tr>
					            <td>Last Name: </td>
					             <td><input type='text' name='lName' id='lName'  value="<?php echo $myrow['lName']; ?>" /></td>
					        </tr>
							<tr>
					            <td>Phone Number:</td>
					            <td><input type='text' name='phone_number' id='phone_number'  value="<?php echo $myrow['phone_number']; ?>" /></td>
					        </tr>
					        <tr>
					            <td>Year:</td>
					            <td><input type='text' name='year' id='year'  value="<?php echo $myrow['year']; ?>" /></td>
					        </tr>
					        <tr>
					            <td>Faculty:</td>
					            <td><input type='text' name='faculty' id='faculty'  value="<?php echo $myrow['faculty']; ?>" /></td>
					        </tr>
					        <tr>
					            <td></td>
					            <td>
					                <input type='submit' name='updateBtn' id='updateBtn' class="match btn btn-success btn-lg" value='Update' /> 
					            </td>
					        </tr>
					    </table>
					</form>
					<form name='deleteaccount' id='delaccYo' action='deleteAcc.php' method='post'>
						<input type="submit" name='deleteAccount' id="deleteAccount" class="btn btn-success btn-lg" value="Delete Account"/>
					</form>
					<form name='cancel' id='cancel' action='manage.php' method='post'>
						<input type="submit" id="cancelBtn" class="btn btn-success btn-lg" value="Cancel"/>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>