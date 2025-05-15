<?php
session_start();
$plan = $_GET['plan'] ?? '';
$prices = ['one_day' => 150, 'monthly' => 3000, 'annual' => 31200];
$price = $prices[$plan] ?? 0;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    header("Location: success.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Card Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #F4ECD8;">
    <div class="container mt-5">
        <h3 class="text-center">Card Payment</h3>
        <form method="POST" class="mt-4 col-md-6 mx-auto">
            <div class="mb-3">
                <label for="bank" class="form-label">Select Bank</label>
                <select class="form-select" name="bank" required>
                    <option value="">Choose Bank</option>
                    <option>Bank Asia</option>
                    <option>BRAC Bank</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="card" class="form-label">Card Number</label>
                <input type="text" class="form-control" name="card" required>
            </div>
            <p><strong>Amount:</strong> <?php echo $price; ?> Taka</p>
            <button type="submit" class="btn btn-success w-100">Make Payment</button>
        </form>
    </div>
</body>
</html>
