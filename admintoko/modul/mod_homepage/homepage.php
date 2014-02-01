<?php
$aksi="modul/mod_homepage/aksi_homepage.php";
switch($_GET[act]){
  // Tampil Modul
  default:
    $featured = mysql_query("SELECT * FROM setting WHERE tipe='featured'");
    $rfeatured=mysql_fetch_array($featured);
    echo "<h2>Tampilan Halaman Home (Beranda)</h2>
          <table>
          <tr><th>No</th><th>Nama Komponen</th><th>Tampilkan ?</th><th>Value2</th><th>Value3</th><th>Aksi</th></tr>";
          $no=1;
    $tampil=mysql_query("SELECT * FROM setting WHERE tipe='hometerbaru' OR tipe='homefeatured' OR tipe='homekoleksi' OR tipe='homediskon' OR tipe='homewelcome' OR tipe='homesmsbbm'");
    while ($r=mysql_fetch_array($tampil)){
      if($r[tipe]=="homewelcome") { $namanya="Tampilan Selamat Datang"; }
      elseif($r[tipe]=="hometerbaru") { $namanya="Tampilan Produk Terbaru"; }
      elseif($r[tipe]=="homefeatured") { $namanya="Tampilan Produk $rfeatured[value2]"; }
      elseif($r[tipe]=="homekoleksi") { $namanya="Tampilan Produk Koleksi"; }
      elseif($r[tipe]=="homediskon") { $namanya="Tampilan Produk Diskon"; }
      elseif($r[tipe]=="homesmsbbm") { $namanya="Tampilan Order via SMS/BBM"; }
      echo "<tr><td width='30px'>$no</td>
            <td width='300px'>$namanya</td>
            <td width='100px'>$r[value1]</td>
            <td width='100px'>$r[value2]</td>
            <td width='100px'>$r[value3]</td>
            <td><a href=?module=homepage&act=edithomepage&id=$r[tipe]><b>Edit</b></a>
            </td></tr>";
            $no++;
    }
    echo "<tr><td colspan=6 align='center'>
            <a href='?module=homepage&act=yall'>Aktifkan Semua</a> | <a href='?module=homepage&act=nall'>Nonaktifkan Semua</a>
          </td></tr>
          </table>";
    break;

  case "edithomepage":
    $edit = mysql_query("SELECT * FROM setting WHERE tipe='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
    $featured = mysql_query("SELECT * FROM setting WHERE tipe='featured'");
    $rfeatured=mysql_fetch_array($featured);
      if($r[tipe]=="homewelcome") { $namanya="Tampilan Selamat Datang"; }
      elseif($r[tipe]=="hometerbaru") { $namanya="Tampilan Produk Terbaru"; }
      elseif($r[tipe]=="homefeatured") { $namanya="Tampilan Produk $rfeatured[value2]"; }
      elseif($r[tipe]=="homekoleksi") { $namanya="Tampilan Produk Koleksi"; }
      elseif($r[tipe]=="homediskon") { $namanya="Tampilan Produk Diskon"; }
      
    echo "<h2>Edit $namanya</h2>
          <form method=POST action=$aksi?module=homepage&act=update>
          <input type=hidden name=id value='$r[tipe]'>
          <table>
          <tr><td width='200px'>Nama Komponen</td>     <td> : $namanya</td></tr>";
    if ($r[value1]=='Y'){
      echo "<tr><td>Tampilkan di Halaman Depan?</td> <td> : <input type=radio name='value1' value='Y' checked>Y  
                                      <input type=radio name='value1' value='N'> N</td></tr>";
    }
    else{
      echo "<tr><td>Tampilkan di Halaman Depan?</td> <td> : <input type=radio name='value1' value='Y'>Y  
                                      <input type=radio name='value1' value='N' checked>N</td></tr>";
    }
    if($_GET[id]=="hometerbaru" || $_GET[id]=="homediskon" || $_GET[id]=="homefeatured")
    {
      ?>
       <tr><td>Tipe Tampilan</td>     <td> : 
         <select name="value2">
           <?php
           $list = array("geser","biasa");
           $length = sizeof($list);
           for($counter=0;$counter<$length;$counter++) {
           if($list[$counter]==$r[value2])
           {
            echo "<option selected='yes' value='$list[$counter]'>&nbsp;$list[$counter]</option>";
           }
           else echo "<option value='$list[$counter]'>&nbsp;$list[$counter]</option>";
           }
           ?>
          </select>
       </td></tr>
       <tr><td>Jumlah Yg Ditampilkan</td>     <td> : 
         <select name="value3">
           <?php
           $list = array("4","7","8","11","12","15","16","15","19","20","23","24","27","28");
           $length = sizeof($list);
           for($counter=0;$counter<$length;$counter++) {
           if($list[$counter]==$r[value3])
           {
            echo "<option selected='yes' value='$list[$counter]'>&nbsp;$list[$counter]</option>";
           }
           else echo "<option value='$list[$counter]'>&nbsp;$list[$counter]</option>";
           }
           ?>
          </select>
       </td></tr>
      <?php
    }
    elseif($_GET[id]=="homekoleksi")
    {
      ?>
      <tr><td>Jumlah Yg Ditampilkan</td>     <td> : 
         <select name="value2">
           <?php
           $list = array("4","7","8","11","12","15","16","18","19","20","23","24","27","28");
           $length = sizeof($list);
           for($counter=0;$counter<$length;$counter++) {
           if($list[$counter]==$r[value2])
           {
            echo "<option selected='yes' value='$list[$counter]'>&nbsp;$list[$counter]</option>";
           }
           else echo "<option value='$list[$counter]'>&nbsp;$list[$counter]</option>";
           }
           ?>
          </select>
       </td></tr>
      <?php
    }
    echo "<tr><td colspan=2><input type=submit class='tombol' value=Update>
                            <input type=button class='tombol' value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;
  
  case "yall":
    $edit = mysql_query("UPDATE setting SET value1='Y' WHERE tipe='hometerbaru' OR tipe='homekoleksi' OR tipe='homediskon' OR tipe='homewelcome'");
      if($edit)
      {
         echo "<script>location.href='media.php?module=homepage'</script>";
      }
    break;
  
  case "nall":
    $edit = mysql_query("UPDATE setting SET value1='N' WHERE tipe='hometerbaru' OR tipe='homekoleksi' OR tipe='homediskon' OR tipe='homewelcome'");
      if($edit)
      {
         echo "<script>location.href='media.php?module=homepage'</script>";
      }
    break;  
}
?>
