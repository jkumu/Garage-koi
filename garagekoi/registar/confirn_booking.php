<?php
session_start();
include 'connect.php';

// Ensure only logged-in users can access this page
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'general_user') {
    header("Location: login1.php");
    exit();
}

// Check if booking details are available
if (!isset($_GET['garage_id'])) {
    echo "No booking information provided!";
    exit();
}

$garage_id = $_GET['garage_id'];

// Fetch the garage details from the database
$sql = "SELECT id, garage_name, location, capacity FROM garages WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $garage_id);
$stmt->execute();
$result = $stmt->get_result();
$garage = $result->fetch_assoc();

// Check if the garage exists
if (!$garage) {
    echo "Garage not found!";
    exit();
}

// Process the confirmation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id']; // Assuming `user_id` is stored in session
    $booking_date = date("Y-m-d H:i:s"); // Current timestamp
    $status = "Confirmed";

    // Insert the booking into the database
    $sql = "INSERT INTO bookings (user_id, garage_id, booking_date, status) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiss", $user_id, $garage_id, $booking_date, $status);

    if ($stmt->execute()) {
        $success_message = "Booking has been successfully confirmed!";
    } else {
        $error_message = "There was an issue confirming your booking. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Booking - GarageKoi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #F4ECD8;
            color: #333;
        }
        .navbar-custom {
            background-color: #FFD700;
        }
        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: #333;
        }
        .navbar-custom .nav-link:hover {
            color: #fff;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        .btn-custom {
            background-color: #FFD700;
            color: #333;
            font-weight: bold;
            border: none;
            transition: background-color 0.3s;
        }
        .btn-custom:hover {
            background-color: #333;
            color: #fff;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">GarageKoi</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
                <!-- Go Back Button -->
                <button class="btn btn-custom ms-auto" onclick="history.back()">Go Back</button>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <h2 class="text-center mb-4">Confirm Your Booking</h2>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body">
                        <?php if (isset($success_message)): ?>
                            <div class="alert alert-success">
                                <?php echo $success_message; ?>
                            </div>
                        <?php elseif (isset($error_message)): ?>
                            <div class="alert alert-danger">
                                <?php echo $error_message; ?>
                            </div>
                        <?php else: ?>
                            <h5 class="card-title"><?php echo htmlspecialchars($garage['garage_name']); ?></h5>
                            <p><strong>Location:</strong> <?php echo htmlspecialchars($garage['location']); ?></p>
                            <p><strong>Capacity:</strong> <?php echo htmlspecialchars($garage['capacity']); ?></p>
                            <form method="POST" action="">
                                <div class="mb-3">
                                    <label for="bookingDate" class="form-label">Booking Date</label>
                                    <input type="text" class="form-control" id="bookingDate" value="<?php echo date('Y-m-d H:i:s'); ?>" readonly>
                                </div>
                                <button type="submit" class="btn btn-custom">Confirm Booking</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
