<?php 
session_start();
//koneksi ke database
include 'koneksi.php';
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Daftar</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
	<link rel="shortcut icon" href="img/NJMFishLogo.png" />
	<style>
    
    /* Add a gray background color and some padding to the footer */
    .footer {
      background-color: #f2f2f2;
      padding: 10px;
      position: fixed;
      left: 0;
      bottom: 0;
      width: 100%;
      text-align: center;
 	  }

  </style>
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
        <!-- jika sudah login (ada session pelanggan) -->

        <form action="pencarian.php" method="get" class="navbar-form navbar-right">
            <input type="text" class="form-control" name="keyword" placeholder="Pencarian">
            <button class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button>

        </form>
      </ul>
    </div>
  </div>
</nav>
<br>

	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title"><center><strong>..:: Daftar Pelanggan ::..</strong></center></h3>
					</div>
					<div class="panel-body">
						<form method="post" class="form-horizontal">
							<div class="form-group">
								<label class="control-label col-md-3">Nama</label>
								<div class="col-md-7">
									<input class="form-control" type="text" name="nama" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Email</label>
								<div class="col-md-7">
									<input class="form-control" type="email" name="email" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Password</label>
								<div class="col-md-7">
									<input class="form-control" type="password" name="password" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Alamat</label>
								<div class="col-md-7">
									<textarea class="form-control" name="alamat" required></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">No HP</label>
								<div class="col-md-7">
									<input class="form-control" type="text" name="telepon" required>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-7 col-md-offset-3">
									<button class="btn btn-primary" name="daftar"><span class="glyphicon glyphicon-floppy-saved"></span> Daftar</button>
									Sudah punya akun? <a href="login.php">Login</a>
								</div>
							</div>
						</form>

						<?php 
						// jika ada tombol daftar di tekan 
						if (isset($_POST["daftar"])) 
						{
							// mengambil isian nama email password alamat telepon
							$nama = $_POST["nama"];
							$email = $_POST["email"];
							$password = $_POST["password"];
							$alamat = $_POST["alamat"];
							$telepon = $_POST["telepon"];

							// cek apakah email tidak di gunakan
							$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email'");
							$yangcocok = $ambil->num_rows;
							if ($yangcocok==1)
							{
								echo "<script>alert('pendaftaran gagal, email sudah di gunakan');</script>";
								echo "<script>location='daftar.php';</script>";
							}
							else
							{
								// query insert ke table pelanggan
								$koneksi->query("INSERT INTO pelanggan (email_pelanggan,password_pelanggan,nama_pelanggan,telepon_pelanggan,alamat_pelanggan) VALUES ('$email','$password','$nama','$telepon','$alamat')");

								echo "<script>alert('pendaftaran sukses, silahkan login');</script>";
								echo "<script>location='login.php';</script>";

							}

						}
						 ?>

				</div>
			</div>
		</div>
	</div>


	<div class="footer">
  NJM Fish Shop
</div>

</body>
</html>