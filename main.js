//status of switch initialised as false
let loginPwdStatus = false;
/*
	Shows and hides the password 
*/
function changePwdView() {
	let getLoginInput = document.getElementById("pwd"); //gets the password input
	let getIcon = document.getElementById("icon"); // gets the icon 

	// if switch not "on" then
	if (loginPwdStatus === false) { 
		getLoginInput.setAttribute("type" , "text"); // change the value of the type attribute to text
		getIcon.setAttribute("class" , "fas fa-eye-slash"); //change the value of the class attribute
		loginPwdStatus = true; //set status as true
	}
	// when the switch is pressed again, reverse the action
	else{
		getLoginInput.setAttribute("type" , "password");
		getIcon.setAttribute("class" , "fas fa-eye");
		loginPwdStatus = false; //set status back to false
	}
}
/* 
	Checks the if password field and confirm password field match.
*/
function check() {
		var password = document.getElementById('pwd').value; //password
		var confirm = document.getElementById('confirm-pwd').value; //confirmation password
		var regex = /^(?=.*[a-zA-Z])(?=.*[0-9])\w{8,}$/;

		//document.getElementById('status').innerHTML = "";

		if(!regex.test(password)){
			document.getElementById('pwd').style.outline = "1 solid red"; //make outline colour red
          	document.getElementById('pwd').style.boxShadow = '0 0 3px red';
		}
		else {
			document.getElementById('pwd').style.outline = "1 solid green"; 
          	document.getElementById('pwd').style.boxShadow = '0 0 3px green';
		}

		//if the passwords match
      	if (password === confirm) { 
          document.getElementById('check-message').style.color = 'green'; //make icon green
          document.getElementById('confirm-pwd').style.outline = "1 solid green"; //make outline green
          document.getElementById('confirm-pwd').style.boxShadow = '0 0 3px green';
          document.getElementById('check-message').innerHTML = '<i class="fas fa-check"></i>';
      	} 
      	//if the passwords don't match
      	else {
      		document.getElementById('check-message').style.color = 'red'; //make icon red
      		document.getElementById('confirm-pwd').style.outline = "1 solid red"; //make outline colour red
          	document.getElementById('confirm-pwd').style.boxShadow = '0 0 3px red';
          	document.getElementById('check-message').innerHTML = '<i class="fas fa-times"></i>';
      	}
}

/* 
	Removes the password message when the password field is empty
*/
function remove() {
 	var password = document.getElementById('pwd').value;
 
 	// if password is empty
 	if (password === "") {
 		document.getElementById('check-message').innerHTML = "";
 		document.getElementById('confirm-pwd').style.outline = "1 solid white";
        document.getElementById('confirm-pwd').style.boxShadow = '0 0 3px white';
        document.getElementById('pwd').style.outline = "1 solid white"; 
        document.getElementById('pwd').style.boxShadow = '0 0 3px white';
 	}
 }

