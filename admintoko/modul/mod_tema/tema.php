<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_".$_GET[module]."/aksi_".$_GET[module].".php";
  switch($_GET[act]){
    // Tampil header
    default:
      $tema = mysql_query("SELECT value1 FROM setting WHERE tipe='".$_GET[module]."'");
      $r = mysql_fetch_array($tema);

      echo "<h2>Edit Tema Website</h2>
           <form method=POST action='$aksi?module=".$_GET[module]."&act=status'>
           <table border=1>
      ";


      echo "
        <tr><td width='200px'><b>Posisi Menu Samping (Sidebar)</b> : </td>
        <td width='200px'>
      ";

      $temanya = array("merah","biru");
      
      foreach ($temanya as $data) {
        if ($r[value1]==$data) {
          echo "<input type=radio name='posisi' value='$data' checked> $data <br>";
        } else {
          echo "<input type=radio name='posisi' value='$data'> $data <br>";
        }
      }

      echo "</td><td><input type=submit class=tombol value=Simpan></td></tr>";
      echo "</table></form>";
      
      // if ($r[value1]=="default"){
      //   echo "<tr><td width='200px'><b>Posisi Menu Samping (Sidebar)</b> : </td>
      //             <td width='200px'><input type=radio name='posisi' value='kanan' checked> Kanan <br>
      //                 <input type=radio name='posisi' value='kiri'> Kiri </td>
      //             <td><input type=submit class=tombol value=Simpan></td></tr>";
      // }
      // else{
      //   echo "<tr><td width='200px'><b>Posisi Menu Samping (Sidebar)</b> : </td>
      //             <td width='200px'><input type=radio name='posisi' value='kanan'> Kanan <br>
      //                 <input type=radio name='posisi' value='kiri' checked> Kiri </td>
      //             <td><input type=submit class=tombol value=Simpan></td></tr>";
      // }

      break;
    
  }
}
?>
