<?php
include "connect.php";
session_start();

// Load PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Adjust the path to PHPMailer based on your project structure
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the form
    $user_id = $_POST['user-id'];
    $username = $_POST['booking-username'];
    $product_id = $_POST['product-id'];
    $productprice = $_POST['booking-price'];
    $contact_info = $_POST['booking-contact'];
    $booking_date = date('Y-m-d H:i:s'); // Current timestamp
    $status = 'pending'; // Default status

    // Prepare the SQL query to insert booking into the database
    $sql = "INSERT INTO booking (user_id, username, product_id, contact_info, booking_date, status, price) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Correct type definition: "isisssd"
        $stmt->bind_param("isisssd", $user_id, $username, $product_id, $contact_info, $booking_date, $status, $productprice);

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

            // Send email notification
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
                $mail->addAddress('ismaelkihagama@gmail.com'); // Admin email

                // Set the reply-to address to the user's email
                $mail->addReplyTo($userEmail, $username); // Reply to the user's email

                // Email content
                $mail->isHTML(false);
                $mail->Subject = 'New Booking Confirmation';
                $mail->Body = "You have a new booking request:\n\n
                Product: $product_id\n
                Username: $username\n
                Contact Info: $contact_info\n
                Price: $productprice\n
                Booking Date: $booking_date\n
                Status: $status";

                // Send the email
                $mail->send();

                // Redirect to product page with a success message
                header("Location: product.php?message=booking_success");
                exit();
            } catch (Exception $e) {
                echo "Error sending email: {$mail->ErrorInfo}";
            }
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing the statement: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request.";
}
?>