<?php
require 'function.php';
require 'cek.php';
$idm=$_GET['id'];



?>
<html>
<head>
  <title>Stock Barang</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>

<body>
<div class="container">
			<h2>Imadi Poteto Dept.</h2>
            <p>Bukti Terima Barang</p>
			
				<div class="data-tables datatable-dark">
					
                <table class="table table-bordered" id="maudiexport" width="100%" cellspacing="0">
                                    <thead>
                                        
                                        <tr>
                                            <td>Kode</td>
                                            <td>Tanggal</td>
                                            <td>Nama Barang</td>
                                            <td>Dari</td>
                                            <td>Banyak</td>
                                            <td>Penerima</td>
                                            <td>Barcode</td>   
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ambilsemuadatastock = mysqli_query($conn,"select * from brgmasuk m, stockbrg s where m.idmasuk='$idm'and s.idbarang=m.idbarang");
                                       
                                        while($data=mysqli_fetch_array($ambilsemuadatastock)){
                                            $idbarang=$data['idbarang'];
                                            $idmasuk=$data['idmasuk'];
                                            $namabarang=$data['namabarang'];
                                            $tanggal=$data['tanggal'];
                                            $qty=$data['qty'];
                                            $admin=$data['admin'];
                                            $ket=$data['ket'];
                                            
                                        ?>
                                        <tr>
                                            <td><?php echo $idmasuk;?></td>
                                            <td><?php echo $tanggal;?></td>
                                            <td><?php echo $namabarang;?></td>
                                            <td><?php echo $ket;?></td>
                                            <td><?php echo $qty;?></td>
                                            <td><?php echo $admin;?></td>
                                            <td><img src="../temp/barangmasuk<?=$idmasuk;?>.png"></td>
                                            
                                            
                                        </tr>
                                        
                                        <?php
                                        };
                                        ?>
                                        
                                    </tbody>
                                </table>
					
				</div>
</div>
	
<script>
$(document).ready(function() {
    $('#maudiexport').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    } );
} );

</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

	

</body>

</html>