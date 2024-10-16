<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Update Achievement</title>
</head>
<body>
	<h2>Update Achievement</h2>
	<?php
		include "koneksi.php";

		$id = $_GET['id'];

		if (isset($_POST['name'])) {
			$nama 		= $_POST['name'];
			$tanggal 	= $_POST['date'];
			$deskripsi 	= $_POST['description'];

			if ($nama == "" || $tanggal == "" || $deskripsi == "") {
				echo '<script>alert("Semua data harus diisi")</script>';
			}else{
				$query = mysqli_query($koneksi, "UPDATE achievement SET name='$nama',date='$tanggal',description='$deskripsi' WHERE idachievement=$id");
				if ($query) {
					echo '<script>alert("Ubah data berhasil")</script>';
				}else{
					echo '<script>alert("Ubah data gagal")</script>';
				}
			}

			
		}

		$query = mysqli_query($koneksi, "SELECT*FROM achievement where idachievement=$id");
		$data = mysqli_fetch_array($query);
	?>
	<form method="post">
		<table>
			<tr>
				<td>Nama Achievement</td>
				<td><input type="text" name="name" value="<?php echo $data['name'] ?>"></td>
			</tr>
			<tr>
				<td>Tanggal</td>
				<td><input type="date" name="date" value="<?php echo $data['date'] ?>"></td>
			</tr>
			<tr>
				<td>Deskripsi</td>
				<td><textarea name="description"><?php echo $data['description'] ?></textarea></td>
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