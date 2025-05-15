<?php
session_start();

if (!isset($_SESSION['email']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'garage_owner') {
    header("Location: login1.php");
    exit();
}

$owner_name = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Garage Owner Home - GarageKoi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <style>
        body {
            background-color: #FFD700;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .center-box {
            background-color: white;
            max-width: 1100px;
            height: 600px;
            margin: 80px auto;
            padding: 60px 50px 40px;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .top-buttons {
            position: absolute;
            top: 25px;
            right: 40px;
        }

        .top-buttons a {
            background-color: #FFD700;
            border: none;
            font-weight: bold;
            padding: 8px 16px;
            border-radius: 8px;
            color: #333;
            text-decoration: none;
            margin-left: 10px;
        }

        .top-buttons a:hover {
            background-color: #e6c200;
            color: white;
        }

        .center-box h2 {
            font-weight: bold;
            margin-top: 80px;
            margin-bottom: 20px;
        }

        .center-box p {
            font-size: 1.1rem;
            margin-bottom: 40px;
        }

        .btn-custom {
            background-color: #FFD700;
            color: #333;
            font-weight: bold;
            border: none;
            padding: 12px 24px;
            margin: 15px;
            border-radius: 10px;
            font-size: 1.1rem;
        }

        .btn-custom:hover {
            background-color: #e6c200;
            color: #fff;
        }
    </style>
</head>
<body>

    <div class="center-box text-center">
        <div class="top-buttons">
            <a href="profile.php">Profile</a>
            <a href="logout.php">Logout</a>
        </div>

        <h2>Welcome, <?php echo htmlspecialchars($owner_name); ?>!</h2>
        <p>Manage your garage efficiently with GarageKoi. Use the options below to update your listings or check bookings.</p>
        <div>
            <a href="add_garage.php" class="btn btn-custom">Add Garage</a>
            <a href="view_reservations.php" class="btn btn-custom">View Reservations</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
