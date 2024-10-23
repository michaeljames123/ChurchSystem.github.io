<?php
$servername = "localhost"; // Change if needed
$username = "root"; // Change if needed
$password = ""; // Change if needed
$dbname = "user_auth"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start(); // Start the session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle registration
    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // Check if the username already exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) { // Username doesn't exist
            $stmt->close();

            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $password);
            if ($stmt->execute()) {
                $stmt->close();
                // Redirect to login page after successful registration
                header("Location: login.php");
                exit();
            } else {
                $error = "Registration failed. Please try again.";
            }
        } else {
            $error = "Username already exists. Please choose another.";
        }
    }

    // Handle login
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // Set session variable and redirect to home page
                $_SESSION['username'] = $username;
                header("Location: home.php");
                exit();
            } else {
                $error = "Invalid credentials.";
            }
        } else {
            $error = "No user found.";
        }
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration and Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet"> <!-- Google Fonts -->
    <style>
        body {
            background-color: #f0f4f8;
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            flex-direction: column;
            background: linear-gradient(to right, #74ebd5, #acb6e5);
        }
        .container {
            background: gray;
            padding: 2em;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 350px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative; /* Added for positioning the logo */
        }
        .container:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.2);
        }
        h1 {
            text-align: center;
            margin-bottom: 0.2em; /* Reduced space between headings */
            color: #333;
            font-size: 2rem; /* Adjust font size as needed */
            font-family: 'Poppins', sans-serif; /* Stylish font */
            text-size-adjust: 1000px;
        }
        h2 {
            text-align: center;
            margin-bottom: 2em; /* Space between the second heading and the form */
            color: #333;
            font-size: 1.5rem; /* Adjust font size as needed */
            font-family: 'Poppins', sans-serif; /* Stylish font */
        }
        input[type="text"], input[type="password"] {
            width: 93%;
            padding: 12px;
            margin: 0.5em 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            transition: border-color 0.3s ease, background-color 0.3s ease;
        }
        input[type="text"]:focus, input[type="password"]:focus {
            border-color: #007BFF;
            background-color: #e8f0fe;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        button:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }
        .form-group {
            margin-bottom: 1em;
        }
        .link {
            text-align: center;
            margin-top: 20px;
        }
        .link a {
            color: #007BFF;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .link a:hover {
            color: #0056b3;
        }
        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
        .logo {
            position: center; /* Position the logo */
            top: 5px; /* Adjust as needed */
            left: 10px; /* Adjust as needed */
            width: 150px; /* Adjust size as needed */
            height: auto; /* Maintain aspect ratio */
        }
    </style>
</head>
<body>

<img src="fop2.PNG" alt="Logo" class="logo"> <!-- Add logo image -->
<h1>Information Management System</h1> <!-- Centered H1 Title -->
<h2>for Freedom of Praise Church</h2> <!-- Centered H2 Title -->

<div class="container">
    <h2>Register</h2>
    <form method="POST">
        <div class="form-group">
            <input type="text" name="username" placeholder="Username" required>
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <?php if (isset($error)): ?>
            <div class="error"><?= $error; ?></div>
        <?php endif; ?>
        <button type="submit" name="register">Register</button>
    </form>
</div>

<div class="link">
    <a href="login.php">Already have an account? Login here.</a>
</div>

</body>
</html>
