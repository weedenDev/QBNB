<!DOCTYPE html>
<html>
	 <?php
			 if(isset($_POST['confirmBtn'])) {
				include_once 'config/connection.php';
				$houseZ = $_POST['housezI'];
				$newStatus = $_POST['confirmText'];
				$currentID = $_POST['currentI'];
				$query = "UPDATE Bookings SET status='$newStatus' WHERE owner_ID='$currentID' AND house_ID = '$houseZ'";
				$stmt = $con->prepare($query);

			// Execute the query
		        if($stmt->execute()){
		            echo "Updating Status!<br/>";
		        }else{
		            echo 'Unable to update status. Please try again. <br/>';
		        }
		    }
		?>

	 <?php
	 	if ($newStatus == 'Confirmed' or $newStatus == 'Confirm') {
			 if(isset($_POST['confirmBtn'])) {
				include_once 'config/connection.php';

				$query = "UPDATE Rental_Properties SET available='No' WHERE suppliers ='$currentID' AND house_ID = '$houseZ'";
				$stmt = $con->prepare($query);

			// Execute the query
		        if($stmt->execute()){
		            echo "Updating Status!x2<br/>";
		        }else{
		            echo 'Unable to update status. Please try again. <br/>';
		        }
		    }
		}
	?>
<script type="text/javascript">   
	function GoToMain() {  
		window.location="statusBookings.php"; 
	} 
	document.write("You will be redirected to the main page in 2 seconds"); 
	setTimeout('GoToMain()', 2000);   
</script>
</html>