<?php
include "../../../config/koneksi.php";
include "../../../config/library.php";
include "../../../config/fungsi_thumb.php";

$module=$_GET[module];
$act=$_GET[act];

if ($module=='grid' AND $act=='update'){
  mysql_query("UPDATE setting SET value1='$_POST[value1]' WHERE tipe='grid'");
  header('location:../../media.php?module='.$module);
}
?>
