<?php
$aksi="modul/mod_aboutus/aksi_aboutus.php";
switch($_GET[act]){
  // Tampil Profil
  default:
    $sql  = mysql_query("SELECT * FROM modul WHERE id_modul='67'");
    $r    = mysql_fetch_array($sql);

    echo "<h2>Edit About Us (Kiri Bawah)</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=aboutus&act=update>
          <input type=hidden name=id value=$r[id_modul]>
          <table>
      
         <tr><td><textarea name='isi' style='width: 600px; height: 350px;'>$r[static_content]</textarea></td></tr>
         <tr><td><input type=submit class=tombol value=Update></td></tr>
         </form></table>";
    break;  
}
?>
