<?php

session_start();
	//include the database connection
	include 'includes/databaseConnection.inc.php';

	$email = mysqli_real_escape_string($conn, $_POST['email']); //email
	$pwd = mysqli_real_escape_string($conn, $_POST['pwd']); //password

	//Error handlers
	//Check if inputs are empty
	if (empty($email) || empty($pwd)) {
		echo "EMPTY";
		return;
	}
	else{
		//check if email format is valid
		if (!preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/' , $email)) {
			echo "EMAIL_INVALID";
			return;
		}
		else {
		//check if email exists in db
		$sql = "SELECT * FROM accounts WHERE user_email='$email'";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		//if email doesn't exist
		if($resultCheck < 1) {
			echo "EMAIL_NOT_FOUND";
			return;
		}
		else {
			//check if password format is valid
			if(!preg_match("/^(?=.*[a-zA-Z])(?=.*[0-9])\w{8,}$/", $pwd)){
				echo "PASSWORD_INVALID";
				return;
			}
			else{
				//check if password is correct with the one in db
				if ($row = mysqli_fetch_assoc($result)) { //get all the data from user
					//dehashing the password
					$hashedPwdCheck = password_verify($pwd, $row['user_pwd']);
					if($hashedPwdCheck == false){
						echo "INCORRECT_PASSWORD";
						return;
					}
					elseif ($hashedPwdCheck == true) { //this is done instead of an else, in the case that the variable is returned as a number or code 
						//Log in the user here
						$_SESSION['u_id'] = $row['user_id'];
						$_SESSION['u_first'] = $row['user_first'];
						$_SESSION['u_last'] = $row['user_last'];
						$_SESSION['u_email'] = $row['user_email'];

						echo "OK";
						exit;
					} 
				}
			}
		}
		}
	}
?>