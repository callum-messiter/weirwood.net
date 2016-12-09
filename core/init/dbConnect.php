<?php 

// Database connection to be included in all PHP files //
$hostname = "localhost";
$user     = "root";
$password = "";
$dbName   = "thrones";

$db = mysqli_connect($hostname, $user, $password, $dbName); 

?>
