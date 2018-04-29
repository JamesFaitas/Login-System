<!-- Confirmation page when password is reset -->
<!DOCTYPE html>
<html>
<head>
	<title>Password Reset</title>
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
					<span>Please check your email!<br></span>
					</br>
					<form action="index.php">
						<input class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="backHome" value="Home Page">
					</form>
				</div>
			</div>
		</section>

<?php 
	include_once 'footer.php';
?>