<?php
include 'config.php'; // Database connection

if (isset($_POST['register'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    $confirmPassword = $conn->real_escape_string($_POST['confirmPassword']);

    if ($password !== $confirmPassword) {
        echo "<script>alert('Password dan konfirmasi password tidak cocok.');</script>";
    } else {
        $passwordHash = md5($password); // Mengubah menjadi hash md5 (tidak direkomendasikan untuk produksi)

        // Query untuk menambahkan pengguna baru
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $passwordHash);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "<script>alert('Registrasi berhasil! Anda sekarang dapat login.'); window.location='login.php';</script>";
        } else {
            echo "<script>alert('Username sudah digunakan atau terjadi kesalahan.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mt-5">
                <div class="card-body">
                    <h3 class="card-title text-center">Register</h3>
                    <form action="register.php" method="post">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="confirmPassword">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="register">Register</button>
                    </form>
                    <p class="mt-2">Sudah punya akun? <a href="login.php">Login di sini.</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS, Popper.js, dan jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
