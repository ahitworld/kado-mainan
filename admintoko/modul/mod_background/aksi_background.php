<?php
session_start();
include "../../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Update widget
if($module=='background' AND $act=='update'){
  mysql_query("UPDATE setting SET value2='$_POST[value2]' WHERE tipe='background'");
  header('location:../../media.php?module='.$module);
}
?>
