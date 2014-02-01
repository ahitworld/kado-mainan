<?php
session_start();
include "../../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Update widget
if($module=='homepage' AND $act=='update'){
  if($_POST[id]=="hometerbaru" || $_POST[id]=="homediskon" || $_POST[id]=="homefeatured")
  {
   mysql_query("UPDATE setting SET value1='$_POST[value1]', value2='$_POST[value2]', value3='$_POST[value3]' WHERE tipe='$_POST[id]'");
  }
  elseif($_POST[id]=="homekoleksi")
  {
   mysql_query("UPDATE setting SET value1='$_POST[value1]', value2='$_POST[value2]' WHERE tipe='$_POST[id]'");
  }
  else
  {
   mysql_query("UPDATE setting SET value1='$_POST[value1]' WHERE tipe='$_POST[id]'");
  }
  header('location:../../media.php?module='.$module);
}
?>
