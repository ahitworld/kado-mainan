<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_grid/aksi_grid.php";
switch($_GET[act]){
  // Tampil header
  default:
    $banner = mysql_query("SELECT value1 FROM setting WHERE tipe='grid'");
    $r    = mysql_fetch_array($banner);
    
    echo "<h2>Jumlah Kolom Produk</h2>
         <form method=POST action='$aksi?module=grid&act=update'>
         <table border=1>
    ";
    if ($r[value1]=="4"){
      echo "<tr><td width='150px'><b>Jumlah kolom produk</b> : </td>
                <td width='200px'><input type=radio name='value1' value='4' checked> 4 (kecil-rapat) <br>
                    <input type=radio name='value1' value='3'> 3 (besar-renggang) </td>
                <td><input type=submit class=tombol value=Simpan></td></tr>";
    }
    else{
      echo "<tr><td width='150px'><b>Jumlah kolom produk</b> : </td>
                <td width='200px'><input type=radio name='value1' value='4'> 4 (kecil-rapat) <br>
                    <input type=radio name='value1' value='3' checked> 3 (besar-renggang) </td>
                <td><input type=submit class=tombol value=Simpan></td></tr>";
    }
    echo "</table></form>";
    break;
  
}
}
?>
