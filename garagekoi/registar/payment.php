<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'general_user') {
    header("Location: login1.php");
    exit();
}

$plan = $_GET['plan'] ?? 'unknown';
$prices = [
    'one_day' => 150,
    'monthly' => 3000,
    'annual' => 31200
];
$price = $prices[$plan] ?? 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Select Payment Method</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #F4ECD8;">
    <div class="container mt-5">
        <h3 class="text-center mb-4">Select Payment Method</h3>
        <div class="d-grid gap-3 col-6 mx-auto">
            <a href="bkash_nagad.php?plan=<?php echo $plan; ?>&method=bkash" class="btn btn-danger">Pay with bKash</a>
            <a href="bkash_nagad.php?plan=<?php echo $plan; ?>&method=nagad" class="btn btn-warning">Pay with Nagad</a>
            <a href="card.php?plan=<?php echo $plan; ?>" class="btn btn-dark">Pay with Card</a>
        </div>
    </div>
</body>
</html>
