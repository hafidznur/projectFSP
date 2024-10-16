<?php
    $conn = new mysqli("localhost", "root", "", "esport");
    if ($conn->connect_errno) {
        die("Failed to connect to MySQL: " . $conn->connect_error);
    }

    // Check if idevent and idteam are passed as parameters
    if(isset($_GET['idevent']) && isset($_GET['idteam'])){
        $eventID = $_GET['idevent'];
        $teamID = $_GET['idteam'];

        // Query to delete the team from the event
        $query = "DELETE FROM event_teams WHERE idevent = ? AND idteam = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ii', $eventID, $teamID);
        $stmt->execute();

        $rowsAffected = $stmt->affected_rows;

        // Redirect back to manage team page with success message
        header("location: manageteam.php?idevent=".$eventID."&hapus=".$rowsAffected);
    }

    $stmt->close();
    $conn->close();
?>
