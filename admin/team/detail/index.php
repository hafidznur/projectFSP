<?php
$conn = new mysqli("localhost", "root", "", "esport");
if ($conn->connect_errno) {
    die("Failed to connect to MySQL: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Team</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #007bff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #dee2e6;
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
    </style>
</head>
<body>

<?php
if (isset($_GET['hasil'])) {
    echo $_GET['hasil'] ? "<p>Data member berhasil disimpan</p>" : "<p>Data member gagal disimpan</p>";
}

if (isset($_GET['hapus'])) {
    echo $_GET['hapus'] ? "<p>Data berhasil dihapus</p>" : "<p>Data gagal dihapus</p>";
}

if (isset($_GET['idcek'])) {
    $teamID = (int)$_GET['idcek'];

    $query = "SELECT m.*, t.name AS team_name FROM team_members tm 
              INNER JOIN team t ON tm.idteam = t.idteam 
              INNER JOIN member m ON tm.idmember = m.idmember 
              WHERE t.idteam = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $teamID);
    $stmt->execute();
    $result = $stmt->get_result();

    $queryTeam = "SELECT name FROM team WHERE idteam = ?";
    $stmtTeam = $conn->prepare($queryTeam);
    $stmtTeam->bind_param('i', $teamID);
    $stmtTeam->execute();
    $resultTeam = $stmtTeam->get_result();
    
    // Pastikan ada hasil dari $resultTeam
    if ($dataTeam = $resultTeam->fetch_assoc()) {
        $namaTeam = htmlspecialchars($dataTeam['name']);
        echo "<h1>Nama Team: " . $namaTeam . "</h1>";
    } else {
        echo "<h1>Nama Team: Tidak Ditemukan</h1>";
    }

    echo "<table>
            <tr>
                <th>Nama</th>
                <th>Username</th>
                <th>Aksi</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['fname']) . "</td>
                <td>" . htmlspecialchars($row['usename']) . "</td>
                <td><a href='prosesHapus.php?idhapus=" . $row['idmember'] . "&idteam=" . $row['idteam'] . "'>Hapus</a></td>
              </tr>";
    }
    echo "</table>";

    $stmt->close();
    $stmtTeam->close();
?>
    <h2>Team Join Proposal</h2>
    <?php
    $query = "SELECT jp.*, m.fname, m.usename FROM join_proposal jp 
              INNER JOIN member m ON jp.idmember = m.idmember 
              WHERE jp.idteam = ? AND jp.status = 'waiting'";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $teamID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    echo "<table>
            <tr>
                <th>Nama</th>
                <th>Username</th>
                <th>Description</th>
                <th>Aksi</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['fname']) . "</td>
                <td>" . htmlspecialchars($row['usename']) . "</td>
                <td>" . htmlspecialchars($row['description']) . "</td>
                <td><a href='prosesAccept.php?idterima=" . $row['idmember'] . "&idteam=" . $row['idteam'] . "&usename=" . $row['usename'] . "'>Terima</a></td>
                <td><a href='prosesReject.php?idhapus=" . $row['idmember'] . "&idteam=" . $row['idteam'] . "'>Hapus</a></td>
              </tr>";
    }
    echo "</table>";

    $stmt->close();
}
$conn->close();
?>
</body>
</html>