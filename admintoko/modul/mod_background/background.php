<?php
$aksi="modul/mod_background/aksi_background.php";
switch($_GET[act]){
  // Tampil Modul
  default:
    $sql = mysql_query("SELECT * from setting where tipe='background'");
    $r = mysql_fetch_array($sql);
    
    echo "<h2>Edit Background Website</h2>
          <form method=POST action=$aksi?module=background&act=update>
          <table>
          <tr><td width='200px'>Tipe Background</td>     <td> : ";
         ?>
         <select name="tipe">
           <?php
           $list = array("warna");
           $length = sizeof($list);
           for($counter=0;$counter<$length;$counter++) {
           if($list[$counter]==$r[value1])
           {
            echo "<option selected='yes' value='$list[$counter]'>&nbsp;$list[$counter]</option>";
           }
           else echo "<option value='$list[$counter]'>&nbsp;$list[$counter]</option>";
           }
           ?>
          </select>
         <?php 
    echo "</td></tr>
    <tr><td>Preview: <div id=\"previewColor\" style=\"background-color: #0000ff; width:180px; height:170px; margin:10px 3px 10px 10px;\"></div></td><td>
    Pilih warna: <a id='resetColor' href='javascript:void(0)' onclick='resetColor()'>[reset]</a> <input type='hidden' name='value2' id='valueColor'>
    <p id='colorpickerHolder' style='margin-left:0px;'></p>
    </td></tr>";
    
    echo "<tr><td colspan='2'>&nbsp;</td></tr>
          <tr><td colspan=2><input type=submit class='tombol' value=Update>
                            <input type=button class='tombol' value=Batal onclick=self.history.back()></td></tr>
          </table></form>
          ";
    break;
  
}
?>
