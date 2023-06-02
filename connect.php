<?php

$hostname = "localhost";
$username = "linked";//getenv("USER");
$password = "2HsFaeK%DFy#7r";//getenv("PWD");
$dbname = "si5a";

$conn = mysqli_connect($hostname, $username, $password, $dbname);

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}