<!DOCTYPE html>
<html>
<?php
	 if(isset($_POST['replyBB'])) {
		include_once 'config/connection.php';

		$houseID = $_POST['houseID'];
		$rate = $_POST['wRate'];
		$consumers = $_POST['consumer'];
		$post = $_POST['addCom'];

		$query = "INSERT INTO Comments (member_ID, house_ID, ratings, comment_texts) VALUES ('$consumers', '$houseID', '$rate', '$post')";

		$stmt = $con->prepare($query);

	// Execute the query
        if($stmt->execute()){
            echo "Reply added! <br/>";
        }else{
            echo 'Unable to add reply. Please try again. <br/>';
        }
    }
?>

<?php
	 if(isset($_POST['replyBB'])) {
		include_once 'config/connection.php';
		$commentID = $_POST['commID'];
		$query = "INSERT INTO reply_id (comment_ID) VALUES ('$commentID')";

		$stmt = $con->prepare($query);

	// Execute the query
        if($stmt->execute()){
            echo "Rating has been added! <br/>";
        }else{
            echo 'Unable to add rating. Please try again. <br/>';
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