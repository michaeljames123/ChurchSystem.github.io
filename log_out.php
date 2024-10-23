<?php
session_start();
$_SESSION['logout_message'] = "Logout successfully"; // Set the logout message
session_destroy(); // Destroy the session
header("Location: login.php"); // Redirect to login page
exit();
?>
