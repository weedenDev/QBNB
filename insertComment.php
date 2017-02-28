<!DOCTYPE html>
<html>
<?php
	 if(isset($_POST['subCom'])) {
		include_once 'config/connection.php';

		$currentID = $_POST['consumer'];
		$houseID = $_POST['houseID'];
		$rates = $_POST['wRate'];
		$post = $_POST['addCom'];

		$query = "INSERT INTO Comments (member_ID, house_ID, ratings, comment_texts) VALUES ('$currentID', '$houseID', '$rates', '$post')";

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