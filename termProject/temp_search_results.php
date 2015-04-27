<html>
<body bgcolor="#073f40">

<!--For responsive design-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--stylesheet-->

<!--fonts-->

<link href='http://fonts.googleapis.com/css?family=Dosis|Josefin+Sans|Maven+Pro|Quicksand|Exo+2|Pontano+Sans|EB+Garamond|Jura|Comfortaa|Sintony|Antic+Slab|Quattrocento|Marvel|Poiret+One' rel='stylesheet' type='text/css'>

<!--styles-->
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="stylesheet" href="css/bootstrap-theme.min.css">
<link href="results_responsive.css" rel="stylesheet" type="text/css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<nav role="navigation" class="navbar navbar-default navbar-fixed-top" id="navbar">
	<div class="container-fluid" id="container-fluid">
		<div class="navbar-header">
			<button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
		</div>
		<!-- Collection of nav links and other content for toggling -->
        
        	<div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
            	<?php
				include('login.php'); // Includes Login Script

				if(isset($_SESSION['login_user'])){
					?>
					<li id="hello">Hello, <?php echo $_SESSION['login_first_name']; ?></li>
					<li><a href="http://www.opero.us/index_responsive.php">Home</a></li>
					<li><a href="http://www.opero.us/profile.php">View Profile</a></li>
					<li><a href="http://www.opero.us/logout.php">Log Out</a></li>
					<?php
				}
				else {
					?>
					<li class="dropdown" id="menu1">
		             <a class="dropdown-toggle" data-toggle="dropdown" href="#menu1">
		               Login
		                <b class="caret"></b>
		             </a>
		             <div class="dropdown-menu">
		               <form  name="userInfo" method="POST" action="login.php">
		                   <input id="homePageUserLogin" placeholder=" User Name" name="email" type="text">
		                   <input id="homePageUserLogin" placeholder=" Password" name="password" type="password">
		                   <input type="button" id="register" onclick="window.location='signup.php'" value="Register">
		                   <input id="login" type="submit" name="submit" value="Log In">
		                   <input type="button" id="forgotLogin" onclick="window.location='sendReminder.php'" value="Forgot Login Info?">
		               </form>
		             </div>
		           </li>
					<!-- 		           
					<div id="navbarCollapse" class="collapse navbar-collapse">
					<div class="userForm">
					<form  name="userInfo" method="POST" action="login.php">
					<input id="homePageUserLogin" placeholder=" User Name" name="email" type="text"><br>
					<input id="homePageUserLogin" placeholder=" Password" name="password" type="password"><br>
					<input type="button" id="register" onclick="window.location='signup.php'" value="Register">
					<input id="login" type="submit" name="submit" value="Log In">
					<input type="button" id="forgotLogin" onclick="window.location='sendReminder.php'" value="Forgot Login Info?">-->
					
			
					<span><?php echo $error; ?></span>
					</form>
					</div>
					<br>
					<?php
				}
				?>
            </ul>
            </div>
        </div>
	</div>
</nav>

<?php

require_once "Careerjet_API.php";

function verifyInput(){

	$goodData = TRUE;
	$job = $_POST["job"];
	$checkJob = gettype($job);
		
	$state = $_POST["state"];
	$checkState = gettype($state);

	$city = $_POST["city"];
	$checkCity = gettype($city);
	
	//check to make sure at least one of the city state or zip code are present for location
	if(($checkCity != "string") && ($checkState != "string")) $goodData = FALSE;
	else if($checkJob != "string") $goodData = FALSE;

		
	return $goodData;

}//end verifyData


if($_SERVER["REQUEST_METHOD"] == "POST"){

	$goodData = verifyInput();

	$job = $_POST["job"];
	
	$city = $_POST["city"];
	
	$state = $_POST["state"];

	//$zipcode = $_POST["zipCode"];

	//$dol = $_POST["dolInfo"];

	$time = $_POST["time"];

	$contractType = $_POST["contract"];

	$sort = $_POST["sortBy"];

	$results = $_POST["#OfResults"];

	

	if($goodData == TRUE){
		
		//set default search region to US. Can be expanded at will
		$api = new Careerjet_API('en_US');

		$page = 1;


		//get data from database given user's parameters
		$result = $api->search(array( 

		'keywords' => $job,
		'location' => $city . ' ' . $state, 
		'pagesize' => $results,
		'sort' => $sort, 
		'contractype' => $contractType, 
		'contractperiod' => $time, 
		'page' => $page,));
		if($result->hits == 0){

		echo "<div id=\"no_of_results_message\">No results found for '".$job."' in ".$city.", ".$state."</div>";
		echo "<a class=\"ax\" href=\"index.html\"><p id=\"homelink\">Click to go back to homepage</p></a>";
		}
		if ($result->type == 'JOBS' ) {	
	
		if($result->pages > 1){

		echo "<div class=\"container\">
			  <div class=\"row\">
		      <div class=\"col-sm-12\">";	
		echo "<h1 id=\"no_of_results_message\">Opero found " .$result->hits." jobs";
		echo " on ".$result->pages." pages\n</h1>";
		echo "</div>
			  </div>
			  </div>";

		}

		elseif($result->pages == 1){

	
		echo "<h1 id=\"no_of_results_message\">Opero found " .$result->hits." jobs";
		echo " on ".$result->pages." page\n</h1>";

		
		}

		$jobs = $result->jobs;

		foreach($jobs as $job){

		?><div class="container">
		  <div class="row">
	      <div class="col-sm-12"><?php 
		//job division
		echo "<div id=\"job\">";

		//eventually format this data
			echo "<a id=\"url_link\" href=\"$job->url\"><img src=\"https://pbs.twimg.com/profile_images/1319539968/mobile_icon_eng.png\" height=\"100\" width=\"100\" alt=\"career jet logo\"></a>";
			echo "<div id=\"title\">".$job->title."</div><br>";
			echo "<div id=\"loc\">Locale: ".$job->locations."</div>\n";
		
			echo "<div id=\"salary\">Salary: ".$job->salary."</div>\n";	
	
			echo "<div id=\"company\">Company: ".$job->company."</div>\n";
			echo "<div id=\"click_message\">Click Logo<br>For Full Details</div>";
				
			echo "<div id=\"desc\">Key word matches: ".$job->description."</div>\n";
			echo "</div>";
			echo "\n";
			?></div>
				  </div>
				  </div> <?php 
		}//endforeach

		}//end if
			
		//if location is ambiguous...


			if ( $result->type == 'LOCATIONS' ){

  			$locations = $result->solveLocations ;

  			foreach ( $locations as $loc ){

    			echo $loc->name."\n" ; # For end user display
    		## Use $loc->location_id when making next search call
    		## as 'location_id' parameter

		////////////////////IMPORTANT!!/////////////////

		//add database deposit of information here

		///////////////////IMORTANT!!///////////////////
  }
}
}



}

//end php
?>


</body>
</html>			
