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
    $img='<img src="image/'.$gambar.'" class="zoomable">';
}

//qr code


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link rel="icon" href="../css/title.png">
        <title>Detail Barang</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <style>
            .zoomable{
                width:100px;
            }
            .zoomable:hover{
                transform: scale(2.0);
                transition: 0.3s ease;
            }

        </style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Imadi Poteto Dept.</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li><a class="nav-link"><?=$_SESSION['username'];?></a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                    <div class="nav">
                            
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Stock Barang
                            </a>
                            <a class="nav-link" href="brgmasuk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-fw fa-chart-area"></i></div>
                                Barang Masuk
                            </a>
                            <a class="nav-link" href="brgkeluar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-fw fa-table"></i></div>
                                Barang Keluar
                            </a>
                           
                            
                        </div>
                    </div>
                    
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Detail Barang</h1>
                        
                        
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <h2><?=$namabarang;?></h2><br>
                                <?=$img;?>
                                
                                
                            </div>
                            <div class="card-body">

                            <div class="row">
                                <div class="col-md-2">Deskripsi</div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-2"><?=$deskripsi;?></div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-2">Stock</div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-2"><?=$stock;?></div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Barcode</div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-2"><img src="temp/barang<?=$idbarang;?>.png"></div>
                            </div>
                            <br><br>
                            

                            <h3>Barang Masuk</h3>
                            <div class = "table-responsive">
                                <table class="table table-bordered" id="detailmasuk" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tanggal Masuk</th>
                                            <th>Penerima</th>
                                            <th>Jumlah Barang Masuk</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ambildatamasuk = mysqli_query($conn, "select * from brgmasuk where idbarang='$idbarang'");
                                        $i=1;
                                        while($fetch=mysqli_fetch_array($ambildatamasuk)){
                                            $tanggal=$fetch['tanggal'];
                                            $ket=$fetch['ket'];
                                            $qty=$fetch['qty'];
                                        ?>
                                        <tr>
                                            <td><?=$i++;?></td>

                                            <td><?=$tanggal;?></td>
                                            <td><?=$ket;?></td>
                                            <td><?=$qty;?></td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                        
                                    </tbody>
                                </table>
                                <br><br>
                            </div>
                            <h3>Barang Keluar</h3>
                            <div class = "table-responsive">
                                <table class="table table-bordered" id="detailkeluar" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tanggal Keluar</th>
                                            <th>Pembeli</th>
                                            <th>Jumlah Barang</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $ambildatakeluar = mysqli_query($conn, "select * from brgkeluar where idbarang='$idbarang'");
                                        $i=1;
                                        while($fetch=mysqli_fetch_array($ambildatakeluar)){
                                            $tanggal=$fetch['tanggal'];
                                            $penerima=$fetch['penerima'];
                                            $qty=$fetch['qty'];
                                        ?>
                                        <tr>
                                            <td><?=$i++;?></td>

                                            <td><?=$tanggal;?></td>
                                            <td><?=$penerima;?></td>
                                            <td><?=$qty;?></td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                        
                                    </tbody>
                                </table>
                                
                            </div>               
                            
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>

     <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Barang</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <input type="text" name="namabarang" placeholder="Nama Barang" class="form-control" required>
          <br>
          <input type="text" name="deskripsi" placeholder="Deskripsi Barang" class="form-control" required>
          <br>
          <input type="number" name="stock" class="form-control" placeholder="Banyak Barang" required><br>
          <input type="file" name="file" class="form-control"><br>
          <button type="submit" class="btn btn-primary" name="tambahbarang">Tambah</button>
        </div>
        </form>
        
        
        
      </div>
  </div>

  

  <!-- The Modal -->
  <div class="modal fade" id="delete">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Barang</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form method="post">
        <div class="modal-body">
          <input type="text" name="namabarang" placeholder="Nama Barang" class="form-control" required>
          <br>
          <input type="text" name="deskripsi" placeholder="Deskripsi Barang" class="form-control" required>
          <br>
          <input type="number" name="stock" class="form-control" placeholder="Banyak Barang" required><br>
          <button type="submit" class="btn btn-primary" name="tambahbarang">Tambah</button>
        </div>
        </form>
        
        
        
      </div>
  </div>
                

</html>
