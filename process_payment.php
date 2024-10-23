<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booking_id = intval($_POST['booking_id']);
    $total_amount = floatval($_POST['total_amount']);
    $payment_type = htmlspecialchars($_POST['payment_type']);

    // Here, you can add your payment processing logic using the payment type
    // For now, we will just simulate success

    echo "<h1>Payment Successful</h1>";
    echo "<p>Booking ID: " . $booking_id . "</p>";
    echo "<p>Total Amount: $" . number_format($total_amount, 2) . "</p>";
    echo "<p>Payment Method: " . ucfirst($payment_type) . "</p>";
    echo "<p>Thank you for your payment!</p>";

    // Optionally, you can redirect to a confirmation page or send a confirmation email
} else {
    echo "Invalid request.";
}
?>
