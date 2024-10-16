<?php
    // Membuat koneksi
    $conn = new mysqli("localhost", "root", "", "esport");
    if ($conn->connect_errno) {
        die("Failed to connect to MySQL: " . $conn->connect_error);
    }

    if(isset($_POST['submit'])){
        $teamID = $_POST['idteam'];
        $teamGame = $_POST['game'];
        $teamName = $_POST['name'];

        $query = "UPDATE team SET idgame = ?, name = ? WHERE idteam = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssi', $teamGame, $teamName, $teamID);
        $stmt->execute();

        $rowsAffected = $stmt->affected_rows;

        header("location: index.php?edit=".$rowsAffected);
    }
?>
