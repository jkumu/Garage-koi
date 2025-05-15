<?php
session_start();

if (!isset($_SESSION['email']) || !isset($_SESSION['user_id'])) {
    header("Location: login1.php");
    exit();
}

$loggedInUserId = $_SESSION['user_id'];

$conn = new mysqli('localhost', 'root', '', 'garagekoi');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT g.garage_name, b.booking_date 
        FROM booking b 
        JOIN garages g ON b.garage_id = g.id 
        WHERE b.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $loggedInUserId);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Bookings</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #F4ECD8;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
        }
        .main-container {
            display: flex;
            min-height: 100vh;
            justify-content: center;
            align-items: center;
        }
        .card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            width: 100%;
            overflow: hidden;
            display: flex;
            flex-wrap: wrap;
        }
        .card-left {
            background-color: #FFE699;
            padding: 30px;
            flex: 1 1 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card-left img {
            max-width: 100%;
            height: auto;
        }
        .card-right {
            flex: 1 1 50%;
            padding: 40px;
        }
        h2 {
            font-weight: bold;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            margin-bottom: 20px;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
        }
        thead {
            background-color: #333;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .btn-back {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 500;
            display: inline-block;
        }
        .btn-back:hover {
            background-color: #FFD700;
            color: #000;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="card">
            
            <div class="card-right">
                <h2>Your Bookings</h2>
                <?php if ($result->num_rows > 0): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Garage Name</th>
                                <th>Booking Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['garage_name']) ?></td>
                                    <td><?= htmlspecialchars($row['booking_date']) ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>You have no bookings yet.</p>
                <?php endif; ?>
                <a href="user_home.php" class="btn-back">← Go Back</a>
            </div>
        </div>
    </div>
</body>
</html>
