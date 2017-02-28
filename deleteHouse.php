<!DOCTYPE html>
<html>		
		<?php
			 if(isset($_POST['deleteBtn'])) {
				include_once 'config/connection.php';

				$yo = $_POST['houseB'];
				$test = "DELETE FROM Rental_Properties WHERE house_ID = '$yo'";

				$stmt = $con->prepare($test);

			// Execute the query
		        if($stmt->execute()){
		            echo "House ID ".$yo." Deleted House! <br/>";
		        }else{
		            echo 'Unable to delete. Please try again. <br/>';
		        }
		    }
		?>
	<script type="text/javascript">   
		function GoToMain() {  
			window.location="viewHouse.php"; 
		} 
		document.write("You will be redirected to the main page in 2 seconds"); 
		setTimeout('GoToMain()', 2000);   
	</script>
</html>