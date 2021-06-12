<?php
session_start();

$conn = mysqli_connect("db","root","example","tugas1");

//Menambah Barang
if(isset($_POST['tambahbarang'])){
    $namabarang = $_POST['namabarang'];
    $deskripsi =$_POST['deskripsi'];
    $stock = $_POST['stock'];

    //gambr
    $allowed_extension = array('jpg','png');
    $nama=$_FILES['file']['name'];      //nama file
    $dot= explode('.',$nama);
    $ekstensi= strtolower(end($dot)); //ngambil ekstensi gmbr
    $ukuran = $_FILES['file']['size']; //size file
    $file_temp = $_FILES['file']['tmp_name']; //lokasi awal file

    //penamaan file->enkripsi
    $image=md5(uniqid($nama,true) . time()).'.'.$ekstensi; //gabung nama file yg diemkripsi

    $cek=mysqli_query($conn, "select* from stockbrg where namabarang='$namabarang'");
    $hitung=mysqli_num_rows($cek);

    if($hitung<1){
        //proses upload gambar
        if(in_array($ekstensi, $allowed_extension)=== true){
            //validasi ukuran file
            if($ukuran < 20000000){
                move_uploaded_file($file_temp, 'image/'.$image);

                $addtotable = mysqli_query($conn, "INSERT INTO stockbrg (namabarang, deskripsi, stock, image) values('$namabarang', '$deskripsi', '$stock', '$image')");
                if($addtotable){
                    header('location:index.php');
                }else{
                    echo 'gagal input';
                    header('location:index.php');
                }
            }else{
                //kalau ukuran file lebih
                echo '
                <script>
                    alert("Ukuran file terlalu besar");
                    window.location.href="index.php";
                </script>';
            }
        }else{
            //kalau tidak ingin memasukkan gambar
            if($ukuran==0){
                $addtotable = mysqli_query($conn, "INSERT INTO stockbrg (namabarang, deskripsi, stock) values('$namabarang', '$deskripsi', '$stock')");
                        if($addtotable){
                            header('location:index.php');
                        }else{
                            echo 'gagal input';
                            header('location:index.php');
                        }
                    }else{
            //kalau file tidak sesuai
            echo '
            <script>
                alert("File harus jpg/png");
                window.location.href="index.php";
            </script>';
        }
    }
}
   else{
    
            echo '
            <script>
                alert("Barang yang ingin anda input sudah ada");
                window.location.href="index.php";
            </script>';
    }
   
};

//Menambah barang masuk
if(isset($_POST['barangmasuk'])){
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];
    $admin = $_POST['admin'];

    $cekstockskrg = mysqli_query($conn, "select * from stockbrg where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstockskrg);

    $stockskrg = $ambildatanya['stock'];
    $tambahstockdgnqty = $stockskrg+$qty;

    $addtomasuk = mysqli_query($conn, "insert into brgmasuk (idbarang, ket, qty, admin) values('$barangnya','$penerima','$qty','$admin')");
    $updatestockmasuk = mysqli_query($conn, "update stockbrg set stock='$tambahstockdgnqty' where idbarang='$barangnya'");
    if($addtomasuk&&$updatestockmasuk){
        echo'<script>
            alert("Barang berhasil ditambah, Kepala Gudang akan segera mengkonfirmasi data anda");
            window.location.href="brgmasuk.php";
            </script>';
    }else{
        echo 'gagal input';
        header('location:brgmasuk.php');
    }
};

//Menambah barang keluar
if(isset($_POST['barangkeluar'])){
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];
    $admin = $_POST['admin'];

    $cekstockskrg = mysqli_query($conn, "select * from stockbrg where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstockskrg);

    $stockskrg = $ambildatanya['stock'];

    if($stockskrg>=$qty){
        //kalau ada stock
    $tambahstockdgnqty = $stockskrg-$qty;

    $addtomasuk = mysqli_query($conn, "insert into brgkeluar (idbarang, penerima, qty, admin) values('$barangnya','$penerima','$qty', '$admin')");
    $updatestockmasuk = mysqli_query($conn, "update stockbrg set stock='$tambahstockdgnqty' where idbarang='$barangnya'");
    if($addtomasuk&&$updatestockmasuk){
        echo'<script>
            alert("Barang berhasil ditambah, Kepala Gudang akan segera mengkonfirmasi data anda");
            window.location.href="brgkeluar.php";
            </script>';
    }else{
        echo 'gagal input';
        header('location:brgkeluar.php');
    }
}else{
    //kalau tidak ada stock
    echo '
    <script>
        alert("Stock saat ini tidak mencukupi");
        window.location.href="brgkeluar.php";
    </script>';
}
};

