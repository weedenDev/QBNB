<!DOCTYPE html>
<html>
<?php
	 if(isset($_POST['Register'])) {
		include_once 'config/connection.php';

		$mail = $_POST['email'];
		$pass = $_POST['password'];
		$first = $_POST['fname'];
		$last = $_POST['lname'];
		$phone = $_POST['pnum'];
		$years = $_POST['year'];
		$fac = $_POST['faculty'];

		$query = "INSERT INTO QBnB_Service_Member (fName, lName, email, phone_number, year, faculty, type) VALUES ('$first', '$last', '$mail', '$phone', '$years', '$fac', '0')";

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
	 if(isset($_POST['Register'])) {
		include_once 'config/connection.php';

		$mail = $_POST['email'];
		$pass = $_POST['password'];

		$query = "INSERT INTO login (email, password) VALUES ('$mail', '$pass')";

		$stmt = $con->prepare($query);

	// Execute the query
        if($stmt->execute()){
            echo "Registration completed!2 <br/>";
        }else{
            echo 'Unable to register. Please try again. <br/>';
        }
    }
?>

		<?php
	 		if(isset($_POST['Register'])) {
			   // include database connection
			    include_once 'config/connection.php'; 
				
				// SELECT query
			        $getID = "SELECT member_ID FROM QBnB_Service_Member WHERE email='$mail' limit 1";
			        // prepare query for execution
			        $stmt = $con->prepare($getID);
			        // bind the parameters. This is the best way to prevent SQL injection hacks.
			        //$stmt->bind_Param("s", $_SESSION['id']);
			        // Execute the quer;y
					$stmt->execute();
					// results 
					$result = $stmt->get_result();
					// Row data
					$theMID = $result->fetch_assoc();

					// Execute the query
		        if($stmt->execute()){
		            echo "Registration completed!3 <br/>";
		        }else{
		            echo 'Unable to register. Please try again. <br/>';
		        }		
			}
		?>

<script type="text/javascript">   
	function GoToMain() {  
		window.location="login.php"; 
	} 
	document.write("You will be redirected to the main page in 5 seconds"); 
	setTimeout('GoToMain()', 5000);   
</script>
</html>