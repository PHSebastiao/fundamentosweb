<?php

$servername = "localhost";
$username = "linked"; //getenv("USER");
$password = "2HsFaeK%DFy#7r"; //getenv("PWD");
$dbname = "atividade";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
