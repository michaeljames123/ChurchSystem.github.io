<?php
require 'db_connection.php';

$type = $_GET['type'] ?? '';

$query = $db->prepare("SELECT booking_date FROM bookings WHERE booking_type = ?");
$query->execute([$type]);

$dates = $query->fetchAll(PDO::FETCH_COLUMN);
echo json_encode($dates);
?>
