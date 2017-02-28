<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<!--[if IE]> <meta http-equiv="X-UA-Compatible" content="IE=edge"> <![endif]-->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="Raymond Chung">
		<title>Login</title>

		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="css/animate.min.css">
		<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="css/signup1.css">

		<!-- Favicon -->
		<link rel="shortcut icon" href="img/favicon.png">
		<!-- For Chrome for Android -->
	</head>

	<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
		 <?php
		  //Create a user session or resume an existing one
		 session_start();
		?>

		 <?php
		 //check if the user clicked the logout link and set the logout GET parameter
		if(isset($_GET['logout'])){
			//Destroy the user's session.
			$_SESSION['id']=null;
			session_unset();
		}
		?>
		 
		 <?php
		 //check if the user is already logged in and has an active session
		if(isset($_SESSION['id'])){
			//Redirect the browser to the profile editing page and kill this page.
			header("Location: main.php");
			exit();
			//die();
		}
		 ?>
		 
		 <?php
		//check if the login form has been submitted
		if(isset($_POST['loginBtn'])){
		 
		    // include database connection
		    include_once 'config/connection.php'; 
			
			// SELECT query
		        //$query = "SELECT id,username, password, email FROM user WHERE username=? AND password=?";
		    	$query = "SELECT member_id, password, type, email FROM (login NATURAL JOIN QBnB_Service_Member) WHERE email=? AND password=?";
		        // prepare query for execution
		        if($stmt = $con->prepare($query)){
				
		        // bind the parameters. This is the best way to prevent SQL injection hacks.
		        $stmt->bind_Param("ss", $_POST['email'], $_POST['password']);


		         
		        // Execute the query
				$stmt->execute();
		 
				/* resultset */
				$result = $stmt->get_result();

				// Get the number of rows returned
				$num = $result->num_rows;;
				
				if($num>0){
					//If the username/password matches a user in our database
					//Read the user details
					$myrow = $result->fetch_assoc();
					//Create a session variable that holds the user's id
					$_SESSION['id'] = $myrow['member_id'];
					//Redirect the browser to the profile editing page and kill this page.
					// echo $_SESSION['id'];
					header("Location: main.php");
					die();
				} else {
					//If the username/password doesn't matche a user in our database
					// Display an error message and the login form
					echo "Failed to login";
				}
				} else {
					echo "failed to prepare the SQL";
				}
		 }
		 
		?>
		<div class="container">
			<div class="col-md-6 col-lg-12">
				<!-- dynamic content will be here -->
				<h1 class="typingText text-center">Login!</h1>
				<form name='login' class="text-center" id='login' action='' method='post'>
					<label>Email:</label>
					<input type='text' name='email' id='email'/><br>
					<label>Password:</label>
					<input type='password' name='password' id='password'/><br>
				    <input type='submit' class="btn btn-success btn-lg" id='loginBtn' name='loginBtn' value='Log In'/> 
				</form>
			</div>
		</div>
	</body>
</html>