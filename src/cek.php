<?php
//jika belum login

if(isset($_SESSION['log'])){

}else{
    echo '
            <script>
                alert("Silahkan Login Terlebih dahulu");
                window.location.href="login.php";
            </script>';
}
?>