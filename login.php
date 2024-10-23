<?php
session_start();
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

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Admin Login Check
        if ($username === 'admin' && $password === '011416') {
            $_SESSION['username'] = 'admin';
            header("Location: adminpage.php");
            exit();
        }

        // Regular User Login Check from Database
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
    <title>Login</title>
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
            background: white;
            padding: 2em;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 350px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .container:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.25);
        }
        h2 {
            text-align: center;
            margin-bottom: 1.5em;
            color: #555;
        }
        input[type="text"], input[type="password"] {
            width: 93%;
            padding: 14px;
            margin: 0.8em 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            transition: border-color 0.3s ease, background-color 0.3s ease;
        }
        input[type="text"]:focus, input[type="password"]:focus {
            border-color: #6a5acd;
            background-color: #f0f8ff;
        }
        button {
            width: 100%;
            padding: 14px;
            background-color: #6a5acd;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        button:hover {
            background-color: #483d8b;
            transform: translateY(-2px);
        }
        .form-group {
            margin-bottom: 1.5em;
        }
        .link {
            text-align: center;
            margin-top: 30px;
        }
        .link a {
            color: #6a5acd;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .link a:hover {
            color: #483d8b;
        }
        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
        .logout-message {
            color: green;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Login</h2>

    <?php
    // Check if the logout message is set and display it
    if (isset($_SESSION['logout_message'])) {
        echo '<p class="logout-message">' . htmlspecialchars($_SESSION['logout_message']) . '</p>';
        unset($_SESSION['logout_message']); // Unset the message after displaying it
    }

    // Display any login errors
    if (isset($error)) {
        echo '<div class="error">' . htmlspecialchars($error) . '</div>';
    }
    ?>

    <form method="POST">
        <div class="form-group">
            <input type="text" name="username" placeholder="Username" required>
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <button type="submit" name="login">Login</button>
    </form>
</div>

<div class="link">
    <a href="index.php">Don't have an account? Register here.</a>
</div>

</body>
</html>
