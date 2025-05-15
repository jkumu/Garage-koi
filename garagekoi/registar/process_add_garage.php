<?php
session_start();

// Ensure only logged-in garage owners can access this page
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'garage_owner') {
    header("Location: login1.php");
    exit();
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'garagekoi'); // Replace with your DB credentials

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data
$garagename = $_POST['garagename'];
$location = $_POST['location'];
$capacity = $_POST['capacity'];
$owner_id = $_SESSION['user_id']; // Ensure user_id is stored in session during login

// Insert data into the database
$stmt = $conn->prepare("INSERT INTO garages (garage_name, location, capacity, owner_id) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssii", $garage_name, $location, $capacity, $owner_id);

if ($stmt->execute()) {
    // Redirect to garage owner homepage with a success message
    header("Location: garage_owner_home.php?success=1");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
