<!DOCTYPE html>
<html>
<head>
	<title>Tambah Kategori</title>
</head>
<body>


<h3>Data Kategori</h3>
<hr>


<?php 
$semuadata = array();
$ambil = $koneksi->query("SELECT * FROM kategori");
while($tiap = $ambil->fetch_assoc())
{
	$semuadata[] = $tiap;
}
 ?>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Kategori</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($semuadata as $key => $value): ?>
			
		
		<tr>
			<td><?php echo $key+1 ?></td>
			<td><?php echo $value["nama_kategori"] ?></td>
			<td>
				<a href="" class="btn btn-warning">Ubah</a>
				<a href="" class="btn btn-danger">Hapus</a>
			</td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>

<a href="index.php?halaman=tambahkategori" class="btn btn-success">Tambah Data</a><hr>




<form method="post">
	<div class="form-group">
	<label>Nama Kategori : <input type="text" name="nama_kategori" class="form-control" placeholder="Masukan Kategori">
	</label>
	</div>
	<button class="btn btn-primary" name="save">Simpan</button>
</form>

<?php 
if (isset($_POST['save'])) 
{
	$koneksi->query("INSERT INTO kategori (nama_kategori) VALUES ('$_POST[nama_kategori]')");
	
	echo "<script>alert('Kategori telah ditambah');</script>";
	echo "<script>location='index.php?halaman=kategori';</script>";

}
 ?>


</body>
</html>