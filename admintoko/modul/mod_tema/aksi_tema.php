<?php
include "../../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

if ($module=='tema' AND $act=='status'){
  mysql_query("UPDATE setting SET value1='$_POST[posisi]' WHERE tipe='tema'");
  header('location:../../media.php?module='.$module);
}
?>
