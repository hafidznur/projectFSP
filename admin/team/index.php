<?php
// Membuat koneksi ke database
$conn = new mysqli("localhost", "root", "", "esport");
if ($conn->connect_errno) {
    die("Failed to connect to MySQL: " . $conn->connect_error);
}

// Pagination variables
$limit = 5; // Number of teams per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page number
$start = ($page > 1) ? ($page * $limit) - $limit : 0; // Calculate the offset

// Query to count total teams
$countQuery = "SELECT COUNT(*) as total FROM team";
$countResult = $conn->query($countQuery);
$totalTeams = $countResult->fetch_assoc()['total'];
$totalPages = ceil($totalTeams / $limit); // Calculate total pages

// Query to fetch teams along with their associated game
$query = "SELECT t.*, g.name AS game FROM team t 
          INNER JOIN game g ON t.idgame = g.idgame
          LIMIT ?, ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $start, $limit); // Bind the limit and offset parameters
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Esports</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        background-color: #f8f9fa;
        color: #343a40;
    }
    .button {
        display: inline-block;
        padding: 10px 15px;
        color: white;
        background-color: #007bff;
        border-radius: 4px;
        text-decoration: none;
        transition: background-color 0.3s;
    }
    .button:hover {
        background-color: #0056b3;
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
    button {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 5px;
        transition: background-color 0.3s;
    }
    button:hover {
        background-color: #0056b3;
    }
    .disabled {
        pointer-events: none;
        color: gray;
    }
</style>
</head>
<body>

    <h1>Daftar Tim Esports</h1>

    <table>
        <tr>
            <th>Cabang Game</th>
            <th>Nama Team</th>
            <th>Event</th>
            <th colspan="3">Aksi</th>
        </tr>

        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['game']."</td>";
            echo "<td>".$row['name']."</td>";

            // Query to fetch the events associated with the current team
            $query_events = "SELECT e.name AS event_name, e.idevent 
                             FROM event_teams et 
                             JOIN event e ON et.idevent = e.idevent 
                             WHERE et.idteam = ?";
            $stmt_events = $conn->prepare($query_events);
            $stmt_events->bind_param("i", $row['idteam']);
            $stmt_events->execute();
            $result_events = $stmt_events->get_result();

            echo "<td>";
            if ($result_events->num_rows > 0) {
                while ($event = $result_events->fetch_assoc()) {
                    echo $event['event_name'] . "<br>";
                }
            } else {
                echo "No events";
            }
            echo "</td>";

            // Check for achievements associated with the current team
            $query_achievements = "SELECT COUNT(*) as total FROM achievement WHERE idteam = ?";
            $stmt_achievements = $conn->prepare($query_achievements);
            $stmt_achievements->bind_param("i", $row['idteam']);
            $stmt_achievements->execute();
            $result_achievements = $stmt_achievements->get_result();
            $totalAchievements = $result_achievements->fetch_assoc()['total'];

            // Detail, Edit, and Cek Achievement actions
            echo "<td><a href='detail/index.php?idcek=".$row['idteam']."'>Detail</a></td>";
            echo "<td><a href='edit.php?idupdate=".$row['idteam']."'>Edit</a></td>";
            
            // Check if there are achievements to enable/disable the button
            if ($totalAchievements > 0) {
                echo "<td><a href='../achievement/cekAcv.php?idteam=".$row['idteam']."'>Cek Achievement</a></td>";
            } else {
                echo "<td><a class='disabled' href='#'>Cek Achievement</a></td>"; // Disabled button
            }

            echo "</tr>";
        }
        ?>

    </table>

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

    <p><a href="insert.php" class="button">Tambahkan Team >></a></p>
    <p><a href="addevent.php" class="button">Tambahkan Event</a></p>
    <p><a href="../index.php"><button>Kembali ke Dashboard Admin</button></a></p>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
