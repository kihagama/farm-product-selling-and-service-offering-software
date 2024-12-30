<?php
include 'connect.php';

// Determine the action
$action = $_POST['action'] ?? null;

if ($action === "add") {
    // Add a new officer
    $name = $_POST['name'];
    $specialty = $_POST['specialty'];
    $experience = (int) $_POST['experience'];
    $qualifications = $_POST['qualifications'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];

    // Handle file upload
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $photo = 'uploads/' . basename($_FILES['photo']['name']);
        move_uploaded_file($_FILES['photo']['tmp_name'], $photo);
    } else {
        die("Error uploading photo.");
    }

    $stmt = $conn->prepare("INSERT INTO officers (name, specialty, experience, qualifications, contact, email, photo) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssissss", $name, $specialty, $experience, $qualifications, $contact, $email, $photo);

    if ($stmt->execute()) {
        echo "Officer added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    header("Location: admin.php");
    exit;

} elseif ($action === "delete") {
    // Delete an officer
    $id = (int) $_POST['id'];

    // Fetch the photo path
    $result = $conn->query("SELECT photo FROM officers WHERE id = $id");
    if ($row = $result->fetch_assoc()) {
        $photoPath = $row['photo'];
        if (file_exists($photoPath)) {
            unlink($photoPath); // Delete the photo file
        }
    }

    $stmt = $conn->prepare("DELETE FROM officers WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Officer deleted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    header("Location: admin.php");
    exit;

} elseif ($action === "edit") {
    // Edit an officer
    $id = (int) $_POST['id'];
    $name = $_POST['name'];
    $specialty = $_POST['specialty'];
    $experience = (int) $_POST['experience'];
    $qualifications = $_POST['qualifications'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];

    $query = "UPDATE officers SET name = ?, specialty = ?, experience = ?, qualifications = ?, contact = ?, email = ?";
    $types = "ssisss";
    $params = [$name, $specialty, $experience, $qualifications, $contact, $email];

    // Handle optional photo update
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        // Fetch and delete the old photo
        $result = $conn->query("SELECT photo FROM officers WHERE id = $id");
        if ($row = $result->fetch_assoc()) {
            $oldPhoto = $row['photo'];
            if (file_exists($oldPhoto)) {
                unlink($oldPhoto); // Delete old photo
            }
        }

        $photo = 'uploads/' . basename($_FILES['photo']['name']);
        move_uploaded_file($_FILES['photo']['tmp_name'], $photo);

        $query .= ", photo = ?";
        $types .= "s";
        $params[] = $photo;
    }

    $query .= " WHERE id = ?";
    $types .= "i";
    $params[] = $id;

    $stmt = $conn->prepare($query);
    $stmt->bind_param($types, ...$params);

    if ($stmt->execute()) {
        echo "Officer updated successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    header("Location: admin.php");
    exit;

} else {
    echo "Invalid action.";
}

$conn->close();
?>