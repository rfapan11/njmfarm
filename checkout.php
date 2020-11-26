<?php 
session_start();
//koneksi ke database
include 'koneksi.php';

// jika tidak ada session pelanggan (belum login) maka di larikan ke login.php
if (!isset($_SESSION["pelanggan"]))
{
	echo "<script>alert('Silahkan Login dulu');</script>";
	echo "<script>location='login.php';</script>";
}
elseif (empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"]))
{
	echo "<script>alert('Keranjang kosong, silahkan belanja dulu');</script>";
	echo "<script>location='index.php';</script>";
}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Checkout</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
	<link rel="shortcut icon" href="img/NJMFishLogo.png" />
	<script src="admin/assets/js/jquery.min.js"></script>
</head>
<body>

<hr>

<section class="konten">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Checkout</h1>
		<hr>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Produk</th>
					<th>Harga</th>
					<th>Jumlah</th>
					<th>Sub Harga</th>
				</tr>
			</thead>
			<tbody>
				<?php $nomor=1; ?>
				<?php $totalberat=0; ?>
				<?php $totalbelanja=0; ?>
				<?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
				<!-- menampilkan produk yg sedang  di perulangkan berdasarkan id_produk -->
				<?php 
				$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
				$pecah = $ambil->fetch_assoc();
				$subharga = $pecah['harga_produk']*$jumlah;

				//subberat diperoleh dari berat produk di kali jumlah
				$subberat = $pecah["berat_produk"] * $jumlah;
				// total berat
				$totalberat+=$subberat;
				 ?>
				
				
				<tr>
					<td><?php echo $nomor; ?></td>
					<td><?php echo $pecah["nama_produk"]; ?></td>
					<td>Rp.<?php echo number_format($pecah["harga_produk"]); ?></td>
					<td><?php echo $jumlah; ?></td>
					<td>Rp.<?php echo number_format($subharga); ?></td>
				</tr>
				<?php $nomor++; ?>
				<?php $totalbelanja+=$subharga; ?>
				<?php endforeach ?>
			</tbody>
			<tfoot>
				<tr>
					<th colspan="4">Total Belanja</th>
					<th>Rp.<?php echo number_format($totalbelanja) ?></th>
				</tr>
			</tfoot>
		</table>

		<form method="post">
			
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label>Nama</label>
						<input type="text" readonly value="<?php echo $_SESSION["pelanggan"]['nama_pelanggan'] ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Telepon</label>
						<input type="text" readonly value="<?php echo $_SESSION["pelanggan"]['telepon_pelanggan'] ?>" class="form-control">
					</div>
				</div>
				
			</div>

			<div class="form-group">
				<label>Alamat Pengiriman</label>
				<textarea class="form-control" name="alamat_pengiriman" placeholder="Masukan alamat lengkap pengiriman (termasuk kode pos)"></textarea>
			</div>

			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label>Provinsi</label>
						<select class="form-control" name="nama_provinsi">
							
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Kota</label>
						<select class="form-control" name="nama_kota">

						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Ekspedisi</label>
						<select class="form-control" name="nama_ekspedisi">

						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Paket</label>
						<select class="form-control" name="nama_paket">

						</select>
					</div>
				</div>

			</div>
			<input type="hidden" name="total_berat" value="<?php echo $totalberat ?>">
			<input type="hidden" name="provinsi">
			<input type="hidden" name="city">
			<input type="hidden" name="tipe">
			<input type="hidden" name="kodepos">
			<input type="hidden" name="ekspedisi">
			<input type="hidden" name="paket">
			<input type="hidden" name="ongkir">
			<input type="hidden" name="estimasi">

		
			<button class="btn btn-primary" name="checkout"><span class="glyphicon glyphicon-check"></span> Checkout</button>
		</form>
<?php  
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$perproduk = $ambil->fetch_assoc();?>

<?php if (($perproduk["stok_produk"]==0)): ?>
echo "<script>alert('Maaf produk yg anda inginkan telah HABIS');</script>";
echo "<script>location='index.php';</script>";
<?php else: ?>	



		<?php 
		if (isset($_POST["checkout"])) 
		{
			$id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];

			$tanggal_pembelian = date("Y-m-d");
			$alamat_pengiriman = $_POST['alamat_pengiriman'];


			$totalberat = $_POST['total_berat'];
			$provinsi = $_POST['provinsi'];
			$kota = $_POST['city'];
			$tipe = $_POST['tipe'];
			$kodepos = $_POST['kodepos'];
			$ekspedisi = $_POST['ekspedisi'];
			$paket = $_POST['paket'];
			$ongkir = $_POST['ongkir'];
			$estimasi = $_POST['estimasi'];



			$total_pembelian = $totalbelanja + $ongkir;

			// menyimpan data ke tabel pembelian
			$koneksi->query("INSERT INTO pembelian (id_pelanggan,tanggal_pembelian,total_pembelian,alamat_pengiriman,totalberat,provinsi,kota,tipe,kodepos,ekspedisi,paket,ongkir,estimasi) VALUES ('$id_pelanggan','$tanggal_pembelian','$total_pembelian','$alamat_pengiriman','$totalberat','$provinsi','$kota','$tipe','$kodepos','$ekspedisi','$paket','$ongkir','$estimasi')");

			// mendapatkan id_pembelian barusan terjadi
			$id_pembelian_barusan = $koneksi->insert_id;

			foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) 
			{

			// mendapatkan data produk berdasarkan id produk
				$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
				$perproduk = $ambil->fetch_assoc();

				$nama = $perproduk['nama_produk'];
				$harga = $perproduk['harga_produk'];
				$berat = $perproduk['berat_produk'];

				$subberat = $perproduk['berat_produk']*$jumlah;
				$subharga = $perproduk['harga_produk']*$jumlah;
				$koneksi->query("INSERT INTO pembelian_produk (id_pembelian,id_produk,nama,harga,berat,subberat,subharga,jumlah)
					VALUES ('$id_pembelian_barusan','$id_produk','$nama','$harga','$berat','$subberat','$subharga','$jumlah')");


				// skrip update stok
				$koneksi->query("UPDATE produk SET stok_produk=stok_produk-$jumlah
					WHERE id_produk='$id_produk'");
			}


			// mengkosongkan keranjang belanja
			unset($_SESSION["keranjang"]);


			// tampilan di alihkan ke halaman nota, nota dari pembelian yg barusan
			echo "<script>alert('Pembelian sukses');</script>";
			echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";

		}


		 ?>
<?php endif ?>
			</div>
		</div>
	</div>
	
</section><hr>
<?php include 'menu.php'; ?>
</body>
</html>


<script>
	$(document).ready(function(){
		$.ajax({
			type:'post',
			url:'dataprovinsi.php',
			success:function(hasil_provinsi)
			{
				$("select[name=nama_provinsi]").html(hasil_provinsi);
			}
		});

		$("select[name=nama_provinsi]").on("change",function(){
			// ambil id_provinsi yang di pilih (dari attribut pribadi)
			var id_provinsi_terpilih = $("option:selected",this).attr("id_provinsi");
			$.ajax({
				type:'post',
				url:'datakota.php',
				data:'id_provinsi='+id_provinsi_terpilih,
				success:function(hasil_kota)
				{
					$("select[name=nama_kota]").html(hasil_kota);
				}
			});
		});

		$.ajax({
			type:'post',
			url:'dataekspedisi.php',
			success:function(hasil_ekspedisi)
			{
				$("select[name=nama_ekspedisi]").html(hasil_ekspedisi);
			}
		});

		$("select[name=nama_ekspedisi]").on("change",function(){
			// mendapatkan data ongkos kirim

			// mendapatkan ekspedisi yg di pilih 
			var ekspedisi_terpilih = $("select[name=nama_ekspedisi]").val();

			// mendapatkan id_kota yg di pilih pengguna
			var kota_terpilih = $("option:selected","select[name=nama_kota]").attr("id_kota");

			// mendapatkan total_berat dari inputan
			var total_berat = $("input[name=total_berat]").val();
			$.ajax({
				type:'post',
				url:'datapaket.php',
				data:'ekspedisi='+ekspedisi_terpilih+'&kota='+kota_terpilih+'&berat='+total_berat,
				success:function(hasil_paket)
				{
					// console log (hasil_paket) 
					$("select[name=nama_paket]").html(hasil_paket);

					// letakan nama ekspedisi terpilih di input ekspedisi
					$("input[name=ekspedisi]").val(ekspedisi_terpilih);
				}
			})
		});

		$("select[name=nama_kota]").on("change",function(){
			var prov = $("option:selected",this).attr("nama_provinsi");
			var kot = $("option:selected",this).attr("nama_kota");
			var tipe = $("option:selected",this).attr("tipe_kota");
			var kodepos = $("option:selected",this).attr("kodepos");
			
			$("input[name=provinsi]").val(prov);
			$("input[name=city]").val(kot);
			$("input[name=tipe]").val(tipe);
			$("input[name=kodepos]").val(kodepos);

		});

		$("select[name=nama_paket]").on("change",function(){
			var paket = $("option:selected",this).attr("paket");
			var ongkir = $("option:selected",this).attr("ongkir");
			var etd = $("option:selected",this).attr("etd");
			$("input[name=paket]").val(paket);
			$("input[name=ongkir]").val(ongkir);
			$("input[name=estimasi]").val(etd);
		})

	});
</script>