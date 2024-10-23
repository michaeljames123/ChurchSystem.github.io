<?php
session_start(); // Start session

// Redirect to login page if not logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Include the database connection
include 'db_connection.php';

// Get the current user's username
$currentUser = $_SESSION['username'];

// Function to fetch bookings for a user from a specific table
function fetchUserBookings($conn, $table, $username) {
    $stmt = $conn->prepare("SELECT * FROM $table WHERE username = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Fetch bookings from the three tables
$baptismBookings = fetchUserBookings($conn, 'bookings', $currentUser);
$dedicationBookings = fetchUserBookings($conn, 'child_dedication_bookings', $currentUser);
$funeralBookings = fetchUserBookings($conn, 'funeral_service_bookings', $currentUser);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings - Freedom of Praise Church</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        header {
            background-color: #333;
            padding: 15px;
            text-align: center;
            color: white;
        }

        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #4A90E2;
        }

        .booking-section {
            margin-bottom: 40px;
        }

        .booking-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .booking-table th, .booking-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .booking-table th {
            background-color: #4A90E2;
            color: white;
        }

        .booking-table tr:hover {
            background-color: #f1f1f1;
        }

        .no-data {
            text-align: center;
            font-style: italic;
            color: #888;
        }

        .back-button {
            display: inline-block;
            padding: 10px 15px;
            margin: 20px auto;
            background-color: #4A90E2;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #357ABD;
        }
    </style>
</head>
<body>

<header>
    <h2>Freedom of Praise Church - Booking Management</h2>
</header>

<main class="container">
    <h1>Your Bookings</h1>

    <div class="booking-section">
        <h2>Baptism Bookings</h2>
        <table class="booking-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($baptismBookings)): ?>
                    <tr><td colspan="4" class="no-data">No baptism bookings found.</td></tr>
                <?php else: ?>
                    <?php foreach ($baptismBookings as $booking): ?>
                        <tr>
                            <td><?= htmlspecialchars($booking['id']); ?></td>
                            <td><?= htmlspecialchars($booking['name']); ?></td>
                            <td><?= htmlspecialchars($booking['email']); ?></td>
                            <td><?= htmlspecialchars($booking['booking_date']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="booking-section">
        <h2>Child Dedication Bookings</h2>
        <table class="booking-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Parent Name</th>
                    <th>Parent Email</th>
                    <th>Child Name</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($dedicationBookings)): ?>
                    <tr><td colspan="5" class="no-data">No child dedication bookings found.</td></tr>
                <?php else: ?>
                    <?php foreach ($dedicationBookings as $booking): ?>
                        <tr>
                            <td><?= htmlspecialchars($booking['id']); ?></td>
                            <td><?= htmlspecialchars($booking['parent_name']); ?></td>
                            <td><?= htmlspecialchars($booking['parent_email']); ?></td>
                            <td><?= htmlspecialchars($booking['child_name']); ?></td>
                            <td><?= htmlspecialchars($booking['dedication_date']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="booking-section">
        <h2>Funeral Service Bookings</h2>
        <table class="booking-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Deceased Name</th>
                    <th>Contact Person</th>
                    <th>Contact Email</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($funeralBookings)): ?>
                    <tr><td colspan="5" class="no-data">No funeral service bookings found.</td></tr>
                <?php else: ?>
                    <?php foreach ($funeralBookings as $booking): ?>
                        <tr>
                            <td><?= htmlspecialchars($booking['id']); ?></td>
                            <td><?= htmlspecialchars($booking['deceased_name']); ?></td>
                            <td><?= htmlspecialchars($booking['contact_person']); ?></td>
                            <td><?= htmlspecialchars($booking['contact_email']); ?></td>
                            <td><?= htmlspecialchars($booking['service_date']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <a href="book.php" class="back-button">Back</a>
</main>

</body>
</html>
