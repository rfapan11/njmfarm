<?php 

$id_foto = $_GET["idfoto"];
$id_produk = $_GET["idproduk"];


// ambil data nya
$ambilfoto = $koneksi->query("SELECT * FROM produk_foto WHERE id_produk_foto='$id_foto'");
$detailfoto = $ambilfoto->fetch_assoc();

$namafilefoto = $detailfoto["nama_produk_foto"];
// hapus file foto dari folder
unlink("..//foto_produk/".$namafilefoto);


// // menghapus data di mysql
$koneksi->query("DELETE FROM produk_foto WHERE id_produk_foto='$id_foto'");

echo "<script>alert('Foto Produk Terhapus');</script>";
echo "<script>location='index.php?halaman=detailproduk&id=$id_produk';</script>";


 ?>