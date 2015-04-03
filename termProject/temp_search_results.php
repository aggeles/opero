<html>
<body bgcolor="#073f40">


<!--stylesheet-->

<!--fonts-->

<link href='http://fonts.googleapis.com/css?family=Dosis|Josefin+Sans|Maven+Pro|Quicksand|Exo+2|Pontano+Sans|EB+Garamond|Jura|Comfortaa|Sintony|Antic+Slab|Quattrocento|Marvel|Poiret+One' rel='stylesheet' type='text/css'>

<!--styles-->

<link href="results.css" rel="stylesheet" type="text/css">


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

		echo "<div id=\"no_of_results_message\">No results found for ".$job."</div>";
		echo "<a class=\"ax\" href=\"index.html\"><p id=\"homelink\">Click to go back to homepage</p></a>";
		}
		if ($result->type == 'JOBS' ) {	
	
		if($result->pages > 1){

		echo "<h1 id=\"no_of_results_message\">Opero found " .$result->hits." jobs";
		echo " on ".$result->pages." pages\n</h1>";

		}

		elseif($result->pages == 1){

	
		echo "<h1 id=\"no_of_results_message\">Opero found " .$result->hits." jobs";
		echo " on ".$result->pages." page\n</h1>";

		
		}

		$jobs = $result->jobs;

		foreach($jobs as $job){
			
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
