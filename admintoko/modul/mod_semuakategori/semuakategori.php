<?php
$aksi="modul/mod_semuakategori/aksi_semuakategori.php";
switch($_GET[act]){
  // Tampil Modul
  default:
    $featured = mysql_query("SELECT * FROM setting WHERE tipe='featured'");
    $rfeatured=mysql_fetch_array($featured);
   $ster="";$sjum="";$kater="";$kajum="";
    $sql = mysql_query("SELECT * from setting where tipe='semuajumlah' OR tipe='semuaterbaru'
     OR tipe='kategorijumlah' OR tipe='kategoriterbaru' OR tipe='semuafeatured' OR tipe='kategorifeatured'");
    while($r=mysql_fetch_array($sql))
    {
      if($r[tipe]=="semuaterbaru") { $ster=$r[value1]; }
      elseif($r[tipe]=="semuajumlah") { $sjum=$r[value1]; }
      elseif($r[tipe]=="kategoriterbaru") { $kater=$r[value1]; }
      elseif($r[tipe]=="kategorijumlah") { $kajum=$r[value1]; }
      elseif($r[tipe]=="semuafeatured") { $semfeat=$r[value1]; }
      elseif($r[tipe]=="kategorifeatured") { $katfeat=$r[value1]; }
    }
    echo "<h2>Edit Tampilan Semua Produk / Tampilan Kategori</h2>
          <form method=POST action=$aksi?module=semuakategori&act=update>
          <table>
          <tr><td colspan='2'><b>TAMPILAN HALAMAN SEMUA PRODUK</b></td></tr>
          <tr><td width='300px'>Jumlah Produk yg Ditampilkan Per Halaman</td>     <td> : ";
         ?>
         <select name="semuajumlah">
           <?php
           $list = array("12","15","16","18","20","21","24","27","28");
           $length = sizeof($list);
           for($counter=0;$counter<$length;$counter++) {
           if($list[$counter]==$sjum)
           {
            echo "<option selected='yes' value='$list[$counter]'>&nbsp;$list[$counter]</option>";
           }
           else echo "<option value='$list[$counter]'>&nbsp;$list[$counter]</option>";
           }
           ?>
          </select>
         <?php 
    echo "</td></tr>";
    
    if ($ster=='Y'){
      echo "<tr><td>Sisipkan slider produk terbaru di atasnya?</td> <td> : <input type=radio name='semuaterbaru' value='Y' checked>Y  
                                      <input type=radio name='semuaterbaru' value='N'> N</td></tr>";
    }
    else{
      echo "<tr><td>Sisipkan slider produk terbaru di atasnya?</td> <td> : <input type=radio name='semuaterbaru' value='Y'>Y  
                                      <input type=radio name='semuaterbaru' value='N' checked>N</td></tr>";
    }
    
    if ($semfeat=='Y'){
      echo "<tr><td>Sisipkan slider produk $rfeatured[value2] di atasnya?</td> <td> : <input type=radio name='semuafeatured' value='Y' checked>Y  
                                      <input type=radio name='semuafeatured' value='N'> N</td></tr>";
    }
    else{
      echo "<tr><td>Sisipkan slider produk $rfeatured[value2] di atasnya?</td> <td> : <input type=radio name='semuafeatured' value='Y'>Y  
                                      <input type=radio name='semuafeatured' value='N' checked>N</td></tr>";
    }
    
    echo "<tr><td colspan='2'>&nbsp;</td></tr>
          <tr><td colspan='2'><b>TAMPILAN HALAMAN KATEGORI</b></td></tr>
          <tr><td width='300px'>Jumlah Produk yg Ditampilkan Per Halaman</td>     <td> : ";
         ?>
         <select name="kategorijumlah">
           <?php
           $list = array("12","15","16","18","20","21","24","27","28");
           $length = sizeof($list);
           for($counter=0;$counter<$length;$counter++) {
           if($list[$counter]==$kajum)
           {
            echo "<option selected='yes' value='$list[$counter]'>&nbsp;$list[$counter]</option>";
           }
           else echo "<option value='$list[$counter]'>&nbsp;$list[$counter]</option>";
           }
           ?>
          </select>
         <?php 
    echo "</td></tr>";
    if ($kater=='Y'){
      echo "<tr><td>Sisipkan slider produk terbaru di atasnya?</td> <td> : <input type=radio name='kategoriterbaru' value='Y' checked>Y  
                                      <input type=radio name='kategoriterbaru' value='N'> N</td></tr>";
    }
    else{
      echo "<tr><td>Sisipkan slider produk terbaru di atasnya?</td> <td> : <input type=radio name='kategoriterbaru' value='Y'>Y  
                                      <input type=radio name='kategoriterbaru' value='N' checked>N</td></tr>";
    }
    if ($katfeat=='Y'){
      echo "<tr><td>Sisipkan slider produk $rfeatured[value2] di atasnya?</td> <td> : <input type=radio name='kategorifeatured' value='Y' checked>Y  
                                      <input type=radio name='kategorifeatured' value='N'> N</td></tr>";
    }
    else{
      echo "<tr><td>Sisipkan slider produk $rfeatured[value2] di atasnya?</td> <td> : <input type=radio name='kategorifeatured' value='Y'>Y  
                                      <input type=radio name='kategorifeatured' value='N' checked>N</td></tr>";
    }
    echo "<tr><td colspan=2><input type=submit class='tombol' value=Update>
                            <input type=button class='tombol' value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;
  
}
?>
