<?php
session_start();
include 'connect.php';

// Ensure only logged-in users can access this page
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'general_user') {
    header("Location: login1.php");
    exit();
}

// Handle location-based search
$search = '';
$result = null;

if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
    $search = trim($_GET['search']);
    $stmt = $conn->prepare("SELECT id, garage_name, location, capacity FROM garages WHERE location LIKE ?");
    $likeSearch = "%" . $search . "%";
    $stmt->bind_param("s", $likeSearch);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Parking - GarageKoi</title>
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
        .garage-card {
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            margin-bottom: 20px;
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <button class="btn btn-custom ms-auto" onclick="history.back()">Go Back</button>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <h2 class="text-center mb-4">Find Parking</h2>

        <!-- Search Bar -->
        <form method="GET" class="mb-4 d-flex justify-content-center">
            <input type="text" name="search" class="form-control me-2" style="max-width: 400px;" placeholder="Search by location" value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit" class="btn btn-custom">Search</button>
        </form>

        <div class="row">
            <?php if ($result !== null): ?>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="col-md-4">
                            <div class="card garage-card">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($row['garage_name']); ?></h5>
                                    <p class="card-text">
                                        <strong>Location:</strong> <?php echo htmlspecialchars($row['location']); ?><br>
                                        <strong>Capacity:</strong> <?php echo htmlspecialchars($row['capacity']); ?>
                                    </p>
                                    <a href="book_garage.php?garage_id=<?php echo $row['id']; ?>" class="btn btn-custom">Book Now</a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="text-center">No garages found in this location.</p>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>