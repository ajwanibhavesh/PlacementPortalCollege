<?php

// Your MySQL Config
$servername = "localhost:3308"; // Add port number (3308)
$username = "root";
$password = ""; // Set to your MySQL root password if one is configured
$dbname = "placement_portal";

// Create New Database Connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check Connection
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
} 

?>
