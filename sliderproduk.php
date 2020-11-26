
<?php include 'koneksi.php'; ?>
<?php 

$fotoproduk = array();
$ambilfoto = $koneksi->query("SELECT * FROM produk_foto");
while($tiap = $ambilfoto->fetch_assoc())
{
  $fotoproduk[] = $tiap;
}

 ?>
<!DOCTYPE html>
<html>
    <head>
      <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      position: fixed;
      top: 0;
      width: 100%;
      margin-bottom: 0;
      border-radius: 0;
    }
    
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
    <body>
<hr>



<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>

    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="/foto_produk/<?php echo $ambilfoto["nama_produk_foto"] ?>" alt="Image">
        <div class="carousel-caption">
          <h3>NJM Fish Shop</h3>
          <p>Jual Berbagai Macam Ikan</p>
        </div>      
      </div>

      <div class="item">
        <img src="img/njmfish2.png" alt="Image">
        <div class="carousel-caption">
          <h3>NJM Fish Shop</h3>
          <p>Jual Berbagai Macam Ikan</p>
        </div>      
      </div>
      <div class="item">
        <img src="img/njmfish3.png" alt="Image">
        <div class="carousel-caption">
          <h3>NJM Fish Shop</h3>
          <p>Jual Berbagai Macam Ikan</p>
        </div>      
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>

<?php echo $ambil ?>


    </body>
</html>