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

		<?php $ambil=$koneksi->query("SELECT * FROM kategori WHERE id_kategori"); ?>
		<?php $pecah = $ambil->fetch_assoc();?>

		<?php foreach ($semuadata as $key => $value): ?>
			
		
		<tr>
			<td><?php echo $key+1 ?></td>
			<td><?php echo $value["nama_kategori"] ?></td>
			<td>
				<a href="" class="btn btn-warning">Ubah</a>
				<a href="index.php?halaman=hapuskategori&id=<?php echo $pecah['id_kategori']; ?>" class="btn btn-danger">Hapus</a>
			</td>
		</tr>
		<?php endforeach ?>
		
	</tbody>
</table>

<a href="index.php?halaman=tambahkategori" class="btn btn-success">Tambah Data</a>