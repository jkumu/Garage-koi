<?php
session_start();

// Ensure only logged-in garage owners can access this page
if (!isset($_SESSION['email']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'garage_owner') {
    header("Location: login1.php");
    exit();
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'garagekoi'); // Replace with your database credentials
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT booking.id, registar.name , booking_date FROM booking, registar WHERE booking.user_id=registar.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Reservations - GarageKoi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <style>
        body {
            background-color: #F4ECD8;
            color: #333;
        }
        .table-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        .back-button {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="table-container">
        <h2 class="text-center">Your Reservations</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Reservation ID</th>
                    <th>Customer Name</th>
                    <th>Reservation Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($result as $reservation) {
                    echo "<tr>
                        <td>{$reservation['id']}</td>
                        <td>{$reservation['name']}</td>
                        <td>{$reservation['booking_date']}</td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="back-button">
            <a href="garage_owner_home.php" class="btn btn-warning">Go Back</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
