<?php
// Membuat koneksi
$conn = new mysqli("localhost", "root", "", "esport");
if ($conn->connect_errno) {
    die("Failed to connect to MySQL: " . $conn->connect_error);
}

// Pagination variables
$limit = 5; // Number of events per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page number
$offset = ($page - 1) * $limit; // Calculate the offset

// Query to count total events
$countQuery = "SELECT COUNT(*) as total FROM event";
$countResult = $conn->query($countQuery);
$totalEvents = $countResult->fetch_assoc()['total'];
$totalPages = ceil($totalEvents / $limit); // Calculate total pages

// Query to fetch event data along with team count
$query = "SELECT e.*, COUNT(et.idteam) AS team_count 
          FROM event e 
          LEFT JOIN event_teams et ON e.idevent = et.idevent 
          GROUP BY e.idevent 
          LIMIT ? OFFSET ?";
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
    <title>Events</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: white;
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
            padding: 8px 16px;
            text-decoration: none;
            color: white;
            background-color: #007bff;
            border-radius: 4px;
        }
        .pagination a:hover {
            background-color: #0056b3;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
            text-align: center;
        }
        button:hover {
            background-color: #0056b3;
        }
        .disabled {
            color: #ccc; 
            cursor: not-allowed;
        }
    </style>
</head>
<body>

    <h1>Daftar Event Esports</h1>

    <?php
        // Handling messages for insert, delete, edit
        if (isset($_GET['hasil'])) {
            echo $_GET['hasil'] ? "<p>Data event berhasil disimpan</p>" : "<p>Data event gagal disimpan</p>";
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
                    <th>Nama Event</th>
                    <th>Tanggal</th>
                    <th>Deskripsi</th>
                    <th>Tim</th>
                    <th colspan='2'>Aksi</th>
                </tr>";

        // Loop through each event and display the event data
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
                echo "<td>".$row['name']."</td>";
                echo "<td>".$row['date']."</td>";
                echo "<td>".$row['description']."</td>";

                // Check if there are teams associated with the event
                if ($row['team_count'] > 0) {
                    echo "<td><a href='manageteam.php?idevent=".$row['idevent']."'>Cek</a></td>";
                } else {
                    echo "<td class='disabled'>Tidak ada tim</td>"; // Indicate no teams
                }

                echo "<td><a href='prosesdeleteevent.php?idhapus=".$row['idevent']."'>Hapus</a></td>";
                echo "<td><a href='editevent.php?idupdate=".$row['idevent']."'>Edit</a></td>";
            echo "</tr>";
        }
        echo "</table>";

        $stmt->close();
    ?>

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

    <div style="text-align: center;">
    <p><a href="insertevent.php"><button>Insert Event >></button></a></p>
        <?php if ($totalEvents > 0) { ?>
            <p><a href="addTeam.php"><button>Add Team >></button></a></p>
        <?php } else { ?>
            <p class='disabled'>Add Team (Tidak ada event)</p>
        <?php } ?>
        <p><a href="../index.php"><button>Kembali ke Dashboard Admin</button></a></p>
    </div>

</body>
</html>

<?php
$conn->close();
?>
