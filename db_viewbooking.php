<?php
$host = 'localhost';
$dbname = 'bookings'; // Correct database name for bookings
$username = 'root'; // Adjust if needed
$password = ''; // Adjust if needed

// Establish the MySQL connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
