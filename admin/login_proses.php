<?php
$servername = "localhost"; // Ganti dengan server Anda
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "esport"; // Ganti dengan nama database Anda

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data dari form
$username = $_POST['username'];
$password = $_POST['password'];

// Query untuk mengambil data pengguna
$sql = "SELECT * FROM member WHERE username='$username' AND password='$password' AND profile='admin'"; // Ganti 'users' sesuai dengan tabel Anda
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Login berhasil
    session_start();
    $_SESSION['username'] = $username; // Simpan username di session
    header("Location: dashboard.php"); // Ganti dengan halaman yang ingin dituju setelah login
} else {
    // Login gagal
    header("Location: index.php?error=Invalid Login");
}

$conn->close();
?>
