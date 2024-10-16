<?php
    $conn = new mysqli("localhost", "root", "", "esport");
    if ($conn->connect_errno) {
        die("Failed to connect to MySQL: " . $conn->connect_error);
    }

    if(isset($_GET['idhapus'])){
        $eventID = $_GET['idhapus'];

        $query = "DELETE FROM event WHERE idevent = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $eventID);
        $stmt->execute();

        $rowsAffected = $stmt->affected_rows;

        header("location: index.php?hapus=".$rowsAffected);
    }

    $stmt->close();
    $conn->close();
?>
