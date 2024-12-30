<?php
include 'connect.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - NanaAgricFarm</title>
    <link rel="stylesheet" href="adm.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <nav>
        <div class="logo">Admin Panel</div>
        <button class="menu-toggle" onclick="toggleMenu()">☰</button>
        <ul id="menu">
            <li><a href="#dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="#products"><i class="fas fa-box"></i> Manage Products</a></li>
            <li><a href="#training"><i class="fas fa-chalkboard-teacher"></i> Manage Training</a></li>
            <li><a href="#users"><i class="fas fa-users"></i> Manage Users</a></li>
            <li><a href="index.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </nav>
    <div class="wrapper">




        <div class="admin-container">
            <h1 class="admin-header">Welcome, Admin</h1>
            <!-- Manage Products booking -->
            <h1>Manage product Orders</h1>

            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>Product ID</th>
                        <th>Contact Info</th>
                        <th>Booking Date</th>
                        <th>Status</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $conn->query("SELECT * FROM booking");
                    while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['user_id']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['product_id']; ?></td>
                            <td><?php echo $row['contact_info']; ?></td>
                            <td><?php echo $row['booking_date']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td><?php echo $row['price']; ?></td>
                            <td>
                                <form method="POST" style="display:inline;" action="admin_actions.php">
                                    <input type="hidden" name="booking_id" value="<?php echo $row['id']; ?>">
                                    <input type="hidden" name="action" value="confirm">
                                    <button type="submit">Confirm</button>
                                </form>
                                <form method="POST" style="display:inline;" action="admin_actions.php">
                                    <input type="hidden" name="booking_id" value="<?php echo $row['id']; ?>">
                                    <input type="hidden" name="action" value="cancel">
                                    <button type="submit">Cancel</button>
                                </form>
                                <form method="POST" style="display:inline;" action="admin_actions.php">
                                    <input type="hidden" name="booking_id" value="<?php echo $row['id']; ?>">
                                    <input type="hidden" name="action" value="delete">
                                    <button type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <!--session bookings-->
            <h1>Manage Training Bookings</h1>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Officer Name</th>
                        <th>Specialty</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>User Name</th>
                        <th>User Contact</th>
                        <th>Booking Date</th>
                        <th>Booking Time</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch bookings from the database
                    $sql = "SELECT * FROM bookings";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['officer_name']}</td>
                        <td>{$row['officer_specialty']}</td>
                        <td>{$row['officer_contact']}</td>
                        <td>{$row['officer_email']}</td>
                        <td>{$row['user_name']}</td>
                        <td>{$row['user_contact']}</td>
                        <td>{$row['booking_date']}</td>
                        <td>{$row['booking_time']}</td>
                        <td>{$row['status']}</td>
                        <td>
                            <form method='POST' style='display:inline;' action='trainingactions.php'>
                                <input type='hidden' name='booking_id' value='{$row['id']}'>
                                <input type='hidden' name='action' value='confirm'>
                                <button type='submit' class='btn-action btn-confirm'>Confirm</button>
                            </form>
                            <form method='POST' style='display:inline;' action='trainingactions.php'>
                                <input type='hidden' name='booking_id' value='{$row['id']}'>
                                <input type='hidden' name='action' value='cancel'>
                                <button type='submit' class='btn-action btn-cancel'>Cancel</button>
                            </form>
                            <form method='POST' style='display:inline;' action='trainingactions.php'>
                                <input type='hidden' name='booking_id' value='{$row['id']}'>
                                <input type='hidden' name='action' value='delete'>
                                <button type='submit' class='btn-action btn-delete'>Delete</button>
                            </form>
                        </td>
                    </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='11'>No bookings found.</td></tr>";
                    }


                    ?>
                </tbody>
            </table>

            <!-- Manage Products Section -->
            <div class="card" id="products">
                <h3>Manage Products</h3>
                <p>Add, edit, or remove farm products.</p>

                <!-- Add Product Form -->
                <form action="product_actions.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="add">
                    <input type="text" name="name" placeholder="Product Name" required>
                    <textarea name="description" placeholder="Description" required></textarea>
                    <input type="number" name="price" placeholder="Price" required step="0.01">
                    <input type="file" name="image" accept="image/*" required>
                    <button type="submit">Add Product</button>
                </form>

                <!-- Product List -->
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $conn->query("SELECT * FROM products");
                        while ($row = $result->fetch_assoc()) {
                            $imagePath = htmlspecialchars($row['image']);
                            echo "<tr>
                        <td>{$row['id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['description']}</td>
                            <td>shs.{$row['price']}</td>
                            <td><img src='$imagePath' alt='Product Image' width='100'></td>
                            <td>
                                <form action='product_actions.php' method='POST' style='display:inline;'>
                                    <input type='hidden' name='action' value='delete'>
                                    <input type='hidden' name='id' value='{$row['id']}'>
                                    <button type='submit'>Delete</button>
                                </form>
                                <form action='product_edit.php' method='GET' style='display:inline;'>
                                    <input type='hidden' name='id' value='{$row['id']}'>
                                    <button type='submit'>Edit</button>
                                </form>
                            </td>
                        </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Manage Users Section -->
        <div class="card" id="users">
            <h3>Manage Users</h3>
            <p>Add, edit, or remove users.</p>

            <!-- Add User Form -->
            <form action="user_actions.php" method="POST">
                <input type="hidden" name="action" value="add">
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>

                <!-- Role Selection -->
                <label for="role">User Role:</label>
                <select name="role" id="role" required>
                    <option value="0">Regular User</option>
                    <option value="1">Admin</option>
                </select>

                <button type="submit">Add User</button>
            </form>

            <!-- User List -->
            <table>
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $userResult = $conn->query("SELECT * FROM users");
                    while ($user = $userResult->fetch_assoc()) {
                        $role = $user['role'] == 1 ? 'Admin' : 'Regular User';
                        echo "<tr>
                            <td>{$user['username']}</td>
                            <td>{$user['email']}</td>
                            <td>{$role}</td>
                            <td>
                                <form action='user_actions.php' method='POST' style='display:inline;'>
                                    <input type='hidden' name='action' value='delete'>
                                    <input type='hidden' name='id' value='{$user['id']}'>
                                    <button type='submit'>Delete</button>
                                </form>
                                <form action='user_edit.php' method='GET' style='display:inline;'>
                                    <input type='hidden' name='id' value='{$user['id']}'>
                                    <button type='submit'>Edit</button>
                                </form>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>



        <!-- Manage Agricultural Officers Section -->
        <div class="card" id="agriculture-officers">
            <h3>Manage Agricultural Officers</h3>
            <p>Add, edit, or remove agricultural officers' information.</p>

            <!-- Add Officer Form -->
            <form action="officer_actions.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="add">
                <input type="text" name="name" placeholder="Full Name" required>
                <input type="text" name="specialty" placeholder="Specialty" required>
                <input type="number" name="experience" placeholder="Years of Experience" required>
                <textarea name="qualifications" placeholder="Qualifications" required></textarea>
                <input type="text" name="contact" placeholder="Contact Number" required>
                <input type="email" name="email" placeholder="Email Address" required>
                <input type="file" name="photo" accept="image/*" required>
                <button type="submit">Add Officer</button>
            </form>

            <!-- Officers List -->
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Specialty</th>
                        <th>Experience</th>
                        <th>Qualifications</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Photo</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch officers from the database
                    $result = $conn->query("SELECT * FROM officers");
                    while ($row = $result->fetch_assoc()) {
                        $photoPath = htmlspecialchars($row['photo']);
                        echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['specialty']}</td>
                    <td>{$row['experience']} years</td>
                    <td>{$row['qualifications']}</td>
                    <td>{$row['contact']}</td>
                    <td>{$row['email']}</td>
                    <td><img src='$photoPath' alt='Officer Photo' width='100'></td>
                    <td>
                        <form action='officer_actions.php' method='POST' style='display:inline;'>
                            <input type='hidden' name='action' value='delete'>
                            <input type='hidden' name='id' value='{$row['id']}'>
                            <button type='submit'>Delete</button>
                        </form>
                        <form action='officer_edit.php' method='GET' style='display:inline;'>
                            <input type='hidden' name='id' value='{$row['id']}'>
                            <button type='submit'>Edit</button>
                        </form>
                    </td>
                </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function toggleMenu() {
            const menu = document.getElementById('menu');
            menu.classList.toggle('active');
        }

    </script>
</body>


</html>

<?php mysqli_close($conn); ?>