<?php
include 'producthandle.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NanaAgricFarm - Training Booking</title>
    <link rel="icon" href="path/to/your/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="training.css">
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
            color: white;
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

        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            z-index: 1000;
            left: 0;
            top: -30px;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .modal-content label {
            color: black;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .booking-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .booking-card {
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            width: 300px;
            text-align: center;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .booking-card:hover {
            transform: translateY(-5px);
        }

        .booking-header h3 {
            margin: 0;
            font-size: 1.2em;
            color: #333;
        }

        .booking-status {
            display: inline-block;
            margin-top: 5px;
            padding: 5px 10px;
            font-size: 0.9em;
            font-weight: bold;
            border-radius: 5px;
            color: #fff;
        }

        .booking-status.confirmed {
            background-color: #28a745;
            /* Green */
        }

        .booking-status.pending {
            background-color: #ffc107;
            /* Yellow */
        }

        .booking-status.cancelled {
            background-color: #dc3545;
            /* Red */
        }

        .booking-body {
            margin-top: 10px;
            text-align: left;
            color: #555;
        }

        .booking-body p {
            margin: 5px 0;
        }

        .no-booking {
            text-align: center;
            font-size: 1.1em;
            color: #777;
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
            <li><a href="aboutUs2.php"><i class="fas fa-info-circle"></i> About Us</a></li>
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

    <!-- Training Officers Section -->
    <section id="officers">
        <div class="officers-container">
            <h2>Meet Our Agriculture Officers</h2>
            <div class="officers-cards">
                <?php
                // Fetch officers from the database
                $result = $conn->query("SELECT * FROM officers");
                while ($row = $result->fetch_assoc()) {
                    $photoPath = htmlspecialchars($row['photo']);

                    echo "
                <div class='card'>
                    <img src='$photoPath' alt='{$row['name']}'> <!-- Officer photo -->
                    <h3 id='officerid'>{$row['name']}</h3>
                    <p>Specialty: {$row['specialty']}</p>
                    <p>Experience: {$row['experience']} years</p>
                    <p>Qualifications: {$row['qualifications']}</p>
                    <p>Contact: {$row['contact']}</p>
                    <p>Email: <a href='mailto:{$row['email']}'>{$row['email']}</a></p>
                    <button class='book-session-btn' 
                        data-id='{$row['id']}' 
                        data-name='{$row['name']}'
                        data-specialty='{$row['specialty']}'
                        data-contact='{$row['contact']}'
                        data-email='{$row['email']}'>Book Session</button>
                </div>";
                }
                ?>
            </div>
        </div>
    </section>




    <!-- Overlay for booking form -->
    <div id="booking-overlay" class="overlay">
        <div class="form-container">
            <button class="close-btn" onclick="closeBookingForm()">×</button>

            <h2>Booking</h2>
            <form action="sessionbooking.php" method="POST">
                <!-- Officer Information -->
                <input type="text" id="officer-id" name="officer_id" readonly hidden>
                <label for="officer-name">Name:</label>
                <input type="text" id="officer-name" name="officer_name" readonly>

                <label for="officer-specialty">Specialty:</label>
                <input type="text" id="officer-specialty" name="officer_specialty" readonly>

                <input type="text" id="officer-contact" name="officer_contact" readonly hidden>
                <input type="text" id="officer-email" name="officer_email" readonly hidden>

                <!-- User Information -->


                <input type="text" id="user-id" name="user_id" value="<?php echo htmlspecialchars($user['id']); ?>"
                    readonly hidden>


                <input type="text" id="user-name" name="user_name"
                    value="<?php echo htmlspecialchars($user['username']); ?>" readonly hidden>


                <input type="text" id="user-contact" name="user_contact"
                    value="<?php echo htmlspecialchars($user['phone']); ?>" readonly hidden>

                <!-- Booking Information -->

                <label for="booking-date">Preferred Date:</label>
                <input type="date" id="booking-date" name="booking_date" required>

                <label for="booking-time">Start Time:</label>
                <input type="time" id="booking-time" name="booking_time" required>

                <button type="submit">Submit Booking</button>
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

        // When a "Book Session" button is clicked
        document.querySelectorAll('.book-session-btn').forEach(button => {
            button.addEventListener('click', function () {
                // Get officer data from the button's data attributes
                const officerId = this.getAttribute('data-id');
                const officerName = this.getAttribute('data-name');
                const officerSpecialty = this.getAttribute('data-specialty');
                const officerContact = this.getAttribute('data-contact');
                const officerEmail = this.getAttribute('data-email');

                // Populate the booking form with officer data
                document.getElementById('officer-id').value = officerId;
                document.getElementById('officer-name').value = officerName;
                document.getElementById('officer-specialty').value = officerSpecialty;
                document.getElementById('officer-contact').value = officerContact;
                document.getElementById('officer-email').value = officerEmail;
            });
        });
        // Open modal
        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'block';
        }
        // Function to close the booking form overlay
        function closeBookingForm() {
            document.getElementById('booking-overlay').style.display = 'none';
        }

        // Close the booking overlay
        function closeBookingForm() {
            document.getElementById('booking-overlay').style.display = 'none';
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
    <script src="training.js"></script>
    <script src="index.js"></script>
</body>

</html>