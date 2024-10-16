<?php
    // Membuat koneksi
    $conn = new mysqli("localhost", "root", "", "esport");
    if ($conn->connect_errno) {
        die("Failed to connect to MySQL: " . $conn->connect_error);
    }

    if(isset($_POST['submit'])){
        $team = $_POST['team'];
        $name = $_POST['name'];
        $achievDate = $_POST['date'];
        $description = $_POST['description'];
    }

    $query = "INSERT INTO achievement (idteam, name, date, description) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('isss', $team, $name, $achievDate, $description);
    $stmt->execute();

    $rowsAffected = $stmt->affected_rows;

    $stmt->close();
    $conn->close();

    header("location: index.php?hasil=".$rowsAffected);
?>