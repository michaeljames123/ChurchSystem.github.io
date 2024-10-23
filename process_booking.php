<?php 
session_start();

$servername = "localhost"; // Change if needed
$username = "root"; // Change if needed
$password = ""; // Change if needed
$dbname = "bookings"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process booking
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate input
    $type = $_POST['type']; // Get the booking type

    if ($type == "Baptism") {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $date = $_POST['date'];
        $username = $_POST['username'];

        // Check required fields
        if (empty($name) || empty($email) || empty($date) || empty($username))  {
            $_SESSION['error_message'] = "All fields are required!";
            echo "<script>alert('All fields are required!'); window.location.href='book.php';</script>";
            exit();
        }

        // Prepare and bind for baptism
        $stmt = $conn->prepare(
            "INSERT INTO bookings (name, email, booking_date, service_type, username ) VALUES (?, ?, ?, ?, ?)"
        );

        $service_type = "Baptism"; // Service type for baptism
        $stmt->bind_param("sssss", $name, $email, $date, $service_type, $username );

    } elseif ($type == "Child Dedication") {
        $parent_name = trim($_POST['parent_name']);
        $parent_email = trim($_POST['parent_email']);
        $child_name = trim($_POST['child_name']);
        $dedication_date = $_POST['dedication_date'];
        $username = $_POST['username'];

        if (empty($parent_name) || empty($parent_email) || empty($child_name) || empty($dedication_date) || empty($username)) {
            $_SESSION['error_message'] = "All fields are required!";
            echo "<script>alert('All fields are required!'); window.location.href='book.php';</script>";
            exit();
        }

        // Prepare and bind for child dedication
        $stmt = $conn->prepare(
            "INSERT INTO child_dedication_bookings (parent_name, parent_email, child_name, dedication_date, username) VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("sssss", $parent_name, $parent_email, $child_name, $dedication_date, $username );

    } elseif ($type == "Funeral Service") {
        $deceased_name = trim($_POST['deceased_name']);
        $contact_person = trim($_POST['contact_person']);
        $contact_email = trim($_POST['contact_email']);
        $service_date = $_POST['service_date'];
        $username = $_POST['username'];

        if (empty($deceased_name) || empty($contact_person) || empty($contact_email) || empty($service_date) || empty($username)) {
            $_SESSION['error_message'] = "All fields are required!";
            echo "<script>alert('All fields are required!'); window.location.href='book.php';</script>";
            exit();
        }

        // Prepare and bind for funeral service
        $stmt = $conn->prepare(
            "INSERT INTO funeral_service_bookings (deceased_name, contact_person, contact_email, service_date, username) VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("sssss", $deceased_name, $contact_person, $contact_email, $service_date, $username);
    }

    // Execute the statement
if ($stmt->execute()) {
    // Set a success message with reservation details
    $_SESSION['success_message'] = "Booking successful! Your reservation for a " . $service_type . " has been confirmed. We will contact you soon.";
    echo "<script>alert('Booking successful! Your reservation for a " . $service_type . " has been confirmed. We will contact you soon.'); window.location.href='book.php';</script>";
} else {
    $_SESSION['error_message'] = "Error: " . $stmt->error;
    echo "<script>alert('Error: " . $stmt->error . "'); window.location.href='book.php';</script>";
}

    $stmt->close();
    $conn->close();

    exit();
}
?>
