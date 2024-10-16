<?php
    // Membuat koneksi
    $conn = new mysqli("localhost", "root", "", "esport");
    if ($conn->connect_errno) {
        die("Failed to connect to MySQL: " . $conn->connect_error);
    }

    if(isset($_POST['submit'])){
        $eventName = $_POST['name'];
        $eventDate = $_POST['date'];
        $eventDesc = $_POST['description'];
    }

    $query = "INSERT INTO event(name, date, description) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sss', $eventName, $eventDate, $eventDesc);
    $stmt->execute();

    $rowsAffected = $stmt->affected_rows;

    $stmt->close();
    $conn->close();

    header("location: index.php?hasil=".$rowsAffected);
?>
