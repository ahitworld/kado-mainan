<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_identitas/aksi_identitas.php";
switch($_GET[act]){
  // Tampil Cara Pembelian
  default:
   $list = array("namatoko","namasitus","alamatsitus","email","keyword","tagline");
   $length = sizeof($list);
   
   for($counter=0;$counter<$length;$counter++) {
      $queryset = "SELECT * FROM setting WHERE tipe='".$list[$counter]."'";
      $sqlset = mysql_query($queryset);
      $rset = mysql_fetch_array($sqlset);
      
      if($rset[tipe]=="namatoko")
      {
         $s_namatoko = $rset[value1];
      }
      elseif($rset[tipe]=="namasitus")
      {
         $s_namasitus = $rset[value1];
      }
      elseif($rset[tipe]=="alamatsitus")
      {
         $s_alamatsitus = $rset[value1];
      }
      elseif($rset[tipe]=="email")
      {
         $s_email = $rset[value1];
      }
      elseif($rset[tipe]=="keyword")
      {
         $s_keyword = $rset[value1];
      }
      elseif($rset[tipe]=="tagline")
      {
         $s_tagline = $rset[value1];
      }
   }

    echo "<h2>Edit Indentitas Toko Online</h2>
          <form method=POST action='$aksi?module=identitas&act=update'>
          <table>
          <tr><td><b>Nama Toko Online</b></td><td>  : <input type=text name='namatoko' size=50 value='$s_namatoko'></td></tr>
          <tr><td><b>Nama Situs</b></td><td>   : <input type=text name='namasitus' size='50' value='$s_namasitus'></td></tr>
          <tr><td><b>Alamat Situs</b></td><td>   : <input type=text name='alamatsitus' size='50' value='$s_alamatsitus'> <b>*) Tanpa http:// (mis: www.blablabla.com)</b></td></tr>
          <tr><td><b>Email Toko</td><td>   : <input type=text name='email' size='50' value='$s_email'></td></tr>
          <tr><td><b>Tagline Toko</td><td>   : <input type=text name='tagline' size='100' value='$s_tagline'></td></tr>
          <tr><td colspan=2>
            <b>SEO Keyword</b>, adalah sekumpulan kata-kata kunci yang menggambarkan tentang website Anda.<br>Keyword ini akan digunakan oleh mesin pencari (Search Engine) semacam Google untuk menemukan dan menggolongkan website Anda.<br>
            <b>Pisahkan keyword dengan koma ( , )</b><br>
            <input type=text name='keyword' value='$s_keyword' style='width:100%;height:20px;' autocomplete='off'><br><br>
          </td></tr>
          <tr><td colspan=2><input type=submit class=tombol value=Simpan>
                            <input type=button class=tombol value=Batal onclick=self.history.back()>
          </td></tr>
          </table></form>";
    break;  
}
}
?>
