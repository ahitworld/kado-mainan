<?php
session_start();
include "../../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Update widget
if($module=='detailproduk' AND $act=='update'){
  mysql_query("UPDATE setting SET value1='$_POST[like]' WHERE tipe='detail_fblike'");
  mysql_query("UPDATE setting SET value1='$_POST[comment]' WHERE tipe='detail_fbcomment'");
  mysql_query("UPDATE setting SET value1='$_POST[related]' WHERE tipe='detail_related'");
  mysql_query("UPDATE setting SET value1='$_POST[diskon]' WHERE tipe='detail_diskon'");
  mysql_query("UPDATE setting SET value1='$_POST[featured]' WHERE tipe='detail_featured'");
  header('location:../../media.php?module='.$module);
}
?>
