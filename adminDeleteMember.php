<!DOCTYPE HTML>
<html>	
 <?php
	  //Create a user session or resume an existing one
	 session_start();
	 ?> 
	 <?php
	 $current = $_POST['memID'];
	 if(isset($_POST['adeleteBtn'])){
	  // include database connection
	    include_once 'config/connection.php'; 
		
		$query = "DELETE FROM qbnb_service_member WHERE member_ID = '$current'";
	  	//$current = $_SESSION['id'];
		$stmt = $con->prepare($query);
		// Execute the query
	    if($stmt->execute()){
	        echo "Account was deleted<br/>";
	    }else{
	        echo $current.'Please try again. <br/>';
	    }
	 }
	 ?>

	<?php
		 if(isset($_POST['adeleteBtn'])) {
			include_once 'config/connection.php';

			$test = "DELETE FROM Rental_Properties WHERE suppliers = '$current'";

			$stmt = $con->prepare($test);

		// Execute the query
	        if($stmt->execute()){
	            echo "House(s) has been deleted! <br/>";
	        }else{
	            echo 'Unable to delete house. Please try again. <br/>';
	        }
	    }
	?>

	 <?php
	 if(isset($_POST['adeleteBtn'])){
	  // include database connection
	    include_once 'config/connection.php'; 
		
		$query = "DELETE FROM login WHERE member_ID = '$current'";
	  	//$current = $_SESSION['id'];
		$stmt = $con->prepare($query);
		// Execute the query
	    if($stmt->execute()){
	        echo "Account was deleted x2<br/>";
	    }else{
	        echo $current.'Please try again. <br/>';
	    }
	 }
	 
	 ?>

	 <script type="text/javascript">   
	function GoToMain() {  
		window.location="adminChangeM.php"; 
	} 
	document.write("You will be redirected to the main page in 2 seconds"); 
	setTimeout('GoToMain()', 2000);   
</script>
</html>