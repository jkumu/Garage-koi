<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'garage_owner') {
    header("Location: login1.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $garagename = $_POST['garagename'];
    $location = $_POST['location'];
    $capacity = $_POST['capacity'];
    $owner_id = $_SESSION['user_id'];
    $amount = $_POST['amount'];

    $sql = "INSERT INTO garages (garage_name, location, capacity, owner_id, amount)
            VALUES ('$garagename', '$location', '$capacity', '$owner_id', '$amount')";
    $insertResult = mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Garage - GarageKoi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background: linear-gradient(to bottom right, #FFEFBA, #FFD700);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .form-box {
        background-color: #fff;
        max-width: 700px;
        margin: 80px auto;
        padding: 50px 40px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    .form-box h2 {
        text-align: center;
        font-weight: bold;
        margin-bottom: 30px;
        position: relative;
    }

    .form-box h2::after {
        content: '';
        display: block;
        width: 80px;
        height: 3px;
        background-color: #FFD700;
        margin: 10px auto 0;
        border-radius: 2px;
    }

    .form-label {
        font-weight: bold;
    }

    .btn-submit {
        background-color: #FFD700;
        color: #333;
        font-weight: bold;
        border: none;
        padding: 12px 24px;
        border-radius: 10px;
    }

    .btn-submit:hover {
        background-color: #e6c200;
        color: white;
    }
    </style>

</head>
<body>

    <div class="form-box">
        <h2>Add Garage</h2>
        <form action="add_garage.php" method="POST">
            <div class="mb-3">
                <label for="garagename" class="form-label">Garage Name</label>
                <input type="text" class="form-control" id="garagename" name="garagename" required>
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" name="location" required>
            </div>
            <div class="mb-3">
                <label for="capacity" class="form-label">Capacity</label>
                <input type="number" class="form-control" id="capacity" name="capacity" required>
            </div>
            <div class="mb-3">
                <label for="amount" class="form-label">Amount (Tk.)</label>
                <input type="number" class="form-control" id="amount" name="amount" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-submit">Add Garage</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
