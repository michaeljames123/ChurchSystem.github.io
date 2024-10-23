<?php 
session_start(); // Start the session

// Check if the admin is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit();
}

// Database connection
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "bookings"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Delete Request
if (isset($_GET['delete_id']) && isset($_GET['table'])) {
    $id = intval($_GET['delete_id']);
    $table = $_GET['table'];
    
    $deleteQuery = "DELETE FROM $table WHERE id = $id";
    if ($conn->query($deleteQuery) === TRUE) {
        header("Location: bookings.php"); // Refresh page after deletion
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Fetch all bookings
$baptismBookings = $conn->query("SELECT * FROM bookings WHERE service_type='Baptism'");
$dedicationBookings = $conn->query("SELECT * FROM child_dedication_bookings");
$funeralBookings = $conn->query("SELECT * FROM funeral_service_bookings");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings - Admin Panel</title>
    <style>
        /* Sidebar Styles */
        body {
            display: flex;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        /* Sidebar Div */
        div.sidebar {
            color: #fff;
            width: 250px;
            padding-left: 20px;
            height: 100vh;
            background-image: linear-gradient(30deg, #11cf4d, #055e21);
            border-top-right-radius: 0px;
            
            
        }
        /* Div header */
        div.sidebar h2 {
            padding: 40px 0 0 0;
            cursor: pointer;
        }
        /* Div links */
        div.sidebar a {
            font-size: 14px;
            color: #fff;
            display: block;
            padding: 12px;
            padding-left: 30px;
            text-decoration: none;
            outline: none;
        }
        /* Div link on hover */
        div.sidebar a:hover {
            color: #56ff38;
            background: #fff;
            position: relative;
            background-color: #fff;
            border-top-left-radius: 22px;
            border-bottom-left-radius: 22px;
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            background-color: #f4f4f4;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #4A90E2;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        a.action-link {
            margin: 0 5px;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 4px;
            color: #fff;
        }
        .edit-link {
            background-color: #ffc107;
        }
        .delete-link {
            background-color: #dc3545;
        }
    </style>
    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this booking?');
        }
    </script>
</head>
<body>

<div class="sidebar">
    <!-- Div Header-->
    <h2>Admin</h2>
    <!-- Links in Div -->
    <a href="bookings.php">Bookings</a>
    <a href="schedules.php">Schedules</a>
    <a href="users.php"> Users </a>
    <a href="log_out.php">Log out</a>
</div>

<div class="main-content">
    <h2>All Bookings</h2>

    <h3>Baptism Bookings</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Booking Date</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $baptismBookings->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= htmlspecialchars($row['name']); ?></td>
                <td><?= htmlspecialchars($row['email']); ?></td>
                <td><?= htmlspecialchars($row['booking_date']); ?></td>
                <td><?= htmlspecialchars($row['username']); ?></td>
                <td>
                    <a class="action-link edit-link" href="edit_booking.php?id=<?= $row['id'];?>&table=bookings">Edit</a>
                    <a class="action-link delete-link" href="?delete_id=<?= $row['id']; ?>&table=bookings" onclick="return confirmDelete();">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <h3>Child Dedication Bookings</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Parent Name</th>
                <th>Parent Email</th>
                <th>Child Name</th>
                <th>Dedication Date</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $dedicationBookings->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= htmlspecialchars($row['parent_name']); ?></td>
                <td><?= htmlspecialchars($row['parent_email']); ?></td>
                <td><?= htmlspecialchars($row['child_name']); ?></td>
                <td><?= htmlspecialchars($row['dedication_date']); ?></td>
                <td><?= htmlspecialchars($row['username']); ?></td>
                <td>
                    <a class="action-link edit-link" href="edit_booking.php?id=<?= $row['id']; ?>&table=child_dedication_bookings">Edit</a>
                    <a class="action-link delete-link" href="?delete_id=<?= $row['id']; ?>&table=child_dedication_bookings" onclick="return confirmDelete();">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <h3>Funeral Service Bookings</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Deceased Name</th>
                <th>Contact Person</th>
                <th>Contact Email</th>
                <th>Service Date</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $funeralBookings->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= htmlspecialchars($row['deceased_name']); ?></td>
                <td><?= htmlspecialchars($row['contact_person']); ?></td>
                <td><?= htmlspecialchars($row['contact_email']); ?></td>
                <td><?= htmlspecialchars($row['service_date']); ?></td>
                <td><?= htmlspecialchars($row['username']); ?></td>
                <td>
                    <a class="action-link edit-link" href="edit_booking.php?id=<?= $row['id']; ?>&table=funeral_service_bookings">Edit</a>
                    <a class="action-link delete-link" href="?delete_id=<?= $row['id']; ?>&table=funeral_service_bookings" onclick="return confirmDelete();">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
