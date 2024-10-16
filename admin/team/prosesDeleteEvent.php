<?php
// Check if 'idteam' and 'idevent' are provided in the URL
if (isset($_GET['idteam']) && isset($_GET['idevent'])) {
    $idteam = $_GET['idteam'];
    $idevent = $_GET['idevent'];

    // Create connection
    $conn = new mysqli("localhost", "root", "", "esport");
    if ($conn->connect_errno) {
        die("Failed to connect to MySQL: " . $conn->connect_error);
    }

    // Delete the specific event association from the event_teams table
    $query = "DELETE FROM event_teams WHERE idteam = ? AND idevent = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $idteam, $idevent);

    if ($stmt->execute()) {
        // Redirect back to index.php with a success message
        header("Location: index.php?hapus=1");
    } else {
        // Redirect back with a failure message
        header("Location: index.php?hapus=0");
    }

    // Close connection
    $stmt->close();
    $conn->close();
} else {
    // If idteam or idevent is missing, redirect back with an error
    header("Location: index.php?hapus=0");
}
?>
