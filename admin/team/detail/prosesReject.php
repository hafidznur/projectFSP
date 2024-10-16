<?php
    // Membuat koneksi
    $conn = new mysqli("localhost", "root", "", "esport");
    if ($conn->connect_errno) {
        die("Failed to connect to MySQL: " . $conn->connect_error);
    }

    if(isset($_GET['idhapus'])){
        $teamID = $_GET['idteam'];
        $memberID = $_GET['idhapus'];

        $query = "UPDATE join_proposal SET status = 'rejected' WHERE idmember = ?;";
        
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $memberID);
        $stmt->execute();

        $rowsAffected = $stmt->affected_rows;
        $stmt->close();
        $conn->close();
        header("location: index.php?hasil=".$rowsAffected."&idcek=".$teamID);
    }

    
?>