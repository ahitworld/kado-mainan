<?php
  //ob_start( 'ob_gzhandler' );
  error_reporting(0);
  session_start();
  include "config/minify_html.php";
  include "config/koneksi.php";
  include "config/settings.php";
  include "config/widget.php";
  include "config/getURL.php";
  include "config/fungsi_indotgl.php";
  include "config/class_paging.php";
  include "config/fungsi_combobox.php";
  include "config/library.php";
  include "config/fungsi_autolink.php";
  include "config/fungsi_rupiah.php";
  include "config/hapus_orderfiktif.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:fb="http://ogp.me/ns/fb#">
<head>
<title><?php include "config/seo_title.php"; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="index, follow">
<meta name="description" content="<?php include "config/seo_description.php"; ?>">
<meta name="keywords" content="<?php include "config/seo_keyword.php"; ?>">
<meta http-equiv="Copyright" content="Ghozy Arif Fajri, gojigeje">
<meta name="author" content="Ghozy Arif Fajri, gojigeje">
<meta http-equiv="imagetoolbar" content="no">
<meta name="language" content="Indonesia">
<meta name="revisit-after" content="7">
<meta name="webcrawlers" content="all">
<meta name="rating" content="general">
<meta name="spiders" content="all">
<meta property="fb:admins" content="1142928489,100000157608552"/>

<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="rss.xml" />
<link rel="shortcut icon" href="images/favicon.png"/>
<!--// Stylesheet //-->
<link href="css/default.advanced.css" rel="stylesheet" type="text/css" />
<link href="css/jquery.fancybox-1.3.1.css" rel="stylesheet" type="text/css" />
<link href="css/jquery.simplyscroll.css" rel="stylesheet" type="text/css" />
<?php 
  echo "<link href=\"css/style1_$setting_tema.css\" rel=\"stylesheet\" type=\"text/css\" />";
  echo "<link href=\"css/style_$setting_tema.css\" rel=\"stylesheet\" type=\"text/css\" />";
 ?>
<link href="css/slider.css" rel="stylesheet" type="text/css" />
<link href="css/slide.css" rel="stylesheet" type="text/css" />
<link href="css/ui.totop.css" rel="stylesheet" type="text/css" />
<?php if($setting_grid=="3") { ?>
<link href="css/big.css" rel="stylesheet" type="text/css" />
<?php } ?>
<!--href="css/contentslider.css"-->
<!--href="css/jquery.ad-gallery.css"-->
<!--// Javascript //-->
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/cbslidetotophint.js"></script>
<script type="text/javascript" src="js/jquery.anythingslider.js"></script>
<script type="text/javascript" src="js/anythingslider.js"></script>
<script type="text/javascript" src="js/jquery.simplyscroll.js"></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/eurofurence_500-eurofurence_700.font_9bc22cbd.js"></script>
<script type="text/javascript" src="js/cufon.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.2.js"></script>
<script type="text/javascript" src="js/easy.js"></script>
<script type="text/javascript" src="js/jscript.js"></script>
<!--"js/jquery.fancybox-1.3.1.js"-->
<!--src="js/lightbox.js"-->
<!--src="js/jquery.min14.js" -->
<!--src="js/jquery-ui.min.js" -->
<!--src="js/jquery.ad-gallery.js"-->
<!--src="js/contentslider.js"-->
<!--[if lte IE 7]>
<script type="text/javascript" src="js/jquery.dropdown.js"></script>
<![endif]-->

<?php if($setting_hometerbaru_tipe=="geser") { ?>
<script type="text/javascript">
(function($) {
	$(function() {
		$("#scrollerhomeTerbaru").simplyScroll({
			frameRate: 30
		});
	});
})(jQuery);
</script>
<?php } ?>

<?php if($setting_homefeatured_tipe=="geser") { ?>
<script type="text/javascript">
(function($) {
	$(function() {
		$("#scrollerhomeFeatured").simplyScroll({
			frameRate: 30
		});
	});
})(jQuery);
</script>
<?php } ?>

<?php if($setting_homediskon_tipe=="geser") { ?>
<script type="text/javascript">
(function($) {
	$(function() {
		$("#scrollerhomeDiskon").simplyScroll({
			speed: 10,
			auto: false
		});
	});
})(jQuery);
</script>
<?php } ?>

