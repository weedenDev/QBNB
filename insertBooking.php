<!DOCTYPE html>
<html>
<?php
	 if(isset($_POST['bookingBtn'])) {
		include_once 'config/connection.php';

		$ownerID = $_POST['suppliers'];
		$houseID = $_POST['houseID'];
		$duration = $_POST['duration'];
		$consumers = $_POST['consumer'];
		$status = "Not Confirmed";

		$query = "INSERT INTO Bookings (owner_ID, house_ID, consumer, booking_period, status) VALUES ('$ownerID', '$houseID', '$consumers', '$duration', '$status')";

		$stmt = $con->prepare($query);

	// Execute the query
        if($stmt->execute()){
            echo "Registration completed! <br/>";
        }else{
            echo 'Unable to register. Please try again. <br/>';
        }
    }
?>

<script type="text/javascript">   
	function GoToMain() {  
		window.location="listing.php"; 
	} 
	document.write("You will be redirected to the main page in 2 seconds"); 
	setTimeout('GoToMain()', 2000);   
</script>
</html>