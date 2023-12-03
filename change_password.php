<?php
include 'config.php'; // Database connection

if (isset($_POST['changePassword']) && isset($_POST['id'])) {
    $user_id = $_POST['id'];
    $newPassword = $_POST['newPassword'];
    $confirmNewPassword = $_POST['confirmNewPassword'];

    // Cek apakah kedua password cocok
    if ($newPassword !== $confirmNewPassword) {
        echo "<script>alert('Password baru dan konfirmasi password tidak cocok.'); window.location='profile.php';</script>";
        exit();
    }

    // Hash password baru (gunakan metode yang lebih aman seperti password_hash dalam aplikasi nyata)
    $newPasswordHash = md5($newPassword);

    // Update password di database
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
    $stmt->bind_param("si", $newPasswordHash, $user_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Password berhasil diubah.'); window.location='profile.php';</script>";
    } else {
        echo "<script>alert('Gagal mengubah password atau tidak ada perubahan pada password.'); window.location='profile.php';</script>";
    }
} else {
    echo "<script>alert('Data tidak lengkap.'); window.location='profile.php';</script>";
}
?>
