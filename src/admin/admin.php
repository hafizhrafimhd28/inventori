<?php
require 'function.php';
require 'cek.php';
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
        <title>Kelola Admin</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
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
                        <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
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
                            <a class="nav-link" href="admin.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-alt"></i></div>
                                Kelola Admin
                            </a>
                            
                        </div>
                    </div>
                    
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Kelola Admin</h1>
                        
                        
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                 <!-- Button to Open the Modal -->
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                                Tambah Admin
                                </button>
                                
                            </div>
                            <div class="card-body">

                            
                                <div class = "table-responsive">
                                <table id="datatablesSimple" width="100%" cellspacing="1">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>No.</th>
                                            <th>Username</th>
                                            <th>Nama Lengkap</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Alamat</th>
                                            <th>Level</th>
                                            <th></th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ambilsemuadatauser = mysqli_query($conn,"select * from user");
                                        $i = 1;
                                        while($data=mysqli_fetch_array($ambilsemuadatauser)){
                                            
                                            $id=$data['id'];
                                            $username=$data['username'];
                                            $password=$data['password'];
                                            $ttl=$data['ttl'];
                                            $alamat=$data['alamat'];
                                            $namalengkap=$data['nama_lengkap'];
                                            $level=$data['level'];
                                        ?>
                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$username;?></td>
                                            <td><?=$namalengkap;?></td>
                                            <td><?=$ttl;?></td>
                                            <td><?=$alamat;?></td>
                                            <td><?=$level;?></td>
                                            
                                            <td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$id;?>">
                                                Edit
                                                </button>
                                                <input type="hidden" name="editbarang" value="<?=$id;?>"> 
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$id;?>">
                                                Delete
                                                </button></td>
                                        </tr>
                                        <!-- The Modal -->
                                        <div class="modal fade" id="edit<?=$id;?>">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                            
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                <h4 class="modal-title">Edit Admin</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                
                                                <!-- Modal body -->
                                                <form method="post">
                                                <div class="modal-body">
                                                <input type="text" name="namalengkapbr" value="<?=$namalengkap;?>" class="form-control" required>
                                                <br>
                                                <input type="text" name="alamatbr" value="<?=$alamat;?>" class="form-control" required>
                                                <br>
                                                <input type="date" name="ttlbr" value="<?=$ttl;?>" class="form-control" required>
                                                <br>
                                                <input type="text" name="usernamebr" value="<?=$username;?>" class="form-control" required>
                                                <br>
                                                <input type="password" name="passwordbr" value="" placeholder="Password" class="form-control" required>
                                                <br>
                                                <select name="level" class="form-control" placeholder="Pilih Level">
                                                <option>admin</option>
                                                <option>kepala</option>
                                                <option>pegawai</option>
                                                </select>
                                                <br>
                                                <input type="hidden" name="id" value="<?=$id;?>">
                                                <button type="submit" class="btn btn-primary" name="updateadmin">Update</button>
                                                </div>
                                                </form>
                                                
                                                
                                                
                                            </div>
                                        </div>
                                        </div>

                                        <!-- The Modal -->
                                        <div class="modal fade" id="delete<?=$id;?>">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                            
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                <h4 class="modal-title">Hapus Barang?</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                
                                                <!-- Modal body -->
                                                <form method="post">
                                                <div class="modal-body">
                                                Apakah anda yakin ingin menghapus <?=$username;?><br><br>
                                                <input type="hidden" name="id" value="<?=$id;?>">
                                                <button type="submit" class="btn btn-danger" name="hapusadmin">Hapus</button>
                                                </div>
                                                </form>
                                                
                                                
                                                
                                            </div>
                                        </div>
                                        </div>
                                        <?php
                                        };
                                        ?>
                                        
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="../assets/demo/chart-area-demo.js"></script>
        <script src="../assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="../js/datatables-simple-demo.js"></script>
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
          <h4 class="modal-title">Tambah Admin</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form method="post">
            <div class="modal-body">
                <input type="text" name="namalengkap" placeholder="Nama Lengkap"  class="form-control" required>
                <br>
                <input type="text" name="alamat" placeholder="Alamat" class="form-control" required>
                <br>
                <input type="date" name="ttl" placeholder="Tanggal Lahir" class="form-control" required>
                <br>
                <input type="text" name="username" placeholder="Username" class="form-control" required>
                <br>
                <input type="password" name="password" placeholder="Password" class="form-control" required>
                <br>
                <select name="level" class="form-control" placeholder="Pilih Level">
                    <option>admin</option>
                    <option>kepala</option>
                    <option>pegawai</option>
                </select>
                <br>
                <button type="submit" class="btn btn-primary" name="tambahadmin">Tambah</button>
            </div>
        </form>
        
        
        
      </div>
  </div>

  

                

</html>
