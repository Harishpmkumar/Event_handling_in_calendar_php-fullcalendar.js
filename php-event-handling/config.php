<?php

// Database configuration: specify your hostname, username, password, and database name
$host = "hostname";  // The hostname of the database server (usually 'localhost')
$username = "username";  // The username to connect to the database (default is 'root' for local development)
$password = "password";  // The password for the database connection (leave empty for local development with no password)
$dbname = "database_name";  // The name of the database to connect to

// Create a new MySQLi connection using the specified parameters
$conn = new mysqli($host, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    // If there was a connection error, display the error message and exit the script
    die("Connection failed: " . $conn->connect_error);
}
?>
