<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_kontak/aksi_kontak.php";
switch($_GET[act]){
  default:
  $list = array("namatoko","nohp1","nohp2","pinbb","facebook", "pinbb2", "ym1", "ym2", "wa", "wechat", "kakao", "line"
);
   $length = sizeof($list);
   // $centang = arrary();
   
   for($counter=0;$counter<$length;$counter++) {
      $queryset = "SELECT * FROM setting WHERE tipe='".$list[$counter]."'";
      $sqlset = mysql_query($queryset);
      $rset = mysql_fetch_array($sqlset);
      
      if($rset[tipe]=="nohp1")
      {
         $s_nohp1 = $rset[value1];
         $centang[nohp1] = $rset[value2];
      }
      elseif($rset[tipe]=="nohp2")
      {
         $s_nohp2 = $rset[value1];
         $centang[nohp2] = $rset[value2];
      }
      elseif($rset[tipe]=="pinbb")
      {
         $s_pinbb = $rset[value1];
         $centang[pinbb] = $rset[value2];
      }
      elseif($rset[tipe]=="pinbb2")
      {
         $s_pinbb2 = $rset[value1];
         $centang[pinbb2] = $rset[value2];
      }
      elseif($rset[tipe]=="ym1")
      {
         $s_ym1 = $rset[value1];
         $centang[ym1] = $rset[value2];
      }
      elseif($rset[tipe]=="ym2")
      {
         $s_ym2 = $rset[value1];
         $centang[ym2] = $rset[value2];
      }
      elseif($rset[tipe]=="wa")
      {
         $s_wa = $rset[value1];
         $centang[wa] = $rset[value2];
      }
      elseif($rset[tipe]=="wechat")
      {
         $s_wechat = $rset[value1];
         $centang[wechat] = $rset[value2];
      }
      elseif($rset[tipe]=="kakao")
      {
         $s_kakao = $rset[value1];
         $centang[kakao] = $rset[value2];
      }
      elseif($rset[tipe]=="line")
      {
         $s_line = $rset[value1];
         $centang[line] = $rset[value2];
      }
      elseif($rset[tipe]=="facebook")
      {
         $s_fb = $rset[value1];
         $s_fburl = $rset[value2];
         $centang[fb] = $rset[value3];
      }
      elseif($rset[tipe]=="namatoko")
      {
         $s_namatoko = $rset[value1];
      }
   }

    echo "<h2>Edit Kontak Toko Online</h2>
          <form method=POST action='$aksi?module=kontak&act=update'>
          <table>
          <tr><td colspan=2>
            Kontak ini akan ditampilkan pada bagian Kontak $s_namatoko di halaman web.
          </td></tr>
          <tr><td><b>Nomor HP 1</b></td><td>: <input type=text name='nohp1' size=35 value='$s_nohp1'>
            <input type='checkbox' name='tampilkan[]' value='nohp1' $centang[nohp1]> Tampilkan di widget?
          </td></tr>
          <tr><td><b>Nomor HP 2</b></td><td>: <input type=text name='nohp2' size='35' value='$s_nohp2'>
            <input type='checkbox' name='tampilkan[]' value='nohp2' $centang[nohp2]> Tampilkan di widget?
          </td></tr>
          <tr><td><b>PIN BB 1</b></td><td>: <input type=text name='pinbb' size='35' value='$s_pinbb'> <b></b>
            <input type='checkbox' name='tampilkan[]' value='pinbb' $centang[pinbb]> Tampilkan di widget?
          </td></tr>
          <tr><td><b>PIN BB 2</b></td><td>: <input type=text name='pinbb2' size='35' value='$s_pinbb2'> <b></b>
            <input type='checkbox' name='tampilkan[]' value='pinbb2' $centang[pinbb2]> Tampilkan di widget?
          </td></tr>
          <tr><td><b>Nama di Facebook</td><td>: <input type=text name='fb' size='35' value='$s_fb'>
            <input type='checkbox' name='tampilkan[]' value='facebook' $centang[fb]> Tampilkan di widget?
          </td></tr>
          <tr><td><b>URL/Link Facebook</td><td>: <input type=text name='fburl' size='35' value='$s_fburl'>
          <b>*) Tanpa http:// (www.facebook.com/xxxxxx)</b>
          </td></tr>
          <tr><td><b>Yahoo Messenger 1</td><td>: <input type=text name='ym1' size='35' value='$s_ym1'>
            <input type='checkbox' name='tampilkan[]' value='ym1' $centang[ym1]> Tampilkan di widget?
          </td></tr>
          <tr><td><b>Yahoo Messenger 2</td><td>: <input type=text name='ym2' size='35' value='$s_ym2'>
            <input type='checkbox' name='tampilkan[]' value='ym2' $centang[ym2]> Tampilkan di widget?
          </td></tr>
          <tr><td><b>WhatsApp</td><td>: <input type=text name='wa' size='35' value='$s_wa'>
            <input type='checkbox' name='tampilkan[]' value='wa' $centang[wa]> Tampilkan di widget?
          </td></tr>
          <tr><td><b>WeChat</td><td>: <input type=text name='wechat' size='35' value='$s_wechat'>
            <input type='checkbox' name='tampilkan[]' value='wechat' $centang[wechat]> Tampilkan di widget?
          </td></tr>
          <tr><td><b>Kakao Talk</td><td>: <input type=text name='kakao' size='35' value='$s_kakao'>
            <input type='checkbox' name='tampilkan[]' value='kakao' $centang[kakao]> Tampilkan di widget?
          </td></tr>
          <tr><td><b>Line</td><td>: <input type=text name='line' size='35' value='$s_line'>
            <input type='checkbox' name='tampilkan[]' value='line' $centang[line]> Tampilkan di widget?
          </td></tr>

          <tr><td colspan=2><input type=submit class=tombol value=Simpan>
                            <input type=button class=tombol value=Batal onclick=self.history.back()>
          </td></tr>
          </table></form>";
    break;  
  }
}
?>