/* 
	Checks if the first and last name contain any invalid characters or numbers
	and if so,  displays an error message to the user.
*/
function checkName(id) {
 	var special_chars = /[ !@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/; //special characters regex
 	var numbers = /\d/; //numbers regex

 	document.getElementById('status').innerHTML = "";

 	//gets the first or last name
 	var name = document.getElementById(id).value;

 	//if the name contains any invalid characters
 	if (special_chars.test(name) || numbers.test(name)) {
 		document.getElementById('error-message').innerHTML = "Invalid input"; //displays error message
 		document.getElementById(id).style.outline = "1 solid red"; //make outline colour red
        document.getElementById(id).style.boxShadow = '0 0 3px red';
 	}
 	//if it doesn't
 	else {
 		document.getElementById('error-message').innerHTML = ""; //clear error message
 		document.getElementById(id).style.outline = "1 solid green"; //make outline colour green
        document.getElementById(id).style.boxShadow = '0 0 3px green';
 	}
}

/* 
	Removes the outline of the input if it's empty
*/
function removeOutline(id) {
	var input = document.getElementById(id).value;
	if (input === "") {
		document.getElementById('error-message').innerHTML = ""; //clear error message
 		document.getElementById(id).style.outline = "1 solid white"; //make outline color white
        document.getElementById(id).style.boxShadow = '0 0 3px white';
 	}
}

/* 
	Email validation
	If invalid an appropriate error message is displayed
*/
function checkEmail(){
	// regex is taken from Chromioum
	var regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	var email = document.getElementById('email').value;

	document.getElementById('status').innerHTML = "";
	//if the email doesn't match the standard regex 
	if (!regex.test(email)) {
		document.getElementById('error-message').innerHTML = "Invalid input";
 		document.getElementById('email').style.outline = "1 solid red"; //make outline colour red
        document.getElementById('email').style.boxShadow = '0 0 3px red';
	}
	//otherwise
	else {
		document.getElementById('error-message').innerHTML = ""; //clear error message
 		document.getElementById('email').style.outline = "1 solid green"; //make outline colour green
        document.getElementById('email').style.boxShadow = '0 0 3px green';
	}
}
/* 
	Capitlize first letter of first and last name
	used with onfocusout, so the function is called once the input is provided by the user
*/
function capitalizeFirstLetter(name) {
   var input = document.getElementById(name);
   input.value = input.value.charAt(0).toUpperCase() + input.value.slice(1);
}

/*
	AJAX function to check if email exists in database for when the user attempts to sign up
*/
function emailExist(){

	//create XMLHttpRequest object
	var xhttp = new XMLHttpRequest();
	var email = document.getElementById('email').value;
	var parameter = "email="+email;
	xhttp.open("POST", "checkEmail.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	var regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

	if(email === ""){
		document.getElementById('status').innerHTML = "";
	}

	xhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			var response = this.responseText;
			if(response === "OK_EMAIL"){
				if(!regex.test(email)){
					document.getElementById('error-message').innerHTML = "Invalid input";
 					document.getElementById('email').style.outline = "1 solid red"; //make outline colour red
       				 document.getElementById('email').style.boxShadow = '0 0 3px red';
				}
				else {
				document.getElementById('error-message').innerHTML = ""; //clear error message
				document.getElementById('status').innerHTML = "Email available!";
				document.getElementById('status').style = "position: relative; left: 65px; bottom: 10px; color: green;";
				}
			}
			else if(response === "EMAIL_TAKEN") {
				document.getElementById('status').innerHTML = "Email taken. Please log in.";
				document.getElementById('status').style = "position: relative; left: 45px; bottom: 10px; color: red;";
			}
		}
	}
	xhttp.send(parameter); //execute the request
}
/*
	AJAX function for the sign uo page
*/
function signupValid(e){
	e.preventDefault();

	//create XMLHttpRequest object
	var xhttp = new XMLHttpRequest();
	var email = document.getElementById('email').value;
	var f_name = document.getElementById('first').value;
	var l_name = document.getElementById('last').value;
	var pwd = document.getElementById('pwd').value;
	var confirm_pwd = document.getElementById('confirm-pwd').value;
	
	var parameter = "first="+f_name+"&last="+l_name+"&email="+email+"&pwd="+pwd+"&confirm-pwd="+confirm_pwd;

	xhttp.open("POST", "signupCheck.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	xhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			var response = this.responseText;
			if(response === "OK"){
				document.getElementById("signup-form").reset();
				document.getElementById('status').innerHTML = "Account created!";
				document.getElementById('status').style = "position: relative; left: 65px; bottom: 10px; color: green;";
				window.setTimeout(function(){
       			 window.location.href = "index.php";}, 3000); //after 3 seconds since a new account is created,get automatically redirected to the log in page
			}
			else if(response === "EMPTY"){
				document.getElementById('status').innerHTML = "Form not filled";
				document.getElementById('status').style = "position: relative; left: 45px; bottom: 10px; color: red;";
			}
			else if(response === "INVALID_NAME"){
				document.getElementById('status').innerHTML = "Invalid name format";
				document.getElementById('status').style = "position: relative; left: 45px; bottom: 10px; color: red;";
			}
			else if(response === "INVALID_EMAIL") {
				document.getElementById('status').innerHTML = "Invalid email format";
				document.getElementById('status').style = "position: relative; left: 45px; bottom: 10px; color: red;";
			}
			else if(response === "PASS_NO_MATCH"){
				document.getElementById('status').innerHTML = "Passwords don't match";
				document.getElementById('status').style = "position: relative; left: 45px; bottom: 10px; color: red;";
			}
			else if(response === "INVALID_PASS"){
				document.getElementById('status').innerHTML = "Invalid password format";
				document.getElementById('status').style = "position: relative; left: 45px; bottom: 10px; color: red;";
			}
		}
	}
	xhttp.send(parameter); //execute the request
}
/*
	AJAX function for the log in page
*/
function loginValid(e){
	e.preventDefault();

	//create XMLHttpRequest object
	var xhttp = new XMLHttpRequest();
	var email = document.getElementById('email').value;
	var pwd = document.getElementById('pwd').value;
	
	var parameter = "&email="+email+"&pwd="+pwd;

	xhttp.open("POST", "loginCheck.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	xhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			var response = this.responseText;
			if(response === "OK"){
				location.reload();
			}
			 if(response === "EMPTY"){
				document.getElementById('error-message').innerHTML = "Form not filled";
			}
			else if(response === "EMAIL_INVALID") {
				document.getElementById('error-message').innerHTML = "Invalid email format";
			}
			else if(response === "EMAIL_NOT_FOUND" || response === "INCORRECT_PASSWORD"){
				document.getElementById('error-message').innerHTML = "Email/Password combination is wrong";
			}
			else if(response === "PASSWORD_INVALID"){
				document.getElementById('error-message').innerHTML = "Invalid password format";
			}
		}
	}
	xhttp.send(parameter); //execute the request
}
/*
	AJAX function for the change password page
*/
function changeValid(e){
	e.preventDefault();

	//create XMLHttpRequest object
	var xhttp = new XMLHttpRequest();
	var pwd = document.getElementById('pwd').value;
	var confirm_pwd = document.getElementById('confirm-pwd').value;
	var old_pwd = document.getElementById('oldPwd').value;
	
	var parameter = "pwd="+pwd+"&confirm-pwd="+confirm_pwd+"&oldPwd="+old_pwd;

	xhttp.open("POST", "changePwdCheck.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	xhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			var response = this.responseText;
			if(response === "OK"){
				document.getElementById("change-form").reset();
				document.getElementById('error-message').innerHTML = "Password changed successfully!";
				document.getElementById('error-message').style = "position: relative; left: 15px; bottom: 10px; color: green;";
				window.setTimeout(function(){
       			 window.location.href = "index.php";}, 3000);
			}
			 if(response === "EMPTY"){
			 	document.getElementById("change-form").reset();
				document.getElementById('error-message').innerHTML = "Form not filled";
				document.getElementById('error-message').style = "position: relative; left: 15px; bottom: 10px; color: red;";
			}
			else if(response === "PASSWORDS_NO_MATCH"){
				document.getElementById("change-form").reset();
				document.getElementById('status').innerHTML = "Passwords don't match";
				document.getElementById('error-message').style = "position: relative; left: 15px; bottom: 10px; color: red;";
			}
			else if(response === "PASSWORD_INVALID"){
				document.getElementById("change-form").reset();
				document.getElementById('error-message').innerHTML = "Invalid password format";
				document.getElementById('error-message').style = "position: relative; left: 15px; bottom: 10px; color: red;";
			}
			else if(response === "SAME_PASSWORD"){
				document.getElementById("change-form").reset();
				document.getElementById('error-message').innerHTML = "Password already in use";
				document.getElementById('error-message').style = "position: relative; left: 15px; bottom: 10px; color: red;";
			}
			else if(response === "OLD_PASSWORD_NOT_MATCH"){
				document.getElementById("change-form").reset();
				document.getElementById('error-message').innerHTML = "Old password is incorrect";
				document.getElementById('error-message').style = "position: relative; left: 15px; bottom: 10px; color: red;";
			}
		}
	}
	xhttp.send(parameter); //execute the request
}
/*
	AJAX function for the forgot password page
*/
function forgotPassword(e){
	e.preventDefault();
	//create XMLHttpRequest object
	var xhttp = new XMLHttpRequest();
	var email = document.getElementById('email').value;
	var parameter = "email="+email;
	xhttp.open("POST", "forgotPasswordCheck.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	if(email === ""){
		document.getElementById('error-message').innerHTML = "";
	}

	xhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			var response = this.responseText;
			console.log(response);
			if(response === "OK"){
				window.location.href = 'resetConfirmation.php';
			}
			 if(response === "EMPTY"){
				document.getElementById('error-message').innerHTML = "Form not filled";
			}
			else if(response === "EMAIL_INVALID") {
				document.getElementById('error-message').innerHTML = "Invalid email format";
			}
			else if(response === "EMAIL_NOT_EXIST"){
				document.getElementById('error-message').innerHTML = "Email doesn't exist";
			}
		}
	}
	xhttp.send(parameter); //execute the request
}