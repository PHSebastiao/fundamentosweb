<?php

$servername = "db";
$username = "gugu";//"linked"; //getenv("USER");
$password = "banheira";//"2HsFaeK%DFy#7r"; //getenv("PWD");
$dbname = "atividade";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
