<?php
session_start();
include "../../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Update widget
if($module=='widget' AND $act=='update'){
  mysql_query("UPDATE widget SET status      = '$_POST[aktif]',
                                 isi     = '$_POST[isi]'  
                          WHERE id   = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
?>
