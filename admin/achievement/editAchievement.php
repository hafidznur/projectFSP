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
    <title>Edit Achievement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }

        form {
            width: 100%;
            max-width: 500px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
        }

        form p {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"], input[type="date"], select, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            margin-bottom: 10px;
            box-sizing: border-box;
            background-color: #f4f4f4;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus, input[type="date"]:focus, select:focus, textarea:focus {
            border-color: #007bff;
            outline: none;
        }

        textarea {
            height: 100px;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Styling for dropdown menu */
        select {
            height: 40px;
        }

        /* Align the form in the center */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        form {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <?php
        if(isset($_GET['idupdate'])){
            $achievementID = $_GET['idupdate'];

            // Query untuk mendapatkan data event
            $query = "SELECT * FROM achievement WHERE idachievement = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('i', $achievementID);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();

            $achievTeam = $data['idteam'];
            $achievName = $data['name'];
            $achievDate = $data['date'];
            $achievDesc = $data['description'];
        }
    ?>

    <form method="post" action="prosesEditAchiev.php" enctype="multipart/form-data">
        <input type="hidden" name="idachievement" value="<?php echo $data['idachievement']; ?>" required>
        <p>
            <label>Team :</label>
            <select id="team" name="team">
            <?php
                $query = "SELECT * FROM team";
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();

                while($row = $result->fetch_assoc()){
                    if($row['idteam']==$data['idteam']){
                        echo "<option value=\"".$row['idteam']."\" selected>".$row['name']."</option>";
                    } else {
                        echo "<option value=\"".$row['idteam']."\">".$row['name']."</option>";
                    }
                }

                $stmt->close();
                $conn->close();
            ?>
            </select>
        </p>
        <p>
            <label for="name">Nama Achievement:</label>
            <input type="text" id="name" name="name" value="<?php echo $achievName; ?>" required>
        </p>
        <p>
            <label for="date">Tanggal Achievement:</label>
            <input type="date" id="date" name="date" value="<?php echo $achievDate; ?>" required>
        </p>
        <p>
            <label for="description">Deskripsi:</label>
            <textarea id="description" name="description" required><?php echo $achievDesc; ?></textarea>
        </p>
        <button type="submit" name="submit" value="simpan">Simpan</button>
    </form>
</body>
</html>
