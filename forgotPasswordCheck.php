<?php  
//connect to the database
include 'includes/databaseConnection.inc.php';

$email = mysqli_real_escape_string($conn, $_POST['email']); 

//Error handlers
//Check if inputs are empty
if (empty($email)) {
	echo "EMPTY";
	return;
}
else{
	//Check if email is valid
	if (!preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/' , $email)){
		echo "EMAIL_INVALID";
		return;
	}
	else {
		//check if email exists in db
		$sql = "SELECT * FROM accounts WHERE user_email='$email'";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);

		if($resultCheck < 1) {
			echo "EMAIL_NOT_EXIST";
			return;
		}
		else{
			$token = "1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM"; //string containing all valid characters
			$token = str_shuffle($token); //shuffle the characters
			$token = substr($token, 0, 24); //get only the first 24 characters
			$url = "http://lamp0.cs.stir.ac.uk/~dfa/CSCU9W61/resetPassword.php?token=$token&email=$email"; //link to get the new password

			$sql = "UPDATE accounts SET user_token='$token' WHERE user_email='$email'"; //update token field in the db
			mysqli_query($conn, $sql);
			//email the user the new password link				
			mail($email, "Reset Password", "Please follow this link to reset your password: $url \nThank you!" , "From: dif00010@students.stir.ac.uk\r\n");
			echo "OK";
			return;
		}
	}
}
?>