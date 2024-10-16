<?php
    // Membuat koneksi
    $conn = new mysqli("localhost", "root", "", "esport");
    if ($conn->connect_errno) {
        die("Failed to connect to MySQL: " . $conn->connect_error);
    }

    if(isset($_POST['submit'])){
        $achievementID = $_POST['idachievement'];
        $achievTeam = $_POST['team'];
        $achievName = $_POST['name'];
        $achievDate = $_POST['date'];
        $achievDesc = $_POST['description'];

        $query = "UPDATE achievement SET idteam = ?, name = ?, date = ?, description = ? WHERE idachievement = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('isssi', $achievTeam, $achievName, $achievDate, $achievDesc, $achievementID);
        $stmt->execute();

        $rowsAffected = $stmt->affected_rows;

        header("location: index.php?edit=".$rowsAffected);
    }
?>
