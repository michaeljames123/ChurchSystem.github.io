<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
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

// Get the booking ID and type from the URL
$bookingId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$table = isset($_GET['table']) ? $_GET['table'] : '';

// Fetch the current booking data
$bookingData = null;
if ($table) {
    $stmt = $conn->prepare("SELECT * FROM $table WHERE id = ?");
    $stmt->bind_param("i", $bookingId);
    $stmt->execute();
    $result = $stmt->get_result();
    $bookingData = $result->fetch_assoc();
}

// Handle form submission to update the booking
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize input
    $data = [];
    foreach ($_POST as $key => $value) {
        $data[$key] = $conn->real_escape_string($value);
    }

    // Build update query based on table type
    if ($table === 'bookings') {
        $updateQuery = "UPDATE bookings SET name = '{$data['name']}', email = '{$data['email']}', booking_date = '{$data['booking_date']}' WHERE id = $bookingId";
    } elseif ($table === 'child_dedication_bookings') {
        $updateQuery = "UPDATE child_dedication_bookings SET parent_name = '{$data['parent_name']}', parent_email = '{$data['parent_email']}', child_name = '{$data['child_name']}', dedication_date = '{$data['dedication_date']}' WHERE id = $bookingId";
    } elseif ($table === 'funeral_service_bookings') {
        $updateQuery = "UPDATE funeral_service_bookings SET deceased_name = '{$data['deceased_name']}', contact_person = '{$data['contact_person']}', contact_email = '{$data['contact_email']}', service_date = '{$data['service_date']}' WHERE id = $bookingId";
    }

    // Execute update
    if ($conn->query($updateQuery) === TRUE) {
        header("Location: bookings.php"); // Redirect back to bookings page after successful update
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h2 {
            text-align: center;
        }
        form {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        input[type="text"],
        input[type="email"],
        input[type="date"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4A90E2;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #357ABD;
        }
    </style>
</head>
<body>

<h2>Edit Booking</h2>

<form action="edit_booking.php?id=<?= $bookingId ?>&table=<?= $table ?>" method="POST">
    <?php if ($table === 'bookings'): ?>
        <label>Name:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($bookingData['name']) ?>" required>
        
        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($bookingData['email']) ?>" required>
        
        <label>Booking Date:</label>
        <input type="date" name="booking_date" value="<?= htmlspecialchars($bookingData['booking_date']) ?>" required>
        
    <?php elseif ($table === 'child_dedication_bookings'): ?>
        <label>Parent's Name:</label>
        <input type="text" name="parent_name" value="<?= htmlspecialchars($bookingData['parent_name']) ?>" required>
        
        <label>Parent's Email:</label>
        <input type="email" name="parent_email" value="<?= htmlspecialchars($bookingData['parent_email']) ?>" required>
        
        <label>Child's Name:</label>
        <input type="text" name="child_name" value="<?= htmlspecialchars($bookingData['child_name']) ?>" required>
        
        <label>Dedication Date:</label>
        <input type="date" name="dedication_date" value="<?= htmlspecialchars($bookingData['dedication_date']) ?>" required>
        
    <?php elseif ($table === 'funeral_service_bookings'): ?>
        <label>Deceased's Name:</label>
        <input type="text" name="deceased_name" value="<?= htmlspecialchars($bookingData['deceased_name']) ?>" required>
        
        <label>Contact Person:</label>
        <input type="text" name="contact_person" value="<?= htmlspecialchars($bookingData['contact_person']) ?>" required>
        
        <label>Contact Email:</label>
        <input type="email" name="contact_email" value="<?= htmlspecialchars($bookingData['contact_email']) ?>" required>
        
        <label>Service Date:</label>
        <input type="date" name="service_date" value="<?= htmlspecialchars($bookingData['service_date']) ?>" required>
        
    <?php endif; ?>

    <input type="submit" value="Update Booking">
</form>

</body>
</html>
