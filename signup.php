<?php
	session_start();

	if (isset($_SESSION['u_id'])) {
		header("Location: index.php"); 
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Create Account</title>
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
	
				<h2>Create an Account</h2>
				<form id="signup-form" class="signup-form" action="signupCheck.php" method="POST" onsubmit="signupValid(event);">
					<input id="first" onkeyup="checkName('first');removeOutline('first');" onfocusout="capitalizeFirstLetter('first');" class="form-control" type="text" name="first" placeholder="First name" required>
					</br>
					<input id="last" onkeyup="checkName('last');removeOutline('last');" onfocusout="capitalizeFirstLetter('last');" class="form-control" type="text" name="last" placeholder="Last name" required>
					</br>
					<input id="email" onfocusout="checkEmail();removeOutline('email');" onblur="emailExist();" class="form-control" type="text" name="email" placeholder="E-mail" required>
					</br>
					<input id="pwd" class="form-control" type="password" name="pwd" onkeyup="remove();" placeholder="Password" required>
					</br>
					<input id="confirm-pwd" class="form-control" type="password" name="confirm-pwd" onkeyup="check();" placeholder="Confirm your password" required>
					</br>
					<span id="check-message" style="position: relative; left: 245px; bottom: 45px;"></span>
					<span id="error-message" style="position: relative; left: 95px; bottom: 10px; color: #ed4337; text-shadow: 0.4px 0.6px 0.5px black;"></span>
					<span id="status" style="position: relative; left: 65px; bottom: 0px; color: red;"></span>
					</br>
					<button id="submit" class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="submit">Submit</button>
				</form>
				</br>
				<a class="back" href="index.php"><i class="fas fa-long-arrow-alt-left"></i>	Go back</a>
			</div>
		</div>
	</section>

<?php 
	include_once 'footer.php';
?>