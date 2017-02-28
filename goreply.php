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
			        $query = "SELECT comment_id FROM Comments WHERE member_ID='$currentID'";
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
					
			} 

			if(isset($_POST['eplyBtn'])) {
				$comm = $_POST['comID'];
			}
		?>
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h2>Replying to Comment ID <?php echo $comm ?></h2>
					<form name='comments' id='comments' action='reply.php' method='post'>
						<input type="text" id='addCom' name="addCom" placeholder="Enter comment here" size = '150px' value="Replying to Comment ID <?php echo $comm ?>: "/>
						<input type="text" id='wRate' name="wRate" size = '10px' placeholder='Rate' value=""/>
						<input type='text' class='' name='consumer' id='consumer'  value="<?php echo $_SESSION['id']; ?>"/>
						<input type='text' class='dontshow' name='houseID' id='houseID'  value='<?php echo $_POST['houseC']; ?>' />
						<input type="text" class='dontshow' id='commID' name="commID" value='<?php echo $comm ?>'/>
						<input type="submit" class='btn btn-success btn-lg' name="replyBB" value="Submit"/>
					</form>
					<form name='cancel' id='cancelreply' action='booking.php' method='post'>
						<input type="submit" class="btn btn-success btn-lg" id="cancelBtn" value="Cancel"/>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>