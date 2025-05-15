<?php
session_start();

// Redirect to login if user not logged in
if (!isset($_SESSION['email']) || !isset($_SESSION['user_id'])) {
    header("Location: login1.php");
    exit();
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'garagekoi');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if garage_id is passed
if (!isset($_GET['garage_id'])) {
    echo "Invalid request.";
    exit();
}

$garage_id = $_GET['garage_id'];
$user_id = $_SESSION['user_id'];
$booking_date = date("Y-m-d H:i:s");

// Insert the booking into the database
$stmt = $conn->prepare("INSERT INTO booking (user_id, garage_id, booking_date) VALUES (?, ?, ?)");
$stmt->bind_param("iis", $user_id, $garage_id, $booking_date);

$success = false;
if ($stmt->execute()) {
    $success = true;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f4e3;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }
        .message-box {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        a.btn-home {
            margin-top: 20px;
            color: #333;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="message-box">
        <h2>
            <?php echo $success ? "✅ Booking successfully created!" : "❌ Booking failed. Please try again."; ?>
        </h2>
        <a href="user_home.php" class="btn btn-warning btn-home">Back to Homepage</a>
    </div>
</body>
</html>
