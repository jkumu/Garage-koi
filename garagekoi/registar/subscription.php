<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'general_user') {
    header("Location: login1.php");
    exit();
}
$user_name = $_SESSION['email']; // User email as a placeholder for the user's name
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription - GarageKoi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <style>
        body {
            background-color: #F4ECD8;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
        }
        .card {
            margin-bottom: 20px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        .btn-custom {
            background-color: #333;
            color: #fff;
            font-weight: bold;
            border: none;
            transition: background-color 0.3s;
        }
        .btn-custom:hover {
            background-color: #FFD700;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Subscription Plans</h2>
        
        <!-- One Day Plan -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">One Day Plan</h5>
                <p class="card-text">Price: 150 taka / day</p>
                <p class="card-text">Features: Access to parking search and booking.</p>
                <a href="payment.php?plan=one_day" class="btn btn-custom w-100">Subscribe</a>
            </div>
        </div>

        <!-- Monthly Plan -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Monthly Plan</h5>
                <p class="card-text">Price: 3000 taka / month</p>
                <p class="card-text">Features: Everything in Basic + priority support.</p>
                <a href="payment.php?plan=monthly" class="btn btn-custom w-100">Subscribe</a>
            </div>
        </div>

        <!-- Annual Plan -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Annual Plan</h5>
                <p class="card-text">Price: 31200 taka / year</p>
                <p class="card-text">Features: All Premium benefits + two free months.</p>
                <a href="payment.php?plan=annual" class="btn btn-custom w-100">Subscribe</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
