<!DOCTYPE html>
<html>
	<head>
		<title>all_movies by actor</title>
		<link href="index.php">
		<link rel="stylesheet" type="text/css" href="bacon.css">
		<link href="https://webster.cs.washington.edu/images/kevinbacon/favicon.png" type="image/png" rel="shortcut icon" />
	</head>
	<body>
		<div id="frame">
			<div id="banner">
				<a href="index.php"><img src="https://webster.cs.washington.edu/images/kevinbacon/mymdb.png" alt="banner logo" /></a>
				My Movie Database
			</div>
			<div id="main">
				<h1>Results</h1>
				<div id="results">
					<?php
						echo "ON";
						$first = $_GET["firstname"];
						$last = $_GET["lastname"];
						$db = new PDO("mysql: host=23.229.157.41; dbname=imdb_small", "aggeles"); //set up database connection	
						$index_a = 0;
						$index_b = 2;
						$sub = substr($first, $index_a, $index_b); //get substring to check the first few letters of first name 
						$actor = "SELECT * 
						FROM actors a 
						WHERE a.last_name = '".$last."'
						&& a.first_name LIKE '".$sub."%' ORDER BY a.film_count DESC LIMIT 1"; 
						$act = $db->query($actor);  //query to get best match for actor based on user input 
						
						//--Determines which actor to choose when more than one actor with the same name have been in the same number of movies--//
						$count = 0;
						foreach($act as $a){
							if($count == 0){
								$id = $a["id"];
								$num1 = $a["film_count"];
								$name1 = $a["first_name"];
								$count++;
								continue;
							}
							else{
								$num2 = $a["film_count"];
								if($num1 == $num2){
									$name2 = $a["first_name"];
									if(strlen($name2) < strlen($name1)){
										$id = $a["id"];
									}
								}
							}
							break;
						}
						//--display error if actor is not found
						$dup = $act->rowCount();
						if($dup == 0){
							?><h2>Actor <?= $first." ".$last ?> not Found</h2><?php
						}
						else{
							$q = "SELECT * 
							FROM movies m 
							JOIN roles r ON r.movie_id = m.id 
							JOIN actors a ON r.actor_id = a.id 
							WHERE a.id = ".$id." ORDER BY m.year DESC";
							$exist = $db->query($q); //query to find a list of all the actor's movies
							?> <table> <?php
							//--display movies--//
							$count = 1;
							foreach($exist as $t){
								?><tr><td><?= $count?></td>
								<td><?= $t["name"]; ?></td>
								<td><?= $t["year"]; ?></td></tr>
								<?php
								$count++;
							}
							?> </table> <?php
						}
					?> 
				</div>
				<!-- form to search for every movie by a given actor -->
				<form action="search-all.php" method="get">
					<fieldset>
						<legend>All movies</legend>
						<div>
							<input name="firstname" type="text" size="12" placeholder="first name" autofocus="autofocus" /> 
							<input name="lastname" type="text" size="12" placeholder="last name" /> 
							<input type="submit" value="go" />
						</div>
					</fieldset>
				</form>

				<!-- form to search for movies where a given actor was with Kevin Bacon -->
				<form action="search-kevin.php" method="get">
					<fieldset>
						<legend>Movies with Kevin Bacon</legend>
						<div>
							<input name="firstname" type="text" size="12" placeholder="first name" /> 
							<input name="lastname" type="text" size="12" placeholder="last name" /> 
							<input type="submit" value="go" />
						</div>
					</fieldset>
				</form>
			</div>
			<div id="w3c">
				<a href="https://webster.cs.washington.edu/validate-html.php"><img src="https://webster.cs.washington.edu/images/w3c-html.png" alt="Valid HTML5" /></a>
				<a href="https://webster.cs.washington.edu/validate-css.php"><img src="https://webster.cs.washington.edu/images/w3c-css.png" alt="Valid CSS" /></a>
			</div>	
		</div>	
	</body>
</html>
