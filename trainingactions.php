<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booking_id = intval($_POST['booking_id']);
    $action = $_POST['action'];

    if ($action === 'confirm') {
        $sql = "UPDATE bookings SET status = 'confirmed' WHERE id = ?";
    } elseif ($action === 'cancel') {
        $sql = "UPDATE bookings SET status = 'cancelled' WHERE id = ?";
    } elseif ($action === 'delete') {
        $sql = "DELETE FROM bookings WHERE id = ?";
    } else {
        header("Location: admin.php?error=Invalid action");
        exit();
    }

    // Execute the SQL query
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $booking_id);
    if ($stmt->execute()) {
        header("Location: admin.php?success=Action completed successfully");
    } else {
        header("Location: admin.php?error=Action failed: " . $stmt->error);
    }
    $stmt->close();
}

$conn->close();
?>