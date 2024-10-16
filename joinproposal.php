<?php
// Mulai sesi untuk mengakses cookie dan memeriksa status login
session_start();
if (!isset($_COOKIE["usename"])) {
    header("Location: login.php");
    exit();
}

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "esport");
if ($conn->connect_errno) {
    die("Failed to connect to MySQL: " . $conn->connect_error);
}

// Mendapatkan informasi member yang login
$usename = $_COOKIE['usename'];
$memberQuery = "SELECT idmember FROM member WHERE usename = ?";
$stmt = $conn->prepare($memberQuery);
$stmt->bind_param("s", $usename);
$stmt->execute();
$memberResult = $stmt->get_result();
$member = $memberResult->fetch_assoc();
$idmember = $member['idmember'];

// Mendapatkan semua tim dari database
$teamQuery = "SELECT * FROM team";
$teamsResult = $conn->query($teamQuery);

// Proses submit form proposal join
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idteam = $_POST['idteam'];
    $description = $_POST['description'];

    // Cek apakah member sudah mengajukan proposal untuk team tersebut
    $checkQuery = "SELECT * FROM join_proposal WHERE idmember = ? AND idteam = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("ii", $idmember, $idteam);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<p>Anda sudah mendaftar atau anda ditolak oleh team.</p>";
    } else {
        // Menambahkan proposal join ke database
        $insertQuery = "INSERT INTO join_proposal (idmember, idteam, description, status) VALUES (?, ?, ?, 'waiting')";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("iis", $idmember, $idteam, $description);
        if ($stmt->execute()) {
            echo "<p>Proposal bergabung berhasil diajukan. Status: waiting</p>";
        } else {
            echo "<p>Terjadi kesalahan saat mengajukan proposal.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Proposal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            box-sizing: border-box;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Join a Team</h1>

    <table>
        <tr>
            <th>Nama Tim</th>
            <th>Action</th>
        </tr>
        <?php while ($team = $teamsResult->fetch_assoc()): ?>
            <tr>
                <td><?php echo $team['name']; ?></td>
                <td>
                    <form action="joinproposal.php" method="POST">
                        <input type="hidden" name="idteam" value="<?php echo $team['idteam']; ?>">
                        <textarea name="description" placeholder="Tulis alasan ingin join..." required></textarea>
                        <button type="submit">Ajukan Proposal</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    

</body>
</html>

<?php
// Tutup koneksi
$conn->close();
?>
