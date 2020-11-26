<?php 
session_start();
//koneksi ke database
include 'koneksi.php';
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Pelanggan</title>
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
<?php include 'menu.php'; ?><hr>

<br>


<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><center><STRONG>..:: LOGIN ::..</STRONG></center></h3>
				</div>
				<div class="panel-body">
					<form method="post">
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" name="email">
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" class="form-control" name="password">
						</div>
						<button class="btn btn-primary" name="login"><span class="glyphicon glyphicon-log-in"></span> Login</button>
						Belum punya akun? <a href="daftar.php">Daftar</a>
					</form>
				</div>
			</div>
		</div>		
	</div>
</div>


<?php 
// jika ada tombol login(tombol login di tekan)
if (isset($_POST["login"])) 
{

	$email = $_POST["email"];
	$password = $_POST["password"];

	// lakukan query ngecek akun di tabel pelanggan di db
	$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email' AND password_pelanggan='$password'");

	// ngitung akun yg di ambil
	$akunyangcocok = $ambil->num_rows;

	// jika 1 akun yg cocok maka boleh di loginkan
	if ($akunyangcocok==1) 
	{
		// anda sudah login
		// mendapatkan akun dalam bentuk array
		$akun = $ambil->fetch_assoc();
		// simpan di session pelanggan
		$_SESSION["pelanggan"] = $akun;
		echo "<script>alert('Anda berhasil login');</script>";

		// jika sudah belanja 
		if (isset($_SESSION["keranjang"]) OR !empty($_SESSION["keranjang"])) 
		{
			echo "<script>location='checkout.php';</script>";
		}
		else
		{
			echo "<script>location='index.php';</script>";
		}
	}
	else
	{
		// anda gagal login
		echo "<script>alert('anda gagal login, perika akun anda');</script>";
		echo "<script>location='login.php';</script>";
	}
}


 ?>


<div class="footer">
  NJM Fish Shop
</div>

</body>
</html>