<?php 
session_start();
//koneksi ke database
include 'koneksi.php';
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Redeem Code</title>
</head>
<body>



<?php 

$ambil=$koneksi->query("SELECT * FROM chat JOIN pelanggan ON kategori.id_pelanggan=pelanggan.id_pelanggan"); 
$ambil = $koneksi->query("SELECT * FROM chat");
$pecah = $ambil->fetch_assoc();
?>

<form method="post">
	<div class="form-group">
		<?php 
		$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
		$nama_pelanggan = $_SESSION['pelanggan']['nama_pelanggan'];
		$waktu = time();
		
		 ?>

	 
	<input type="text" name="isi_pesan" placeholder="Masukan Pesan">
	</div>
	<button class="btn btn-primary" name="kirim">Kirim</button>
</form>

<?php 
if (isset($_POST['kirim'])) 
{
	$koneksi->query("INSERT INTO chat (isi_pesan,id_pelanggan,nama_pelanggan,waktu) VALUES ('$_POST[isi_pesan]','$id_pelanggan','$nama_pelanggan','$waktu')");
	
	echo "<script>alert('Pesan Terkirim');</script>";
	echo "<script>location='chat.php';</script>";

}
 ?>




<?php 
echo $nama_pelanggan;
?>    
<?php
echo $pecah['isi_pesan']; 
?> 

</body>
</html>