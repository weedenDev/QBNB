<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<!--[if IE]> <meta http-equiv="X-UA-Compatible" content="IE=edge"> <![endif]-->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="Raymond Chung">
		<title>Sign Up</title>

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
		<div class="container">
			<div class="col-md-6 col-lg-12">
				<!-- dynamic content will be here -->
				<h1 class="typingText text-center">Make an account!</h1>
				<form name='register' class="text-center" id='register' action='insert.php' method='post'>
					<label>First Name:</label>
					<input type='text' name='fname' id='fname'/><br>	
					<label>Last Name:</label>
					<input type='text' name='lname' id='lname'/><br>
					<label>Email:</label>
					<input type='text' name='email' id='email'/><br>
					<label>Password:</label>
					<input type='password' name='password' id='password'/><br>
					<label>Phone Number:</label>
					<input type='text' name='pnum' id='pnum'/><br>
					<label>Year:</label>
					<input type='text' name='year' id='year'/><br>
					<label>Faculty:</label>
					<input type='text' name='faculty' id='faculty'/><br>

				    <input type='submit' class="btn btn-success btn-lg" id='registerBtn' name='Register' value='Register'/> 
				</form>
			</div>
		</div>
	</body>
</html>