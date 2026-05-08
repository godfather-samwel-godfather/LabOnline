<?php

//=====DATABASE CONFIGURATION===
$host = "localhost";
$username = "root";
$password = "";
$database = "online_labo"; 

// ===== CREATE CONNECTION====
$conn = new mysqli($host, $username, $password, $database);

//====CHECK CONNECTION ERROR===
if($conn->connect_error){
    die("Database Connection Failed: " . $conn->connect_error);
}

//====SET CHARACTER ENCODING (important for English, special characters, emojis, etc.)
$conn->set_charset("utf8mb4");

?>