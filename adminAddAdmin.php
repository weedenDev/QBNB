<!DOCTYPE HTML>
<html>	
 <?php
	  //Create a user session or resume an existing one
	 session_start();
	 ?> 
	 <?php
	 $current = $_POST['memID'];
	 if(isset($_POST['addADBtn'])){
	  // include database connection
	    include_once 'config/connection.php'; 
		
		$query = "UPDATE qbnb_service_member SET type = '1' WHERE member_ID = '$current'";
	  	//$current = $_SESSION['id'];
		$stmt = $con->prepare($query);
		// Execute the query
	    if($stmt->execute()){
	        echo "Account was updated<br/>";
	    }else{
	        echo'Please try again. <br/>';
	    }
	 }
	 
	 ?>

	 <script type="text/javascript">   
	function GoToMain() {  
		window.location="adminADD.php"; 
	} 
	document.write("You will be redirected to the main page in 2 seconds"); 
	setTimeout('GoToMain()', 2000);   
</script>
</html>