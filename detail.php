<?php session_start(); ?>
<?php include 'koneksi.php'; ?>
<?php 
// mendapatkan id produk dari url
$id_produk = $_GET["id"];

// query ambil data
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$detail = $ambil->fetch_assoc();

// echo "<pre>";
// print_r($detail);
// echo "</pre>";

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Detail Produk</title>
      <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
      <link rel="shortcut icon" href="img/NJMFishLogo.png" />
      <style type="text/css">
      	body {
      background-image: url("img/background3.jpg"); 
      width: 100%;
    }
      .thumbnail{
      background-image: url("img/bgthumbnail.jpg"); 
      }
      </style>
</head>
<body>
<hr><br>


<section class="konten">
        <div class="container">
            <div class="row">
            	<div class="col-md-4 col-md-offset-4">
              	<div class="thumbnail"><br>
                   <div class="caption">
                <img src="foto_produk/<?php echo $detail["foto_produk"]; ?>" class="img-thumbnail" style="width:350px;height:200px;">
<hr>
               
		           	 <div class="row">
		              <div class="col-md-12">
		                <div class="alert alert-info">
		                  <p>
		                  	<label>Detail Produk</label><br>
		                  	<b><?php echo $detail["nama_produk"] ?><br></b>
		                  	Harga : Rp. <?php echo number_format($detail["harga_produk"]) ?><br>
		                	Berat : <?php echo $detail["berat_produk"] ?> Gram<br>
		                	Stok : Tersisa <b><?php echo $detail["stok_produk"] ?></b> Ekor<br><br>
		                    <label>Deskripsi Produk</label><br>
		                    <?php echo $detail["deskripsi_produk"]; ?>
		                  </p>
		                </div>
		              </div>
		            </div>
            Masukan Jumlah Beli
            <form method="post">
          <div class="form-group">
            <div class="input-group">
              <input type="number" min="1" class="form-control" name="jumlah" max="<?php echo $detail["stok_produk"] ?>" value="1">
              <div class="input-group-btn">
                <button class="btn btn-primary" name="beli"><span class="glyphicon glyphicon-shopping-cart"></span> Beli</button>
              </div>
            </div>
          </div>
        </form>

        <?php 
        // jika ada tombol beli
        if (isset($_POST["beli"])) 
        {
          // mendapatkan jumlah yg di inputkan
          $jumlah = $_POST["jumlah"];
          // masukan di keranjang belanja
          $_SESSION["keranjang"]["$id_produk"] = $jumlah;

          echo "<script>alert('Produk telah masuk ke keranjang belanja');</script>";
          echo "<script>location='keranjang.php';</script>";
        }
         ?>

        </div>
            	</div>

            </div>
        </div>

</section>



<?php include 'menu.php'; ?>
</body>
</html>