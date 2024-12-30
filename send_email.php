<?php
// Load PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Adjust the path to PHPMailer based on your project structure
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Ensure this is a POST request
    // Collect form data
    $userEmail = $_POST['email'];
    $userMessage = $_POST['message'];

    // Validate inputs
    if (filter_var($userEmail, FILTER_VALIDATE_EMAIL) && !empty($userMessage)) {
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
            $mail->setFrom($userEmail, 'Website User');
            $mail->addAddress('ismaelkihagama@gmail.com'); // Your email address

            // Email content
            $mail->isHTML(false);
            $mail->Subject = 'Message from Website User';
            $mail->Body = "You have received a message from your website:\n\nEmail: $userEmail\n\nMessage:\n$userMessage";

            // Send the email
            $mail->send();

            // Show custom alert on success
            echo "
            <div class='custom-alert'>
                <div class='alert-content'>
                    <h2>Success</h2>
                    <p>Your message has been successfully submitted. We shall attend to you within minutes.</p>
                    <button onclick='closeAlert()'>OK</button>
                </div>
            </div>
            <script>
                function closeAlert() {
                    document.querySelector('.custom-alert').style.display = 'none';
                    window.location.href = 'aboutUs.php'; // Redirect to a desired page
                }
            </script>";
        } catch (Exception $e) {
            // Show custom alert on error
            echo "
            <div class='custom-alert'>
                <div class='alert-content'>
                    <h2>Error</h2>
                    <p>Message could not be sent. Mailer Error: {$mail->ErrorInfo}</p>
                    <button onclick='closeAlert()'>Retry</button>
                </div>
            </div>
            <script>
                function closeAlert() {
                    document.querySelector('.custom-alert').style.display = 'none';
                    window.history.back();
                }
            </script>";
        }
    } else {
        // Show custom alert for invalid input
        echo "
        <div class='custom-alert'>
            <div class='alert-content'>
                <h2>Invalid Input</h2>
                <p>Please provide a valid email address and message.</p>
                <button onclick='closeAlert()'>Retry</button>
            </div>
        </div>
        <script>
            function closeAlert() {
                document.querySelector('.custom-alert').style.display = 'none';
                window.history.back();
            }
        </script>";
    }
} else {
    echo "
    <div class='custom-alert'>
        <div class='alert-content'>
            <h2>Invalid Request</h2>
            <p>Only POST requests are allowed.</p>
            <button onclick='closeAlert()'>Back</button>
        </div>
    </div>
    <script>
        function closeAlert() {
            document.querySelector('.custom-alert').style.display = 'none';
            window.history.back();
        }
    </script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        /* Custom Alert Styling */
        .custom-alert {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .alert-content {
            background: #fff;
            padding: 20px;
            width: 90%;
            max-width: 400px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.3s ease;
        }

        .alert-content h2 {
            margin: 0;
            color: #4caf50;
            font-size: 24px;
        }

        .alert-content p {
            margin: 15px 0;
            color: #555;
            font-size: 16px;
        }

        .alert-content button {
            background: #4caf50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .alert-content button:hover {
            background: #45a049;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @media (max-width: 480px) {
            .alert-content {
                padding: 15px;
            }

            .alert-content h2 {
                font-size: 20px;
            }

            .alert-content p {
                font-size: 14px;
            }

            .alert-content button {
                font-size: 14px;
                padding: 8px 16px;
            }
        }
    </style>
</head>

<body>

</body>

</html>