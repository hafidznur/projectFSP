<?php
    // Membuat koneksi
    $conn = new mysqli("localhost", "root", "", "esport");
    if ($conn->connect_errno) {
        die("Failed to connect to MySQL: " . $conn->connect_error);
    }

    if(isset($_POST['submit'])){
        $eventID = $_POST['idevent'];
        $eventName = $_POST['name'];
        $eventDate = $_POST['date'];
        $eventDesc = $_POST['description'];

        $query = "UPDATE event SET name = ?, date = ?, description = ? WHERE idevent = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssi', $eventName, $eventDate, $eventDesc, $eventID);
        $stmt->execute();

        $rowsAffected = $stmt->affected_rows;

        header("location: index.php?edit=".$rowsAffected);
    }
?>