<script type="text/javascript">
(function($) {
	$(function() {
		$("#scrollerprodDiskon").simplyScroll({
			speed: 10,
			auto: false
		});
	});
})(jQuery);
</script>

<?php if($w_semuakategori_isi=="geser") { ?>
<script type="text/javascript">
(function($) {
	$(function() {
		$(".scrollerSemuaKategori").simplyScroll({
			speed: 10,
			auto: false
		});
	});
})(jQuery);
</script>
<?php } ?>

<script type="text/javascript">
(function($) {
	$(function() {
		$("#scrollerprodLain").simplyScroll({
			speed: 10,
			auto: false
		});
	});
})(jQuery);
</script>

<script type="text/javascript">
(function($) {
	$(function() {
		$("#listticker").simplyScroll({
			customClass:'testimoni',
			orientation:'vertical',
			frameRate: 15
		});

	});
})(jQuery);
</script>

<meta charset="UTF-8">
<style type="text/css">
<!--
.style1 {color: #FF6600}
-->
</style>
<?php
   if($setting_background_tipe=="warna") {
      echo "
         <style type='text/css'>
            body {
               background-color: #$setting_background_value;
            }
         </style>
      ";
   }
   
   if($setting_layout=="kiri")
   {
      echo "
         <link href='css/kiri.css' rel='stylesheet' type='text/css' />
      ";
   }
   
   if($setting_slider=="Y") {
      $slideraktif = true;
   }
   else {
      // cssnya
      echo "
         <style type='text/css'>
            .col1 {
               padding-top:0px;
            }
         </style>
      ";
   }
?>
</head>

<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/id_ID/all.js#xfbml=1&appId=140831729365765";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<a name="top"></a>
<div id="wrapper_sec">
	<div id="head">
<!--========== LOGO ==========-->
      <div class="logo">
         <a href="index.php"><img src="images/logo.png" alt="" /></a>
      </div>
<!--========== /LOGO ==========-->

<!--========== TANGGALAN ==========-->
      <div class="rightnavi">
          <div class="clear">
          <ul>
          <SCRIPT language=JavaScript src="js/tanggalan.js"></SCRIPT> 
          <!-- 
          <span class="style1">I</span>
        -->
          <SCRIPT language=JavaScript>var d = new Date();
var h = d.getHours();
if (h < 11) { var greet = "Selamat Pagi, "; }
else { if (h < 15) { var greet = "Selamat Siang, ";}
else { if (h < 19) { var greet = "Selamat Sore, "; }
else { if (h <= 23) { var greet = "Selamat Malam, "; }
}}}</SCRIPT>
           </ul>
           </div>
      </div>
<!--========== /TANGGALAN ==========-->

<!--========== MENU ==========-->
        <div class="clear"></div>
        <div class="navigation">
          <ul id="nav" class="dropdown dropdown-linear dropdown-columnar">
            <?php               
              $main=mysql_query("SELECT * FROM mainmenu WHERE aktif='Y'");

              while($r=mysql_fetch_array($main)){
	               echo "<li><b><a href='$r[link]'>$r[nama_menu]</a></b>
                          <ul>";
	               $sub=mysql_query("SELECT * FROM submenu, mainmenu  
                                  WHERE submenu.id_main=mainmenu.id_main 
                                  AND submenu.id_main=$r[id_main]");
	               while($w=mysql_fetch_array($sub)){
                    echo " <li class='clear'><b><a href='$w[link_sub]'>$w[nama_sub]</a></b></li>";
	               }
	             echo "</ul>
            </li>";} ?>
          </ul>
        </div></div>
<!--========== /MENU ==========-->

<!--========== BREADCRUMBS & SEARCH ==========-->
    <div id="read" class="clear"></div>
    <div id="crumb">
    	<ul class="left">
        	<li><p>Anda berada di:</p></li>
      </ul>
	   <ul class="left2">
         <?php include "config/breadcrumb.php";?>
      </ul>
      <ul class="search right">
         <form method="POST" action="hasil-pencarian.html#read">
         <li><input name="kata" type="text" class="bar" title="Cari Produk, Ketik lalu ENTER"/></li>
         <li><input type="submit" class="go" value="cari" /></li></form>
      </ul>
  </div>
<!--========== /BREADCRUMBS & SEARCH ==========-->

<!--========== SLIDER ==========-->
    <div class="clear"></div>
<?php
   if($slideraktif) {
      include "modulweb/mod_slider.php";
   }
?>
<!--========== /SLIDER ==========-->

<!--========== KONTEN ==========-->
    <div class="clear"></div>
    <div id="content_sec">
<!--========== KIRI ==========-->
    	<div class="col1">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="images/spacer.gif" width="1" height="20" /></td>
              </tr>
              <tr>
                <td><span class="center_content2"><?php include "modulweb/tengah.php";?></td>
              </tr>
            </table>
            <div class="clear"></div>
      </div>
<!--========== /KIRI ==========-->

<!--========== KANAN ==========-->
    	<div class="col2">

<?php
if($w_login=="Y")
{
   include "widget/login.php";
}
include "widget/keranjangbelanja.php";
if($w_kategori=="Y")
{
   include "widget/kategori.php";
}
if($w_panduan=="Y")
{
   include "widget/panduan.php";
}  
include "widget/rekening.php";
include "widget/kontak.php";
if($w_featured=="Y")
{
   include "widget/produk-featured.php";
}

if($w_terbaru=="Y")
{
   include "widget/produk-terbaru.php";
}

if($w_terlaris=="Y")
{
   include "widget/produk-laris.php";
}

if($w_link=="Y")
{
   include "widget/link.php";
}

if($w_statistik=="Y")
{
   include "widget/statistik.php";
}
if($w_facebook=="Y")
{
   include "widget/facebook.php";
}
?>
    	</div>
<!--========== /KANAN ==========-->
    	<div class="clear"></div>
    </div>
<!--========== /KONTEN ==========-->

<!--========== FOOTER ==========-->
    <div class="clear"></div>
    <div id="footer">
<!--========== ABOUTUS ==========-->
        <div class="aboutus">
        	<h5>Tentang <?=$setting_namatoko?></h5>
        	<?php
        	   $about = mysql_query("SELECT * FROM modul WHERE id_modul='67'");
	         $r      = mysql_fetch_array($about);
	         
	         echo $r[static_content];
        	?>
         <div align="right">
            <img src="images/chatdisini.png" width="150px">
         </div>
        </div>
<!--========== /ABOUTUS ==========-->

<!--========== CHAT ==========-->
        <div class="joinnews">
        	<h5>Chat Box</h5>
<!-- BEGIN CBOX - www.cbox.ws - v001 -->
<div id="cboxdiv" style="text-align: center; line-height: 0">
<div><iframe frameborder="0" width="180" height="180" src="http://www5.cbox.ws/box/?boxid=757365&amp;boxtag=r4l1wp&amp;sec=main" marginheight="2" marginwidth="2" scrolling="auto" allowtransparency="yes" name="cboxmain5-757365" style="border:#ababab 1px solid;" id="cboxmain5-757365"></iframe></div>
<div><iframe frameborder="0" width="180" height="90" src="http://www5.cbox.ws/box/?boxid=757365&amp;boxtag=r4l1wp&amp;sec=form" marginheight="2" marginwidth="2" scrolling="no" allowtransparency="yes" name="cboxform5-757365" style="border:#ababab 1px solid;border-top:0px" id="cboxform5-757365"></iframe></div>
</div>
<br/>
<!-- END CBOX -->
        	<!--<ul>
            	<li>
            	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><?php //include "widget/polling.php" ?></td>
                    </tr>
                  </table>
            	</li>
            	<li></li>
            </ul>-->
        </div>
<!--========== /CHAT ==========-->

<!--========== SEKILAS ==========-->
        <div class="ourblog">
        	<h5>Testimoni Customer</h5>
        	<ul>
                <?php include "widget/testimoni.php" ?>
            </ul>
        </div>
<!--========== /SEKILAS ==========-->

<!--========== CONTACT ==========-->
        <div class="contactus">
        	<h5>Kontak <?=$setting_namatoko?></h5>
        	<p>
        	   Pertanyaan / info lebih lanjut hubungi kontak kami berikut ini:
        	</p>
            <ul>
               <?php
            	   if(!empty($setting_fb))
            	   {
            	      ?>
            	         <li class="fb"><span class="bold"><a href="http://<?=$setting_fburl?>" target="_blank"><?=$setting_fb?></a></li>
            	      <?php
            	   }
            	?>
            	<?php
            	   if(!empty($setting_nohp1))
            	   {
            	      ?>
            	         <li class="tel"><span class="bold"><?=$setting_nohp1?> (SMS Only)</li>
            	      <?php
            	   }
            	?>
            	<?php
            	   if(!empty($setting_nohp2))
            	   {
            	      ?>
            	         <li class="tel"><span class="bold"><?=$setting_nohp2?> (SMS Only)</li>
            	      <?php
            	   }
            	?>
            	<?php
            	   if(!empty($setting_pinbb))
            	   {
            	      ?>
            	         <li class="bb"><span class="bold">PIN BB: <?=$setting_pinbb?></li>
            	      <?php
            	   }
            	?>
            	 <li class="ym"><span class="bold"><a href="ymsgr:sendim?saharabutik@ymail.com">saharabutik@ymail.com</a></li>
                <li class="email"><span class="bold"><a href="mailto:<?=$setting_email?>"><?=$setting_email?></a></li>
            </ul>
            <br>
            <div align="left">
                <br/>
               <img src="images/isitestimoni.png" width="150px">
            </div>
        </div>
<!--========== /CONTACT ==========-->

<!--========== COPYRIGHT ==========-->
        <div class="clear"></div>
        <div class="copyright_network" id="promosi">
         <p>
            <span class="blinker"><big>&nbsp;&nbsp;Ingin membuat toko online seperti ini..? &nbsp;&nbsp;Dapatkan sekarang..!! &nbsp;&nbsp;Hubungi <a href="http://goji.web.id" target="_blank">Goji</a> lewat <a href="http://facebook.com/gojigeje" target="_blank">facebook</a> atau <a href="mailto:gojigeje@gmail.com?subject=Order Web">email</a> :)</big></span>
        	</p>
        </div>
        
        <div class="copyright_network">
         <p>
           	Copyright © 2012 <a href="#"><?=$setting_alamatsitus?></a> | email: <?=$setting_email?> | Web Development by <a href="http://goji.web.id" target="_blank">gojigeje</a> & <a href="mailto:rizal_fzl@yahoo.com?subject=Dari SaharaButik.com">Rizal Faizal</a>
        	</p>
        	<ul class="network">
                <li><a href="rss.xml"><img src="images/rss.gif" alt="RSS Feed" border="0" height="20px" /></a></li>
            </ul>
        </div>
<!--========== /COPYRIGHT ==========-->

        <div class="clear"></div>
	</div>
</div>
<!--========== /FOOTER ==========-->
<?php
   if($w_panelatas=="Y")
   {
    ?>
      <!--========== TOPPANEL ==========-->
      <div id="toppanel">
      <?php
         if($w_panelatas_isi=="login")
         {
      ?>
	      <div id="panel">
		      <div class="slidezcontent clearfix">
			      <div class="slidezleft">
				      <h1>Keuntungan Menjadi Member di <?=$setting_namasitus?></h1>
				      <p class="slidezgrey">Dengan menjadi member, Anda dapat berbelanja dengan lebih mudah. Dan berkesempatan mendapatkan promo / diskon spesial di waktu-waktu tertentu!</p>
				      <h2>Download</h2>
				      <p class="slidezgrey">To download this script go back to <a href="http://web-kreation.com/index.php/tutorials/nice-clean-sliding-login-panel-built-with-jquery" title="Download">article »</a></p>
			      </div>
			      <div class="slidezleft">			
				      <!-- Register Form -->
				      <form action="#" method="post">
					      <h1>Belum jadi member? Ayo Daftar!</h1>				
					      <label class="slidezgrey" for="signup">Tentukan Username:</label>
					      <input class="slidezfield" type="text" name="signup" id="signup" value="" size="23">
					      <label class="slidezgrey" for="email">Alamat Email:</label>
					      <input class="slidezfield" type="text" name="email" id="email" size="23">
					      <label class="slidezgrey" for="pwd">Tentukan Password:</label>
					      <input class="slidezfield" type="text" name="password" id="password" size="23">
					      <label>Anda bisa langsung berbelanja setelahnya.</label>
					      <input type="submit" name="submit" value="Daftar Sekarang" class="slidezbt_register">
				      </form>
			      </div>
			      <div class="slidezleft right">
				      <!-- Login Form -->
				      <form class="slidezclearfix" action="#" method="post">
					      <h1>Member Login</h1>
					      <label class="slidezgrey" for="log">Username:</label>
					      <input class="slidezfield" type="text" name="log" id="log" value="" size="23">
					      <label class="slidezgrey" for="pwd">Password:</label>
					      <input class="slidezfield" type="password" name="pwd" id="pwd" size="23">
              			<div class="slidezclear"></div>
              			<a class="slidezlost-pwd" href="#">Lupa password?</a>
					      <input type="submit" name="submit" value="Login" class="slidezbt_login">
				      </form>
			      </div>
			
		      </div>
      </div> <!-- /login -->
	      <!-- The tab on top -->	
	      <div class="slideztab">
		      <ul class="slidezlogin">
			      <li class="slidezleft">&nbsp;</li>
			      <li>Halo, sudah jadi member <?=$setting_namasitus?> ?</li>
			      <li class="slidezsep">|</li>
			      <li id="toggle">
				      <a id="open" class="slidezopen" style="cursor:pointer;">LOGIN / DAFTAR JADI MEMBER</a>
				      <a id="close" style="display:none;cursor:pointer;" class="slidezclose">TUTUP PANEL</a>			
			      </li>
			      <li class="slidezright">&nbsp;</li>
		      </ul> 
	      </div> <!-- / top -->
      </div>
      <!--========== /TOPPANEL ==========-->  
    <?php
      }
      elseif($w_panelatas_isi=="info")
      {
         $sql = "SELECT * from (SELECT harga, diskon, id_produk, produk_seo, nama_kategori, gambar, nama_produk FROM produk, kategori WHERE kategori.id_kategori=produk.id_kategori AND produk.stok!=0 ORDER BY harga ASC LIMIT 3) as a ORDER BY rand() LIMIT 1";
         $q = mysql_query($sql);
         $r = mysql_fetch_array($q);
         $pharga = format_rupiah($r[harga]);
         $pdisc     = ($r[diskon]/100)*$r[harga];
         $phargadisc     = number_format(($r[harga]-$pdisc),0,",",".");
         
         if($totalitem!=0)
         {
         ?>
         <div class="slideztab">
		      <ul class="slidezlogin">
			      <li class="slidezleft">&nbsp;</li>
			      <li class='tooltip' title='<center><img src="foto_produk/small/small_<?=$r[gambar]?>" width="150px"><br>klik untuk melihat detail</center>'>
			         <span class="blinker">
			            <a href="produk-<?=$r[id_produk]?>-<?=$r[produk_seo]?>.html#read">!! PROMO !! - <?=$r[nama_kategori]?> <?=$r[nama_produk]?> murah hanya Rp <?=$phargadisc?></a>
			         </span>
			      </li>
			      <li class="slidezsep">|</li>
			      <li id="topPanelTotal">Total belanja Anda: <?=$totalitem?> item ( Rp <?=$subtotalwidget_rp?> )</li>
			      <li class="slidezsep">|</li>
			      <li id="topPanelGoto"><a href="keranjang-belanja.html#read">Lihat Keranjang</a>&nbsp; | &nbsp;<a href="selesai-belanja.html#read">Ke Kasir/Checkout</a></li>
			      <li class="slidezright">&nbsp;</li>
		      </ul> 
	      </div> <!-- / top -->
	  </div>
         <?php
         }
         else
         {
         ?>
         <div class="slideztab">
		      <ul class="slidezlogin">
			      <li class="slidezleft">&nbsp;</li>
			      <li class='tooltip' title='<center><img src="foto_produk/small/small_<?=$r[gambar]?>" width="150px"><br>klik untuk melihat detail</center>'>
			         <span class="blinker">
			            <a href="produk-<?=$r[id_produk]?>-<?=$r[produk_seo]?>.html#read">!! PROMO !! - <?=$r[nama_kategori]?> <?=$r[nama_produk]?> murah hanya Rp <?=$phargadisc?></a>
			         </span>
			      </li>
			      <li class="slidezsep">|</li>
			      <li>Halo, selamat berlanja di <?=$setting_namasitus?></li>
			      <li class="slidezright">&nbsp;</li>
		      </ul> 
	      </div> <!-- / top -->
	  </div>
         <?php
         }
      }
   }
?>
<script type="text/javascript" src="js/fb.comment.js"></script>
</body>
</html>
