<?php
$success = 0;
$userExists = 0; // Initialize $userExists to avoid undefined variable warning
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $role = $_POST['role'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    // Check if the user already exists in the `registar` table
    $sql = "SELECT * FROM registar WHERE name = '$name' OR email = '$email'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $num = mysqli_num_rows($result);

        if ($num > 0) {
            // User already exists
            $userExists = 1;

            // Update the role if the user already exists
            $sql = "UPDATE registar SET role = '$role' WHERE name = '$name' OR email = '$email'";
            $updateResult = mysqli_query($conn, $sql);

            if (!$updateResult) {
                die("Error updating role: " . mysqli_error($conn));
            }
        } else {
            // Insert a new user
            $sql = "INSERT INTO registar (name, email, age, gender, role, phone, password)
                    VALUES ('$name', '$email', '$age', '$gender', '$role', '$phone', '$password')";
            $insertResult = mysqli_query($conn, $sql);

            if ($insertResult) {
                $success = 1;
            } else {
                die("Error inserting new user: " . mysqli_error($conn));
            }
        }

        // Redirect to login page after successful sign-up or role update
        header("Location: login1.php");
        exit();
    } else {
        die("Error checking user existence: " . mysqli_error($conn));
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - GarageKoi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <style>
        body {
            background-color: #F4ECD8;
        }
        .form-container {
            max-width: 500px;
            margin: 100px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2 class="text-center">Sign Up</h2>
        <form action="sign.php" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="number" class="form-control" id="age" name="age" required>
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select class="form-select" id="gender" name="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-select" id="role" name="role" required>
                    <option value="general_user">General User</option>
                    <option value="garage_owner">Garage Owner</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="tel" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-warning w-100">Sign Up</button>
        </form>
        <?php if ($userExists): ?>
            <div class="alert alert-danger mt-3">User already exists!</div>
        <?php elseif ($success): ?>
            <div class="alert alert-success mt-3">Sign up successful!</div>
        <?php endif; ?>
    </div>
</body>
</html>
