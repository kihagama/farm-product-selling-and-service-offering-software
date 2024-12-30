<?php
include 'connect.php';

$id = (int) $_GET['id'];
$result = $conn->query("SELECT * FROM officers WHERE id = $id");

if ($row = $result->fetch_assoc()) {
    ?>
    <form action="officer_actions.php" method="POST" enctype="multipart/form-data" class="officer-form">
        <input type="hidden" name="action" value="edit">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

        <label for="name">Name</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>

        <label for="specialty">Specialty</label>
        <input type="text" name="specialty" value="<?php echo htmlspecialchars($row['specialty']); ?>" required>

        <label for="experience">Experience (Years)</label>
        <input type="number" name="experience" value="<?php echo $row['experience']; ?>" required>

        <label for="qualifications">Qualifications</label>
        <textarea name="qualifications" required><?php echo htmlspecialchars($row['qualifications']); ?></textarea>

        <label for="contact">Contact</label>
        <input type="text" name="contact" value="<?php echo htmlspecialchars($row['contact']); ?>" required>

        <label for="email">Email</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>

        <label for="photo">Upload Photo</label>
        <input type="file" name="photo" accept="image/*">

        <button type="submit" class="submit-btn">Update Officer</button>
    </form>
    <?php
} else {
    echo "Officer not found.";
}

$conn->close();
?>

<style>
    /* General form styling */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f7fc;
        margin: 0;
        padding: 0;
    }

    .officer-form {
        background-color: white;
        max-width: 600px;
        margin: 30px auto;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .officer-form h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .officer-form label {
        font-weight: bold;
        margin-bottom: 8px;
        display: block;
        color: #555;
    }

    .officer-form input,
    .officer-form textarea {
        width: 100%;
        padding: 12px;
        margin: 8px 0 20px 0;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }

    .officer-form input[type="file"] {
        padding: 0;
    }

    .officer-form textarea {
        height: 120px;
    }

    .submit-btn {
        background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
        font-size: 16px;
    }

    .submit-btn:hover {
        background-color: #45a049;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .officer-form {
            padding: 15px;
            margin: 15px;
        }

        .officer-form h2 {
            font-size: 1.5rem;
        }

        .officer-form input,
        .officer-form textarea,
        .submit-btn {
            font-size: 16px;
        }
    }

    @media (max-width: 480px) {
        .officer-form {
            padding: 10px;
            margin: 10px;
        }

        .submit-btn {
            font-size: 14px;
        }
    }
</style>