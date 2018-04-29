<!-- Log In Page -->
<img class="profile-img-card" src="google-contacts.png"/>
</br>
<span id="error-message" style="position: relative; left: 15px; bottom: 10px; color: #ed4337;"></span>
<form action="loginCheck.php" method="POST" onsubmit="loginValid(event);">
	<div class="input-group">
		<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
		<input id="email" class= "form-control" type="text" name="email" placeholder="Email" required>
	</div>							
</br>
<div class="input-group">
	<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
	<input id="pwd" class="form-control" type="password" name="pwd" placeholder="Password" required>
</div>
<div class="hide-show">
	<span onclick="changePwdView()"><i id="icon" class="fas fa-eye"></i></span>
</div>
<a href="forgotPassword.php" style="font-size: 11px; float: left; margin-top: 5px;">Forgot Your Password?</a>
</br>
</br>
<button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="submit">Sign in</button>
</form>

</br>
</br>
<p style="font-size: 13px; margin-left: 70px;">Don't have an account?</p>
<a href="signup.php" style="font-size: 14px; margin-left: 114px; text-decoration: underline;">Sign Up</a>