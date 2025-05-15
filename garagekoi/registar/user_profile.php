<?php
session_start();

// Check if user is logged in and role is general_user
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'general_user') {
    header("Location: login1.php");
    exit();
}

// Include DB connection
require_once('connect.php'); // adjust path if needed

// Get email from session
$email = $_SESSION['email'];

// Simple query to verify user by email
$sql = "SELECT email FROM registar WHERE email = '$email'";
$result = $conn->query($sql);

// Check if user exists
if ($result->num_rows > 0) {
    $message = "User verified successfully.";
} else {
    $message = "User not found.";
}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile Information - GarageKoi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <style>
        body {
            background-color: #F4ECD8;
        }
        .form-container {
            max-width: 500px;
            margin: 100px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2 class="text-center mb-4">Profile Information</h2>
        <form>
            <div class="mb-3">
                <label for="full_name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="full_name" name="full_name" required>
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="number" class="form-control" id="age" name="age" required>
            </div>
            <div class="mb-3">
                <label for="nid" class="form-label">NID Number</label>
                <input type="text" class="form-control" id="nid" name="nid" required>
            </div>
            <div class="mb-3">
                <label for="vehicle_number" class="form-label">Vehicle Number</label>
                <input type="text" class="form-control" id="vehicle_number" name="vehicle_number" required>
            </div>
            <button type="submit" class="btn btn-warning w-100">Submit</button>
        </form>
    </div>
</body>
</html>
