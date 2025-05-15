<?php
session_start(); // Start the session
include 'connect.php';
$login_error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Check if user exists
    $sql = "SELECT * FROM registar WHERE email = '$email' AND password = '$password' AND role = '$role'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $num = mysqli_num_rows($result);
        if ($num == 1) {
            // Fetch user details
            $user = mysqli_fetch_assoc($result);
            $_SESSION['email'] = $user['email']; // Store email in session
            $_SESSION['role'] = $user['role'];  // Store role in session
            $_SESSION['user_id'] = $user['id']; 
            $_SESSION['name'] = $user['name']; 

            // Redirect user based on their role
            if ($role === 'garage_owner') {
                header("Location: garage_owner_home.php");
            } elseif ($role === 'general_user') {
                header("Location: user_home.php");
            }
            exit();
        } else {
            $login_error = "Invalid credentials. Please try again.";
        }
    } else {
        $login_error = "Error connecting to the database: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - GarageKoi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <style>
        body {
            background-color: #F4ECD8;
            color: #333;
        }
        .navbar {
            background-color: #FFD700;
            padding: 10px 20px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand {
            font-weight: bold;
            color: #333;
        }
        .form-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .alert {
            background-color: #F8D7DA;
            color: #842029;
            border: none;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">GarageKoi</a>
        </div>
    </nav>
    <div class="form-container">
        <h2 class="text-center">Login</h2>
        <?php if (!empty($login_error)): ?>
            <div class="alert text-center" role="alert">
                <?php echo $login_error; ?>
            </div>
        <?php endif; ?>
        <form action="login1.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-select" id="role" name="role" required>
                    <option value="">Select Role</option>
                    <option value="garage_owner">Garage Owner</option>
                    <option value="general_user">General User</option>
                </select>
            </div>
            <button type="submit" class="btn btn-warning w-100">Login</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>