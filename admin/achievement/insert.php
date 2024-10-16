<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Tambah Achievement</title>
</head>
<body>
	<h2>Tambah Achievement</h2>
	<?php
	include "koneksi.php";

	if (isset($_POST['name'])) {
		$nama 		= $_POST['name'];
		$tanggal 	= $_POST['date'];
		$deskripsi 	= $_POST['description'];

		if ($nama == "" || $tanggal == "" || $deskripsi == "") {
			echo '<script>alert("Semua data harus diisi")</script>';
		}else{
			$query = mysqli_query($koneksi, "INSERT into achievement (name,date,description) values('$nama','$tanggal','$deskripsi')");
			if ($query) {
				echo '<script>alert("Tambah data berhasil")</script>';
			}else{
				echo '<script>alert("Tambah data gagal")</script>';
			}
		}
	}
	?>
	<form method="post">
		<table>
			<tr>
				<td>Nama Achievement</td>
				<td><input type="text" name="name"></td>
			</tr>
			<tr>
				<td>Tanggal</td>
				<td><input type="date" name="date"></td>
			</tr>
			<tr>
				<td>Deskripsi</td>
				<td><textarea name="description"></textarea></td>
			</tr>
			<tr>
				<td></td>
				<td>
					<button type="submit">Simpan</button>
					<button type="reset">Reset</button>
					<a href="index.php">Kembali</a>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>