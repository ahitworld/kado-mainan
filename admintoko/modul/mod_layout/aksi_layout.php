<?php
include "../../../config/koneksi.php";
include "../../../config/library.php";
include "../../../config/fungsi_thumb.php";

$module=$_GET[module];
$act=$_GET[act];

if ($module=='layout' AND $act=='status'){
  mysql_query("UPDATE setting SET value1='$_POST[posisi]' WHERE tipe='layout'");
  header('location:../../media.php?module='.$module);
}
?>
