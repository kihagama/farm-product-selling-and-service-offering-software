<?php
include "producthandle.php";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NanaAgricFarm</title>
    <!-- Favicon placeholder -->
    <link rel="icon" href="path/to/your/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="aboutUs.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        /* Dropdown menu styling */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 170px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            right: 0;
            /* Aligns dropdown to the right */
            border-radius: 5px;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            font-size: 14px;
        }

        .dropdown-content a i {
            margin-right: 8px;
            /* Adds space between icons and text */
            color: #3e8e41;
            /* Matches hover color for consistency */
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: #3e8e41;
            color: white;
            /* Improves visibility on hover */
            transition: background-color 0.3s ease;
        }

        .dropbtn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Modal Overlay Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            overflow: auto;
            padding: 20px;
        }

        .modal-content {
            background-color: #fff;
            margin: auto;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            animation: fadeIn 0.4s ease-in-out;
        }

        .modal h2 {
            color: black;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Modal Header */
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .modal-header h2 {
            font-size: 1.8rem;
            color: #333;
            font-family: 'Arial', sans-serif;
            margin: 0;

        }

        .close {
            font-size: 30px;
            color: #aaa;
            cursor: pointer;
        }

        .close:hover {
            color: #333;
        }

        /* Modal Body */
        .modal-body {
            font-family: 'Arial', sans-serif;
            color: #555;
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        /* Form Styling */
        .form-group {
            margin-bottom: 20px;
        }

        .modal button {
            margin-top: 10px;
        }

        label {
            font-size: 1rem;
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-top: 5px;
            box-sizing: border-box;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #3498db;
        }

        textarea {
            resize: vertical;
            height: 150px;
        }

        /* Submit Button */
        .btn-submit {
            background-color: #3498db;
            color: white;
            font-size: 1rem;
            padding: 12px 20px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
            margin-top: 15px;
            /* Added margin to create space between input fields and button */
        }

        .btn-submit:hover {
            background-color: #2980b9;
        }

        /* Footer */
        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 20px;
        }

        .btn-close {
            background-color: #e74c3c;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        .btn-close:hover {
            background-color: #c0392b;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .modal-content {
                padding: 15px;
                width: 80%;
            }

            .modal-header h2 {
                font-size: 1.5rem;
            }

            .form-group {
                margin-bottom: 15px;
            }
        }

        /* Booking Card Styling */
        .booking-list {
            list-style: none;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .booking-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            background: #fff;
            width: 300px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .booking-card:hover {
            transform: translateY(-5px);
        }

        .booking-image {
            height: 180px;
            overflow: hidden;
            background: #f9f9f9;
        }

        .booking-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .booking-header {
            padding: 10px 15px;
            background: #007bff;
            color: #fff;
            text-align: center;
        }

        .booking-header h3 {
            margin: 0;
            font-size: 1.2rem;
        }

        .booking-body {
            padding: 15px;
            line-height: 1.5;
        }

        .booking-status {
            display: inline-block;
            margin-top: 5px;
            padding: 5px 10px;
            border-radius: 5px;
            background-color: #ffc107;
            color: #000;
            font-size: 0.9rem;
        }

        .booking-status.pending {
            background-color: #ffc107;
        }

        .booking-status.confirmed {
            background-color: #28a745;
            color: #fff;
        }

        .booking-status.cancelled {
            background-color: #dc3545;
            color: #fff;
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav>
        <div class="logo">NanaAgricFarm</div>
        <button class="menu-toggle" onclick="toggleMenu()">☰</button>
        <ul>
            <li><a href="aboutUs.php"><i class="fas fa-info-circle"></i> About Us</a></li>
            <li><a href="user.php"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="product.php"><i class="fas fa-box"></i> Products</a></li>
            <li><a href="Training.php"><i class="fas fa-chalkboard-teacher"></i> Training</a></li>
            <li>
                <div class="dropdown">
                    <button class="dropbtn">
                        <i class="fas fa-user-circle"></i> Profile: <?php echo htmlspecialchars($username); ?>
                    </button>
                    <div class="dropdown-content">
                        <a href="#" onclick="openModal('myProductModal')"><i class="fas fa-box"></i> My Product</a>
                        <a href="#" onclick="openModal('myTrainingModal')"><i class="fas fa-calendar-alt"></i> My
                            Training</a>
                        <a href="#" onclick="openModal('updateProfileModal')"><i class="fas fa-user-edit"></i> Update
                            Profile</a>
                        <a href="index.php" style="color: red;"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                </div>
            </li>

        </ul>
    </nav>

    <!-- Modals -->
    <!-- My Product Modal -->
    <div id="myProductModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('myProductModal')">&times;</span>
            <h2>My Bookings</h2>
            <p>Here, are your booking details.</p>
            <ul class="booking-list">
                <?php
                if ($result_product_booking->num_rows > 0) {
                    while ($booking = $result_product_booking->fetch_assoc()) {
                        echo "
        <li class='booking-card'>
            <div class='booking-image'>
                <img src='" . htmlspecialchars($booking['product_image']) . "' alt='" . htmlspecialchars($booking['product_name']) . "'>
            </div>
            <div class='booking-header'>
                <h3>" . htmlspecialchars($booking['product_name']) . "</h3>
                <span class='booking-status " . htmlspecialchars($booking['status']) . "'>" . ucfirst($booking['status']) . "</span>
            </div>
            <div class='booking-body'>
                <p><strong>Price:</strong> shs. " . htmlspecialchars($booking['price']) . "</p>
                <p><strong>Contact:</strong> " . htmlspecialchars($booking['contact_info']) . "</p>
                <p><strong>Date:</strong> " . htmlspecialchars($booking['booking_date']) . "</p>
            </div>
        </li>";
                    }
                } else {
                    echo "<li class='no-booking'>No bookings found.</li>";
                }
                ?>
            </ul>

        </div>
    </div>

    <!-- My Training Modal -->
    <div id="myTrainingModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('myTrainingModal')">&times;</span>
            <h2>My Training Sessions</h2>
            <p>Here, are your training session details.</p>
            <ul class="booking-list">
                <?php
                if ($result_training_booking->num_rows > 0) {
                    while ($booking = $result_training_booking->fetch_assoc()) {
                        echo "
                <li class='booking-card'>
                    <div class='booking-header'>
                        <img src='" . htmlspecialchars($booking['officer_photo']) . "' alt='Officer Photo' class='officer-photo'>
                        <h3>" . htmlspecialchars($booking['officer_name']) . " (" . htmlspecialchars($booking['officer_specialty']) . ")</h3>
                        <span class='booking-status " . htmlspecialchars($booking['status']) . "'>" . ucfirst($booking['status']) . "</span>
                    </div>
                    <div class='booking-body'>
                        <p><strong>Date:</strong> " . htmlspecialchars($booking['booking_date']) . "</p>
                        <p><strong>Time:</strong> " . htmlspecialchars($booking['booking_time']) . "</p>
                    </div>
                </li>";
                    }
                } else {
                    echo "<li class='no-booking'>No training sessions booked.</li>";
                }
                ?>
            </ul>
        </div>
    </div>
    <!-- Update Profile Modal -->
    <div id="updateProfileModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('updateProfileModal')">&times;</span>
            <h2>Update Profile</h2>
            <form action="updateProfileHandler.php" method="POST">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username"
                    value="<?php echo htmlspecialchars($user['username']); ?>" required>

                <label for="currentpassword">Current Password:</label>
                <input type="password" name="currentpassword" id="currentpassword" required>

                <label for="newpassword">New Password:</label>
                <input type="password" name="newpassword" id="newpassword">

                <label for="phone">Phone:</label>
                <input type="text" name="phone" id="phone" value="<?php echo htmlspecialchars($user['phone']); ?>"
                    required>

                <button type="submit">Update Profile</button>
            </form>
        </div>
    </div>

    <!-- Overlay for login/signup form -->
    <div id="login-overlay" class="overlay">
        <div class="form-container">
            <button class="close-btn" onclick="closeLoginForm()">×</button>
            <h2 id="form-title">Login</h2>

            <!-- Login Form -->
            <form id="login-form" class="active-form" onsubmit="return validateLoginForm()">
                <input type="text" id="login-username" placeholder="Username" required>
                <input type="password" id="login-password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>

            <!-- Register Form -->
            <form id="register-form" onsubmit="return validateRegisterForm()">
                <input type="text" id="register-username" placeholder="Username" required>
                <input type="email" id="register-email" placeholder="Email" required>
                <input type="text" id="register-phone" placeholder="Phone Number" required>
                <input type="text" id="register-district" placeholder="District" required>
                <input type="password" id="register-password" placeholder="Password" required>
                <button type="submit">Register</button>
            </form>

            <div class="toggle-link">
                <p id="toggle-to-register">Don't have an account? <a href="#" onclick="toggleForms()">Register</a></p>
                <p id="toggle-to-login" style="display:none;">Already have an account? <a href="#"
                        onclick="toggleForms()">Login</a></p>
            </div>
        </div>
    </div>
    <header>
        <h1 class="fade-slide-in-header">Welcome to NanaAgricFarms</h1>
        <p class="fade-slide-in-header">Where agriculture meets the environment. Let's go green together</p>
    </header>

    <div class="content">
        <h2>About Us</h2>
        <div class="section">
            <div>
                <img src="ImagesAg/pexels-pixabay-235725.jpg" alt="Farm View">
                <p>
                    At NanaAgricFarm, we are dedicated to sustainable agriculture and promoting healthy lifestyles.
                    Our farm specializes in producing organic crops, fresh fruits, and vegetables while preserving the
                    environment.
                </p>
            </div>
            <div>
                <img src="ImagesAg/pexels-brettjordan-840111 (1).jpg" alt="Farm Team">
                <p>
                    Established in 2000, we have grown into a trusted source of premium agricultural products.
                    Our team is passionate about cultivating the land responsibly and sharing the benefits of organic
                    farming with the community.
                </p>
            </div>
        </div>

        <div class="cta">
            <a href="#">Contact Us for More Information</a>
        </div>

        <div class="contact-info">
            <p>Have questions? Reach out to us directly:</p>
            <p>Email: <a href="mailto:ismaelkihagama@gmail.com">ismaelkihagama@gmail.com</a></p>
            <p>Phone: <a href="tel:+256700750061">0700750061</a></p>
        </div>

        <div class="contact-form">
            <h3>Send Us a Message</h3>
            <form action="useremail.php" method="POST">
                <label for="email">Your Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="message">Your Message:</label>
                <textarea id="message" name="message" rows="5" required></textarea>

                <button type="submit">Send Message</button>
            </form>
        </div>
    </div>

    <!-- Footer Section -->
    <footer>
        <div class="footer-container">
            <div class="footer-column">
                <h3>About NanaAgricFarm</h3>
                <p>Your partner in sustainable farming. We deliver fresh products, provide farmer training, and use
                    innovative techniques to ensure a greener tomorrow.</p>
            </div>
            <div class="footer-column">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About Us</a></li>
                    <li><a href="#products">Products</a></li>
                    <li><a href="#training">Training</a></li>
                    <li><a href="#contact">Contact Us</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Follow Us</h3>
                <ul class="social-links">
                    <li><a href="https://x.com/YourFarmHandle" class="fab fa-x" target="_blank"
                            title="X (formerly Twitter)"></a></li>
                    <li><a href="https://www.linkedin.com/company/YourFarmLinkedIn" class="fab fa-linkedin"
                            target="_blank" title="LinkedIn"></a></li>
                    <!-- New social media links -->
                    <li><a href="https://www.facebook.com/YourFarmPage" class="fab fa-facebook" target="_blank"
                            title="Facebook"></a></li>
                    <li><a href="https://twitter.com/YourFarmHandle" class="fab fa-twitter" target="_blank"
                            title="Twitter"></a></li>
                    <li><a href="https://www.instagram.com/YourFarmHandle" class="fab fa-instagram" target="_blank"
                            title="Instagram"></a></li>
                    <li><a href="https://www.youtube.com/c/YourFarmChannel" class="fab fa-youtube" target="_blank"
                            title="YouTube"></a></li>
                    <li><a href="https://wa.me/1234567890" class="fab fa-whatsapp" target="_blank" title="WhatsApp"></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 NanaAgricFarm. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Open modal
        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'block';
        }

        // Close modal
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Close modal when clicking outside of it
        window.onclick = function (event) {
            const modals = document.querySelectorAll('.modal');
            modals.forEach(modal => {
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            });
        }
    </script>
    <script src="index.js"></script>
</body>

</html>