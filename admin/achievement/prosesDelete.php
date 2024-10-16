<?php
    $conn = new mysqli("localhost", "root", "", "esport");
    if ($conn->connect_errno) {
        die("Failed to connect to MySQL: " . $conn->connect_error);
    }

    if(isset($_GET['idhapus'])){
        $achievementID = $_GET['idhapus'];

        $query = "DELETE FROM achievement WHERE idachievement = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $achievementID);
        $stmt->execute();

        $rowsAffected = $stmt->affected_rows;

        header("location: index.php?hapus=".$rowsAffected);
    }

    $stmt->close();
    $conn->close();
?>
