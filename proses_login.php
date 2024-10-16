<?php
$servername = "localhost"; // Ganti dengan server Anda
$usename = "root"; // Ganti dengan usename database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "esport"; // Ganti dengan nama database Anda

// Buat koneksi
$conn = new mysqli($servername, $usename, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data dari form
$usename = $_POST['usename']; // Mengganti dengan nama kolom yang benar 'usename'
$password = $_POST['password'];

// Query untuk mengambil data pengguna
$sql = "SELECT * FROM member WHERE usename=? AND password=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $usename, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Ambil data pengguna
    $user = $result->fetch_assoc();
    
    session_start();
    setcookie("usename", $usename, time() + (3600)); //1 hari disimpan ke dalam cookies
    
    // Cek profile pengguna
    if ($user['profile'] === 'admin') {
        header("Location: admin/index.php"); // Halaman untuk admin
    } elseif ($user['profile'] === 'member') {
        header("Location: index.php"); // Halaman untuk member
    } else {
        header("Location: index.php?error=Invalid Profile");
    }
} else {
    // Login gagal
    header("Location: index.php?error=Invalid Login");
}

$conn->close();
?>
