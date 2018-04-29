<?php 

	include_once 'includes/databaseConnection.inc.php';

	$first = mysqli_real_escape_string($conn, $_POST['first']);
	$last = mysqli_real_escape_string($conn, $_POST['last']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
	$confirmPwd = mysqli_real_escape_string($conn, $_POST['confirm-pwd']);

	//error handlers
	//Check for empty fields
	if (empty($first) || empty($last) || empty($email) || empty($pwd) || empty($confirmPwd)) {
		echo "EMPTY";
		return;
	} 
	else {
		//check if input characters are valid
		if (!preg_match("/^[a-zA-z]*$/", $first) || !preg_match("/^[a-zA-z]*$/", $last) ) {
			echo "INVALID_NAME";
			return;
		}
		else {
			//Check if email is valid
			if (!preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/' , $email)) {
				echo "INVALID_EMAIL";
				return;
			}
			else {
				$sql = "SELECT * FROM accounts WHERE user_email='$email'";
				$result = mysqli_query($conn, $sql);
				$resultCheck = mysqli_num_rows($result);
				//check if email is available
				if ($resultCheck > 0) {
					echo "EMAIL_TAKEN";
					return;
				}
				else {
					//checks if the password fields match
					if($pwd != $confirmPwd){
						echo "PASS_NO_MATCH";
						return;
					}
					else{
						//check if password format is valid
						if(!preg_match("/^(?=.*[a-zA-Z])(?=.*[0-9])\w{8,}$/", $pwd) && !preg_match("/^(?=.*[a-zA-Z])(?=.*[0-9])\w{8,}$/", $confirmPwd)){
							echo "INVALID_PASS";
							return;
						}
						else{
						//Hashing the password
						$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
						//Insert the user into the database
						$sql = "INSERT INTO accounts (user_first, user_last, user_email, user_pwd, user_token) VALUES ('$first', '$last', '$email', '$hashedPwd', null);";
						mysqli_query($conn, $sql);

						echo "OK";
						return;
						}
					}
				}
			}
		}
	}
?>
