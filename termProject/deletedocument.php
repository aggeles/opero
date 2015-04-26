<!DOCTYPE html>
<html>
<?php 
include "session.php";
?>	
	<head></head>
	
	<body>
	<?php
	 $username = $_SESSION['login_user'];
	 $len = $_GET['count'];
	 
	 $links = array();
	 
	 for($i = 0; $i < $len; $i++) {
	 	array_push($links, $_GET['link' . ($i + 1)]);
	 }

// 	 array_push($links, $_GET['link1']);

	 $user_name = "a";
	 $password = "Csci4300";
	 $hostname = "localhost";
	 
	 try {
	 	$db = new PDO("mysql:host=$hostname;dbname=Documents", "a", "Csci4300");
	 	$sql = "DELETE FROM resumes WHERE ";
		for($i = 0; $i < sizeof($links); $i++) {
			$sql = $sql .  "(username = '$username' AND url = '$links[$i]')";
			if($i == (count(links) - 1) && ($len != 1)) {
				$sql = $sql . " OR ";	
			}	
		}
	 	$count = $db->exec($sql);
	 	
		$db = null;
	 }
	 catch(PDOException $e)
	 {
	 	echo $e->getMessage();
	 }
 	?>
	</body></html>
	

