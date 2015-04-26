<!DOCTYPE html>
<html>
<?php 
include "session.php";
?>	
	<head></head>
	
	<body>
	<?php
	 $username = $_SESSION['login_user'];
	 $url = $_GET['url'];
	 
	 $user_name = "a";
	 $password = "Csci4300";
	 $hostname = "localhost";
	 
	 try {
	 	$db = new PDO("mysql:host=$hostname;dbname=Documents", "a", "Csci4300");
		$sql = "INSERT INTO resumes(username, url) VALUES ('$username', '$url')";
	 	$count = $db->exec($sql);
	 	
		$db = null;
	 }
	 catch(PDOException $e)
	 {
	 	echo $e->getMessage();
	 }
	?>
	</body></html>
	
