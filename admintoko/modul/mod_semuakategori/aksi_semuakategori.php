<?php
session_start();
include "../../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Update widget
if($module=='semuakategori' AND $act=='update'){
  mysql_query("UPDATE setting SET value1='$_POST[semuajumlah]' WHERE tipe='semuajumlah'");
  mysql_query("UPDATE setting SET value1='$_POST[semuaterbaru]' WHERE tipe='semuaterbaru'");
  mysql_query("UPDATE setting SET value1='$_POST[kategorijumlah]' WHERE tipe='kategorijumlah'");
  mysql_query("UPDATE setting SET value1='$_POST[kategoriterbaru]' WHERE tipe='kategoriterbaru'");
  mysql_query("UPDATE setting SET value1='$_POST[semuafeatured]' WHERE tipe='semuafeatured'");
  mysql_query("UPDATE setting SET value1='$_POST[kategorifeatured]' WHERE tipe='kategorifeatured'");
  header('location:../../media.php?module='.$module);
}
?>
