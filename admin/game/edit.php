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
    <title>Edit Event</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        p {
            margin: 15px 0;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
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
        .back-button {
            display: block;
            margin: 20px auto;
            text-align: center;
        }
        .back-button a {
            text-decoration: none;
            color: white;
            background-color: #007bff;
            padding: 10px 20px;
            border-radius: 4px;
        }
        .back-button a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php
        if(isset($_GET['idupdate'])){
            $eventID = $_GET['idupdate'];

            // Query untuk mendapatkan data event
            $query = "SELECT * FROM game WHERE idgame = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('i', $eventID);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();

            $gameName = $data['name'];
            $gameDesc = $data['description'];
        }
    ?>

    <form method="post" action="prosesedit.php" enctype="multipart/form-data">
        <input type="hidden" name="idgame" value="<?php echo $data['idgame']; ?>" required>
        <p>
            <label for="name">Nama Game:</label>
            <input type="text" id="name" name="name" value="<?php echo $gameName; ?>" required>
        </p>
        <p>
            <label for="description">Deskripsi:</label>
            <textarea id="description" name="description" required><?php echo $gameDesc; ?></textarea>
        </p>
        <button type="submit" name="submit" value="simpan">Simpan</button>
    </form>
</body>
</html>
