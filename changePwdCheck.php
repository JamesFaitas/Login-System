<?php

session_start();
include 'includes/databaseConnection.inc.php';

	$pwd = mysqli_real_escape_string($conn, $_POST['pwd']); //password
	$confirmPwd = mysqli_real_escape_string($conn, $_POST['confirm-pwd']); //cofirm password
	$oldPwd = mysqli_real_escape_string($conn, $_POST['oldPwd']); //old password

	//Error handlers
	//Check if inputs are empty
	if (empty($pwd) || empty($confirmPwd) || empty($oldPwd)) {
		echo "EMPTY";
		return;
	}
	else{
		//check if passwords match
		if($pwd != $confirmPwd){
			echo "PASSWORDS_NOT_MATCH";
			return;
		}
		else{
				$sql = "SELECT * FROM accounts WHERE user_id='".$_SESSION['u_id']."'";
				$result = mysqli_query($conn, $sql);
				if ($row = mysqli_fetch_assoc($result)) { //get all the data from user
					
				//dehashing the password
				$hashedPwdCheck = password_verify($oldPwd, $row['user_pwd']);
				if(!$hashedPwdCheck){
					echo "OLD_PASSWORD_NOT_MATCH";
					return;
				}
				else{
					//check if both password fields meet the format requirements
					if(!preg_match("/^(?=.*[a-zA-Z])(?=.*[0-9])\w{8,}$/", $pwd) && !preg_match("/^(?=.*[a-zA-Z])(?=.*[0-9])\w{8,}$/", $confirmPwd)){
						echo "PASSWORD_INVALID";
						return;
					}
					else{
						$sql1 = "SELECT * FROM accounts WHERE user_id='".$_SESSION['u_id']."'";
						$result1 = mysqli_query($conn, $sql1);
						if ($row1 = mysqli_fetch_assoc($result1)) { //get all the data from user
				
						//dehashing the password
						$hashedPwdCheck = password_verify($pwd, $row1['user_pwd']);
			
						if($hashedPwdCheck){
							echo "SAME_PASSWORD";
							return;
						}
						else{
							//Hashing the password
							$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
							//update the db containing the new password
							$sql = "UPDATE accounts SET user_pwd='$hashedPwd' WHERE user_id='".$_SESSION['u_id']."'";
							mysqli_query($conn, $sql);
							echo "OK";
							return;
						}
						}
					}
				}
				}
		}
	}
?>