<?php
$aksi="modul/mod_detailproduk/aksi_detailproduk.php";
switch($_GET[act]){
  // Tampil Modul
  default:
    $featured = mysql_query("SELECT * FROM setting WHERE tipe='featured'");
    $rfeatured=mysql_fetch_array($featured);
    $sql = mysql_query("SELECT * from setting where tipe='detail_fblike' OR tipe='detail_fbcomment'
     OR tipe='detail_related' OR tipe='detail_diskon' OR tipe='detail_featured'");
    while($r=mysql_fetch_array($sql))
    {
      if($r[tipe]=="detail_fblike") { $like=$r[value1]; }
      elseif($r[tipe]=="detail_fbcomment") { $comment=$r[value1]; }
      elseif($r[tipe]=="detail_related") { $related=$r[value1]; }
      elseif($r[tipe]=="detail_diskon") { $diskon=$r[value1]; }
      elseif($r[tipe]=="detail_featured") { $featured=$r[value1]; }
    }
    echo "<h2>Edit Tampilan Detail Produk</h2>
          <form method=POST action=$aksi?module=detailproduk&act=update>
          <table>";
    
    if ($like=='Y'){
      echo "<tr><td width='200px'>Tampilkan tombol Facebook Like?</td> <td> : <input type=radio name='like' value='Y' checked>Y  
                                      <input type=radio name='like' value='N'> N</td></tr>";
    }
    else{
      echo "<tr><td width='200px'>Tampilkan tombol Facebook Like?</td> <td> : <input type=radio name='like' value='Y'>Y  
                                      <input type=radio name='like' value='N' checked>N</td></tr>";
    }
    
    if ($comment=='Y'){
      echo "<tr><td width='200px'>Tampilkan Komentar via Facebook?</td> <td> : <input type=radio name='comment' value='Y' checked>Y  
                                      <input type=radio name='comment' value='N'> N</td></tr>";
    }
    else{
      echo "<tr><td width='200px'>Tampilkan Komentar via Facebook?</td> <td> : <input type=radio name='comment' value='Y'>Y  
                                      <input type=radio name='comment' value='N' checked>N</td></tr>";
    }
    
    if ($related=='Y'){
      echo "<tr><td width='200px'>Tampilkan produk terkait?</td> <td> : <input type=radio name='related' value='Y' checked>Y  
                                      <input type=radio name='related' value='N'> N</td></tr>";
    }
    else{
      echo "<tr><td width='200px'>Tampilkan produk terkait?</td> <td> : <input type=radio name='related' value='Y'>Y  
                                      <input type=radio name='related' value='N' checked>N</td></tr>";
    }
    
    if ($diskon=='Y'){
      echo "<tr><td width='200px'>Tampilkan produk dengan diskon?</td> <td> : <input type=radio name='diskon' value='Y' checked>Y  
                                      <input type=radio name='diskon' value='N'> N</td></tr>";
    }
    else{
      echo "<tr><td width='200px'>Tampilkan produk dengan diskon?</td> <td> : <input type=radio name='diskon' value='Y'>Y  
                                      <input type=radio name='diskon' value='N' checked>N</td></tr>";
    }
    
    if ($featured=='Y'){
      echo "<tr><td width='200px'>Tampilkan produk $rfeatured[value2]?</td> <td> : <input type=radio name='featured' value='Y' checked>Y  
                                      <input type=radio name='featured' value='N'> N</td></tr>";
    }
    else{
      echo "<tr><td width='200px'>Tampilkan produk $rfeatured[value2]?</td> <td> : <input type=radio name='featured' value='Y'>Y  
                                      <input type=radio name='featured' value='N' checked>N</td></tr>";
    }
    
    echo "<tr><td colspan=2><input type=submit class='tombol' value=Update>
                            <input type=button class='tombol' value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;
  
}
?>