//Mengubah atau Edit barang
if(isset($_POST['updatebarang'])){
    $idbarang = $_POST['idb'];
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];
    //gambr
    $allowed_extension = array('jpg','png');
    $nama=$_FILES['file']['name'];      //nama file
    $dot= explode('.',$nama);
    $ekstensi= strtolower(end($dot)); //ngambil ekstensi gmbr
    $ukuran = $_FILES['file']['size']; //size file
    $file_temp = $_FILES['file']['tmp_name']; //lokasi awal file

    //penamaan file->enkripsi
    $image=md5(uniqid($nama,true) . time()).'.'.$ekstensi; //gabung nama file yg diemkripsi

    if($ukuran==0){
        //jika tidk ingin upload
        $update = mysqli_query($conn, "update stockbrg set namabarang='$namabarang', deskripsi='$deskripsi' where idbarang='$idbarang'");
        if($update){
            
            header('location:index.php');
        }else{
            echo 'gagal input';
            header('location:index.php');
    }
    }else{
        //jika ingin upload
        move_uploaded_file($file_temp, 'image/'.$image);
        $update = mysqli_query($conn, "update stockbrg set namabarang='$namabarang', deskripsi='$deskripsi',image='$image' where idbarang='$idbarang'");
        if($update){
            header('location:index.php');
        }else{
            echo 'gagal input';
            header('location:index.php');
        }
    }
    
        
};

//Hapus barang
if(isset($_POST['hapusbarang'])){
    $idb = $_POST['idb'];

    $gambar=mysqli_query($conn, "select*from stockbrg where idbarang='$idb'");
    $get=mysqli_fetch_array($gambar);
    $img= 'image/'.$get['image'];
    unlink($img);

    $hapus = mysqli_query($conn, "delete from stockbrg where idbarang='$idb'");
    if($hapus){
        header('location:index.php');
    }else{
        echo 'gagal input';
        header('location:index.php');
    }
};

