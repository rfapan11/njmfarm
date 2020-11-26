<?php 
session_start();
//koneksi ke database
include 'koneksi.php';


// jika tidak ada session pelanggan (belum login)
if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"])) 
{
	echo "<script>alert('silahkan login');</script>";
	echo "<script>location='login.php'</script>";
	exit();
}
 ?>
<!DOCTYPE html>
<html>
    <head>
      <title>NJM Fish Shop</title>
      <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
      <link rel="shortcut icon" href="img/NJMFishLogo.png" />
    </head>
    <body>
        

<hr>

<section class="riwayat">
	<div class="container">
		<h3>Riwayat Belanja <?php echo $_SESSION["pelanggan"]["nama_pelanggan"] ?></h3>

		<table class="table table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Tanggal</th>
					<th>Status</th>
					<th>Total</th>
					<th>Opsi</th>
				</tr>
			</thead>
			<tbody>
				<?php 

				$nomor=1;
				// mendapatkan id_pelanggan yg login dari session
				$id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];

				$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan'");
				while($pecah = $ambil->fetch_assoc()){

				 ?>
				
				<tr>
					<td><?php echo $nomor; ?></td>
					<td><?php echo $pecah["tanggal_pembelian"] ?></td>
					<td><strong>
						<?php echo $pecah["status_pembelian"] ?>
						<br>
						<?php if (!empty($pecah['resi_pengiriman'])): ?>
						No. Resi : <?php echo $pecah['resi_pengiriman']; ?>
						<?php endif ?>	
						</strong>					
					</td>
					<td><?php echo number_format($pecah["total_pembelian"]) ?></td>
					<td>
						<a href="nota.php?id=<?php echo $pecah["id_pembelian"] ?>" class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span> Nota</a>

						<?php if ($pecah['status_pembelian']=="Belum Bayar"): ?>
							
						
						<a href="pembayaran.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="btn btn-success"><span class="glyphicon glyphicon-usd"></span> Lakukan Pembayaran
						</a>
						<?php else: ?>
							<a href="lihat_pembayaran.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="btn btn-warning"><span class="glyphicon glyphicon-file"></span>
								Lihat Pembayaran
							</a>
						<?php endif ?>
					</td>
				</tr>
			<?php $nomor++; ?>
			<?php } ?>
			</tbody>
		</table>
	</div>
</section>
<?php include 'menu.php'; ?>
</body>
</html>