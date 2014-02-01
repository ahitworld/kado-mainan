<?php
include "../../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Update cara pembelian
if ($module=='identitas' AND $act=='update'){
  mysql_query("UPDATE setting SET value1 = '$_POST[namatoko]' WHERE tipe ='namatoko'");
  mysql_query("UPDATE setting SET value1 = '$_POST[namasitus]' WHERE tipe ='namasitus'");
  mysql_query("UPDATE setting SET value1 = '$_POST[alamatsitus]' WHERE tipe ='alamatsitus'");
  mysql_query("UPDATE setting SET value1 = '$_POST[email]' WHERE tipe ='email'");
  mysql_query("UPDATE setting SET value1 = '$_POST[keyword]' WHERE tipe ='keyword'");
  mysql_query("UPDATE setting SET value1 = '$_POST[tagline]' WHERE tipe ='tagline'");
  header('location:../../media.php?module='.$module);
}
?>
