<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Team</title>
</head>
<body>
    <form method="post" action="prosesinsertevent.php" enctype="multipart/form-data">
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
    </form>
</body>
</html>
