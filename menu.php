
<!DOCTYPE html>
<html lang="en">
<head>
  <title>NJM Farm</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="fontawesome/css/all.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      background-image: url("img/background3.jpg");
      position: fixed;
      top: 0;
      width: 100%;
      margin-bottom: 0;
      border-radius: 0;
    }

    .judul {
      background-image: url("img/kayu.jpg"); 
      padding: 0px;
      left: 0;
      bottom: 0;
      width: 100%;
      text-align: center;
    }
    
    /* Add a gray background color and some padding to the footer */
    .footer {
      background-color: #f2f2f2;
      padding: 10px;
      left: 0;
      bottom: 0;
      width: 100%;
      text-align: center;
    }

  .carousel-inner img {
      width: 100%; /* Set width to 100% */
      margin: auto;
      max-height:380px;
  }

  /* Hide the carousel text when the screen is less than 600 pixels wide */
  @media (max-width: 600px) {
    .carousel-caption {
      display: none; 
    }
  }

  </style>
</head>
<?php include 'badge.php' ?>

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
        <li><a href="checkout.php"><span class="glyphicon glyphicon-check"></span> Checkout</a></li>
        <?php if (empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"])): ?>
        <li>
          <a href="keranjang.php">
          <i class="fa fa-shopping-cart"></i> 
          </a>
        </li>
        <?php else: ?>
        <li>
          <a href="keranjang.php">
          <i class="fa fa-shopping-cart"></i> <span class="badge badge-light"><?php echo $nomor ?></span>
        </a>
        </li>
        <?php endif ?>
            
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
        <!-- jika sudah login (ada session pelanggan) -->

        <?php if (isset($_SESSION["pelanggan"])): ?>
        <li><a href="riwayat.php">Riwayat Belanja <span class="badge badge-light"><?php echo $riwayatbelanja ?></span></a></li>
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        <!-- salain itu(belum ada session pelanggan) -->
        <?php else: ?>
        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        <li><a href="daftar.php"><span class="glyphicon glyphicon-user"></span> Daftar</a></li>
        <?php endif ?>
        <form action="pencarian.php" method="get" class="navbar-form navbar-right">
            <input type="text" class="form-control" name="keyword" placeholder="Pencarian">
            <button class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button>

        </form>
      </ul>
    </div>
  </div>
</nav>

<div class = "footer">
      <div class="footer">© 2020 <a href="http://instagram.com/njmfish">NJM Fish</a> | Developed by <a href="http://instagram.com/apan1st">A.B Apand</a>
      </div>
</div>