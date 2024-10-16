<?php
    // Membuat koneksi
    $conn = new mysqli("localhost", "root", "", "esport");
    if ($conn->connect_errno) {
        die("Failed to connect to MySQL: " . $conn->connect_error);
    }

    if(isset($_GET['idhapus'])){
        $teamID = $_GET['idteam'];
        $memberID = $_GET['idhapus'];

        $query = "DELETE FROM team_members WHERE idmember = ?";
        $queryProp = "DELETE FROM join_proposal WHERE idmember = ?";

        $stmtProp = $conn->prepare($queryProp);
        $stmt = $conn->prepare($query);
        $stmtProp->bind_param('i', $memberID);
        $stmt->bind_param('i', $memberID);
        $stmtProp->execute();
        $stmt->execute();

        $rowsAffected = $stmt->affected_rows;
        $stmt->close();
        $stmtProp->close();
        $conn->close();
        header("location: index.php?hasil=".$rowsAffected."&idcek=".$teamID);
    }

    
?>