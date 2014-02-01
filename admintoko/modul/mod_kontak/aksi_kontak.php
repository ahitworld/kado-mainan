<?php
include "../../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Update cara pembelian
if ($module=='kontak' AND $act=='update'){
  mysql_query("UPDATE setting SET value1 = '$_POST[nohp1]' WHERE tipe ='nohp1'");
  mysql_query("UPDATE setting SET value1 = '$_POST[nohp2]' WHERE tipe ='nohp2'");
  mysql_query("UPDATE setting SET value1 = '$_POST[pinbb]' WHERE tipe ='pinbb'");
  mysql_query("UPDATE setting SET value1 = '$_POST[fb]' WHERE tipe ='facebook'");
  mysql_query("UPDATE setting SET value2 = '$_POST[fburl]' WHERE tipe ='facebook'");
  mysql_query("UPDATE setting SET value1 = '$_POST[pinbb2]' WHERE tipe ='pinbb2'");
  mysql_query("UPDATE setting SET value1 = '$_POST[ym1]' WHERE tipe ='ym1'");
  mysql_query("UPDATE setting SET value1 = '$_POST[ym2]' WHERE tipe ='ym2'");
  mysql_query("UPDATE setting SET value1 = '$_POST[wa]' WHERE tipe ='wa'");
  mysql_query("UPDATE setting SET value1 = '$_POST[wechat]' WHERE tipe ='wechat'");
  mysql_query("UPDATE setting SET value1 = '$_POST[kakao]' WHERE tipe ='kakao'");
  mysql_query("UPDATE setting SET value1 = '$_POST[line]' WHERE tipe ='line'");
  header('location:../../media.php?module='.$module);
}
?>
