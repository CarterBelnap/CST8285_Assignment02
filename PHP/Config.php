<?php
// Database configuration
$servername = "localhost"; // The server where your database is hosted
$username = "root"; // default username 
$password = ""; // default password
$dbname = "crafting_play"; // database name

// Creates the connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Checks for connection errors
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
