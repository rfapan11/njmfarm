<?php 
//koneksi ke database
include 'koneksi.php';
 ?>
 <?php 
$keyword = $_GET["keyword"];
$semuadata=array();
$ambil = $koneksi->query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%'
	OR deskripsi_produk LIKE '%$keyword%'");
while($pecah = $ambil->fetch_assoc())
{
	$semuadata[]=$pecah;
}


  ?>
<!DOCTYPE html>
<html>
    <head>
      <title>Pencarian</title>
      <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
      <link rel="shortcut icon" href="img/NJMFishLogo.png" />
      <style>
      	body 
    .thumbnail{
      background-image: url("img/bgthumbnail.jpg"); 
      }
      </style>
    </head>
    <body>
        

<?php include 'menu.php'; ?>
<?php include 'slider.html'; ?>

<div class="container">
	
	<strong><h3>Hasil Pencarian : <?php echo $keyword ?></h3></strong>
	
	<?php if (empty($semuadata)): ?>
		<div class="alert alert-danger">Produk <?php echo $keyword ?> Tidak ditemukan</div>
	<?php endif ?>

	<div class="row">


		<?php foreach ($semuadata as $key => $value): ?>
			
		<div class="col-md-3">
			<div class="thumbnail">
				<img src="foto_produk/<?php echo $value["foto_produk"] ?>" alt="" style="width:300px;height:200px; alt="" class="img-responsive">
				<div class="caption">
				<h3><?php echo $value["nama_produk"] ?></h3>
				<h5>Rp. <?php echo number_format($value['harga_produk']); ?></h5>
                  <a href="detail.php?id=<?php echo $value['id_produk']; ?>" class="btn btn-primary"><span class="glyphicon glyphicon-shopping-cart"></span> Beli</a>
				</div>
			</div>
		</div>
		<?php endforeach ?>

	</div>
</div>
<?php include 'menu.php' ?>
</body>
</html>

