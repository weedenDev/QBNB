<!DOCTYPE html>
<html>		
		<?php
			 if(isset($_POST['cAbookBtn'])) {
				include_once 'config/connection.php';

				$house = $_POST['houseBB'];
				$yo = $_POST['conB'];
				$test = "DELETE FROM Bookings WHERE consumer = '$yo'AND house_ID='$house'";

				$stmt = $con->prepare($test);

			// Execute the query
		        if($stmt->execute()){
		            echo "Booking has been cancelled <br/>";
		        }else{
		            echo 'Unable to cancel. Please try again. <br/>';
		        }
		    }
		?>
	<script type="text/javascript">   
		function GoToMain() {  
			window.location="adminChangeB.php"; 
		} 
		document.write("You will be redirected to the main page in 2 seconds"); 
		setTimeout('GoToMain()', 2000);   
	</script>
</html>