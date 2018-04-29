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
	<title>Forgot Password</title>
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
				<h4>Reset Your Password</h4>
	<!-- Forgot your password facility -->	
	<form action="forgotPasswordCheck.php" method="post" onsubmit="forgotPassword(event);">
		<input id="email" class= "form-control" type="text" name="email" placeholder="Email"><br>
		<span id="error-message" style="position: relative; left: 15px; bottom: 10px; color: #ed4337;"></span>
		<input class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="forgotPwd" value="Reset Password">
	</form>
</br>
<a href="index.php"><i class="fas fa-long-arrow-alt-left"></i>	Go back</a>
</div>
</div>
</section>

<?php 
include_once 'footer.php';
?>