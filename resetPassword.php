<!DOCTYPE html>
<html>
<head>
	<title>Reset Password</title>
	<!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
	<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
	<link rel="stylesheet" type="text/css" href="new.css">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Javascript -->
	<script src="main.js"></script>
	<!-- JQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>
<body>
	<section class="main-container">
		<div class="main-wrapper">
			<div class="card card-container">
			<?php  
				if(isset($_GET['email']) && isset($_GET['token'])){
					include "includes/databaseConnection.inc.php";

					$email = mysqli_real_escape_string($conn, $_GET['email']);
					$token = mysqli_real_escape_string($conn, $_GET['token']); 

					//check if email exists in db
					$sql = "SELECT * FROM accounts WHERE user_email='$email' AND user_token ='$token'";
					$result = mysqli_query($conn, $sql);
					$resultCheck = mysqli_num_rows($result);

					if($resultCheck < 1) {
						header("Location: ../loginsystem/index.php?login=error1");
						exit();
					}
					else {
						$randomPwd = "1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";
						$randomPwd = str_shuffle($randomPwd);
						$randomPwd = substr($randomPwd, 0,8); //password set to the minimum 8 character length
						//if the password generated doesn't adhere to the password specifications then generate a new one
						while(!preg_match("/^(?=.*[a-zA-Z])(?=.*[0-9])\w{8,}$/", $randomPwd)){
							$randomPwd = "1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";
							$randomPwd = str_shuffle($randomPwd);
							$randomPwd = substr($randomPwd, 0,8); //password set to the minimum 8 character length
						}
						
						//Hashing the password
						$hashedPwd = password_hash($randomPwd, PASSWORD_DEFAULT);
						//update the database with the new password
						$sql = "UPDATE accounts SET user_pwd ='$hashedPwd', user_token = '' WHERE user_email='$email'";
						mysqli_query($conn, $sql);
						//show password to user
						echo "Your new password is: $randomPwd";
						echo "<br></br>";
					}
				}
				else {
					header("Location: index.php");
					exit();
				}
			?>
	<form action="index.php">
		<input class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="backHome" value="Home Page">
	</form>
</div>
</div>
</section>

<?php 
	include_once 'footer.php';
?>