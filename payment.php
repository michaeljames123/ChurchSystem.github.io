<?php
session_start(); // Start session

// Redirect to login page if not logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Include the database connection
include 'db_connection.php';

// Get the booking ID from the URL
$bookingId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Function to fetch booking details by ID
function fetchBookingById($conn, $id) {
    $stmt = $conn->prepare("SELECT * FROM bookings WHERE id = ? UNION SELECT * FROM child_dedication_bookings WHERE id = ? UNION SELECT * FROM funeral_service_bookings WHERE id = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("iii", $id, $id, $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Fetch booking details
$booking = fetchBookingById($conn, $bookingId);

if (!$booking) {
    echo "<h2>Booking not found.</h2>";
    exit();
}

// Determine the booking type and price
$price = 0;
$bookingType = '';
$bookingName = '';

// Check the booking details to set type and price
if (isset($booking['name']) && !empty($booking['name'])) { // Baptism booking
    $price = 700;
    $bookingType = 'Baptism';
    $bookingName = $booking['name'];
} elseif (isset($booking['child_name']) && !empty($booking['child_name'])) { // Child dedication
    $price = 300;
    $bookingType = 'Child Dedication';
    $bookingName = $booking['child_name'];
} elseif (isset($booking['deceased_name']) && !empty($booking['deceased_name'])) { // Funeral service
    $price = 500;
    $bookingType = 'Funeral Service';
    $bookingName = $booking['deceased_name'];
} else {
    echo "<h2>Booking type not recognized.</h2>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Freedom of Praise Church</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }

        header {
            background-color: #007bff;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        main {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        h1 {
            color: #343a40;
            margin-bottom: 10px;
        }

        p {
            font-size: 16px;
            color: #495057;
            margin: 5px 0;
        }

        h3 {
            color: #28a745;
            margin-top: 20px;
        }

        h2 {
            color: #343a40;
            margin-top: 30px;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }

        input[type="radio"] {
            margin-right: 10px;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        .total-amount {
            font-size: 20px;
            font-weight: bold;
            color: #28a745;
        }
    </style>
</head>
<body>

<header>
    <h2>Freedom of Praise Church - Payment</h2>
</header>

<main>
    <h1>Payment for <?= htmlspecialchars($bookingType); ?></h1>
    <p>Booking ID: <?= htmlspecialchars($booking['id']); ?></p>
    <p>Name: <?= htmlspecialchars($bookingName); ?></p>
    <p>Email: <?= htmlspecialchars($booking['email'] ?? $booking['parent_email'] ?? $booking['contact_email']); ?></p>
    <p>Date: <?= htmlspecialchars($booking['booking_date'] ?? $booking['dedication_date'] ?? $booking['service_date']); ?></p>
    <h3 class="total-amount">Total Amount: $<?= $price; ?></h3>

    <h2>Select Payment Method</h2>
    <form action="process_payment.php" method="POST">
        <input type="hidden" name="booking_id" value="<?= htmlspecialchars($booking['id']); ?>">
        <input type="hidden" name="amount" value="<?= $price; ?>">
        
        <label>
            <input type="radio" name="payment_type" value="gcash" required>
            GCash
        </label>
        
        <label>
            <input type="radio" name="payment_type" value="paypal" required>
            PayPal
        </label>

        <button type="submit">Confirm Payment</button>
    </form>
</main>

</body>
</html>
