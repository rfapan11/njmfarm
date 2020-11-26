<?php 
session_start();
include 'koneksi.php';

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Nota Belanja</title>
 	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
 	<link rel="shortcut icon" href="img/NJMFishLogo.png" />
 </head>
 <body>


<hr>

      <section class="konten">
      	<div class="container">
      		

      		<!-- nota disini copas saja dari nota yg ada di admin -->
      		<h2>Detail Pembelian</h2>
<?php 
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan 
	ON pembelian.id_pelanggan=pelanggan.id_pelanggan
	WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();
 ?>


<!-- jika pelanggan yg beli tidak sama dengan pelanggan yg login, maka di larikan ke riwayat.php karena dia tidak berhak melihat nota orang lain -->
<!-- pelanggan yg beli harus pelanggan yg login -->
<?php 
// mendapatkan id_pelanggan yg beli
$idpelangganyangbeli = $detail["id_pelanggan"];

// mendapatkan id_pelanggan yg login
$idpelangganyanglogin = $_SESSION["pelanggan"]["id_pelanggan"];

if ($idpelangganyangbeli!==$idpelangganyanglogin) 
{
	echo "<script>alert('anda tidak punya akses');</script>";
	echo "<script>location='riwayat.php'</script>";
	exit();
}
 ?>


<div class="row">
	<div class="col-md-4">
		<h3>Pembelian</h3>
		<strong>No. Pembelian : <?php echo $detail['id_pembelian']; ?></strong><br>
		Tanggal : <?php echo date("d F Y",strtotime($detail['tanggal_pembelian'])); ?><br>
		Total : <strong>Rp. <?php echo number_format($detail['total_pembelian']) ?></strong>
	</div>
	<div class="col-md-4">
		<h3>Pelanggan</h3>
		<strong><?php echo $detail['nama_pelanggan']; ?></strong><br>
		<p>
		 	<?php echo $detail['telepon_pelanggan']; ?><br>
		 	<?php echo $detail['email_pelanggan']; ?>
		</p>
	</div>
	<div class="col-md-4">
		<h3>Pengiriman</h3>
		<strong><?php echo $detail['tipe'] ?> <?php echo $detail['kota'] ?></strong><br>
		Ongkos Kirim : <strong>Rp. <?php echo number_format($detail['ongkir']); ?> </strong><br>
		Ekspedisi : <?php echo $detail["ekspedisi"] ?> - <?php echo $detail["paket"] ?> (<?php echo $detail["estimasi"] ?> Hari) <br>
		Alamat : <?php echo $detail['alamat_pengiriman']; ?>
	</div>
</div>

<div class="row">
	<table class="table table-bordered">
	<thead>
		<tr>
			<th>Nama Produk</th>
			<th>Jumlah</th>
			<th>Harga</th>
			<th>Berat</th>
			
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian='$_GET[id]'"); ?>
		<?php while($pecah=$ambil->fetch_assoc()){ ?>
		<tr>
			<td><?php echo $pecah['nama'] ?><br></td>
			<td><?php echo number_format($pecah['jumlah']) ?> Ekor</td>
			<td>Rp.<?php echo number_format($pecah['harga']) ?></td>
			<td><?php echo number_format($pecah['berat']) ?> Gram</td>
			

		</tr>
		
	</tbody>
	<tfoot>
				<tr>
					<th colspan="2">Total</th>
					<td><strong>Rp.<?php echo number_format($pecah['subharga']) ?></strong></td>
					<td><strong><?php echo number_format($pecah['berat']) ?>gr x <?php echo number_format($pecah['jumlah']) ?> = <?php echo number_format($pecah['subberat']) ?> Gram</strong></td>
				</tr>
			</tfoot><?php $nomor++; ?>
		<?php } ?>
</table>
</div>

<div class="row">
	<div class="col-md-7">
		<div class="alert alert-info">
			<p>
				Silahkan melakukan pembayaran sebesar <strong>Rp.<?php echo number_format($detail['total_pembelian']) ?></strong> (Sudah termasuk Ongkir) <br>ke 
				<strong>BANK BCA 7391019111 AN. Achmad Bagus Apandi</strong>
			</p>
		</div>
	</div>
</div>
<div class="col-md-7">
		<a href="riwayat.php" class="btn btn-success">Lanjut <span class="glyphicon glyphicon-forward"></span></a>
	</div>
      	</div>
      </section>
 	<?php include 'menu.php'; ?>
 </body>
 </html>