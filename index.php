<?php 
include_once 'header.php';
?>

<section class="main-container">
	<div class="main-wrapper">
		<div class="card card-container">

			<?php
			//welcome page for when the user is signed in, change password facility is provided
			if (isset($_SESSION['u_id'])) {
				echo "Welcome ".$_SESSION['u_first'];
				echo '</br></br>';
				echo "You are now logged in!";
				echo '</br></br>';
				echo '<form action="includes/logout.inc.php" method="POST">
				<button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="submit">Logout</button>
				</form>';
				echo '</br></br>';
				echo "<h4>Change your password</h4>";
				echo '<form action="changePwd.php" method="POST">
				
				<button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="submitPwd">Change Password</button>
				</form>';
			}
			//otherwise redirect to the log in page
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