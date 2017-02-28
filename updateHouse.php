<!DOCTYPE html>
<html>
<?php
	 if(isset($_POST['modifyBtn'])) {
		include_once 'config/connection.php';

		$currentID = $_POST['houseID'];
		$addressI = $_POST['address'];
		$cityI = $_POST['city'];
		$postalI = $_POST['postal_code'];
		$typeI = $_POST['type'];
		$featuresI = $_POST['features'];
		$priceI = $_POST['price'];

		$query = "UPDATE Rental_Properties SET address='$addressI', city='$cityI', postal_code='$postalI', type='$typeI', features='$featuresI', price='$priceI' WHERE house_ID='$currentID'";
		$stmt = $con->prepare($query);

	// Execute the query
        if($stmt->execute()){
            echo "Registration completed!<br/>";
        }else{
            echo 'Unable to register. Please try again. <br/>';
        }
    }
?>

<script type="text/javascript">   
	function GoToMain() {  
		window.location="main.php"; 
	} 
	document.write("You will be redirected to the main page in 2 seconds"); 
	setTimeout('GoToMain()', 2000);   
</script>
</html>