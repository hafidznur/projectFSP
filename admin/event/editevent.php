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
    <?php
        if(isset($_GET['idupdate'])){
            $eventID = $_GET['idupdate'];

            // Query untuk mendapatkan data event
            $query = "SELECT * FROM event WHERE idevent = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('i', $eventID);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();

            $eventName = $data['name'];
            $eventDate = $data['date'];
            $eventDesc = $data['description'];
        }
    ?>

    <form method="post" action="proseseditevent.php" enctype="multipart/form-data">
        <input type="hidden" name="idevent" value="<?php echo $data['idevent']; ?>" required>
        <p>
            <label for="name">Nama Event:</label>
            <input type="text" id="name" name="name" value="<?php echo $eventName; ?>" required>
        </p>
        <p>
            <label for="date">Tanggal Event:</label>
            <input type="date" id="date" name="date" value="<?php echo $eventDate; ?>" required>
        </p>
        <p>
            <label for="description">Deskripsi:</label>
            <textarea id="description" name="description" required><?php echo $eventDesc; ?></textarea>
        </p>
        <button type="submit" name="submit" value="simpan">Simpan</button>
    </form>
</body>
</html>
