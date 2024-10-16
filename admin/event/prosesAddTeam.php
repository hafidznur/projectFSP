<?php
    // Membuat koneksi
    $conn = new mysqli("localhost", "root", "", "esport");
    if ($conn->connect_errno) {
        die("Failed to connect to MySQL: " . $conn->connect_error);
    }

    if(isset($_POST['submit'])){
        $event = $_POST['event'];
        $team = $_POST['team'];
    }

    $query = "INSERT INTO event_teams(idevent, idteam) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('is', $event, $team);
    $stmt->execute();

    $rowsAffected = $stmt->affected_rows;

    $stmt->close();
    $conn->close();

    header("location: index.php?hasil=".$rowsAffected);
?>
