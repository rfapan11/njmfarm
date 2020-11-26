<?php 
session_start();
include 'koneksi.php';

// jika tidak ada session pelanggan (belum login) maka di larikan ke login.php
if (empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"]))
{
	echo "<script>alert('Keranjang kosong, silahkan belanja dulu');</script>";
	echo "<script>location='index.php';</script>";
}

// echo "<pre>";
// print_r($_SESSION['keranjang']);
// echo "</pre>";



if (empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"]))
{
	echo "<script>alert('Keranjang kosong, silahkan belanja dulu');</script>";
	echo "<script>location='index.php';</script>";
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Keranjang Belanja | NJM Farm</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
	<link rel="shortcut icon" href="img/NJMFishLogo.png" />
</head>
<body>


<?php include 'menu.php'; ?><hr>


<section class="konten">
	<div class="container">
		<div class="row">
			<h1>Keranjang Belanja</h1>
		<hr>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Produk</th>
					<th>Harga</th>
					<th>Jumlah</th>
					<th>Sub Harga</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $nomor=1; ?>
				<?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
				<!-- menampilkan produk yg sedang  di perulangkan berdasarkan id_produk -->
				<?php 
				$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
				$pecah = $ambil->fetch_assoc();
				$subharga = $pecah['harga_produk']*$jumlah;
				 ?>
				
				
				<tr>
					<td><?php echo $pecah["nama_produk"]; ?></td>
					<td>Rp.<?php echo number_format($pecah["harga_produk"]); ?></td>
					<td><?php echo $jumlah; ?></td>
					<td>Rp.<?php echo number_format($subharga); ?></td>
					<td>
						<a href="hapuskeranjang.php?id=<?php echo $id_produk ?>" class="btn btn-danger btn-xs">X</a>
					</td>
				</tr>
				<?php $nomor++; ?>
				<?php endforeach ?>
			</tbody>
		</table>

		<a href="index.php" class="btn btn-default"><span class="glyphicon glyphicon-shopping-cart"></span> Lanjutkan Belanja</a>
		<a href="checkout.php" class="btn btn-primary"><span class="glyphicon glyphicon-check"></span> Checkout</a>

		</div>
	</div>
	
</section><hr>
<div class = "footer">
      <div class="footer">© 2020 <a href="http://instagram.com/njmfish">NJM Fish</a> | Developed by <a href="http://instagram.com/apan1st">A.B Apand</a>
      </div>
</div>
</body>
</html>