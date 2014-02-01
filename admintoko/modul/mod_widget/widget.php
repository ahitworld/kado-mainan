<?php
$aksi="modul/mod_widget/aksi_widget.php";
switch($_GET[act]){
  // Tampil Modul
  default:
    echo "<h2>Manajemen Widget</h2>
          <table>
          <tr><th>No</th><th>Nama Widget</th><th>id</th><th>Aktif?</th><th>Aksi</th></tr>";
          $no=1;
    $tampil=mysql_query("SELECT * FROM widget");
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td>$no</td>
            <td>$r[nama]</td>
            <td>$r[id]</td>
            <td>$r[status]</td>
            <td><a href=?module=widget&act=editwidget&id=$r[id]><b>Edit</b></a>
            </td></tr>";
            $no++;
    }
    echo "<tr><td colspan=5 align='center'>
            <a href='?module=widget&act=yall'>Aktifkan Semua</a> | <a href='?module=widget&act=nall'>Nonaktifkan Semua</a>
          </td></tr>
          </table>";
    break;

  case "editwidget":
    $edit = mysql_query("SELECT * FROM widget WHERE id='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Edit Modul $r[nama]</h2>
          <form method=POST action=$aksi?module=widget&act=update>
          <input type=hidden name=id value='$r[id]'>
          <table>
          <tr><td width='150px'>Nama Widget</td>     <td> : $r[nama]</td></tr>";
    if ($r[status]=='Y'){
      echo "<tr><td>Aktif?</td> <td> : <input type=radio name='aktif' value='Y' checked>Y  
                                      <input type=radio name='aktif' value='N'> N</td></tr>";
    }
    else{
      echo "<tr><td>Aktif?</td> <td> : <input type=radio name='aktif' value='Y'>Y  
                                      <input type=radio name='aktif' value='N' checked>N</td></tr>";
    }
    if($_GET[id]=="terbaru" || $_GET[id]=="terlaris" || $_GET[id]=="featured" || $_GET[id]=="onsale")
    {
      if($_GET[id]=="onsale") $isionsale = "Produk yang stok-nya sama atau kurang dari jumlah isi ini akan otomatis dimasukkan ke ON-SALE";
      echo "<tr><td>Isi</td>     <td> : <input type=text name='isi' value='$r[isi]' size='10'> $isionsale</td></tr>";
    }
    elseif($_GET[id]=="kategori") {
       if ($r[isi]=='Y'){
         echo "<tr><td>Tunjukkan jumlah produk?</td> <td> : <input type=radio name='isi' value='Y' checked>Y  
                                         <input type=radio name='isi' value='N'> N</td></tr>";
       }
       else{
         echo "<tr><td>Tunjukkan jumlah produk?</td> <td> : <input type=radio name='isi' value='Y'>Y  
                                         <input type=radio name='isi' value='N' checked>N</td></tr>";
       }
    }
    elseif($_GET[id]=="semuakategori") {
    ?>
      <tr><td>Tipe Tampilan</td>     <td> : 
      <select name="isi">
        <?php
        $list = array("geser","biasa");
        $length = sizeof($list);
        for($counter=0;$counter<$length;$counter++) {
        if($list[$counter]==$r[isi])
        {
         echo "<option selected='yes' value='$list[$counter]'>&nbsp;$list[$counter]</option>";
        }
        else echo "<option value='$list[$counter]'>&nbsp;$list[$counter]</option>";
        }
        ?>
       </select></td></tr>
    <?php
    }
    elseif($_GET[id]=="panelatas")
    {
      ?>
      <tr><td>Tipe Panel</td>     <td> : 
      <select name="isi">
        <?php
        $list = array("login","info");
        $length = sizeof($list);
        for($counter=0;$counter<$length;$counter++) {
        if($list[$counter]==$r[isi])
        {
         echo "<option selected='yes' value='$list[$counter]'>&nbsp;$list[$counter]</option>";
        }
        else echo "<option value='$list[$counter]'>&nbsp;$list[$counter]</option>";
        }
        ?>
       </select></td></tr>
      <?php
    }
    echo "<tr><td colspan=2><input type=submit class='tombol' value=Update>
                            <input type=button class='tombol' value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;
  
  case "yall":
    $edit = mysql_query("UPDATE widget SET status='Y'");
      echo "<script>location.href='media.php?module=widget'</script>";
    break;
  
  case "nall":
    $edit = mysql_query("UPDATE widget SET status='N'");
      echo "<script>location.href='media.php?module=widget'</script>";
    break;  
}
?>
