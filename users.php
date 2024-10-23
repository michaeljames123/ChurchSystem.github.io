<?php 
session_start();
include 'adminpage.php'; // Include the admin header

// Database connection
$servername = "localhost"; // Change if needed
$username = "root"; // Change if needed
$password = ""; // Change if needed
$dbname = "user_auth"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch users from the database
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="styles.css"> <!-- Include shared CSS -->
    <style>
        body {
            display: flex;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4; /* Light background for contrast */
            height: 100vh; /* Full viewport height */
        }

        /* Sidebar Div */
        .sidebar {
            color: #fff;
            width: 250px;
            padding: 20px;
            height: 100%; /* Full height */
            background-image: linear-gradient(30deg, #11cf4d, #055e21);
            border-top-right-radius: 0px;
            position: fixed; /* Fixed sidebar */
            overflow-y: auto; /* Scroll if content overflows */
        }

        /* Sidebar Header */
        .sidebar h2 {
            text-align: center; /* Center sidebar header */
            font-size: 24px; /* Larger font for header */
            font-weight: bold; /* Bold header */
            margin-bottom: 20px; /* Space below header */
        }

        /* Sidebar links */
        .sidebar a {
            font-size: 16px; /* Increased font size */
            color: #fff;
            display: block;
            padding: 12px;
            text-decoration: none;
            transition: background-color 0.3s; /* Smooth transition */
        }

        /* Sidebar link on hover */
        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.2); /* Slightly transparent white */
        }

        /* Main content area */
        .main-content {
            flex: 1; /* Take remaining space */
            padding: 40px 20px; /* Padding around the content */
            margin-left: 50px; /* Ensure content doesn't go behind sidebar */

        }

        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
     
            background: #fff; /* White background for table */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px; /* Increased padding */
            text-align: left;
            color: black; /* Black text for table data */
        }

        th {
            background-color: #f2f2f2; /* Light gray for header */
            font-weight: bold; /* Bold header text */
        }

        .button {
            padding: 8px 12px; /* Increased button padding */
            margin: 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px; /* Button font size */
            transition: background-color 0.3s; /* Smooth transition */
        }

        .edit-button {
            background-color: #4CAF50; /* Green */
            color: white;
        }

        .edit-button:hover {
            background-color: #45a049; /* Darker green on hover */
        }

        .delete-button {
            background-color: #f44336; /* Red */
            color: white;
        }

        .delete-button:hover {
            background-color: #d32f2f; /* Darker red on hover */
        }

        h2.page-title {
            text-align: center; /* Center the title */
            margin-bottom: 20px; /* Space between title and table */
            font-size: 28px; /* Larger title font */
            color: #333; /* Darker color for the title */
        }

        /* Message styles */
        .message {
            text-align: center;
            margin-bottom: 20px;
            font-size: 16px;
            color: #666;
        }

        .success-message {
            color: #2ecc71; /* Green for success */
        }

        .error-message {
            color: #e74c3c; /* Red for error */
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>Admin</h2>
        <a href="bookings.php">Bookings</a>
        <a href="schedules.php">Schedules</a>
        <a href="users.php">Users</a>
        <a href="log_out.php">Log out</a>
    </div>

    <div class="main-content">
        <h2 class="page-title">User  Management</h2>

        <?php
        // Display success or error messages
        if (isset($_SESSION['success_message'])) {
            echo '<p class="message success-message">' . htmlspecialchars($_SESSION['success_message']) . '</p>';
            unset($_SESSION['success_message']);
        }

        if (isset($_SESSION['error_message'])) {
            echo '<p class="message error-message">' . htmlspecialchars($_SESSION['error_message']) . '</p>';
            unset($_SESSION['error_message']);
        }
        ?>

        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['username']}</td>
                            <td>{$row['create_at']}</td>
                            <td>
                                <form action='edit_user.php' method='POST' style='display:inline;'>
                                    <input type='hidden' name='id' value='{$row['id']}'>
                                    <button type='submit' class='button edit-button'>Edit</button>
                                </form>
                                <form action='delete_user.php' method='POST' style='display:inline;'>
                                    <input type='hidden' name='id' value='{$row['id']}'>
                                    <button type='submit' class='button delete-button'>Delete Account</button>
                                </form>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No users found.</td></tr>";
            }
            ?>
        </table>

    </div>

</body>
</html>

<?php
$conn->close();
?>