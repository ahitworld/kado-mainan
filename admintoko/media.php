<?php
session_start();
error_reporting(0);
include "../config/koneksi.php";
include "../config/settings.php";
$modulnya = $_GET['module'];
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='css/screen.css' rel='stylesheet' type='text/css'><link href='css/reset.css' rel='stylesheet' type='text/css'>


 <center><br><br><br><br><br><br>Maaf, untuk masuk <b>Halaman Administrator</b><br>
  <center>anda harus <b>Login</b> dahulu!<br><br>";
 echo "<div> <a href='index.php'><img src='images/kunci.png'  height=176 width=143></a>
             </div>";
  echo "<input type=button class=simplebtn value='LOGIN DI SINI' onclick=location.href='index.php'></a></center>";
}
else{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html class="halamanadmin" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="description"  content=""/>
<meta name="keywords" content=""/>
<meta name="robots" content="ALL,FOLLOW"/>
<meta name="Author" content="Ghozy Arif Fajri, gojigeje"/>
<meta http-equiv="imagetoolbar" content="no"/>
<title>Dashboard - <?=$setting_namasitus?></title>
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
<link rel="stylesheet" href="css/reset.css" type="text/css"/>
<link rel="stylesheet" href="css/screen.css" type="text/css"/>
<link rel="stylesheet" href="css/fancybox.css" type="text/css"/>
<link rel="stylesheet" href="css/jquery.wysiwyg.css" type="text/css"/>
<link rel="stylesheet" href="css/jquery.ui.css" type="text/css"/>
<link rel="stylesheet" href="css/visualize.css" type="text/css"/>
<link rel="stylesheet" href="css/visualize-light.css" type="text/css"/>
<link rel="stylesheet" media="screen" type="text/css" href="css/colorpicker.css" />

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.visualize.js"></script>
<script type="text/javascript" src="js/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="js/tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript" src="js/jquery.fancybox.js"></script>
<script type="text/javascript" src="js/jquery.idtabs.js"></script>
<script type="text/javascript" src="js/jquery.datatables.js"></script>
<script type="text/javascript" src="js/jquery.jeditable.js"></script>
<script type="text/javascript" src="js/jquery.ui.js"></script>
<script type="text/javascript" src="js/colorpicker.js"></script>
<script type="text/javascript" src="js/hint.js"></script>

<script type="text/javascript" src="js/excanvas.js"></script>
<script type="text/javascript" src="js/cufon.js"></script>
<script type="text/javascript" src="js/Geometr231_Hv_BT_400.font.js"></script>

<script language="javascript" type="text/javascript">
    tinyMCE_GZ.init({
    plugins : 'style,layer,table,save,advhr,advimage, ...',
		themes  : 'simple,advanced',
		languages : 'en',
		disk_cache : true,
		debug : false
});
</script>
<?php
   if($modulnya=="background") {
      include "../config/koneksi.php";
      $sqlbackground = mysql_query("SELECT * FROM setting WHERE tipe='background'");
      $rbackground  = mysql_fetch_array($sqlbackground);
      echo "
      <script>
         $(document).ready(function(){
            $('#colorpickerHolder').ColorPicker({
              flat: true,
              color: '#".$rbackground[value2]."',
              onChange: function (hsb, hex, rgb) {
		            $('#previewColor').css('backgroundColor', '#' + hex);
		            $('#valueColor').val(hex);
	           }
            });
            $('#previewColor').css('backgroundColor', '#".$rbackground[value2]."');
         });
         
         function resetColor() {
            $('#colorpickerHolder').ColorPickerSetColor('".$rbackground[value2]."');
            $('#valueColor').val('".$rbackground[value2]."');
            $('#previewColor').css('backgroundColor', '#".$rbackground[value2]."');
         }
      </script>
      ";
    }
?>
<script language="javascript" type="text/javascript"
src="../tinymcpuk/tiny_mce_src.js"></script>
<script type="text/javascript">
tinyMCE.init({
		mode : "textareas",
		theme : "advanced",
		/*plugins : "table,youtube,advhr,advimage,advlink,emotions,flash,searchreplace,paste,directionality,noneditable,contextmenu", */
		theme_advanced_buttons1_add : "fontselect,fontsizeselect",
		theme_advanced_buttons2_add : "separator,preview,zoom,separator,forecolor,backcolor,liststyle",
		theme_advanced_buttons2_add_before: "cut,copy,paste,separator",
		/*theme_advanced_buttons3_add_before : "tablecontrols,separator,youtube,separator",*/
		/*theme_advanced_buttons3_add : "emotions,flash",*/
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		extended_valid_elements : "hr[class|width|size|noshade]",
		file_browser_callback : "fileBrowserCallBack",
		paste_use_dialog : false,
		theme_advanced_resizing : true,
		theme_advanced_resize_horizontal : false,
		theme_advanced_link_targets : "_something=My somthing;_something2=My somthing2;_something3=My somthing3;",
		apply_source_formatting : true
});

	function fileBrowserCallBack(field_name, url, type, win) {
		var connector = "../../filemanager/browser.html?Connector=connectors/php/connector.php";
		var enableAutoTypeSelection = true;
		
		var cType;
		tinymcpuk_field = field_name;
		tinymcpuk = win;
		
		switch (type) {
			case "image":
				cType = "Image";
				break;
			case "flash":
				cType = "Flash";
				break;
			case "file":
				cType = "File";
				break;
		}
		
		if (enableAutoTypeSelection && cType) {
			connector += "&Type=" + cType;
		}
		
		window.open(connector, "tinymcpuk", "modal,width=600,height=400");
	}
	
	$(document).ready(function(){
	$('input[title!=""]').hint();
	
      $('.notification').hide();
      $('.notification').fadeIn(500);
	   
	   $('#ulpengaturan').hide();
	   $('#ultampilan').hide();
	   $('#ultoko').hide();
	   $('#ulmember').hide();
	   $('#uladmin').hide();
	   
	   $('#menupengaturan').click(function() {
         $('#ulpengaturan').slideToggle(400);
	      $('#ultampilan').slideUp(400);
	      $('#ultoko').slideUp(400);
	      $('#ulmember').slideUp(400);
	      $('#uladmin').slideUp(400);
         return false;
      });
      $('#menutampilan').click(function() {
         $('#ultampilan').slideToggle(400);
         $('#ulpengaturan').slideUp(400);
	      $('#ultoko').slideUp(400);
	      $('#ulmember').slideUp(400);
	      $('#uladmin').slideUp(400);
         return false;
      });
      $('#menutoko').click(function() {
         $('#ultoko').slideToggle(400);
         $('#ulpengaturan').slideUp(400);
	      $('#ultampilan').slideUp(400);
	      $('#ulmember').slideUp(400);
	      $('#uladmin').slideUp(400);
         return false;
      });
      $('#menumember').click(function() {
         $('#ulmember').slideToggle(400);
         $('#ulpengaturan').slideUp(400);
	      $('#ultampilan').slideUp(400);
	      $('#ultoko').slideUp(400);
	      $('#uladmin').slideUp(400);
         return false;
      });
      $('#menuadmin').click(function() {
         $('#uladmin').slideToggle(400);
         $('#ulpengaturan').slideUp(400);
	      $('#ultampilan').slideUp(400);
	      $('#ultoko').slideUp(400);
	      $('#ulmember').slideUp(400);
         return false;
      });
   });
</script>
<?php
    if
    (  $modulnya=="menuutama" || 
       $modulnya=="submenu" || 
       $modulnya=="welcome" || 
       $modulnya=="profil" ||
       $modulnya=="aboutus" ||
       $modulnya=="identitas" ||
       $modulnya=="carabeli" ||
       $modulnya=="carabayar" ||
       $modulnya=="carakonfirmasi" ||
       $modulnya=="carapengiriman" ||
       $modulnya=="bank" ||
       $modulnya=="kontak" ||
       $modulnya=="download" )
    {
      echo "
         <script type='text/javascript'>
            $(document).ready(function(){
               $('#ulpengaturan').show();
            });
         </script>
      ";
    }
    elseif
    (  $modulnya=="homepage" ||
       $modulnya=="semuakategori" ||
       $modulnya=="detailproduk" ||
       $modulnya=="grid" ||
       $modulnya=="thumbnail" ||
       $modulnya=="widget" ||
       $modulnya=="layout" || 
       $modulnya=="header" || 
       $modulnya=="tema" ||
       $modulnya=="background"
    )
    {
      echo "
         <script type='text/javascript'>
            $(document).ready(function(){
               $('#ultampilan').show();
            });
         </script>
      ";
    }
    elseif
    (  $modulnya=="produk" || 
       $modulnya=="kategori" || 
       $modulnya=="order" || 
       $modulnya=="laporan" || 
       $modulnya=="jasakirim" ||
       $modulnya=="ongkoskirim" ||
       $modulnya=="testimoni" )
    {
      echo "
         <script type='text/javascript'>
            $(document).ready(function(){
               $('#ultoko').show();
            });
         </script>
      ";
    }
    elseif
    (  $modulnya=="kelolamember" || 
       $modulnya=="kirimemail" 
    )
    {
      echo "
         <script type='text/javascript'>
            $(document).ready(function(){
               $('#ulmember').show();
            });
         </script>
      ";
    }
    elseif
    (  $modulnya=="tambahadmin" || 
       $modulnya=="password" ||
       $modulnya=="modul"
    )
    {
      echo "
         <script type='text/javascript'>
            $(document).ready(function(){
               $('#uladmin').show();
            });
         </script>
      ";
    }
?>
<style type="text/css">
<!--
.style3 {
	color: #62A621;
	font-weight: bold;
}
-->
</style>
</head>
<body>

	<div class="sidebar">	   
		<div class="logo clear" align="center"><b><a href="media.php?module=home"><span style="color:white;">Halaman Administrator</span></b><img src="images/logo-300px.png" alt="" width="196px" /></a></div>
		
		<div class="menu">
		  <ul>
		     <?php include "menu/menu-pengaturan.php"; ?>
		     <?php include "menu/menu-tampilan.php"; ?>
		     <?php include "menu/menu-toko.php"; ?>
		     <?php include "menu/menu-widget.php"; ?>
		     <?php include "menu/menu-membership.php"; ?>
		     <?php include "menu/menu-admin.php"; ?>
		  </ul>
	  </div>
	</div>
	
	
	<div class="main"> <!-- *** mainpage layout *** -->
	<div class="main-wrap">
		<div class="header clear">
			<ul class="links clear">
			<li><strong>Login sebagai : <?=$_SESSION[namalengkap]?></strong></li>
			<li><a href="?module=home"><img src="images/home.png" alt="" class="icon" /> <span class="text">Ke Dashboard</span></a></li>
			<li><a href="../index.php" target="_blank"><img src="images/ico_view_24.png" alt="" class="icon" /> <span class="text">Lihat Website</span></li>
			
			<li><a href="logout.php"><img src="images/ico_logout_24.png" alt="" class="icon" /> <span class="text">LogOut</span></a></li>
			</ul>
		</div>
		
		<div class="page clear">			
			<!-- MODAL WINDOW -->
			<div id="modal" class="modal-window">
				<!-- <div class="modal-head clear"><a onclick="$.fancybox.close();" href="javascript:;" class="close-modal">Close</a></div> -->
			</div>
			
			<!-- CONTENT BOXES -->
			<!-- end of content-box -->
<div class="notification note-success" style="padding:20px;">
  <?php include "content.php"; ?>
</div>
			<div class="clear">
				<!-- end of content-box -->
			
		</div><!-- end of page -->
		
		<div class="footer clear"></div>
	</div>
	</div>
</div>

<meta http-equiv="content-type" content="text/html;charset=UTF-8">
</html>
<?php
}
?>
