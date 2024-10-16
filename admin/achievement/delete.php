<?php
	include "koneksi.php";
	$id = $_GET['id'];
	$query = mysqli_query($koneksi, "DELETE FROM achievement where idachievement=$id");
	header('location:index.php');
?>