<?php
    // Membuat koneksi
    $conn = new mysqli("localhost", "root", "", "esport");
    if ($conn->connect_errno) {
        die("Failed to connect to MySQL: " . $conn->connect_error);
    }

    if(isset($_POST['submit'])){
        $gameID = $_POST['idgame'];
        $gameName = $_POST['name'];
        $gameDesc = $_POST['description'];

        $query = "UPDATE game SET name = ?, description = ? WHERE idgame = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssi', $gameName, $gameDesc, $gameID);
        $stmt->execute();

        $rowsAffected = $stmt->affected_rows;

        header("location: index.php?edit=".$rowsAffected);
    }
?>
