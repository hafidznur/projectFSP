<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Event</title>
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
        h2 {
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
        input[type="text"], input[type="date"], textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0 15px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            color: #333;
            box-sizing: border-box;
        }
        textarea {
            height: 100px;
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
        }
        button:hover {
            background-color: #0056b3;
        }
        p {
            margin: 0;
        }
        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }
        .buttons a {
            text-decoration: none;
            width: 100%;
        }
        .buttons button {
            width: 100%;
        }
    </style>
</head>
<body>
    <form method="post" action="prosesinsertevent.php" enctype="multipart/form-data">
    <h2>Insert Event</h2>
        <p>
            <label>Nama Event</label>
            <input type="text" name="name" required>
        </p>
        <p>
            <label>Tanggal Event</label>
            <input type="date" name="date" required>
        </p>
        <p>
            <label>Deskripsi</label>
            <textarea name="description" required></textarea>
        </p>
        <button type="submit" name="submit" value="simpan">Simpan</button>

        <div class="buttons">
            <a href="../event/index.php"><button type="button">Kembali</button></a>
        </div>
    </form>
</body>
</html>
