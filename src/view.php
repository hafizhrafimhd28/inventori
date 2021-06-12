<?php
require 'function.php';
require 'cek.php';

//get id barang
$idbarang=$_GET['id'];

//get informasi brg
$get=mysqli_query($conn, "select*from stockbrg where idbarang='$idbarang'");
$fetch=mysqli_fetch_assoc($get);
//set variabel
$namabarang=$fetch['namabarang'];
$deskripsi=$fetch['deskripsi'];
$stock=$fetch['stock'];
$image=$fetch['image'];

//cek gambar
$gambar=$fetch['image'];
if($gambar==null){
    //jika tidak ada gambar
    $img='No Photo';
}else{
    //jika ada gambar
    $img='<img class="card-img-top" src="image/'.$gambar.'" alt="Card image" style="width:100%">';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Tampilan Barang</title>
</head>
<body>
<div class="container">
  <h2>Detail Barang</h2>
  
  <div class="card" style="width:400px">
    <?=$img;?>
    <div class="card-body">
      <h4 class="card-title"><?=$namabarang;?></h4>
      <p class="card-text">Deskripsi    :<?=$deskripsi;?></p>
      <p class="card-text">Stock        :<?=$stock;?></p>
    </div>
  </div>
  <br>
</body>
</html>