//Mengubah data barang masuk
if(isset($_POST['updatebarangmasuk'])){
    $idb = $_POST['idb'];
    $idm = $_POST['idm'];
    $ket = $_POST['ket'];
    $qty = $_POST['qty'];
    $admin = $_POST['admin'];

    $lihatstock = mysqli_query($conn, "select * from stockbrg where idbarang='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stocksekarang = $stocknya['stock'];

    $qtyskrg = mysqli_query($conn, "select * from brgmasuk where idmasuk = '$idm'");
    $qtynya = mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['qty'];

    if($qty>$qtyskrg){
        $selisih = $qty-$qtyskrg;
        $kurangin = $stocksekarang+$selisih;

        $kurangistocknya = mysqli_query($conn, "update stockbrg set stock='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update brgmasuk set qty='$qty', ket='$ket', admin='$admin', status ='0' where idmasuk='$idm'");

        if($kurangistocknya&&$updatenya){
            echo'<script>
            alert("Barang berhasil diubah, Kepala Gudang akan segera mengkonfirmasi data anda");
            window.location.href="brgmasuk.php";
            </script>';
            }else{
                echo 'gagal input';
                header('location:brgmasuk.php');
        }
        }else{
        $selisih = $qtyskrg-$qty;
        $kurangin = $stocksekarang-$selisih;

        $kurangistocknya = mysqli_query($conn, "update stockbrg set stock='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update brgmasuk set qty='$qty', ket='$ket', admin='$admin', status='0' where idmasuk='$idm'");

        if($kurangistocknya&&$updatenya){
            echo'<script>
            alert("Barang berhasil diubah, Kepala Gudang akan segera mengkonfirmasi data anda");
            window.location.href="brgmasuk.php";
            </script>';
            }else{
                echo 'gagal input';
                header('location:brgmasuk.php');
        }

    }
};

//menghapus barang masuk
if(isset($_POST['hapusbarangmasuk'])){
    $idb = $_POST['idb'];
    $qty = $_POST['kty'];
    $idm = $_POST['idm'];

    $getdatastock = mysqli_query($conn, "select*from stockbrg where idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stok = $data['stock'];
    $selisih = $stok-$qty;
    $update = mysqli_query($conn, "update stockbrg set stock='$selisih' where idbarang='$idb'");
    $hapusdata = mysqli_query($conn, "delete from brgmasuk where idmasuk='$idm'");

    if($update&&$hapusdata){
        header('location:brgmasuk.php');
    }else{
        header('location:brgmasuk.php');
    }
};

//ubah data keluar
if(isset($_POST['updatebarangkeluar'])){
    $idb = $_POST['idb'];
    $idk = $_POST['idk'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];
    $admin = $_POST['admin'];

    $lihatstock = mysqli_query($conn, "select * from stockbrg where idbarang='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stocksekarang = $stocknya['stock'];

    $qtyskrg = mysqli_query($conn, "select * from brgkeluar where idkeluar = '$idk'");
    $qtynya = mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['qty'];

    if($qty>$qtyskrg){
        $selisih = $qty-$qtyskrg;
        $kurangin = $stocksekarang-$selisih;

        if($selisih<=$stocksekarang){
            $kurangistocknya = mysqli_query($conn, "update stockbrg set stock='$kurangin' where idbarang='$idb'");
            $updatenya = mysqli_query($conn, "update brgkeluar set qty='$qty', penerima='$penerima', admin='$admin',status='0' where idkeluar='$idk'");

            if($kurangistocknya&&$updatenya){
                echo'<script>
                alert("Barang berhasil diubah, Kepala Gudang akan segera mengkonfirmasi data anda");
                window.location.href="brgkeluar.php";
                </script>';
                }else{
                    echo 'gagal input';
                    header('location:brgkeluar.php');
        }
        }else{
            echo '
            <script>
            alert("Stock tidak mencukupi");
            window.location.href="brgkeluar.php";
            </script>';

        }

        
        }else{
        $selisih = $qtyskrg-$qty;
        $kurangin = $stocksekarang+$selisih;

        $kurangistocknya = mysqli_query($conn, "update stockbrg set stock='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update brgkeluar set qty='$qty', penerima='$penerima', admin='$admin', status = '0' where idkeluar='$idk'");

        if($kurangistocknya&&$updatenya){
            echo'<script>
            alert("Barang berhasil diubah, Kepala Gudang akan segera mengkonfirmasi data anda");
            window.location.href="brgmasuk.php";
            </script>';
            }else{
                echo 'gagal input';
                header('location:brgkeluar.php');
        }

    }
};

//menghapus barang keluar
if(isset($_POST['hapusbarangkeluar'])){
    $idb = $_POST['idb'];
    $qty = $_POST['kty'];
    $idk = $_POST['idk'];

    $getdatastock = mysqli_query($conn, "select*from stockbrg where idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stok = $data['stock'];
    $selisih = $stok+$qty;
    $update = mysqli_query($conn, "update stockbrg set stock='$selisih' where idbarang='$idb'");
    $hapusdata = mysqli_query($conn, "delete from brgkeluar where idkeluar='$idk'");

    if($update&&$hapusdata){
        header('location:brgkeluar.php');
    }else{
        header('location:brgkeluar.php');
    }
};

//Menambah Admin
if(isset($_POST['tambahadmin'])){
    $namalengkap = $_POST['namalengkap'];
    $alamat = $_POST['alamat'];
    $ttl = $_POST['ttl'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $addadmin = mysqli_query($conn, "INSERT INTO user (nama_lengkap, alamat, ttl, username, password) values('$namalengkap', '$alamat', '$ttl','$username','$password')");
    if($addadmin){
        header('location:admin.php');
    }else{
        echo 'gagal input';
        header('location:admin.php');
    }
};

//edit admin
if(isset($_POST['updateadmin'])){
    $namalengkapbr= $_POST['namalengkapbr'];
    $alamatbr=$_POST['alamatbr'];
    $ttlbr=$_POST['ttlbr'];
    $usernamebr=$_POST['usernamebr'];
    $passwordbr=$_POST['passwordbr'];
    $id=$_POST['id'];


    $queryupdate=mysqli_query($conn, "update user set username='$usernamebr',nama_lengkap='$namalengkapbr',password='$passwordbr',ttl='$ttlbr',alamat='$alamatbr' where id ='$id'");
    if($queryupdate){
        header('location:admin.php');
    }else{
        echo 'gagal input';
        header('location:admin.php');
    }
}

//hapus admin
if(isset($_POST['hapusadmin'])){
    $id=$_POST['id'];

    $queryhapus=mysqli_query($conn, "delete from user where id='$id'");
    if($queryhapus){
        header('location:admin.php');
    }else{
        echo 'gagal input';
        header('location:admin.php');
    }
}


?>