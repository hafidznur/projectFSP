<?php
    // Membuat koneksi
    $conn = new mysqli("localhost", "root", "", "esport");
    if ($conn->connect_errno) {
        die("Failed to connect to MySQL: " . $conn->connect_error);
    }

    if(isset($_POST['submit'])){
        $teamID = $_GET['idteam'];
        $memberID = $_GET['idterima'];
        $description = $_POST['description'];

        $query = "UPDATE join_proposal SET status = 'approved' WHERE idmember = ?;";
        $queryTeam = "INSERT INTO team_members (idteam, idmember, description) VALUES (?, ?, ?)";
        
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $memberID);
        $stmt->execute();

        $stmtTeam = $conn->prepare($queryTeam);
        $stmtTeam->bind_param('iis', $teamID, $memberID, $description);
        $stmtTeam->execute();

        $rowsAffected = $stmt->affected_rows;
        $stmtTeam->close();
        $stmt->close();

        $conn->close();
        header("location: index.php?hasil=".$rowsAffected."&idcek=".$teamID);
    }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accept Member</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }
    h3 {
        color: #007bff;
    }
    textarea {
        width: 100%;
        height: 100px;
        padding: 10px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        resize: vertical;
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
</style>
</head>
<body>
    <form action="" method="post">
        <h3>Berikan alasan anda menerima <?php echo $_GET['usename'] ?>?</h3>
        <textarea name="description" id="description"></textarea><br>
        <button type="submit" name="submit" value="simpan">Submit</button>
    </form>
</body>
</html>