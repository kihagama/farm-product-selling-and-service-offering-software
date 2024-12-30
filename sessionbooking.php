<?php
// sessionbooking.php

// Start session
session_start();

include 'connect.php';

// Load PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Adjust the path to PHPMailer based on your project structure
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and fetch form data
    $officer_id = htmlspecialchars($_POST['officer_id']);
    $officer_name = htmlspecialchars($_POST['officer_name']);
    $officer_specialty = htmlspecialchars($_POST['officer_specialty']);
    $officer_contact = htmlspecialchars($_POST['officer_contact']);
    $officer_email = htmlspecialchars($_POST['officer_email']);

    $user_id = htmlspecialchars($_POST['user_id']);
    $user_name = htmlspecialchars($_POST['user_name']);
    $user_contact = htmlspecialchars($_POST['user_contact']);

    $booking_date = htmlspecialchars($_POST['booking_date']);
    $booking_time = htmlspecialchars($_POST['booking_time']);

    // SQL query to insert booking data into the database
    $sql = "INSERT INTO bookings (officer_id, officer_name, officer_specialty, officer_contact, officer_email, user_id, user_name, user_contact, booking_date, booking_time)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "isssssssss",
        $officer_id,
        $officer_name,
        $officer_specialty,
        $officer_contact,
        $officer_email,
        $user_id,
        $user_name,
        $user_contact,
        $booking_date,
        $booking_time
    );

    // Execute the query and check for success
    if ($stmt->execute()) {
        // Fetch the user's email from the users table
        $userEmailQuery = "SELECT email FROM users WHERE id = ?";
        $stmtEmail = $conn->prepare($userEmailQuery);
        $stmtEmail->bind_param("i", $user_id);
        $stmtEmail->execute();
        $stmtEmail->bind_result($userEmail);
        $stmtEmail->fetch();
        $stmtEmail->close();

        // Send email notification using PHPMailer
        $mail = new PHPMailer(true);

        try {
            // SMTP server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'ismaelkihagama@gmail.com'; // Replace with your Gmail address
            $mail->Password = 'ufvd grdr rudw bqib';       // Replace with your App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Sender and recipient settings
            $mail->setFrom('ismaelkihagama@gmail.com', 'Your Website'); // Use your valid email address here
            $mail->addAddress('ismaelkihagama@gmail.com'); // Send to officer's email

            // Set the reply-to address to the user's email
            $mail->addReplyTo($userEmail, $user_name); // Reply to the user's email

            // Email content
            $mail->isHTML(false);
            $mail->Subject = 'New Booking Confirmation';
            $mail->Body = "You have a new booking request:\n\n
            Officer: $officer_name ($officer_specialty)\n
            User: $user_name\n
            Contact Info: $user_contact\n
            Booking Date: $booking_date\n
            Booking Time: $booking_time";

            // Send the email
            $mail->send();


            // Redirect to Training page
            header("Location: Training.php?message=success");
            exit();

        } catch (Exception $e) {
            echo "Error sending email: {$mail->ErrorInfo}";
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>