<?php
require 'db.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and retrieve POST data
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars($_POST['phone']);
    $message = htmlspecialchars($_POST['message']);

    try {
        // Prepare the SQL query to insert data
        $sql = "INSERT INTO contacts (name, email, phone, message) 
                VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Bind parameters and execute the query
        if ($stmt->execute([$name, $email, $phone, $message])) {
            echo "<script>alert('Your message has been sent successfully!');
                  window.location.href='contact.php';</script>";
        } else {
            echo "<script>alert('Failed to send your message. Please try again.');
                  window.location.href='contact.php';</script>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    // Redirect to contact page if accessed without form submission
    header('Location: contact.php');
    exit();
}
?>
