<?php
    // Membuat koneksi
    $conn = new mysqli("localhost", "root", "", "esport");
    if ($conn->connect_errno) {
        die("Failed to connect to MySQL: " . $conn->connect_error);
    }

    if(isset($_POST['submit'])){
        $teamGame = $_POST['game'];
        $teamName = $_POST['name'];
    }

    $query = "INSERT INTO team(idgame, name) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('is', $teamGame, $teamName);
    $stmt->execute();

    $rowsAffected = $stmt->affected_rows;

    $stmt->close();
    $conn->close();

    header("location: index.php?hasil=".$rowsAffected);
?>
