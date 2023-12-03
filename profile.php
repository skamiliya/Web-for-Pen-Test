<?php
include 'config.php'; // Database connection
// Memeriksa apakah cookie 'login' ada
$isLoggedIn = isset($_COOKIE['login']);
if (!isset($_COOKIE['login'])) {
    header('Location: login.php');
    exit();
}

// Mengambil user ID dari URL
$user_id = isset($_GET['id']) ? $_GET['id'] : '';

// Mengambil username dari database berdasarkan user_id
$stmt = $conn->prepare("SELECT username FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$username = '';
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row['username'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
     <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">News</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto"> <!-- Perubahan di sini -->
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <?php if ($isLoggedIn): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Log Out</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <h1>Welcome, <?php echo htmlspecialchars($username); ?></h1>
        <p>Ini adalah halaman profil Anda.</p>

       <!-- Formulir perubahan password -->
        <form action="change_password.php" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($user_id); ?>">
            <div class="form-group">
                <label for="newPassword">New Password:</label>
                <input type="password" class="form-control" id="newPassword" name="newPassword" required>

                <label for="confirmNewPassword">Confirm New Password:</label>
                <input type="password" class="form-control" id="confirmNewPassword" name="confirmNewPassword" required>
            </div>
            <button type="submit" class="btn btn-primary" name="changePassword">Change Password</button>
        </form>

    </div>

    <!-- Bootstrap JS, Popper.js, dan jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
