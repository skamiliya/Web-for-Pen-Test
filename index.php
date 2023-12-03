<?php

include 'config.php'; // Database connection
// Memeriksa apakah cookie 'login' ada
$isLoggedIn = isset($_COOKIE['login']);
$username = $isLoggedIn ? $_COOKIE['login'] : 'Guest';

// Mengambil user_id dari database berdasarkan username
$stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

$user_id = 0;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_id = $row['id'];
}

// Membaca data JSON dari file
$newsJson = file_get_contents('news_data.json');
$newsData = json_decode($newsJson, true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .card {
        display: flex;
        flex-direction: column;
    }

    .card-body {
        flex: 1; /* Meregangkan body card untuk mengisi ruang */
    }
</style>


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
                    <a class="nav-link" href="profile.php?id=<?php echo htmlspecialchars($user_id); ?>">Profile</a>
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


    <!-- Konten Halaman -->
    <div class="container mt-4">
        <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
        <!-- Konten lainnya bisa ditambahkan di sini -->
    </div>

    <!-- Tempat menampilkan berita -->
    <div class="container mt-4">
    <h2>Berita Terkini</h2>
    <div class="row">
        <?php foreach ($newsData as $newsItem): ?>
            <div class="col-md-4 mb-3 d-flex align-items-stretch"> <!-- Gunakan class d-flex dan align-items-stretch -->
                <div class="card w-100"> <!-- Gunakan w-100 untuk lebar penuh -->
                    <!-- Contoh jika ada gambar: <img src="path_to_image" class="card-img-top" alt="..."> -->
                    <div class="card-body d-flex flex-column"> <!-- Gunakan d-flex flex-column untuk konten card -->
                        <h5 class="card-title"><?php echo htmlspecialchars($newsItem['title']); ?></h5>
                        <p class="card-text flex-grow-1"><?php echo htmlspecialchars($newsItem['content']); ?></p> <!-- flex-grow-1 memungkinkan paragraf ini tumbuh dan mengisi ruang -->
                        <div class="mt-auto">
                            <p class="card-text"><small class="text-muted">Penulis: <?php echo htmlspecialchars($newsItem['author']); ?></small></p>
                            <p class="card-text"><small class="text-muted">Tanggal: <?php echo htmlspecialchars($newsItem['date']); ?></small></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>



 
    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
