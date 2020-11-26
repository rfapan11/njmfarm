

<!-- // Badge Riwayat Belanja -->
<?php include 'koneksi.php'; ?>
<?php if (isset($_SESSION["pelanggan"])): ?>
<?php 
$id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
$data_belanja = mysqli_query($koneksi,"SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan'");
$riwayatbelanja = mysqli_num_rows($data_belanja); 
$nomor=0; ?>

<?php endif ?>


<!-- // badge Keranjang -->
<?php 

if (isset($_SESSION["keranjang"]))
{
	// mengambil data barang
$dikeranjang = mysqli_query($koneksi,"SELECT * FROM produk ");
 
// menghitung data barang
$nomor=1-1;
$jumlahdikeranjang = mysqli_num_rows($dikeranjang);
foreach ($_SESSION["keranjang"] as $id_produk => $jumlah):
$nomor++; 
endforeach;
}

elseif (empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"]))
{
	$keranjangkosong = 0;
}

 ?>