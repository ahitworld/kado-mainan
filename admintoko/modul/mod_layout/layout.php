<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_layout/aksi_layout.php";
switch($_GET[act]){
  // Tampil header
  default:
    $banner = mysql_query("SELECT value1 FROM setting WHERE tipe='layout'");
    $r    = mysql_fetch_array($banner);
    
    echo "<h2>Edit Layout Website</h2>
         <form method=POST action='$aksi?module=layout&act=status'>
         <table border=1>
    ";
    if ($r[value1]=="kanan"){
      echo "<tr><td width='200px'><b>Posisi Menu Samping (Sidebar)</b> : </td>
                <td width='200px'><input type=radio name='posisi' value='kanan' checked> Kanan <br>
                    <input type=radio name='posisi' value='kiri'> Kiri </td>
                <td><input type=submit class=tombol value=Simpan></td></tr>";
    }
    else{
      echo "<tr><td width='200px'><b>Posisi Menu Samping (Sidebar)</b> : </td>
                <td width='200px'><input type=radio name='posisi' value='kanan'> Kanan <br>
                    <input type=radio name='posisi' value='kiri' checked> Kiri </td>
                <td><input type=submit class=tombol value=Simpan></td></tr>";
    }
    echo "</table></form>";
    break;
  
}
}
?>
