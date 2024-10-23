<?php
// Database connection settings
$host = 'localhost';        // Hostname (e.g., localhost)
$user = 'root';     // Database username
$password = ''; // Database password
$dbname = 'bookings';        // Your database name

// Create a connection to the MySQL database
$conn = new mysqli($host, $user, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
?>

