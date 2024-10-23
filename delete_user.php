<?php
session_start();
include 'adminpage.php'; // Include the admin header

$servername = "localhost"; // Change if needed
$username = "root"; // Change if needed
$password = ""; // Change if needed
$dbname = "user_auth"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle user deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $userId = $_POST['id'];

    // Prepare and execute the delete statement
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "User  deleted successfully!";
    } else {
        $_SESSION['error_message'] = "Error deleting user: " . $stmt->error;
    }

    $stmt->close();
    header("Location: users.php"); // Redirect back to the users list
    exit();
}

$conn->close();
?>