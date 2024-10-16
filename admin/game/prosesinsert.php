<?php
    // Membuat koneksi
    $conn = new mysqli("localhost", "root", "", "esport");
    if ($conn->connect_errno) {
        die("Failed to connect to MySQL: " . $conn->connect_error);
    }

    if(isset($_POST['submit'])){
        $gameName = $_POST['name'];
        $gameDesc = $_POST['description'];
    }

    $query = "INSERT INTO game(name, description) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ss', $gameName, $gameDesc);
    $stmt->execute();

    $rowsAffected = $stmt->affected_rows;

    $stmt->close();
    $conn->close();

    header("location: index.php?hasil=".$rowsAffected);
?>
