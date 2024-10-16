<?php
// Check if idteam is passed as a parameter
if (!isset($_GET['idteam'])) {
    die("ID Team tidak ditemukan.");
}

$idteam = $_GET['idteam'];

// Membuat koneksi
$conn = new mysqli("localhost", "root", "", "esport");
if ($conn->connect_errno) {
    die("Failed to connect to MySQL: " . $conn->connect_error);
}

// Pagination variables
$limit = 5; // Number of achievements per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page number
$offset = ($page - 1) * $limit; // Calculate the offset

// Query to count total achievements for the specific team
$countQuery = "SELECT COUNT(*) as total FROM achievement WHERE idteam = ?";
$countStmt = $conn->prepare($countQuery);
$countStmt->bind_param("i", $idteam);
$countStmt->execute();
$countResult = $countStmt->get_result();
$totalAchievements = $countResult->fetch_assoc()['total'];
$totalPages = ceil($totalAchievements / $limit); // Calculate total pages

// Query to fetch achievements for the specific team with pagination
$query = "SELECT a.*, t.name as team FROM achievement a
          INNER JOIN team t ON a.idteam = t.idteam
          WHERE a.idteam = ?
          LIMIT ? OFFSET ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("iii", $idteam, $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Achievement Team</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .pagination {
            text-align: center;
            margin-top: 20px;
        }

        .pagination a {
            margin: 0 5px;
            padding: 10px 15px;
            text-decoration: none;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
        }

        .pagination a:hover {
            background-color: #0056b3;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        p {
            text-align: center;
            margin-top: 20px;
        }

        /* Additional styles for hover effect */
        table tr:hover {
            background-color: #e9ecef;
        }
    </style>
</head>
<body>
    <h1>Daftar Achievement dari Tim <?php
        // Fetch the first achievement to display the team name
        if ($row = $result->fetch_assoc()) {
            echo htmlspecialchars($row['team']);
            // Store the first row to display achievements later
            $achievements[] = $row; // Store first achievement row
        } else {
            echo "Tidak ada data achievement untuk tim ini.";
            $stmt->close();
            $conn->close();
            exit;
        }
    ?></h1>

    <?php
        // Display achievements if they exist
        if (!empty($achievements)) {
            echo "<table border='1'>
                    <tr>
                        <th>Nama Achievement</th>
                        <th>Tanggal</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>";

            // Use a loop to display achievements
            do {
                echo "<tr>";
                echo "<td>".htmlspecialchars($row['name'])."</td>";
                echo "<td>".htmlspecialchars($row['date'])."</td>";
                echo "<td>".htmlspecialchars($row['description'])."</td>";
                echo "<td><a href='prosesDelete.php?idhapus=".urlencode($row['idachievement'])."&idteam=".urlencode($idteam)."'>Hapus</a></td>"; // Hapus Button
                echo "</tr>";
            } while ($row = $result->fetch_assoc());

            echo "</table>";
        } else {
            echo "<p>Tidak ada achievement yang diraih oleh tim ini.</p>";
        }

        $stmt->close();
        $conn->close();
    ?>

    <!-- Pagination Links -->
    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?idteam=<?php echo urlencode($idteam); ?>&page=<?php echo $page - 1; ?>">Previous</a>
        <?php endif; ?>
        
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?idteam=<?php echo urlencode($idteam); ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>

        <?php if ($page < $totalPages): ?>
            <a href="?idteam=<?php echo urlencode($idteam); ?>&page=<?php echo $page + 1; ?>">Next</a>
        <?php endif; ?>
    </div>

    <p><a href="../achievement/index.php"><button>Kembali ke Daftar Achievement</button></a></p>
</body>
</html>
