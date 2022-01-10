<?php

$server = "localhost";
$user = "root"; 
$password = "";
$database = "project";

$conn = mysqli_connect($server, $user, $password, $database);

if ($conn == false){
	die("Error, could not connect to database". mysqli_connect_error());
}	

?>	