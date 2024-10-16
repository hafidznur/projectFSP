<?php
// Membuat koneksi
$conn = new mysqli("localhost", "root", "", "esport");
if ($conn->connect_errno) {
    die("Failed to connect to MySQL: " . $conn->connect_error);
}

// Pagination variables
$limit = 5; // Number of games per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page number
$offset = ($page - 1) * $limit; // Calculate the offset

// Query to count total games
$countQuery = "SELECT COUNT(*) as total FROM game";
$countResult = $conn->query($countQuery);
$totalGames = $countResult->fetch_assoc()['total'];
$totalPages = ceil($totalGames / $limit); // Calculate total pages

// Query to fetch game data
$query = "SELECT * FROM game LIMIT ? OFFSET ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $limit, $offset); // Bind the limit and offset parameters
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Game</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        background-color: #f8f9fa;
        color: #343a40;
    }
    h1 {
        text-align: center;
        color: #007bff;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    table, th, td {
        border: 1px solid #dee2e6;
    }
    th, td {
        padding: 12px;
        text-align: center;
    }
    th {
        background-color: #007bff;
        color: white;
    }
    tr:hover {
        background-color: #f1f1f1;
    }
    a {
        text-decoration: none;
        color: #007bff;
    }
    a:hover {
        text-decoration: underline;
    }
    .pagination {
        margin-top: 20px;
        text-align: center;
    }
    .pagination a {
        margin: 0 5px;
        padding: 10px 15px;
        text-decoration: none;
        color: white;
        background-color: #007bff;
        border-radius: 4px;
    }
    .pagination a:hover {
        background-color: #0056b3;
    }
    button, .button {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }
    button:hover, .button:hover {
        background-color: #0056b3;
    }
    .message {
        text-align: center;
        margin: 10px 0;
        color: green;
    }
    .action-cell {
        display: flex;
        justify-content: center;
        gap: 10px;
    }
</style>
</head>
<body>

    <h1 style="text-align: center;">Daftar Game</h1>

    <?php
        // Handling messages for insert, delete, edit
        if (isset($_GET['hasil'])) {
            echo "<p class='message'>" . ($_GET['hasil'] ? "Data game berhasil disimpan" : "Data game gagal disimpan") . "</p>";
        }

        if (isset($_GET['hapus'])) {
            echo "<p class='message'>" . ($_GET['hapus'] ? "Data berhasil dihapus" : "Data gagal dihapus") . "</p>";
        }

        if (isset($_GET['edit'])) {
            echo "<p class='message'>" . ($_GET['edit'] ? "Data berhasil diubah" : "Data gagal diubah") . "</p>";
        }

        // Display the game data
        echo "<table>
                <tr>
                    <th>Nama Game</th>
                    <th>Deskripsi</th>
                    <th colspan='2'>Aksi</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
                echo "<td>".$row['name']."</td>";
                echo "<td>".$row['description']."</td>";
                echo "<td><a class='button' href='prosesdelete.php?idhapus=".$row['idgame']."'>Hapus</a></td>";
                echo "<td><a class='button' href='edit.php?idupdate=".$row['idgame']."'>Edit</a></td>";
            echo "</tr>";
        }
        echo "</table>";

        $stmt->close();
        $conn->close();
    ?>

    <!-- Pagination Links -->
    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=<?php echo $page - 1; ?>">Sebelumnya</a>
        <?php endif; ?>
        
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>

        <?php if ($page < $totalPages): ?>
            <a href="?page=<?php echo $page + 1; ?>">Selanjutnya</a>
        <?php endif; ?>
    </div>

    <div style="text-align: center;">
        <p><a class="button" href="insert.php">Tambah Game</a></p>
        <p><a class="button" href="../index.php">Kembali ke Dashboard Admin</a></p>
    </div>

</body>
</html>
