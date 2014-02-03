<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_thumbnail/aksi_thumbnail.php";
switch($_GET[act]){
  // Tampil header
  default:
    $banner = mysql_query("SELECT value1 FROM setting WHERE tipe='thumbnail'");
    $r    = mysql_fetch_array($banner);
    $tbbeli = mysql_query("SELECT value1 FROM setting WHERE tipe='tbbeli'");
    $rb    = mysql_fetch_array($tbbeli);
    
    echo "<h2>Atur KLIK Foto Thumbnail Produk</h2>
         <form method=POST action='$aksi?module=thumbnail&act=status'>
         <table border=1>
    ";
    if ($r[value1]=="zoom"){
      echo "<tr><td width='200px'><b>Aksi ketika Thumbnail di-KLIK</b> : </td>
                <td width='350px'><input type=radio name='aksi' value='zoom' checked> Tampilkan gambar dengan ukuran besar <br>
                    <input type=radio name='aksi' value='detail'> Tampilkan detail produk </td>
                <td></td></tr>";
    }
    else{
      echo "<tr><td width='200px'><b>Aksi ketika Thumbnail di-KLIK</b> : </td>
                <td width='350px'><input type=radio name='aksi' value='zoom'> Tampilkan gambar dengan ukuran besar <br>
                    <input type=radio name='aksi' value='detail' checked> Tampilkan detail produk </td>
                <td></td></tr>";
    }

    if ($rb[value1]=="popup"){
      echo "<tr><td width='200px'><b>Aksi ketika Tombol BELI di-KLIK</b> : </td>
                <td width='350px'><input type=radio name='beli' value='popup' checked> Tampilkan pop-up berisi panduan order via sms / bbm. <br>
                    <input type=radio name='beli' value='cart'> Masukkan produk ke keranjang belanja</td>
                <td><input type=submit class=tombol value=Simpan></td></tr>";
    }
    else{
      echo "<tr><td width='200px'><b>Aksi ketika Tombol BELI di-KLIK</b> : </td>
                <td width='350px'><input type=radio name='beli' value='popup'> Tampilkan pop-up berisi panduan order via sms / bbm. <br>
                    <input type=radio name='beli' value='cart' checked> Masukkan produk ke keranjang belanja</td>
                <td><input type=submit class=tombol value=Simpan></td></tr>";
    }

    echo "</table></form>";
    break;
  
}
}
?>
