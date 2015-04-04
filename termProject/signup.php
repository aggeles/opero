<!DOCTYPE html>
<html>
<head>

<!--Google fonts link-->

	<link href='http://fonts.googleapis.com/css?family=Raleway|Dosis|Poiret+One|Jura' rel='stylesheet' type='text/css'>

<!--css stylesheet-->
	<link href="opero_style.css" rel="stylesheet" type="text/css">

	<title>Opero - iWork</title>

</head>

<body bgcolor="#073f40">

<!--if header is desired, use header.php-->

<!--<?php include 'header.php';?>-->

<h1 id="heading">Opero</h1>
<h2 id="tagline">Your source for employment opportunities</h2>

<!--javascript file called "functions.js" is default for all js-->
<script src="functions.js" type="text/javascript"></script>



<!--TODO: write registration page for new members-->
<!--include php file that processes data from form called "userForm"-->
<!--and has method called "run_registration" that is the default call--> 
<p id="instructions">Please fill out this information to create your profile
</p>

<div class="signupForm">
<form name="signupForm" action="signup-submit.php" method="post" enctype="multipart/form-data">

<center><input id="idFormInput" placeholder="First Name" name="first_name" type="text" size="20em" required></center>
<center><input id="idFormInput" placeholder="Last Name" name="last_name" type="text" size="20em" required></center>
<center><input id="idFormInput" placeholder="Email Address" name="email" type="text" size="20em" required></center>
<center><input id="idFormInput" placeholder="Password"  name="password" type="password" size="20em" required></center>
<center><input id="idFormInput" placeholder="Retype Password"  name="password" type="password" size="20em" required></center>

<!--TODO verify passwords match and that email address is valid-->



</div>
</br>
<center><input id="submit" type="submit" value="Register" name="submit"></center>

</form>



</div>

<!--begin footer-->
<div id = "footer">Quasi &copy; 2015 by Brogrammers &trade;   
<div id="motto">Progressio Fraterna</div>
</div><!--end footer-->
 





</body>
</html>
