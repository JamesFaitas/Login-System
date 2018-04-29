<?php  
//only used to check if email exists in the database or not
if (isset($_POST['email'])) {

	include_once 'includes/databaseConnection.inc.php';

	$email = mysqli_real_escape_string($conn, $_POST['email']);

	$sql = "SELECT * FROM accounts WHERE user_email='$email'";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);

	//if email is taken
	if ($resultCheck > 0) {
		echo "EMAIL_TAKEN";
	}
	else {
		echo "OK_EMAIL";
	}
}
?>