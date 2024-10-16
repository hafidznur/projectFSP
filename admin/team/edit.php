<?php
    // Membuat koneksi ke database
    $conn = new mysqli("localhost", "root", "", "esport");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Team</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        background-color: #f8f9fa;
    }
    h1 {
        color: #007bff;
    }
    form {
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    p {
        margin-bottom: 15px;
    }
    label {
        font-weight: bold;
    }
    input[type="text"], select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        margin-top: 5px;
    }
    button {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 4px;
    }
    button:hover {
        background-color: #0056b3;
    }
</style>
</head>
<body>
    <?php
        if(isset($_GET['idupdate'])){
            $eventID = $_GET['idupdate'];

            // Query untuk mendapatkan data event
            $query = "SELECT t.*, g.name as 'game' FROM team t inner JOIN game g on t.idgame=g.idgame WHERE t.idteam = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('i', $eventID);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();

            $teamGame = $data['game'];
            $teamName = $data['name'];
        }
    ?>

    <form method="post" action="prosesedit.php" enctype="multipart/form-data">
        <input type="hidden" name="idteam" value="<?php echo $data['idteam']; ?>" required>
        <p>
            <label>Game :</label>
            <select id="game" name="game">
            <?php
                $query = "SELECT * FROM game";
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();

                while($row = $result->fetch_assoc()){
                    if($row['idgame']==$data['idgame']){
                        echo "<option value=\"".$row['idgame']."\" selected>".$row['name']."</option>";
                    } else {
                        echo "<option value=\"".$row['idgame']."\">".$row['name']."</option>";
                    }
                }

                $stmt->close();
                $conn->close();
            ?>
            </select>
        </p>
        <p>
            <label for="name">Nama Team:</label>
            <input type="text" id="name" name="name" value="<?php echo $teamName; ?>" required>
        </p>
        <button type="submit" name="submit" value="simpan">Simpan</button>
    </form>
</body>
</html>
