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

// Fetch user details for the given id
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $userId = $_POST['id'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "User  not found.";
        exit();
    }
    $stmt->close();
} else {
    echo "Invalid request.";
    exit();
}

// Handle the update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $username = $_POST['username'];
    $password = $_POST['password']; // Assuming you want to update the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the new password

    // Update user in the database
    $updateStmt = $conn->prepare("UPDATE users SET username = ?, password = ? WHERE id = ?");
    $updateStmt->bind_param("ssi", $username, $hashedPassword, $userId);

    if ($updateStmt->execute()) {
        $_SESSION['success_message'] = "User  updated successfully!";
        header("Location: users.php"); // Redirect to users list
        exit();
    } else {
        echo "Error updating user: " . $updateStmt->error;
    }
    $updateStmt->close();
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
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <style>
        /* Add your styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4f8;
            padding: 20px;
        }
        .container {
            background: white;
            padding: 2em;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: auto;
        }
        h2 {
            text-align: center;
            margin-bottom: 1.5em;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50; /* Green */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049; /* Darker green */
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit User</h2>
    <form method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']); ?>">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="<?= htmlspecialchars($user['username']); ?>" required>
        
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" placeholder="Enter new password" required>
        
        <button type="submit" name="update">Update User</button>
    </form>
</div>

</body>
</html>