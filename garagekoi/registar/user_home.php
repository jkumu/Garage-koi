<?php 
session_start();
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'general_user') {
    header("Location: login1.php");
    exit();
}
$user_name = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Home - GarageKoi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #F4ECD8;
            color: #333;
            font-family: 'Segoe UI', sans-serif;
        }
        .navbar {
            background-color: #FFD700;
            padding: 10px 30px;
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand {
            font-weight: bold;
            color: #333;
            font-size: 1.8rem;
        }
        .nav-link {
            font-weight: bold;
            color: #333;
        }
        .nav-link:hover {
            color: #000;
        }
        .main-container {
            max-width: 700px;
            margin: 100px auto;
            text-align: center;
            padding: 40px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        .welcome-message {
            font-size: 1.5rem;
            margin-bottom: 30px;
        }
        .btn-custom {
            background-color: #333;
            color: #fff;
            font-weight: bold;
            border: none;
            padding: 12px 25px;
            margin: 10px;
            transition: 0.3s;
        }
        .btn-custom:hover {
            background-color: #FFD700;
            color: #333;
        }
        .btn-custom i {
            margin-right: 8px;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="#">GarageKoi</a>
        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="subscription.php"><i class="bi bi-star-fill"></i> Subscription</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="user_profile.php"><i class="bi bi-person-circle"></i> Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="main-container">
        <div class="welcome-message">
            Welcome, <strong><?php echo htmlspecialchars($user_name); ?></strong>!<br>Enjoy your time at <span style="color:#FFD700;">GarageKoi</span>.
        </div>
        <a href="find_parking.php" class="btn btn-custom"><i class="bi bi-car-front-fill"></i> Find Parking</a>
        <a href="view_bookings.php" class="btn btn-custom"><i class="bi bi-calendar-check-fill"></i> View My Bookings</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
