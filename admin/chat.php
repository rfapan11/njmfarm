<?php 
session_start();
//koneksi ke database
include '../koneksi.php';
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Redeem Code</title>
</head>
<body>
<pre><?php print_r($_SESSION); ?></pre>

<?php 

$ambil=$koneksi->query("SELECT * FROM chat JOIN pelanggan ON kategori.id_pelanggan=pelanggan.id_pelanggan"); 
$ambil = $koneksi->query("SELECT * FROM chat");
$pecah = $ambil->fetch_assoc();
?>

<form method="post">
	<div class="form-group">
	<input type="text" name="isi_pesan" placeholder="Masukan Pesan">
	</div>
	<button class="btn btn-primary" name="kirim">Kirim</button>
</form>

<?php 
if (isset($_POST['kirim'])) 
{
	$koneksi->query("INSERT INTO chat (isi_pesan,id_pelanggan) VALUES ('$_POST[isi_pesan]','$pecah[id_pelanggan]'')");
	
	echo "<script>alert('Pesan Terkirim');</script>";
	echo "<script>location='chat.php';</script>";

}
 ?>

</body>
</html>