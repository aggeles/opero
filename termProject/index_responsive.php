<!DOCTYPE html>
<html>
<head>

<!--For responsive design-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--Google fonts link-->

	<link href='http://fonts.googleapis.com/css?family=Raleway|Dosis|Poiret+One|Jura' rel='stylesheet' type='text/css'>

<!--css stylesheest-->
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="opero_style.css" rel="stylesheet" type="text/css">

	<title>Opero - iWork</title>

</head>
<body bgcolor="#073f40">

<div class="container">
<div class="row">
<div class="col-xs-12">

	<h1 id="heading">Opero</h1>
	<h2 id="tagline">Your source for employment opportunities</h2>

	<p id="instructions">Please enter what you're seeking so we can show you the best jobs available!
	</p>	
</div>
</div>
</div>

<?php
include('login.php'); // Includes Login Script

if(isset($_SESSION['login_user'])){
	?>
	<div class="userForm">
	Hello: <?php echo $_SESSION['login_first_name']; ?>
	<a href="logout.php">Log Out</a></div>
	<?php
}
else {
		?>
		<div class="userForm">
		<form  name="userInfo" method="POST" action="">
		<input id="homePageUserLogin" placeholder=" User Name" name="email" type="text"><br>
		<input id="homePageUserLogin" placeholder=" Password" name="password" type="password"><br>
		<input type="button" id="register" onclick="window.location='signup.php'" value="Register">
		<input id="login" type="submit" name="submit" value="Log In">
		<span><?php echo $error; ?></span>
		</form>
		</div>
		<br>
		<?php
}
?>

<div class="form">
<form name="dataForm" action="temp_search_results.php" method="POST" class="form-horizontal">
<div class="form-group form-group-sm">
<label class="col-sm-2 control-label" for="inputBox">Occupation: </label>
<div class="col-sm-8">
	<p id="input"><input id="inputBox" name="job" type="text" class="form-control"></p>	
</div>
</div>

<div class="form-group form-group-xs">
<label class="col-sm-1 control-label" for="inputBox">City: </label>
<div class="col-sm-5">
	<input id="inputBox" name="city" type="text" size="15em" class="form-control">
</div>	

<!--drop down menu with all states-->
<label class="col-sm-1 control-label" for="sort">State: </label>
<div class="col-sm-5">
	<select id="sort" name="state" class="form-control">
	<option value ="Alabama">Alabama</option>
	<option value="Alaska">Alaska</option>
	<option value="Arizona">Arizona</option>
	<option value="Arkansas">Arkansas</option>
	<option value="California">California</option>
	<option value="Colorado">Colorado</option>
	<option value="Connecticut">Connecticut</option>
	<option value="Delaware">Delaware</option>
	<option value="Florida">Florida</option>
	<option value="Georgia">Georgia</option>
	<option value="Hawaii">Hawaii</option>
	<option value="Idaho">Idaho</option>
	<option value="Illinois">Illinois</option>
	<option value="Indiana">Indiana</option>
	<option value="Iowa">Iowa</option>
	<option value="Kansas">Kansas</option>
	<option value="Kentucky">Kentucky</option>
	<option value="Louisiana">Lousiana</option>
	<option value="Maine">Maine</option>
	<option value="Maryland">Maryland</option>
	<option value="Massachusettes">Massachusettes</option>
	<option value="Michigan">Michigan</option>
	<option value="Minnisota">Minnisota</option>
	<option value="Mississippi">Mississippi</option>
	<option value="Missouri">Missouri</option>
	<option value="Montana">Montana</option>
	<option value="Nebraska">Nebraska</option>
	<option value="Nevada">Nevada</option>
	<option value="New Hampshire">New Hampshire</option>
	<option value="New Jersey">New Jersey</option>
	<option value="New Mexico">New Mexico</option>
	<option value="New York">New York</option>
	<option value="North Carolina">North Carolina</option>
	<option value="North Dakota">North Dakota</option>
	<option value="Ohio">Ohio</option>
	<option value="Oklahoma">Oklahoma</option>
	<option value="Oregon">Oregon</option>
	<option value="Pennsylvania">Pennsylvania</option>
	<option value="Rhode Island">Rhode Island</option>
	<option value="South Carolina">South Carolina</option>
	<option value="South Dakota">South Dakota</option>
	<option value="Tennessee">Tennessee</option>
	<option value="Texas">Texas</option>
	<option value="Utah">Utah</option>
	<option value="Vermont">Vermont</option>
	<option value="Virginia">Virginia</option>
	<option value="Washington">Washington</option>
	<option value="West Virginia">West Virginia</option>
	<option value="Wisconsin">Wisconsin</option>
	<option value="Wyoming">Wyoming</option>
	</select><!--end states-->
	</div>
</div>

<!--zip isn't needed by this api
Zip Code: <input id="inputBox" type="text" height="40px" size="5em" name="zipCode">
-->

<div class="form-group form-group-xs">
<label class="col-sm-2 control-label" for="full">Full Time</label>
<div class="col-sm-4">
	<input type="radio" name="time" value="f" checked class="form-control radio-inline" id="full">
</div>	
<label class="col-sm-2 control-label" for="part">Part Time</label>
<div class="col-sm-4">
	<input type="radio" name="time" value="p" class="form-control radio-inline" id="part">	
</div>
</div>

<div class="form-group form-group-xs">
<label class="col-sm-5 control-label" for="sort">Type of Employment Sought: </label>
<div class="col-sm-6">
	<p id="input"><select id="sort" name="contract" class="form-control"> 
	<option value="p">Permanent</option>
	<option value="c">Contract</option>
	<option value="t">Temporary</option>
	<option value="i">Training</option>
	<option value="v">Voluntary</option>
	</select></p>
</div>	
</div>

<div class="form-group form-group-xs">
<label class="col-sm-4 control-label" for="sort">Sort Results By: </label>
<div class="col-sm-6">
	<p id="input"><select id="sort" name="sortBy" class="form-control">
		<option value="relevance">Relevance</option>
		<option value="date">Most Recent</option>
		<option value="salary">Highest Salary</option>
	</select>
	</p>
</div>	
</div>

<div class="form-group form-group-xs">
<label class="col-sm-6 control-label" for="inputBox">Number of Results (1-100) Per Page: </label>
<div class="col-sm-5">
	<div id="input"><input id="inputBox" type="number" size="10em" name="#OfResults" max=100 min=1 class="form-control">

	</div>
</div>
</div>

<!--</p>-->

<div class="form-group form-group-xs">
<div class="col-sm-12">
	<input id="submit" type="submit" value="Click Here For Results" class="form-control">
</div>
</div>

</form>
</div>

<!--begin footer-->
<div id = "footer">Quasi &copy; 2015 by Brogrammers &trade;   
<div id="motto">Progressio Fraterna</div>
</div><!--end footer-->
 





</body>
</html>
