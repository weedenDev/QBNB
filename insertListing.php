<!DOCTYPE html>
<html>
<?php
	 if(isset($_POST['listBtn'])) {
		include_once 'config/connection.php';

		$supplierI = $_POST['tOwner'];
		$addressI = $_POST['tAddress'];
		$cityI = $_POST['tCity'];
		$postalI = $_POST['tPostal'];
		$typeI = $_POST['tType'];
		$featuresI = $_POST['tFeatures'];
		$priceI = $_POST['tPrice'];

		$query = "INSERT INTO Rental_Properties (suppliers, address, city, postal_code, type, features, price, available) VALUES ('$supplierI', '$addressI', '$cityI', '$postalI', '$typeI', '$featuresI', '$priceI', 'Yes')";

		$stmt = $con->prepare($query);

	// Execute the query
        if($stmt->execute()){
            echo "Registration completed! <br/>";
        }else{
            echo 'Unable to register. Please try again. <br/>';
        }
    }
?>

<?php
	 if(isset($_POST['listBtn'])) {
		include_once 'config/connection.php';
		//$housee = $myrow['house_ID'];
		$query2 = "UPDATE QBnB_Service_Member SET house_ID = '43434582' WHERE member_ID = '$supplierI'";

		$stmt = $con->prepare($query2);

	// Execute the query
        if($stmt->execute()){
            echo "Registration completed! x3<br/>";
        }else{
            echo 'Unable to register. Please try again. <br/>';
        }
    }
?>

<?php
	 if(isset($_POST['listBtn'])) {
		include_once 'config/connection.php';

		$POI = $_POST['tPOI'];
		echo $POI;
		$dName = $_POST['tDistrict'];
		echo $dName;

		$query = "SELECT house_ID FROM Rental_Properties WHERE suppliers = '$supplierI' AND address = '$addressI'";

		$stmt = $con->prepare($query);
		$stmt->execute();
	 
			// results 
			$result = $stmt->get_result();
			
			// Row data
			$myrow = $result->fetch_assoc();
			$better = $myrow['house_ID'];
	// Execute the query
        if($stmt->execute()){
            echo "Registration completed!x2 <br/>";
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