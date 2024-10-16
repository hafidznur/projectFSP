<?php
// Check if idevent is passed as a parameter
if (!isset($_GET['idevent'])) {
    die("ID Event tidak ditemukan.");
}

$idevent = $_GET['idevent'];

// Membuat koneksi
$conn = new mysqli("localhost", "root", "", "esport");
if ($conn->connect_errno) {
    die("Failed to connect to MySQL: " . $conn->connect_error);
}

// Query to fetch event data and associated teams
$query = "SELECT e.name as event_name, t.name as team_name, t.idteam 
          FROM event e
          LEFT JOIN event_teams et ON e.idevent = et.idevent
          LEFT JOIN team t ON et.idteam = t.idteam
          WHERE e.idevent = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $idevent);
$stmt->execute();
$result = $stmt->get_result();

// Fetch event name
$event_name = '';
if ($row = $result->fetch_assoc()) {
    $event_name = $row['event_name'];
    // Reset the pointer back to the start of the result set
    $result->data_seek(0);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Team</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
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
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        a {
            text-decoration: none;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
        .center-button {
            text-align: center;
            margin-top: 20px;
        }
        .message {
            text-align: center;
            color: red;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Manage Teams for Event "<?php echo htmlspecialchars($event_name); ?>"</h1>

    <table>
        <tr>
            <th>Nama Tim</th>
            <th>Aksi</th>
        </tr>

        <?php
        // Display the teams or a message if no teams are associated
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                    echo "<td>".htmlspecialchars($row['team_name'])."</td>";
                    echo "<td><a href='deleteTeam.php?idevent=".urlencode($idevent)."&idteam=".urlencode($row['idteam'])."' onclick='return confirm(\"Apakah Anda yakin ingin menghapus tim ini dari event?\")'>Hapus</a></td>";
                echo "</tr>";
            }
        } else {
            // If no teams are associated, still show the option to add a new team
            echo "<tr><td colspan='2' class='message'>Tidak ada tim yang mengikuti event ini.</td></tr>";
        }
        ?>

    </table>

    <div class="center-button">
        <a href="addTeam.php?idevent=<?php echo urlencode($idevent); ?>"><button>Tambah Tim</button></a>
        <a href="index.php"><button>Kembali ke Daftar Event</button></a>
    </div>
</body>
</html>

<?php
$conn->close();
?>
