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

<!DOCTYPE html>
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
		<link rel="stylesheet" type="text/css" href="css/home.css">

		<!-- Favicon -->
		<link rel="shortcut icon" href="img/favicon.png">
		<!-- For Chrome for Android -->
	</head>

	<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
		<!-- 1. NAVIGATION BAR -->
		<div class="container">

			<div id="navbar-left">
				<a class="navbar-brand page-scroll" href="#page-top"></a>
			</div>
		</div> <!-- End container -->

		<!-- 2. HOME SECTION -->
		<section id="home">
			<div class="container">
				<div class="col-md-6 col-lg-12">
					<section class="typingText text-center">
						<h1 class="typingText">Welcome to QBnb!</h1>
					</section>
					<div class="text-center">
						<div class="animated fadeInUp">
							<form name='login' id='login' action='login.php' method='post'>
								<input type="submit" id="loginBtn" class="btn btn-success btn-lg" value="Log In"/>
							</form>
							<form name='register' id='register' action='signup.php' method='post'>
								<input type="submit" id="registerBtn" class="btn btn-success btn-lg" value="Sign Up"/>
							</form>
						</div> <!-- end div -->
					</div>
				</div> <!-- End column -->
			</div> <!-- End container -->
		</section>

		<!-- SCRIPTS -->
		<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/jquery.easing.min.js"></script>
	    <script type="text/javascript" src="js/jqBootstrapValidation.js"></script>
    	<script type="text/javascript" src="js/contact_me.js"></script>
		<script type="text/javascript" src="js/home.js"></script>
	</body>
</html>