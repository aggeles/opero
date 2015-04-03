<?php

	if(isset($_POST['submit']) && isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['password'])) {

		$data = $_POST['first_name'] . ',' . $_POST['last_name'] . ',' . $_POST['email'] . ',' . $_POST['password'] . "\n";

		$first_name = $_POST['first_name'];

		$email = $_POST['email'];

		$handle = @fopen("users.txt", "r");

		$inFile = false;

		$duplicate = false;

			if ($handle) 

			{

				while (($buffer = fgets($handle, 4096)) !== false) 

				{

					$exists=explode(",",$buffer);

					if($first_name == $exists[0]) 

					{

						$duplicate = true;

					}

				}

			}

			if ($duplicate == false) {

				$ret = file_put_contents('users.txt', $data, FILE_APPEND | LOCK_EX);

			}

	}


?>





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



		<?php 

		if ($duplicate == false) {

			

			echo "<p id=\"instructions\">Your profile has been created successfully. Welcome $first_name!</p>";

			echo "<p id=\"instructions\">Begin job search here</p>";
			echo "<a href='index.php?firstname=$first_name&lastname=".$_POST['last_name']."'id=\"signuplink\" ><p id=\"searchButton\">Search</p></a>";
		}

		else if ($duplicate == true) {

			

			echo "<p id=\"instructions\">Your profile already exists</p>";

			echo "<p id=\"instructions\">Click here to go to the home page</p>";

		echo "<a href='opero_index.php?firstname=$first_name&lastname=".$_POST['last_name']."'id=\"signuplink\" ><p id=\"searchButton\">Search</p></a>";

	
					}

		?>

	</body>

</html>
