<?php
include "../../../config/koneksi.php";
include "../../../config/library.php";
include "../../../config/fungsi_thumb.php";

$module=$_GET[module];
$act=$_GET[act];

if ($module=='thumbnail' AND $act=='status'){
  mysql_query("UPDATE setting SET value1='$_POST[aksi]' WHERE tipe='thumbnail'");
  header('location:../../media.php?module='.$module);
}
?>
