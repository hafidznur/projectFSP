<?php
    // Membuat koneksi
    $conn = new mysqli("localhost", "root", "", "esport");
    if ($conn->connect_errno) {
        die("Failed to connect to MySQL: " . $conn->connect_error);
    }
    $defaultDate = date('Y-m-d'); //default value date
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Achievement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        p {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"],
        input[type="date"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <form method="post" action="prosesInsert.php" enctype="multipart/form-data">
        <p>
            <label>Team :</label>
            <select id="team" name="team">
            <?php
                $query = "SELECT * FROM team";
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();

                while($row = $result->fetch_assoc()){
                    echo "<option value=\"".$row['idteam']."\">".$row['name']."</option>";
                }

                $stmt->close();
            ?>
            </select>
        </p>
        <p>
            <label>Nama Achievement :</label>
            <input type="text" name="name" required>
        </p>
        <p>
            <label>Tanggal Event :</label>
            <input type="date" name="date" value="<?php echo $defaultDate; ?>" required>
        </p>
        <p>
            <label>Deskripsi :</label>
            <textarea name="description" required></textarea>
        </p>
        <button type="submit" name="submit" value="simpan">Simpan</button>
    </form>
</body>
</html>
