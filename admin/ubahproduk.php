<h2>Ubah Produk</h2>
<?php 
$ambil=$koneksi->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
$pecah= $ambil->fetch_assoc();

 ?>

 <?php 
$datakategori = array();

$ambil = $koneksi->query("SELECT * FROM kategori");
while ($tiap = $ambil->fetch_assoc()) 
{
	$datakategori[] = $tiap;
}

 ?>

<form method="post" enctype="multipart/form-data">
	
	<div class="form-group">
		<label>Kategori</label>
		<select class="form-control" name="id_kategori">
			<option value="">Pilih Kategori</option>
			<?php foreach ($datakategori as $key => $value): ?>
				
			<option value="<?php echo $value["id_kategori"] ?>" <?php if ($pecah["id_kategori"]==$value["id_kategori"]) 
			{
				echo "selected";
			} 
			?>>
				<?php echo $value["nama_kategori"] ?>
			</option>
			<?php endforeach ?>
		</select>
	</div>

	<div class="form-group">
		<label>Nama Produk</label>
		<input type="text" name="nama" class="form-control" value="<?php echo $pecah['nama_produk']; ?>">
	</div>
	<div class="form-group">
		<label>Harga Produk</label>
		<input type="number" name="harga" class="form-control" value="<?php echo $pecah['harga_produk']; ?>">
	</div>
	<div class="form-group">
		<label>Berat Produk</label>
		<input type="number" name="berat" class="form-control" value="<?php echo $pecah['berat_produk']; ?>">
	</div>
	<div class="form-group">
		<label>Foto</label><br>
		<img src="../foto_produk/<?php echo $pecah['foto_produk'] ?>" width="200"><br><br>
		<input type="file" class="form-control" name="foto">
	</div>

	<div class="form-group">
		<label>Deskripsi Produk</label>
		<textarea name="deskripsi" class="form-control" rows="10"><?php echo $pecah['deskripsi_produk']; ?>
		</textarea>
	</div>

	<div class="form-group">
		<label>Stok</label>
		<input type="number" name="stok" class="form-control" value="<?php echo $pecah['stok_produk']; ?>">
	</div><br>

	<button class="btn btn-primary" name="ubah">Ubah</button>
</form>

<?php
if (isset($_POST['ubah'])) 
{
	$foto = $_FILES['foto']['name'];
  	$lokasi = $_FILES['foto']['tmp_name'];
  	$fotoproduk = $pecah['foto_produk'];
  	$fotosebelumnya = $pecah['foto_produk'];
  	
	// jika foto dirubah
	if (!empty($lokasi))
	{
		move_uploaded_file($lokasi, "../foto_produk/".$foto);

		$koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]',harga_produk='$_POST[harga]',berat_produk='$_POST[berat]',foto_produk='$foto',deskripsi_produk='$_POST[deskripsi]',stok_produk='$_POST[stok]',id_kategori='$_POST[id_kategori]'
			WHERE id_produk='$_GET[id]'");
	}

	else 
	{
		$koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]',harga_produk='$_POST[harga]',berat_produk='$_POST[berat]',deskripsi_produk='$_POST[deskripsi]',stok_produk='$_POST[stok]',id_kategori='$_POST[id_kategori]'
			WHERE id_produk='$_GET[id]'");
	}
	echo "<script>alert('Produk Telah Dirubah');</script>";
	echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";
	exit();
}
?>
