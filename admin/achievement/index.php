<?php
    // Membuat koneksi
    $conn = new mysqli("localhost", "root", "", "esport");
    if ($conn->connect_errno) {
        die("Failed to connect to MySQL: " . $conn->connect_error);
    }

    // Set up pagination variables
    $limit = 5; // Number of rows per page
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($page > 1) ? ($page * $limit) - $limit : 0;

    // Query to count total number of records
    $totalQuery = "SELECT COUNT(*) as total FROM achievement";
    $totalResult = $conn->query($totalQuery);
    $totalRow = $totalResult->fetch_assoc();
    $totalRecords = $totalRow['total'];

    // Calculate total pages
    $totalPages = ceil($totalRecords / $limit);

    // Query to fetch event data with pagination
    $query = "SELECT t.name as 'team', a.* FROM achievement a
              INNER JOIN team t ON t.idteam=a.idteam
              LIMIT $start, $limit";

    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Achievement</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        background-color: #f9f9f9;
    }

    a.button {
        display: inline-block;
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.3s ease;
   }

    a.button:hover {
        background-color: #0056b3;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    table, th, td {
        border: 1px solid #dddddd;
    }

    th, td {
        padding: 12px;
        text-align: center;
    }

    th {
        background-color: #f4f4f4;
    }

    a {
        text-decoration: none;
        color: #007bff;
    }

    a:hover {
        text-decoration: underline;
        color: #0056b3;
    }

    button {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 4px;
    }

    button:hover {
        background-color: #0056b3;
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
        transition: background-color 0.3s ease;
    }

    .pagination a:hover {
        background-color: #0056b3;
    }

    .pagination a[style*="background-color: #0056b3;"] {
        cursor: default;
        color: #ffffff;
    }

    p {
        margin-top: 20px;
    }

    .message {
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 4px;
        font-weight: bold;
        text-align: center;
    }

    .message.success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .message.error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    @media (max-width: 768px) {
        table {
            display: block;
            overflow-x: auto;
            white-space: nowrap;
        }

        th, td {
            padding: 8px;
        }

        .pagination a {
            padding: 8px 10px;
        }
    }

    </style>
</head>
<body>

    <?php
        // Handling messages for insert, delete, edit
        if (isset($_GET['hasil'])) {
            echo $_GET['hasil'] ? "<p>Data berhasil disimpan</p>" : "<p>Data gagal disimpan</p>";
        }

        if (isset($_GET['hapus'])) {
            echo $_GET['hapus'] ? "<p>Data berhasil dihapus</p>" : "<p>Data gagal dihapus</p>";
        }

        if (isset($_GET['edit'])) {
            echo $_GET['edit'] ? "<p>Data berhasil diubah</p>" : "<p>Data gagal diubah</p>";
        }

        // Display the event data along with teams
        echo "<table>
                <tr>
                    <th>Nama Team</th>
                    <th>Nama Achievement</th>
                    <th>Tanggal</th>
                    <th>Deskripsi</th>
                    <th colspan='2'>Aksi</th>
                </tr>";

        // Loop through each event and display the event data with associated teams
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".(!empty($row['team']) ? $row['team'] : "No Teams")."</td>"; 
                echo "<td>".$row['name']."</td>";
                echo "<td>".$row['date']."</td>";
                echo "<td>".$row['description']."</td>";
                echo "<td><a href='editAchievement.php?idupdate=".$row['idachievement']."' class='button'>Edit</a></td>";
                echo "<td><a href='cekAcv.php?idteam=".$row['idteam']."' class='button'>Cek Achievement</a></td>"; // Cek Achievement Button
            echo "</tr>";
        }
        echo "</table>";

        $stmt->close();
    ?>

    <p><a href="insertAchievement.php" class="button">Insert Achievement >></a></p>
    <p><a href="../index.php"><button>Kembali ke Dashboard Admin</button></a></p>

    <!-- Pagination Links -->
    <div class="pagination">
        <?php
            if ($page > 1) {
                echo "<a href='index.php?page=".($page - 1)."'>Sebelumnya</a>";
            }

            for ($i = 1; $i <= $totalPages; $i++) {
                if ($i == $page) {
                    echo "<a style='background-color: #0056b3;'>$i</a>";
                } else {
                    echo "<a href='index.php?page=$i'>$i</a>";
                }
            }

            if ($page < $totalPages) {
                echo "<a href='index.php?page=".($page + 1)."'>Selanjutnya</a>";
            }
        ?>
    </div>

</body>
</html>

<?php
    $conn->close();
?>
