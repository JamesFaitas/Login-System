<?php
	include_once 'header.php';
?>	
	<section class="main-container">
		<div class="main-wrapper">
			<div class="card card-container">
	<?php
		//if user is signed in 
		if (isset($_SESSION['u_id'])) {
		echo '
		<h4>Change your password</h4>
		<br>
		<form id="change-form" action="changePwdCheck.php" method="POST" onsubmit="changeValid(event);">
		<input id="oldPwd" class="form-control" type="password" name="pwd" onkeyup="remove();" placeholder="Old password">
		</br>
		<input id="pwd" class="form-control" type="password" name="pwd" onkeyup="remove();" placeholder="New password">
		</br>
		<input id="confirm-pwd" class="form-control" type="password" name="confirm-pwd" onkeyup="check();" placeholder="Confirm your new password">
		</br>
		<span id="check-message" style="position: relative; left: 245px; bottom: 45px;"></span>
		<span id="error-message" style="position: relative; left: 15px; bottom: 10px; color: #ed4337;"></span>
		<button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="submitPwd">Change Password</button>
		</form>
		<br>
		<a href="index.php"><i class="fas fa-long-arrow-alt-left"></i>	Go back</a>';
		
		}
		//if not signed in, redirect to the login page
		else {
			include 'logIn.php';
		}
	?>
</div>
</div>
</section>

<?php 
	include_once 'footer.php';
?>