<?php
    // Membuat koneksi
    $conn = new mysqli("localhost", "root", "", "esport");
    if ($conn->connect_errno) {
        die("Failed to connect to MySQL: " . $conn->connect_error);
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Team at Event</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        label {
            font-size: 16px;
            color: #333;
            margin-bottom: 5px;
            display: block;
        }
        select {
            width: 100%;
            padding: 10px;
            margin: 8px 0 15px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            color: #333;
            box-sizing: border-box;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px; /* Tambahkan margin atas untuk spasi */
        }
        button:hover {
            background-color: #0056b3;
        }
        p {
            margin: 0;
        }
        .buttons {
            margin-top: 15px; /* Ensure space between buttons */
        }
        .buttons a {
            text-decoration: none;
            width: 100%;
        }
    </style>
</head>
<body>
    <form method="post" action="prosesAddTeam.php" enctype="multipart/form-data">
        <h1>Tambah Event & Team</h1>
        
        <p>
            <label>Event :</label>
            <select id="event" name="event" required>
            <?php
                $queryEvent = "SELECT * FROM event";
                $stmt = $conn->prepare($queryEvent);
                $stmt->execute();
                $result = $stmt->get_result();

                while($row = $result->fetch_assoc()){
                    echo "<option value=\"".$row['idevent']."\">".$row['name']."</option>";
                }

                $stmt->close();
            ?>
            </select>
        </p>

        <p>
            <label>Team :</label>
            <select id="team" name="team" required>
            <?php
                $queryTeam = "SELECT * FROM team";
                $stmt = $conn->prepare($queryTeam);
                $stmt->execute();
                $result = $stmt->get_result();

                while($row = $result->fetch_assoc()){
                    echo "<option value=\"".$row['idteam']."\">".$row['name']."</option>";
                }

                $stmt->close();
                $conn->close();
            ?>
            </select>
        </p>
        
        <button type="submit" name="submit" value="simpan">Tambahkan</button>

        <a href="../event/index.php"><button type="button">Kembali</button></a>
    </div>
    </form>


</body>
</html>
