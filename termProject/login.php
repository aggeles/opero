<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['email']) || empty($_POST['password'])) {
$error = "Email or Password is invalid";
}
else
{
// Define $username and $password
$email=$_POST['email'];
$password=$_POST['password'];
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysql_connect("localhost", "a", "Csci4300");
// To protect MySQL injection for Security purpose
$email = stripslashes($email);
$password = stripslashes($password);
$email = mysql_real_escape_string($email);
$password = mysql_real_escape_string($password);
// Selecting Database
$db = mysql_select_db("users", $connection);
// SQL query to fetch information of registerd users and finds user match.
$query = mysql_query("select * from login where password='$password' AND email='$email'", $connection);

$getName= mysql_query("select first_name from login where password='$password' AND email='$email'", $connection);
$getNameRow = mysql_fetch_assoc($getName);
$_SESSION['login_first_name'] = $getNameRow['first_name'];

$rows = mysql_num_rows($query);
if ($rows == 1) {
$_SESSION['login_user']=$email; // Initializing Session
header("location: index.php"); // Redirecting To Other Page
} else {
$error = "Email or Password is invalid";
}
mysql_close($connection); // Closing Connection
}
}
?>