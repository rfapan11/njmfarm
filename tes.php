<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link href="fontawesome/css/all.css" rel="stylesheet">
  <style type="text/css">
  #keranjang .p1[data-count]:after{
  position:absolute;
  right:10%;
  top:8%;
  content: attr(data-count);
  font-size:40%;
  padding:.2em;
  border-radius:50%;
  line-height:1em;
  color: white;
  background:rgba(255,0,0,.85);
  text-align:center;
  min-width: 1em;
  //font-weight:bold;
}


  </style>
</head>
<body>
<div id="keranjang">
  <span class="p1 fa-stack fa-2x has-badge" data-count="4">
    <!--<i class="p2 fa fa-circle fa-stack-2x"></i>-->

  </span>
</div>
</body>
</html>