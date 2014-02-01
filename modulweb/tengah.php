<?php
   if ($_GET[module]=='keranjangbelanja' || $_GET[module]=='selesaibelanja')
   {
?>
<script language="javascript">
function harusangka(jumlah){
  var karakter = (jumlah.which) ? jumlah.which : event.keyCode;
  if ( karakter > 31 && ( karakter < 48 || karakter > 57 ))
    return false;
  return true;
}
</script>
<?php
}
if($setting_grid=="3") {
   $tinggithumbnail = "140";
   $classbox = "prod_box_scroll";
   if($setting_hometerbaru_tipe=="biasa") {
      $classhometerbaru = "prod_box";
   } else { $classhometerbaru = "prod_box_scroll"; }
   if($setting_homefeatured_tipe=="biasa") {
      $classhomefeatured = "prod_box";
   } else { $classhomefeatured = "prod_box_scroll"; }
   if($w_semuakategori_isi=="biasa") {
      $classsemuakategori= "prod_box";
   } else { $classsemuakategori= "prod_box_scroll"; }
} elseif($setting_grid=="4") {
   $tinggithumbnail = "120";
   $classbox = "prod_box";
   $classhomefeatured= "prod_box";
   $classsemuakategori= "prod_box";
}
// Halaman utama (Home)
if ($_GET[module]=='store'){
   if($setting_homewelcome=="Y")
   {
  // Data selamat datang mengacu pada id_modul=56
	$profil = mysql_query("SELECT * FROM modul WHERE id_modul='56'");
	$r      = mysql_fetch_array($profil);

     echo " 
            </div>
               <h4 class='heading colr welcome'><script>document.write(greet);</script>Selamat Datang di $setting_namasitus...</h4>
               <div class='profil2'>$r[static_content]<br /> </div>
            </div> "; 
		  
		  // di atas hanya tambahan
	  
	  echo "<div class='clear'>";
	  }
	  if($setting_fblike=="Y") {
	   echo "<fb:like send=\"true\" width=\"600\" show_faces=\"false\"></fb:like>";
	  }
	  if(!empty($setting_nohp2))
	  {
	   $nohape2 = " / <span class=\"bold\">$setting_nohp2</span>";
	  }
  ?>

<?php if($setting_homesmsbbm=="Y") { ?><br>
<div id="infoTambahan" align="center" valign="center">
         <h4>Ingin order Anda diproses dengan cepat..? Order lewat SMS / BBM saja..<br>SMS ke <span class="bold"><?=$setting_nohp1?></span><?=$nohape2?> (FAST RESPON)
         <?php
            if(!empty($setting_pinbb))
            {
               ?>
                  <br>PIN BB: <span class="bold"><?=$setting_pinbb?></span> - Invite Request "Order <?=$setting_namatoko?>"</h4>
               <?php
            }
         ?>
</div>
<?php } ?>
      
<!--========== TERBARU ==========-->
<?php if($setting_hometerbaru=="Y") { ?>
  <h4 class="heading colr">PRODUK TERBARU, NEW ARRIVAL</h4>
  <div id="scrollerhomeTerbaru">
  <?php
  $sql=mysql_query("SELECT * FROM (SELECT * FROM produk WHERE stok!=0 ORDER BY id_produk desc LIMIT $setting_hometerbaru_isi) as a ORDER BY rand() DESC LIMIT $setting_hometerbaru_isi");
  while ($r=mysql_fetch_array($sql)){
    $harga = format_rupiah($r[harga]);
    $disc     = ($r[diskon]/100)*$r[harga];
    $hargadisc     = number_format(($r[harga]-$disc),0,",",".");
    $stok=$r['stok'];
    $tombolbeli="<a class='prod_cart' href=\"aksi.php?module=keranjang&act=tambah&id=$r[id_produk]\">BELI</a>";
    $tombolhabis="<span class='prod_cart_habis'></span>";
      if ($stok!= "0"){
      $tombol=$tombolbeli;
      }else{
      $tombol=$tombolhabis;
      } 

    $d=$r['diskon'];
    $hargatetap="<div class='prod_price'>
                    <span class='price'></span>
                    <span class='price'> Rp. <b>$hargadisc,-</b></span>
                 </div>";
    $hargadiskon="<div class='prod_price'>
                     <div style='margin-bottom:4px;margin-top:4px;'><span style='text-decoration:line-through;' class='price2'>Rp. $harga,-</span> <br /></div>
                     <div class='s_price'><span class='s_currency s_before'> $r[diskon]% </span></div>
	                  <div><span class='price'>Rp. <b>$hargadisc,-</b></span></div>
	               </div>";
      if ($d!= "0"){
      $divharga=$hargadiskon;
      $harganya = $hargadisc;
      $komen = "<b>DISKON $r[diskon]% !!</b>";
      }else{
      $divharga=$hargatetap;
      $harganya = $harga;
      $komen = "";
      } 

    $s=$r['stok'];
    $stoknya = "<div class='prod_stok'>Stok: $s</div>";
    $limitedStock = "";
    if($s<=3 && $s!=0)
    {
      if($komen=="")
      {
         $limitedStock = "<b>STOK TERBATAS..! ($s)</b>";
      }
      else
      {
         $limitedStock = "<br><b>STOK TERBATAS..! ($s)</b>";
      }
    }
    echo "<div class='$classhometerbaru'>
          <div class='top_prod_box'></div> 
          <div class='center_prod_box'>            
             <div class='product_title'><a href='produk-$r[id_produk]-$r[produk_seo].html#read'>$r[nama_produk]</a></div>
             <div class='product_img'>
                             ";
if($setting_thumbnail=="zoom") {
   echo "<a href='produk-$r[id_produk]-$r[produk_seo].html#read'><a href='foto_produk/$r[gambar]' rel='clearbox[gallery=Produk Terbaru,,title=$r[nama_produk],,comment=<big>Harga : Rp. $harganya,- $komen</big>]'>
               <img src='foto_produk/small/small_$r[gambar]' border='0' height=$tinggithumbnail   class='tooltip' title='klik untuk memperbesar gambar<br>$komen $limitedStock'>";
}
else {
   echo "<a href='produk-$r[id_produk]-$r[produk_seo].html#read'>
               <img src='foto_produk/small/small_$r[gambar]' border='0' height=$tinggithumbnail   class='tooltip' title='klik untuk melihat detail'>";
}
echo "</a>
             </div>
             $divharga
             $stoknya
             </div>
          <div class='bottom_prod_box'></div>
          <div class='prod_details_tab'>
             $tombol            
             <a href='produk-$r[id_produk]-$r[produk_seo].html#read' class='prod_details'>DETAIL</a> 
          </div>
          </div>";
     }    
     echo "</div>";
     echo "<div class='clear'>";
}
/// HOMEFEATURED
if($setting_homefeatured=="Y") {
   $featured = mysql_query("SELECT * FROM setting WHERE tipe='featured'");
   $rfeatured=mysql_fetch_array($featured); ?>
  <h4 class="heading colr"><?=$rfeatured[value3]?></h4>
  <div id="scrollerhomeFeatured">

  <?php
echo "SELECT * FROM produk WHERE featured='Y' ORDER BY rand() DESC LIMIT $setting_homefeatured_isi";
  $sql=mysql_query("SELECT * FROM produk WHERE featured='Y' ORDER BY rand() DESC LIMIT $setting_homefeatured_isi");
  while ($r=mysql_fetch_array($sql)){
    $harga = format_rupiah($r[harga]);
    $disc     = ($r[diskon]/100)*$r[harga];
    $hargadisc     = number_format(($r[harga]-$disc),0,",",".");
    $stok=$r['stok'];
    $tombolbeli="<a class='prod_cart' href=\"aksi.php?module=keranjang&act=tambah&id=$r[id_produk]\">BELI</a>";
    $tombolhabis="<span class='prod_cart_habis'></span>";
      if ($stok!= "0"){
      $tombol=$tombolbeli;
      }else{
      $tombol=$tombolhabis;
      } 

    $d=$r['diskon'];
    $hargatetap="<div class='prod_price'>

                    <span class='price'></span>
                    <span class='price'> Rp. <b>$hargadisc,-</b></span>
                 </div>";
    $hargadiskon="<div class='prod_price'>

                     <div style='margin-bottom:4px;margin-top:4px;'><span style='text-decoration:line-through;' class='price2'>Rp. $harga,-</span> <br /></div>
                     <div class='s_price'><span class='s_currency s_before'> $r[diskon]% </span></div>
	                  <div><span class='price'>Rp. <b>$hargadisc,-</b></span></div>

	               </div>";
      if ($d!= "0"){
      $divharga=$hargadiskon;
      $harganya = $hargadisc;
      $komen = "<b>DISKON $r[diskon]% !!</b>";
      }else{
      $divharga=$hargatetap;
      $harganya = $harga;
      $komen = "";
      } 

    $s=$r['stok'];
    $stoknya = "<div class='prod_stok'>Stok: $s</div>";
    $limitedStock = "";
    if($s<=3 && $s!=0)
    {
      if($komen=="")
      {
         $limitedStock = "<b>STOK TERBATAS..! ($s)</b>";
      }
      else
      {
         $limitedStock = "<br><b>STOK TERBATAS..! ($s)</b>";
      }
    }
    echo "<div class='$classhomefeatured'>
          <div class='top_prod_box'></div> 
          <div class='center_prod_box'>            
             <div class='product_title'><a href='produk-$r[id_produk]-$r[produk_seo].html#read'>$r[nama_produk]</a></div>
             <div class='product_img'>
                             ";
if($setting_thumbnail=="zoom") {
   echo "<a href='produk-$r[id_produk]-$r[produk_seo].html#read'><a href='foto_produk/$r[gambar]' rel='clearbox[gallery=Produk Terbaru,,title=$r[nama_produk],,comment=<big>Harga : Rp. $harganya,- $komen</big>]'>
               <img src='foto_produk/small/small_$r[gambar]' border='0' height=$tinggithumbnail   class='tooltip' title='klik untuk memperbesar gambar<br>$komen $limitedStock'>";
}
else {
   echo "<a href='produk-$r[id_produk]-$r[produk_seo].html#read'>
               <img src='foto_produk/small/small_$r[gambar]' border='0' height=$tinggithumbnail   class='tooltip' title='klik untuk melihat detail'>";
}
echo "</a>
             </div>
             $divharga
             $stoknya
             </div>
          <div class='bottom_prod_box'></div>
          <div class='prod_details_tab'>
             $tombol            
             <a href='produk-$r[id_produk]-$r[produk_seo].html#read' class='prod_details'>DETAIL</a> 
          </div>
          </div>";
     }    
     echo "</div>";
     echo "<div class='clear'>";
}
  ?>

<!--========== AKHIR TERBARU ==========-->

<!--========== KOLEKSI LAINNYA ==========-->
<?php if($setting_homekoleksi=="Y") { ?>
  <h4 class="heading colr">KOLEKSI SAHARA BUTIK</h4>  
  <?php
  $sql=mysql_query("SELECT * FROM (SELECT * FROM produk WHERE diskon=0 ORDER BY stok desc LIMIT $setting_homekoleksi_isi) as a ORDER BY rand() LIMIT $setting_homekoleksi_isi");
  while ($r=mysql_fetch_array($sql)){
    $harga = format_rupiah($r[harga]);
    $disc     = ($r[diskon]/100)*$r[harga];
    $hargadisc     = number_format(($r[harga]-$disc),0,",",".");
    $stok=$r['stok'];
    $tombolbeli="<a class='prod_cart' href=\"aksi.php?module=keranjang&act=tambah&id=$r[id_produk]\">BELI</a>";
    $tombolhabis="<span class='prod_cart_habis'></span>";
      if ($stok!= "0"){
      $tombol=$tombolbeli;
      }else{
      $tombol=$tombolhabis;
      } 

    $d=$r['diskon'];
    $hargatetap="<div class='prod_price'>
                    <span class='price'></span>
                    <span class='price'> Rp. <b>$hargadisc,-</b></span>
                 </div>";
    $hargadiskon="<div class='prod_price'>
                     <div style='margin-bottom:4px;margin-top:4px;'><span style='text-decoration:line-through;' class='price2'>Rp. $harga,-</span> <br /></div>
                     <div class='s_price'><span class='s_currency s_before'> $r[diskon]% </span></div>
	                  <div><span class='price'>Rp. <b>$hargadisc,-</b></span></div>
	               </div>";
      if ($d!= "0"){
      $divharga=$hargadiskon;
      $harganya = $hargadisc;
      $komen = "<b>DISKON $r[diskon]% !!</b>";
      }else{
      $divharga=$hargatetap;
      $harganya = $harga;
      $komen = "";
      } 

    $s=$r['stok'];
    $stoknya = "<div class='prod_stok'>Stok: $s</div>";
    $limitedStock = "";
    if($s<=3 && $s!=0)
    {
      if($komen=="")
      {
         $limitedStock = "<b>STOK TERBATAS..! ($s)</b>";
      }
      else
      {
         $limitedStock = "<br><b>STOK TERBATAS..! ($s)</b>";
      }
    }
    echo "<div class='prod_box'>
          <div class='top_prod_box'></div> 
          <div class='center_prod_box'>            
             <div class='product_title'><a href='produk-$r[id_produk]-$r[produk_seo].html#read'>$r[nama_produk]</a></div>
             <div class='product_img'>
                             ";
if($setting_thumbnail=="zoom") {
   echo "<a href='produk-$r[id_produk]-$r[produk_seo].html#read'><a href='foto_produk/$r[gambar]' rel='clearbox[gallery=Produk Terbaru,,title=$r[nama_produk],,comment=<big>Harga : Rp. $harganya,- $komen</big>]'>
               <img src='foto_produk/small/small_$r[gambar]' border='0' height=$tinggithumbnail   class='tooltip' title='klik untuk memperbesar gambar<br>$komen $limitedStock'>";
}
else {
   echo "<a href='produk-$r[id_produk]-$r[produk_seo].html#read'>
               <img src='foto_produk/small/small_$r[gambar]' border='0' height=$tinggithumbnail   class='tooltip' title='klik untuk melihat detail'>";
}
echo "</a>
             </div>
             $divharga
             $stoknya
             </div>
          <div class='bottom_prod_box'></div>
          <div class='prod_details_tab'>
             $tombol            
             <a href='produk-$r[id_produk]-$r[produk_seo].html#read' class='prod_details'>DETAIL</a> 
          </div>
          </div>";
  }
  echo "<div class='clear'><br>";
      echo "
         <div id='infoTambahan' align='center' style='cursor:pointer;' onclick='location.href=\"semua-kategori.html#read\"'>
            <h4>Lihat koleksi yang lebih lengkap lagi di menu <b>Kategori Produk</b></h4>
         </div>
      ";
  echo "<div class='clear'><br>";
}
  ?>

<!--========== AKHIR KOLEKSI LAINNYA ==========-->

<!--========== ON SALE DISKON ==========-->
<?php if($setting_homediskon=="Y") { ?>
  <h4 class="heading colr">PRODUK ON SALE, DISKON. READY STOCK !</h4>  
  <div id="scrollerhomeDiskon">
  <?php
  $limits = $setting_homediskon_isi+3;
  $sql=mysql_query("SELECT * FROM (SELECT * FROM produk WHERE diskon!=0 ORDER BY diskon desc LIMIT $limits) as a ORDER BY rand() DESC LIMIT $setting_homediskon_isi");
  while ($r=mysql_fetch_array($sql)){
    $harga = format_rupiah($r[harga]);
    $disc     = ($r[diskon]/100)*$r[harga];
    $hargadisc     = number_format(($r[harga]-$disc),0,",",".");
    $stok=$r['stok'];
    $tombolbeli="<a class='prod_cart' href=\"aksi.php?module=keranjang&act=tambah&id=$r[id_produk]\">BELI</a>";
    $tombolhabis="<span class='prod_cart_habis'></span>";
      if ($stok!= "0"){
      $tombol=$tombolbeli;
      }else{
      $tombol=$tombolhabis;
      } 

    $d=$r['diskon'];
    $hargatetap="<div class='prod_price'>
                    <span class='price'></span>
                    <span class='price'> Rp. <b>$hargadisc,-</b></span>
                 </div>";
    $hargadiskon="<div class='prod_price'>
                     <div style='margin-bottom:4px;margin-top:4px;'><span style='text-decoration:line-through;' class='price2'>Rp. $harga,-</span> <br /></div>
                     <div class='s_price'><span class='s_currency s_before'> $r[diskon]% </span></div>
	                  <div><span class='price'>Rp. <b>$hargadisc,-</b></span></div>
	               </div>";
      if ($d!= "0"){
      $divharga=$hargadiskon;
      $harganya = $hargadisc;
      $komen = "<b>DISKON $r[diskon]% !!</b>";
      }else{
      $divharga=$hargatetap;
      $harganya = $harga;
      $komen = "";
      } 

    $s=$r['stok'];
    $stoknya = "<div class='prod_stok'>Stok: $s</div>";
    $limitedStock = "";
    if($s<=3 && $s!=0)
    {
      if($komen=="")
      {
         $limitedStock = "<b>STOK TERBATAS..! ($s)</b>";
      }
      else
      {
         $limitedStock = "<br><b>STOK TERBATAS..! ($s)</b>";
      }
    }
    echo "<div class='prod_box_scroll'>
          <div class='top_prod_box'></div> 
          <div class='center_prod_box'>            
             <div class='product_title'><a href='produk-$r[id_produk]-$r[produk_seo].html#read'>$r[nama_produk]</a></div>
             <div class='product_img'>
                             ";
if($setting_thumbnail=="zoom") {
   echo "<a href='produk-$r[id_produk]-$r[produk_seo].html#read'><a href='foto_produk/$r[gambar]' rel='clearbox[gallery=Produk Terbaru,,title=$r[nama_produk],,comment=<big>Harga : Rp. $harganya,- $komen</big>]'>
               <img src='foto_produk/small/small_$r[gambar]' border='0' height=$tinggithumbnail   class='tooltip' title='klik untuk memperbesar gambar<br>$komen $limitedStock'>";
}
else {
   echo "<a href='produk-$r[id_produk]-$r[produk_seo].html#read'>
               <img src='foto_produk/small/small_$r[gambar]' border='0' height=$tinggithumbnail   class='tooltip' title='klik untuk melihat detail'>";
}
echo "</a>
             </div>
             $divharga
             $stoknya
             </div>
          <div class='bottom_prod_box'></div>
          <div class='prod_details_tab'>
             $tombol            
             <a href='produk-$r[id_produk]-$r[produk_seo].html#read' class='prod_details'>DETAIL</a> 
          </div>
          </div>
";
  }
   echo "</div>";
echo "<!--========== AKHIR ON SALE DISKON ==========-->";
 }
}

// Modul detail produk
elseif ($_GET[module]=='detailproduk'){

	$detail=mysql_query("SELECT * FROM produk,kategori    
                      WHERE kategori.id_kategori=produk.id_kategori 
                      AND id_produk='$_GET[id]'");
	$d   = mysql_fetch_array($detail);
	$tgl = tgl_indo($d[tanggal]);


    $harga = format_rupiah($d[harga]);
    $disc     = ($d[diskon]/100)*$d[harga];
    $hargadisc     = number_format(($d[harga]-$disc),0,",",".");
   if($d[diskon]!=0)
   {
      $diskonnya ="<div class='s_price'><span class='s_currency s_before'> $d[diskon]% </span></div>";
      $hargadiskoncoret = "<div style='font-size:10px;text-decoration:line-through;' class='table7'>Rp. $harga,-</span></div>";
   }
	echo "<h4 id='namaproduknya' class='heading colr'>Detail Produk : <big>$d[nama_produk]</big></h4></div>";
   if($setting_detail_fblike=="Y")
   {
      echo "<fb:like send=\"true\" width=\"600\" show_faces=\"false\"></fb:like>";
   }
	echo"<div class='feat_prod_box_details'>";
 	if ($d[gambar]!='')
 	{
		echo "<div class='prod_img3'><a href='foto_produk/$d[gambar]' rel='clearbox[gallery=Koleksi Produk]' title='$d[nama_produk]'><img src='foto_produk/medium/medium_$d[gambar]' width=300  class='tooltip' title='klik untuk memperbesar gambar' border='0' rel='clearbox[gallery=Koleksi Produk]' title='$d[nama_produk]'/></a>
		<br>
		( Klik gambar untuk memperbesar )
		<br>
		<br>
		$hargadiskoncoret
      <div style='font-size:16px;' class='table6'>Rp. $hargadisc,-</span></div>
		$diskonnya
		<br>
		</div>";
   }
	echo"<div class='details_big_box'>
            <div class='product_title_big'>Deskripsi Produk</div>
            <div class='details'>$d[deskripsi]</div><br />
            <div class='table6'>&bull; HARGA: <span class='table7'>Rp. $hargadisc,-</span></div>
            <div class='table6'>&bull; STOK:<span class='table7'> $d[stok] item</span></div><br />";
   if($d[stok]!=0)
   {
      echo "<a href='aksi.php?module=keranjang&act=tambah&id=$d[id_produk]' class='more'><img src='images/belibutton_$setting_tema.png' alt='' width='170px' title='' border='0' /></a>";
   }
   else
   {
      echo "<img src='images/habisbutton_$setting_tema.png' alt='' width='170px' title='' border='0' />";
   }
   
   if($setting_detail_fblike=="Y")
   {
      $urlHalaman = urlLengkap();
      echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<fb:send href='$urlHalaman'></fb:send>";
   }
   
   echo "</div><div class='clear'>
                    </div>
                    <div class='box_bottom'></div>
                </div> <div class='clear'></div>
            </div>";
            
   if(!empty($setting_nohp2))
	  {
	   $nohape2 = " / <span class=\"bold\">$setting_nohp2</span>";
	  }
	  
	if($setting_detail_fbcomment=="Y") {
	   $urlHalaman = urlLengkap();
	   echo "<h4 class='heading colr'>Komentari produk ini via Facebook</h4></div>";
	   echo "<fb:comments href=\"$urlHalaman\" num_posts=\"2\" width=\"680px\"></fb:comments>";
	}
  ?>
<div id="infoTambahan" align="center" valign="center">
         <h4>Ingin order Anda diproses dengan cepat..? Order lewat SMS / BBM saja..<br>SMS ke <span class="bold"><?=$setting_nohp1?></span><?=$nohape2?> (FAST RESPON)
         <?php
            if(!empty($setting_pinbb))
            {
               ?>
                  <br>PIN BB: <span class="bold"><?=$setting_pinbb?></span> - Invite Request "Order <?=$setting_namatoko?>"</h4>
               <?php
            }
         ?>
</div>
<?php
  if($setting_detail_related=="Y") {
// Produk Lainnya (random)          
  $sql=mysql_query("SELECT * FROM produk WHERE stok!=0 AND id_kategori=$d[id_kategori] ORDER BY rand() LIMIT 7");
  
  echo "<h4 class='heading colr'>Lihat juga koleksi $d[nama_kategori] yang lain..</h4>
        <div id='scrollerprodLain'>";
  while ($r=mysql_fetch_array($sql)){
    $harga = format_rupiah($r[harga]);
    $disc     = ($r[diskon]/100)*$r[harga];
    $hargadisc     = number_format(($r[harga]-$disc),0,",",".");
    $stok=$r['stok'];
    $tombolbeli="<a class='prod_cart' href=\"aksi.php?module=keranjang&act=tambah&id=$r[id_produk]\">BELI</a>";
    $tombolhabis="<span class='prod_cart_habis'></span>";
      if ($stok!= "0"){
      $tombol=$tombolbeli;
      }else{
      $tombol=$tombolhabis;
      } 

    $d=$r['diskon'];
    $hargatetap="<div class='prod_price'>
                    <span class='price'></span>
                    <span class='price'> Rp. <b>$hargadisc,-</b></span>
                 </div>";

    $hargadiskon="<div class='prod_price'>
                     <div style='margin-bottom:4px;margin-top:4px;'><span style='text-decoration:line-through;' class='price2'>Rp. $harga,-</span> <br /></div>
                     <div class='s_price'><span class='s_currency s_before'> $r[diskon]% </span></div>
	                  <div><span class='price'>Rp. <b>$hargadisc,-</b></span></div>
	               </div>";
      if ($d!= "0"){
      $divharga=$hargadiskon;
      $harganya = $hargadisc;
      $komen = "<b>DISKON $r[diskon]% !!</b>";
      }else{
      $divharga=$hargatetap;
      $harganya = $harga;
      $komen = "";
      } 

    $s=$r['stok'];
    $stoknya = "<div class='prod_stok'>Stok: $s</div>";
    $limitedStock = "";
    if($s<=3 && $s!=0)
    {
      if($komen=="")
      {
         $limitedStock = "<b>STOK TERBATAS..! ($s)</b>";
      }
      else
      {
         $limitedStock = "<br><b>STOK TERBATAS..! ($s)</b>";
      }
    }
    echo "<div class='prod_box_scroll'>
          <div class='top_prod_box'></div> 
          <div class='center_prod_box'>            
             <div class='product_title'><a href='produk-$r[id_produk]-$r[produk_seo].html#read'>$r[nama_produk]</a></div>
             <div class='product_img'>
                             ";
if($setting_thumbnail=="zoom") {
   echo "<a href='produk-$r[id_produk]-$r[produk_seo].html#read'><a href='foto_produk/$r[gambar]' rel='clearbox[gallery=Produk Terbaru,,title=$r[nama_produk],,comment=<big>Harga : Rp. $harganya,- $komen</big>]'>
               <img src='foto_produk/small/small_$r[gambar]' border='0' height=$tinggithumbnail   class='tooltip' title='klik untuk memperbesar gambar<br>$komen $limitedStock'>";
}
else {
   echo "<a href='produk-$r[id_produk]-$r[produk_seo].html#read'>
               <img src='foto_produk/small/small_$r[gambar]' border='0' height=$tinggithumbnail   class='tooltip' title='klik untuk melihat detail'>";
}
echo "</a>
             </div>
             $divharga
             $stoknya
             </div>
          <div class='bottom_prod_box'></div>
          <div class='prod_details_tab'>
             $tombol            
             <a href='produk-$r[id_produk]-$r[produk_seo].html#read' class='prod_details'>DETAIL</a> 
          </div>
          </div>
";
  }
  echo "</div>";
  echo "<div class='clear'>";
}

  if($setting_detail_diskon=="Y") {
  ?>
  <!--========== ON SALE DISKON ==========-->
  <h4 class="heading colr">Produk Dengan DISKON SPESIAL Untuk Anda</h4>  
  <div id="scrollerprodDiskon">
  <?php
  $sql=mysql_query("SELECT * FROM (SELECT * FROM produk WHERE diskon!=0 ORDER BY stok desc LIMIT 10) as a ORDER BY rand() DESC LIMIT 7");
  while ($r=mysql_fetch_array($sql)){
    $harga = format_rupiah($r[harga]);
    $disc     = ($r[diskon]/100)*$r[harga];
    $hargadisc     = number_format(($r[harga]-$disc),0,",",".");
    $stok=$r['stok'];
    $tombolbeli="<a class='prod_cart' href=\"aksi.php?module=keranjang&act=tambah&id=$r[id_produk]\">BELI</a>";
    $tombolhabis="<span class='prod_cart_habis'></span>";
      if ($stok!= "0"){
      $tombol=$tombolbeli;
      }else{
      $tombol=$tombolhabis;
      } 

    $d=$r['diskon'];
    $hargatetap="<div class='prod_price'>
                    <span class='price'></span>
                    <span class='price'> Rp. <b>$hargadisc,-</b></span>
                 </div>";

    $hargadiskon="<div class='prod_price'>
                     <div style='margin-bottom:4px;margin-top:4px;'><span style='text-decoration:line-through;' class='price2'>Rp. $harga,-</span> <br /></div>
                     <div class='s_price'><span class='s_currency s_before'> $r[diskon]% </span></div>
	                  <div><span class='price'>Rp. <b>$hargadisc,-</b></span></div>
	               </div>";
      if ($d!= "0"){
      $divharga=$hargadiskon;
      $harganya = $hargadisc;
      $komen = "<b>DISKON $r[diskon]% !!</b>";
      }else{
      $divharga=$hargatetap;
      $harganya = $harga;
      $komen = "";
      } 

    $s=$r['stok'];
    $stoknya = "<div class='prod_stok'>Stok: $s</div>";
    $limitedStock = "";
    if($s<=3 && $s!=0)
    {
      if($komen=="")
      {
         $limitedStock = "<b>STOK TERBATAS..! ($s)</b>";
      }
      else
      {
         $limitedStock = "<br><b>STOK TERBATAS..! ($s)</b>";
      }
    }
    echo "<div class='prod_box_scroll'>
          <div class='top_prod_box'></div> 
          <div class='center_prod_box'>            
             <div class='product_title'><a href='produk-$r[id_produk]-$r[produk_seo].html#read'>$r[nama_produk]</a></div>
             <div class='product_img'>
                             ";
if($setting_thumbnail=="zoom") {
   echo "<a href='produk-$r[id_produk]-$r[produk_seo].html#read'><a href='foto_produk/$r[gambar]' rel='clearbox[gallery=Produk Terbaru,,title=$r[nama_produk],,comment=<big>Harga : Rp. $harganya,- $komen</big>]'>
               <img src='foto_produk/small/small_$r[gambar]' border='0' height=$tinggithumbnail   class='tooltip' title='klik untuk memperbesar gambar<br>$komen $limitedStock'>";
}
else {
   echo "<a href='produk-$r[id_produk]-$r[produk_seo].html#read'>
               <img src='foto_produk/small/small_$r[gambar]' border='0' height=$tinggithumbnail   class='tooltip' title='klik untuk melihat detail'>";
}
echo "</a>
             </div>
             $divharga
             $stoknya
             </div>
          <div class='bottom_prod_box'></div>
          <div class='prod_details_tab'>
             $tombol            
             <a href='produk-$r[id_produk]-$r[produk_seo].html#read' class='prod_details'>DETAIL</a> 
          </div>
          </div>
";
  }
  echo "</div>";
echo "<!--========== AKHIR ON SALE DISKON ==========-->";
  }
  
  if($setting_detail_featured=="Y") {
   $featured = mysql_query("SELECT * FROM setting WHERE tipe='featured'");
   $rfeatured=mysql_fetch_array($featured); ?>
  <h4 class="heading colr"><?=$rfeatured[value3]?></h4>
  <div id="scrollerhomeFeatured">
  <?php
  $sql=mysql_query("SELECT * FROM produk WHERE featured='Y' ORDER BY rand() DESC LIMIT $setting_homefeatured_isi");
  while ($r=mysql_fetch_array($sql)){
    $harga = format_rupiah($r[harga]);
    $disc     = ($r[diskon]/100)*$r[harga];
    $hargadisc     = number_format(($r[harga]-$disc),0,",",".");
    $stok=$r['stok'];
    $tombolbeli="<a class='prod_cart' href=\"aksi.php?module=keranjang&act=tambah&id=$r[id_produk]\">BELI</a>";
    $tombolhabis="<span class='prod_cart_habis'></span>";
      if ($stok!= "0"){
      $tombol=$tombolbeli;
      }else{
      $tombol=$tombolhabis;
      } 

    $d=$r['diskon'];
    $hargatetap="<div class='prod_price'>
                    <span class='price'></span>
                    <span class='price'> Rp. <b>$hargadisc,-</b></span>


                 </div>";
    $hargadiskon="<div class='prod_price'>
                     <div style='margin-bottom:4px;margin-top:4px;'><span style='text-decoration:line-through;' class='price2'>Rp. $harga,-</span> <br /></div>

                     <div class='s_price'><span class='s_currency s_before'> $r[diskon]% </span></div>
	                  <div><span class='price'>Rp. <b>$hargadisc,-</b></span></div>
	               </div>";
      if ($d!= "0"){
      $divharga=$hargadiskon;
      $harganya = $hargadisc;
      $komen = "<b>DISKON $r[diskon]% !!</b>";
      }else{
      $divharga=$hargatetap;
      $harganya = $harga;
      $komen = "";
      } 

    $s=$r['stok'];
    $stoknya = "<div class='prod_stok'>Stok: $s</div>";
    $limitedStock = "";
    if($s<=3 && $s!=0)
    {
      if($komen=="")
      {
         $limitedStock = "<b>STOK TERBATAS..! ($s)</b>";
      }
      else
      {
         $limitedStock = "<br><b>STOK TERBATAS..! ($s)</b>";
      }
    }
    echo "<div class='prod_box_scroll'>
          <div class='top_prod_box'></div> 

          <div class='center_prod_box'>            

             <div class='product_title'><a href='produk-$r[id_produk]-$r[produk_seo].html#read'>$r[nama_produk]</a></div>

             <div class='product_img'>
                             ";
if($setting_thumbnail=="zoom") {
   echo "<a href='produk-$r[id_produk]-$r[produk_seo].html#read'><a href='foto_produk/$r[gambar]' rel='clearbox[gallery=Produk Terbaru,,title=$r[nama_produk],,comment=<big>Harga : Rp. $harganya,- $komen</big>]'>
               <img src='foto_produk/small/small_$r[gambar]' border='0' height=$tinggithumbnail   class='tooltip' title='klik untuk memperbesar gambar<br>$komen $limitedStock'>";
}
else {
   echo "<a href='produk-$r[id_produk]-$r[produk_seo].html#read'>
               <img src='foto_produk/small/small_$r[gambar]' border='0' height=$tinggithumbnail   class='tooltip' title='klik untuk melihat detail'>";
}
echo "</a>
             </div>
             $divharga
             $stoknya
             </div>
          <div class='bottom_prod_box'></div>

          <div class='prod_details_tab'>
             $tombol            
             <a href='produk-$r[id_produk]-$r[produk_seo].html#read' class='prod_details'>DETAIL</a> 

          </div>
          </div>";
     }    
     echo "</div>";
     echo "<div class='clear'>";
}
}

// Modul produk per kategori
elseif ($_GET[module]=='detailkategori'){

   if($setting_kategoriterbaru=="Y")
  {
   ?>
     <h4 class="heading colr">Produk Terbaru di <?=$setting_namatoko?></h4>
     <div id="scrollerhomeTerbaru">
     <?php
     $sql=mysql_query("SELECT * FROM (SELECT * FROM produk WHERE stok!=0 ORDER BY id_produk desc LIMIT $setting_hometerbaru_isi) as a ORDER BY rand() DESC LIMIT $setting_hometerbaru_isi");
     while ($r=mysql_fetch_array($sql)){
       $harga = format_rupiah($r[harga]);
       $disc     = ($r[diskon]/100)*$r[harga];
       $hargadisc     = number_format(($r[harga]-$disc),0,",",".");
       $stok=$r['stok'];
       $tombolbeli="<a class='prod_cart' href=\"aksi.php?module=keranjang&act=tambah&id=$r[id_produk]\">BELI</a>";
       $tombolhabis="<span class='prod_cart_habis'></span>";
         if ($stok!= "0"){
         $tombol=$tombolbeli;
         }else{
         $tombol=$tombolhabis;
         } 

       $d=$r['diskon'];
       $hargatetap="<div class='prod_price'>
                       <span class='price'></span>
                       <span class='price'> Rp. <b>$hargadisc,-</b></span>
                    </div>";
       $hargadiskon="<div class='prod_price'>
                        <div style='margin-bottom:4px;margin-top:4px;'><span style='text-decoration:line-through;' class='price2'>Rp. $harga,-</span> <br /></div>
                        <div class='s_price'><span class='s_currency s_before'> $r[diskon]% </span></div>
	                     <div><span class='price'>Rp. <b>$hargadisc,-</b></span></div>
	                  </div>";
         if ($d!= "0"){
         $divharga=$hargadiskon;
         $harganya = $hargadisc;
         $komen = "<b>DISKON $r[diskon]% !!</b>";
         }else{
         $divharga=$hargatetap;
         $harganya = $harga;
         $komen = "";
         } 

       $s=$r['stok'];
       $stoknya = "<div class='prod_stok'>Stok: $s</div>";
       $limitedStock = "";
       if($s<=3 && $s!=0)
       {
         if($komen=="")
         {
            $limitedStock = "<b>STOK TERBATAS..! ($s)</b>";
         }
         else
         {
            $limitedStock = "<br><b>STOK TERBATAS..! ($s)</b>";
         }
       }
       echo "<div class='prod_box_scroll'>
             <div class='top_prod_box'></div> 
             <div class='center_prod_box'>            
                <div class='product_title'><a href='produk-$r[id_produk]-$r[produk_seo].html#read'>$r[nama_produk]</a></div>
                <div class='product_img'>
                                ";
if($setting_thumbnail=="zoom") {
   echo "<a href='produk-$r[id_produk]-$r[produk_seo].html#read'><a href='foto_produk/$r[gambar]' rel='clearbox[gallery=Produk Terbaru,,title=$r[nama_produk],,comment=<big>Harga : Rp. $harganya,- $komen</big>]'>
               <img src='foto_produk/small/small_$r[gambar]' border='0' height=$tinggithumbnail   class='tooltip' title='klik untuk memperbesar gambar<br>$komen $limitedStock'>";
}
else {
   echo "<a href='produk-$r[id_produk]-$r[produk_seo].html#read'>
               <img src='foto_produk/small/small_$r[gambar]' border='0' height=$tinggithumbnail   class='tooltip' title='klik untuk melihat detail'>";
}
echo "</a>
                </div>
                $divharga
                $stoknya
                </div>
             <div class='bottom_prod_box'></div>
             <div class='prod_details_tab'>
                $tombol            
                <a href='produk-$r[id_produk]-$r[produk_seo].html#read' class='prod_details'>DETAIL</a> 
             </div>
             </div>";
        }    
        echo "</div>";
  }
  
  if($setting_kategorifeatured=="Y") {
   $featured = mysql_query("SELECT * FROM setting WHERE tipe='featured'");
   $rfeatured=mysql_fetch_array($featured); ?>
  <h4 class="heading colr"><?=$rfeatured[value3]?></h4>
  <div id="scrollerhomeFeatured">
  <?php
  $sql=mysql_query("SELECT * FROM produk WHERE featured='Y' ORDER BY rand() DESC LIMIT $setting_homefeatured_isi");
  while ($r=mysql_fetch_array($sql)){
    $harga = format_rupiah($r[harga]);
    $disc     = ($r[diskon]/100)*$r[harga];
    $hargadisc     = number_format(($r[harga]-$disc),0,",",".");
    $stok=$r['stok'];
    $tombolbeli="<a class='prod_cart' href=\"aksi.php?module=keranjang&act=tambah&id=$r[id_produk]\">BELI</a>";
    $tombolhabis="<span class='prod_cart_habis'></span>";
      if ($stok!= "0"){
      $tombol=$tombolbeli;
      }else{
      $tombol=$tombolhabis;
      } 

    $d=$r['diskon'];
    $hargatetap="<div class='prod_price'>
                    <span class='price'></span>
                    <span class='price'> Rp. <b>$hargadisc,-</b></span>
                 </div>";
    $hargadiskon="<div class='prod_price'>
                     <div style='margin-bottom:4px;margin-top:4px;'><span style='text-decoration:line-through;' class='price2'>Rp. $harga,-</span> <br /></div>
                     <div class='s_price'><span class='s_currency s_before'> $r[diskon]% </span></div>
	                  <div><span class='price'>Rp. <b>$hargadisc,-</b></span></div>
	               </div>";
      if ($d!= "0"){
      $divharga=$hargadiskon;
      $harganya = $hargadisc;
      $komen = "<b>DISKON $r[diskon]% !!</b>";
      }else{
      $divharga=$hargatetap;
      $harganya = $harga;
      $komen = "";
      } 

    $s=$r['stok'];
    $stoknya = "<div class='prod_stok'>Stok: $s</div>";
    $limitedStock = "";
    if($s<=3 && $s!=0)
    {
      if($komen=="")
      {
         $limitedStock = "<b>STOK TERBATAS..! ($s)</b>";
      }
      else
      {
         $limitedStock = "<br><b>STOK TERBATAS..! ($s)</b>";
      }
    }
    echo "<div class='prod_box_scroll'>
          <div class='top_prod_box'></div> 
          <div class='center_prod_box'>            
             <div class='product_title'><a href='produk-$r[id_produk]-$r[produk_seo].html#read'>$r[nama_produk]</a></div>
             <div class='product_img'>
                             ";
if($setting_thumbnail=="zoom") {
   echo "<a href='produk-$r[id_produk]-$r[produk_seo].html#read'><a href='foto_produk/$r[gambar]' rel='clearbox[gallery=Produk Terbaru,,title=$r[nama_produk],,comment=<big>Harga : Rp. $harganya,- $komen</big>]'>
               <img src='foto_produk/small/small_$r[gambar]' border='0' height=$tinggithumbnail   class='tooltip' title='klik untuk memperbesar gambar<br>$komen $limitedStock'>";
}
else {
   echo "<a href='produk-$r[id_produk]-$r[produk_seo].html#read'>
               <img src='foto_produk/small/small_$r[gambar]' border='0' height=$tinggithumbnail   class='tooltip' title='klik untuk melihat detail'>";
}
echo "</a>
             </div>
             $divharga
             $stoknya
             </div>
          <div class='bottom_prod_box'></div>
          <div class='prod_details_tab'>
             $tombol            
             <a href='produk-$r[id_produk]-$r[produk_seo].html#read' class='prod_details'>DETAIL</a> 
          </div>
          </div>";
     }    
     echo "</div>";
     echo "<div class='clear'>";
}
  
  // Tampilkan nama kategori
  $sq = mysql_query("SELECT nama_kategori from kategori where id_kategori='$_GET[id]'");
  $n = mysql_fetch_array($sq);
  
  if($_GET['halkategori']>1)
  {
   $halamannya=" - Halaman ".$_GET['halkategori'];
  }

  echo "<span id='view'></span><h4 class='heading colr'><big>Kategori: $n[nama_kategori] $halamannya</big></h4></div>";

  // Tentukan berapa data yang akan ditampilkan per halaman (paging)
  $p      = new Paging3;
  $batas  = $setting_kategorijumlah;
  $posisi = $p->cariPosisi($batas);

  // Tampilkan daftar produk yang sesuai dengan kategori yang dipilih
 	$sql = mysql_query("SELECT * FROM produk WHERE id_kategori='$_GET[id]' 
            ORDER BY id_produk DESC LIMIT $posisi,$batas");		 
	$jumlah = mysql_num_rows($sql);

	// Apabila ditemukan produk dalam kategori
	if ($jumlah > 0){
  while ($r=mysql_fetch_array($sql)){
    $harga = format_rupiah($r[harga]);
    $disc     = ($r[diskon]/100)*$r[harga];
    $hargadisc     = number_format(($r[harga]-$disc),0,",",".");
    $stok=$r['stok'];
    $tombolbeli="<a class='prod_cart' href=\"aksi.php?module=keranjang&act=tambah&id=$r[id_produk]\">BELI</a>";
    $tombolhabis="<span class='prod_cart_habis'></span>";
      if ($stok!= "0"){
      $tombol=$tombolbeli;
      }else{
      $tombol=$tombolhabis;
      } 

    $d=$r['diskon'];
    $hargatetap="<div class='prod_price'>
                    <span class='price'></span>
                    <span class='price'> Rp. <b>$hargadisc,-</b></span>
                 </div>";

    $hargadiskon="<div class='prod_price'>
                     <div style='margin-bottom:4px;margin-top:4px;'><span style='text-decoration:line-through;' class='price2'>Rp. $harga,-</span> <br /></div>
                     <div class='s_price'><span class='s_currency s_before'> $r[diskon]% </span></div>
	                  <div><span class='price'>Rp. <b>$hargadisc,-</b></span></div>
	               </div>";
      if ($d!= "0"){
      $divharga=$hargadiskon;
      $harganya = $hargadisc;
      $komen = "<b>DISKON $r[diskon]% !!</b>";
      }else{
      $divharga=$hargatetap;
      $harganya = $harga;
      $komen = "";
      } 

    $s=$r['stok'];
    $stoknya = "<div class='prod_stok'>Stok: $s</div>";
    $limitedStock = "";
    if($s<=3 && $s!=0)
    {
      if($komen=="")
      {
         $limitedStock = "<b>STOK TERBATAS..! ($s)</b>";
      }
      else
      {
         $limitedStock = "<br><b>STOK TERBATAS..! ($s)</b>";
      }
    }
    echo "<div class='prod_box'>
          <div class='top_prod_box'></div> 

          <div class='center_prod_box'>            
             <div class='product_title'><a href='produk-$r[id_produk]-$r[produk_seo].html#read'>$r[nama_produk]</a></div>
             <div class='product_img'>
";
if($setting_thumbnail=="zoom") {
   echo "<a href='produk-$r[id_produk]-$r[produk_seo].html#read'><a href='foto_produk/$r[gambar]' rel='clearbox[gallery=Produk Terbaru,,title=$r[nama_produk],,comment=<big>Harga : Rp. $harganya,- $komen</big>]'>
               <img src='foto_produk/small/small_$r[gambar]' border='0' height=$tinggithumbnail   class='tooltip' title='klik untuk memperbesar gambar<br>$komen $limitedStock'>";
}
else {
   echo "<a href='produk-$r[id_produk]-$r[produk_seo].html#read'>
               <img src='foto_produk/small/small_$r[gambar]' border='0' height=$tinggithumbnail   class='tooltip' title='klik untuk melihat detail'>";
}
echo "</a>
             </div>

             $divharga
             $stoknya
             </div>
          <div class='bottom_prod_box'></div>

          <div class='prod_details_tab'>
             $tombol            
             <a href='produk-$r[id_produk]-$r[produk_seo].html#read' class='prod_details'>DETAIL</a> 
          </div>

          </div>";
  }



  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM produk WHERE id_kategori='$_GET[id]'"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halkategori], $jmlhalaman);

  echo "<div class='clear'></div><br/><div class=halaman>Halaman : $linkHalaman </div><br>";
  }
  else{
    echo "<p align=left><span class='table7'>Belum ada produk pada kategori ini.</p>";
  }
}

// Menu utama di header

// Modul profil
if ($_GET['module']=='profilkami'){
  // Data profil mengacu pada id_modul=43
	$profil = mysql_query("SELECT * FROM modul WHERE id_modul='43'");
	$r      = mysql_fetch_array($profil);

  echo "<h4 class='heading colr'>Profil Kami</h4>
    	  <div class='prod_box_bigx'>
 
            </div>
          <div class='profil'>
              <div>$r[static_content]</div>
			  <div class='bottom_prod_box_big4'></div>
          </div>    
          </div>
          </div>";                             
}

// Modul hasil poling
elseif ($_GET['module']=='hasilpoling'){
 echo "<div id='content'>          
          <div id='content-detail'>";
 if (isset($_COOKIE["poling"])) {
   echo "<span class='idtanggal'>Maaf, anda sudah pernah melakukan jajak pendapat ini.";
 }
 else{
  // membuat cookie dengan nama poling
  // cookie akan secara otomatis terhapus dalam waktu 24 jam
  setcookie("poling", "sudah poling", time() + 3600 * 24);

echo "<h4 class='heading colr'>Hasil Polling</h4></div>";

  echo "<p align=left><span class='pol1'>Terima kasih atas partisipasi anda mengikuti polling kami<br /><br />
       Hasil polling saat ini: </p><br />";
  
  echo "<table width=600px style='border: 1pt dashed #ccc ;padding: 10px;'>";

  $jml=mysql_query("SELECT SUM(rating) as jml_vote FROM poling WHERE aktif='Y'");
  $j=mysql_fetch_array($jml);
  
  $jml_vote=$j[jml_vote];
  
  $sql=mysql_query("SELECT * FROM poling WHERE aktif='Y' and status='Jawaban'");
  
  while ($s=mysql_fetch_array($sql)){
  	
  	$prosentase = sprintf("%2.1f",(($s[rating]/$jml_vote)*100));
  	$gbr_vote   = $prosentase * 3;

    echo "<tr><td width=200><span class='pol2'>$s[pilihan] ($s[rating]) </td><td> 
          <img src=images/red.jpg width=$gbr_vote height=18 border=0> $prosentase % 
          </td></tr>";  
  }
  echo "</table>
        <p><span class='pol1'>Jumlah Pemilih: <span class='pol2'>$jml_vote</b></p>";
 }
  echo "</div>
    </div>";            
}


// Modul hasil poling
elseif ($_GET['module']=='lihatpoling'){
  echo "<div id='content'>          
          <div id='content-detail'>";
  echo "<h4 class='heading colr'>Hasil Polling</h4></div>";

  echo "<p align=left><span class='pol1'>Terima kasih atas partisipasi anda mengikuti polling kami<br /><br />
       Hasil polling saat ini: </p><br />";
  
  echo "<table width=600px style='border: 1pt dashed #ccc ;padding: 10px;'>";

  $jml=mysql_query("SELECT SUM(rating) as jml_vote FROM poling WHERE aktif='Y'");
  $j=mysql_fetch_array($jml);
  
  $jml_vote=$j[jml_vote];
  
  $sql=mysql_query("SELECT * FROM poling WHERE aktif='Y' and status='Jawaban'");
  
  while ($s=mysql_fetch_array($sql)){
  	
  	$prosentase = sprintf("%2.1f",(($s[rating]/$jml_vote)*100));
  	$gbr_vote   = $prosentase * 3;

    echo "<tr><td width=200><span class='pol2'>$s[pilihan] ($s[rating]) </td><td> 
          <img src=images/red.jpg width=$gbr_vote height=18 border=0> $prosentase % 
          </td></tr>";  
  }
  echo "</table>
        <p><span class='pol1'>Jumlah Pemilih: <span class='pol2'>$jml_vote</b></p>";
  echo "</div>
    </div>";            
}



// Modul cara pembelian
if ($_GET['module']=='carabeli'){
  // Data cara pembelian mengacu pada id_modul=45
	$carabeli = mysql_query("SELECT * FROM modul WHERE id_modul='45'");
	$beli      = mysql_fetch_array($carabeli);
   $carabayar = mysql_query("SELECT * FROM modul WHERE id_modul='64'");
	$bayar      = mysql_fetch_array($carabayar);
	$carakonfirmasi = mysql_query("SELECT * FROM modul WHERE id_modul='65'");
	$konfirmasi      = mysql_fetch_array($carakonfirmasi);
	$carapengiriman = mysql_query("SELECT * FROM modul WHERE id_modul='66'");
	$pengiriman      = mysql_fetch_array($carapengiriman);
   
  echo "<h4 class='heading colr'>Panduan Cara Pembelian / How to Buy</h4>";
  
  ?>
  <div id="panduan" valign="center">
         <h4 class="heading headingok">Cara Membeli Produk</h4>
         <p>
            <?=$beli[static_content]?>
         </p>
   </div>
   <br>
   <div id="panduan" valign="center">
         <h4 class="heading headingok">Cara Pembayaran</h4>
         <p>
            <?=$bayar[static_content]?>
         </p>
   </div>
   <br>
   <div id="panduan" valign="center">
            <h4 class="heading headingok">Cara Konfirmasi</h4>
            <p>
               <?=$konfirmasi[static_content]?>
            </p>
   </div>
   <br>
   <div id="panduan" valign="center">
            <h4 class="heading headingok">Pengiriman</h4>
            <p>
               <?=$pengiriman[static_content]?>
            </p>
   </div>
  <?php
}



// Modul semua download
elseif ($_GET['module']=='semuadownload'){

  echo "<h4 class='heading colr'>Download Katalog</h4>"; 
  $p      = new Paging5;
  $batas  = 20;
  $posisi = $p->cariPosisi($batas);
  // Tampilkan semua download
 	$sql = mysql_query("SELECT * FROM download  
                      ORDER BY id_download DESC LIMIT $posisi,$batas");		  
   while($d=mysql_fetch_array($sql)){
      echo "<p class='download'><a href='downlot.php?file=$d[nama_file]'>&bull; $d[judul]</a> <span class='download2'>(didownload: $d[hits]x)</p>";
	 }

	
  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM download"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[haldownload], $jmlhalaman);

 echo "<div class='clear'></div><br/><div class='halaman'>Halaman : $linkHalaman </div>";
  echo "</div>
    </div>";            
}

// Modul semua produk
elseif ($_GET[module]=='semuaproduk'){

  if($setting_semuaterbaru=="Y")
  {
   ?>
     <h4 class="heading colr">Produk Terbaru di <?=$setting_namatoko?></h4>
     <div id="scrollerhomeTerbaru">
     <?php
     $sql=mysql_query("SELECT * FROM (SELECT * FROM produk WHERE stok!=0 ORDER BY id_produk desc LIMIT $setting_hometerbaru_isi) as a ORDER BY rand() DESC LIMIT $setting_hometerbaru_isi");
     while ($r=mysql_fetch_array($sql)){
       $harga = format_rupiah($r[harga]);
       $disc     = ($r[diskon]/100)*$r[harga];
       $hargadisc     = number_format(($r[harga]-$disc),0,",",".");
       $stok=$r['stok'];
       $tombolbeli="<a class='prod_cart' href=\"aksi.php?module=keranjang&act=tambah&id=$r[id_produk]\">BELI</a>";
       $tombolhabis="<span class='prod_cart_habis'></span>";
         if ($stok!= "0"){
         $tombol=$tombolbeli;
         }else{
         $tombol=$tombolhabis;
         } 

       $d=$r['diskon'];
       $hargatetap="<div class='prod_price'>
                       <span class='price'></span>
                       <span class='price'> Rp. <b>$hargadisc,-</b></span>
                    </div>";
       $hargadiskon="<div class='prod_price'>
                        <div style='margin-bottom:4px;margin-top:4px;'><span style='text-decoration:line-through;' class='price2'>Rp. $harga,-</span> <br /></div>
                        <div class='s_price'><span class='s_currency s_before'> $r[diskon]% </span></div>

	                     <div><span class='price'>Rp. <b>$hargadisc,-</b></span></div>
	                  </div>";
         if ($d!= "0"){
         $divharga=$hargadiskon;
         $harganya = $hargadisc;
         $komen = "<b>DISKON $r[diskon]% !!</b>";
         }else{
         $divharga=$hargatetap;
         $harganya = $harga;
         $komen = "";
         } 

       $s=$r['stok'];
       $stoknya = "<div class='prod_stok'>Stok: $s</div>";
       $limitedStock = "";
       if($s<=3 && $s!=0)
       {
         if($komen=="")
         {
            $limitedStock = "<b>STOK TERBATAS..! ($s)</b>";
         }
         else
         {
            $limitedStock = "<br><b>STOK TERBATAS..! ($s)</b>";
         }
       }
       echo "<div class='prod_box_scroll'>
             <div class='top_prod_box'></div> 
             <div class='center_prod_box'>            

                <div class='product_title'><a href='produk-$r[id_produk]-$r[produk_seo].html#read'>$r[nama_produk]</a></div>
                <div class='product_img'>
                                ";
if($setting_thumbnail=="zoom") {
   echo "<a href='produk-$r[id_produk]-$r[produk_seo].html#read'><a href='foto_produk/$r[gambar]' rel='clearbox[gallery=Produk Terbaru,,title=$r[nama_produk],,comment=<big>Harga : Rp. $harganya,- $komen</big>]'>
               <img src='foto_produk/small/small_$r[gambar]' border='0' height=$tinggithumbnail   class='tooltip' title='klik untuk memperbesar gambar<br>$komen $limitedStock'>";
}
else {
   echo "<a href='produk-$r[id_produk]-$r[produk_seo].html#read'>
               <img src='foto_produk/small/small_$r[gambar]' border='0' height=$tinggithumbnail   class='tooltip' title='klik untuk melihat detail'>";
}
echo "</a>

                </div>
                $divharga
                $stoknya
                </div>

             <div class='bottom_prod_box'></div>
             <div class='prod_details_tab'>
                $tombol            
                <a href='produk-$r[id_produk]-$r[produk_seo].html#read' class='prod_details'>DETAIL</a> 
             </div>
             </div>";
        }    
        echo "</div>";
  }
  
  if($setting_semuafeatured=="Y") {
   $featured = mysql_query("SELECT * FROM setting WHERE tipe='featured'");
   $rfeatured=mysql_fetch_array($featured); ?>
  <h4 class="heading colr"><?=$rfeatured[value3]?></h4>
  <div id="scrollerhomeFeatured">
  <?php
  $sql=mysql_query("SELECT * FROM produk WHERE featured='Y' ORDER BY rand() DESC LIMIT $setting_homefeatured_isi");
  while ($r=mysql_fetch_array($sql)){
    $harga = format_rupiah($r[harga]);
    $disc     = ($r[diskon]/100)*$r[harga];
    $hargadisc     = number_format(($r[harga]-$disc),0,",",".");
    $stok=$r['stok'];
    $tombolbeli="<a class='prod_cart' href=\"aksi.php?module=keranjang&act=tambah&id=$r[id_produk]\">BELI</a>";
    $tombolhabis="<span class='prod_cart_habis'></span>";
      if ($stok!= "0"){
      $tombol=$tombolbeli;
      }else{
      $tombol=$tombolhabis;
      } 

    $d=$r['diskon'];
    $hargatetap="<div class='prod_price'>
                    <span class='price'></span>
                    <span class='price'> Rp. <b>$hargadisc,-</b></span>

                 </div>";
    $hargadiskon="<div class='prod_price'>
                     <div style='margin-bottom:4px;margin-top:4px;'><span style='text-decoration:line-through;' class='price2'>Rp. $harga,-</span> <br /></div>

                     <div class='s_price'><span class='s_currency s_before'> $r[diskon]% </span></div>
	                  <div><span class='price'>Rp. <b>$hargadisc,-</b></span></div>
	               </div>";
      if ($d!= "0"){
      $divharga=$hargadiskon;
      $harganya = $hargadisc;
      $komen = "<b>DISKON $r[diskon]% !!</b>";
      }else{
      $divharga=$hargatetap;
      $harganya = $harga;
      $komen = "";
      } 

    $s=$r['stok'];
    $stoknya = "<div class='prod_stok'>Stok: $s</div>";
    $limitedStock = "";
    if($s<=3 && $s!=0)
    {
      if($komen=="")
      {
         $limitedStock = "<b>STOK TERBATAS..! ($s)</b>";
      }
      else
      {
         $limitedStock = "<br><b>STOK TERBATAS..! ($s)</b>";
      }
    }
    echo "<div class='prod_box_scroll'>
          <div class='top_prod_box'></div> 
          <div class='center_prod_box'>            

             <div class='product_title'><a href='produk-$r[id_produk]-$r[produk_seo].html#read'>$r[nama_produk]</a></div>
             <div class='product_img'>
                             ";
if($setting_thumbnail=="zoom") {
   echo "<a href='produk-$r[id_produk]-$r[produk_seo].html#read'><a href='foto_produk/$r[gambar]' rel='clearbox[gallery=Produk Terbaru,,title=$r[nama_produk],,comment=<big>Harga : Rp. $harganya,- $komen</big>]'>
               <img src='foto_produk/small/small_$r[gambar]' border='0' height=$tinggithumbnail   class='tooltip' title='klik untuk memperbesar gambar<br>$komen $limitedStock'>";
}
else {
   echo "<a href='produk-$r[id_produk]-$r[produk_seo].html#read'>
               <img src='foto_produk/small/small_$r[gambar]' border='0' height=$tinggithumbnail   class='tooltip' title='klik untuk melihat detail'>";
}
echo "</a>
             </div>

             $divharga
             $stoknya
             </div>
          <div class='bottom_prod_box'></div>

          <div class='prod_details_tab'>
             $tombol            
             <a href='produk-$r[id_produk]-$r[produk_seo].html#read' class='prod_details'>DETAIL</a> 

          </div>
          </div>";
     }    
     echo "</div>";
     echo "<div class='clear'>";
}
  
  // semua produk`
  if($_GET['halproduk']>1)
  {
   $halamannya=" - Halaman ".$_GET['halproduk'];
  }
  echo "<span id='view'></span>";
  echo "<h4 class='heading colr'><big>SEMUA PRODUK $halamannya</big></h4>";
  // Tentukan berapa data yang akan ditampilkan per halaman (paging)
  $p      = new Paging2;
  $batas  = $setting_semuajumlah;
  $posisi = $p->cariPosisi($batas);

  // Tampilkan semua produk
  $sql=mysql_query("SELECT * FROM produk ORDER BY id_produk DESC LIMIT $posisi,$batas");

  while ($r=mysql_fetch_array($sql)){
    $harga = format_rupiah($r[harga]);
    $disc     = ($r[diskon]/100)*$r[harga];
    $hargadisc     = number_format(($r[harga]-$disc),0,",",".");
    $stok=$r['stok'];
    $tombolbeli="<a class='prod_cart' href=\"aksi.php?module=keranjang&act=tambah&id=$r[id_produk]\">BELI</a>";
    $tombolhabis="<span class='prod_cart_habis'></span>";
      if ($stok!= "0"){
      $tombol=$tombolbeli;
      }else{
      $tombol=$tombolhabis;
      } 

    $d=$r['diskon'];
    $hargatetap="<div class='prod_price'>
                    <span class='price'></span>
                    <span class='price'> Rp. <b>$hargadisc,-</b></span>
                 </div>";
    $hargadiskon="<div class='prod_price'>
                     <div style='margin-bottom:4px;margin-top:4px;'><span style='text-decoration:line-through;' class='price2'>Rp. $harga,-</span> <br /></div>
                     <div class='s_price'><span class='s_currency s_before'> $r[diskon]% </span></div>
	                  <div><span class='price'>Rp. <b>$hargadisc,-</b></span></div>
	               </div>";
      if ($d!= "0"){
      $divharga=$hargadiskon;
      $harganya = $hargadisc;
      $komen = "<b>DISKON $r[diskon]% !!</b>";
      }else{
      $divharga=$hargatetap;
      $harganya = $harga;
      $komen = "";
      } 

    $s=$r['stok'];
    $stoknya = "<div class='prod_stok'>Stok: $s</div>";
    $limitedStock = "";
    if($s<=3 && $s!=0)
    {
      if($komen=="")
      {
         $limitedStock = "<b>STOK TERBATAS..! ($s)</b>";
      }
      else
      {
         $limitedStock = "<br><b>STOK TERBATAS..! ($s)</b>";
      }
    }
    echo "<div class='prod_box'>
          <div class='top_prod_box'></div> 
          <div class='center_prod_box'>            
             <div class='product_title'><a href='produk-$r[id_produk]-$r[produk_seo].html#read'>$r[nama_produk]</a></div>
             <div class='product_img'>
                             ";
if($setting_thumbnail=="zoom") {
   echo "<a href='produk-$r[id_produk]-$r[produk_seo].html#read'><a href='foto_produk/$r[gambar]' rel='clearbox[gallery=Produk Terbaru,,title=$r[nama_produk],,comment=<big>Harga : Rp. $harganya,- $komen</big>]'>
               <img src='foto_produk/small/small_$r[gambar]' border='0' height=$tinggithumbnail   class='tooltip' title='klik untuk memperbesar gambar<br>$komen $limitedStock'>";
}
else {
   echo "<a href='produk-$r[id_produk]-$r[produk_seo].html#read'>
               <img src='foto_produk/small/small_$r[gambar]' border='0' height=$tinggithumbnail   class='tooltip' title='klik untuk melihat detail'>";
}
echo "</a>
             </div>
             $divharga
             $stoknya
             </div>
          <div class='bottom_prod_box'></div>
          <div class='prod_details_tab'>
             $tombol            
             <a href='produk-$r[id_produk]-$r[produk_seo].html#read' class='prod_details'>DETAIL</a> 
          </div>
          </div>";
  }  
    
  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM produk"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halproduk], $jmlhalaman);
   
  echo "<div class='clear'></div><br/><div class='halaman'>Halaman : $linkHalaman </div>";
}

// Modul Featured Produk
elseif ($_GET[module]=='featured'){
  $featured = mysql_query("SELECT * FROM setting WHERE tipe='featured'");
  $rfeatured=mysql_fetch_array($featured);
  
  // semua produk`
  if($_GET['halfeatured']>1)
  {
   $halamannya=" - Halaman ".$_GET['halfeatured'];
  }
  echo "<span id='view'></span>";
  echo "<h4 class='heading colr'><big>$rfeatured[value3]</big></h4>";
  // Tentukan berapa data yang akan ditampilkan per halaman (paging)
  $p      = new PagingFeatured;
  $batas  = $setting_semuajumlah;
  $posisi = $p->cariPosisi($batas);

  // Tampilkan semua produk
  $sql=mysql_query("SELECT * FROM produk WHERE featured='Y' ORDER BY id_produk DESC LIMIT $posisi,$batas");

  while ($r=mysql_fetch_array($sql)){
    $harga = format_rupiah($r[harga]);
    $disc     = ($r[diskon]/100)*$r[harga];
    $hargadisc     = number_format(($r[harga]-$disc),0,",",".");
    $stok=$r['stok'];
    $tombolbeli="<a class='prod_cart' href=\"aksi.php?module=keranjang&act=tambah&id=$r[id_produk]\">BELI</a>";
    $tombolhabis="<span class='prod_cart_habis'></span>";
      if ($stok!= "0"){
      $tombol=$tombolbeli;
      }else{
      $tombol=$tombolhabis;
      } 

    $d=$r['diskon'];
    $hargatetap="<div class='prod_price'>
                    <span class='price'></span>
                    <span class='price'> Rp. <b>$hargadisc,-</b></span>
                 </div>";
    $hargadiskon="<div class='prod_price'>
                     <div style='margin-bottom:4px;margin-top:4px;'><span style='text-decoration:line-through;' class='price2'>Rp. $harga,-</span> <br /></div>
                     <div class='s_price'><span class='s_currency s_before'> $r[diskon]% </span></div>
	                  <div><span class='price'>Rp. <b>$hargadisc,-</b></span></div>
	               </div>";
      if ($d!= "0"){
      $divharga=$hargadiskon;
      $harganya = $hargadisc;
      $komen = "<b>DISKON $r[diskon]% !!</b>";
      }else{
      $divharga=$hargatetap;
      $harganya = $harga;
      $komen = "";
      } 

    $s=$r['stok'];
    $stoknya = "<div class='prod_stok'>Stok: $s</div>";
    $limitedStock = "";
    if($s<=3 && $s!=0)
    {
      if($komen=="")
      {
         $limitedStock = "<b>STOK TERBATAS..! ($s)</b>";
      }
      else
      {
         $limitedStock = "<br><b>STOK TERBATAS..! ($s)</b>";
      }
    }
    echo "<div class='prod_box'>
          <div class='top_prod_box'></div> 
          <div class='center_prod_box'>            
             <div class='product_title'><a href='produk-$r[id_produk]-$r[produk_seo].html#read'>$r[nama_produk]</a></div>
             <div class='product_img'>
";
if($setting_thumbnail=="zoom") {
   echo "<a href='produk-$r[id_produk]-$r[produk_seo].html#read'><a href='foto_produk/$r[gambar]' rel='clearbox[gallery=Produk Terbaru,,title=$r[nama_produk],,comment=<big>Harga : Rp. $harganya,- $komen</big>]'>
               <img src='foto_produk/small/small_$r[gambar]' border='0' height=$tinggithumbnail   class='tooltip' title='klik untuk memperbesar gambar<br>$komen $limitedStock'>";
}
else {
   echo "<a href='produk-$r[id_produk]-$r[produk_seo].html#read'>
               <img src='foto_produk/small/small_$r[gambar]' border='0' height=$tinggithumbnail   class='tooltip' title='klik untuk melihat detail'>";
}
echo "</a>

             </div>
             $divharga
             $stoknya

             </div>
          <div class='bottom_prod_box'></div>
          <div class='prod_details_tab'>
             $tombol            

             <a href='produk-$r[id_produk]-$r[produk_seo].html#read' class='prod_details'>DETAIL</a> 
          </div>
          </div>";
  }  
    
  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM produk WHERE featured='Y'"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halfeatured], $jmlhalaman);
   
  echo "<div class='clear'></div><br/><div class='halaman'>Halaman : $linkHalaman </div>";
}

// Modul keranjang belanja
elseif ($_GET[module]=='keranjangbelanja'){
  // Tampilkan produk-produk yang telah dimasukkan ke keranjang belanja
	$sid = session_id();
	$sql = mysql_query("SELECT * FROM orders_temp, produk 
			                WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
  $ketemu=mysql_num_rows($sql);
  if($ketemu < 1){
    echo "<h4 class='heading colr'>Keranjang Belanja</h4>
          <form method=post action=aksi.php?module=keranjang&act=update>
          <table class='tabelkeranjang' width=670 border=0 cellpadding=0 cellspacing=1 align=center>
          <tbody>
         <tr background='images/bg_tab.jpg' align=center height=25><th>No</th><th>Produk</th><th>Nama Produk</th><th>Jumlah</th><th>Harga</th><th>Sub Total</th><th>Hapus</th></tr>
         <tr class='barissubtotal'><td align='center' colspan='7'><br><b>Maaf, keranjang belanja Anda masih kosong!<br><br>Silahkan berbelanja terlebih dahulu.<br>Klik tombol BELI pada produk yang diinginkan untuk memasukkannya ke keranjang belanja.</b><br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
         </tbody>
         </table>
         ";  
    }
  else{  
  
    echo "<h4 class='heading colr'>Keranjang Belanja</h4>
          <form method=post action=aksi.php?module=keranjang&act=update>
          <table class='tabelkeranjang' width=670 border=0 cellpadding=0 cellspacing=1 align=center>
          <tbody>
         <tr background='images/bg_tab.jpg' align=center height=23><th>No</th><th>Produk</th><th>Nama Produk</th><th>Jumlah</th><th>Harga</th><th>Sub Total</th><th>Hapus</th></tr>";  
  
  $no=1;
  while($r=mysql_fetch_array($sql)){
    $disc        = ($r[diskon]/100)*$r[harga];
    $hargadisc   = number_format(($r[harga]-$disc),0,",",".");
    $subtotal    = ($r[harga]-$disc) * $r[jumlah];
    $total       = $total + $subtotal;  
    $subtotal_rp = format_rupiah($subtotal);
    $total_rp    = format_rupiah($total);
    $harga       = format_rupiah($r[harga]);
    
    
       echo "<tr class='bariskeranjang' align=center><td><span>$no</td><input type=hidden name=id[$no] value=$r[id_orders_temp]>
              <td align=center><a href='foto_produk/$r[gambar]' rel='clearbox[gallery=Koleksi Produk]' title='$r[nama_produk]'><img height=50px class='imgcart' src=foto_produk/small/small_$r[gambar]  class='tooltip' title='klik untuk memperbesar gambar'></td>
              <td><a href='produk-$r[id_produk]-$r[produk_seo].html#read'>$r[nama_produk]</a></td>
              <td align='center'> ";
      $sqlstok = mysql_query("SELECT stok FROM produk WHERE id_produk='".$r[id_produk]."'");
      $rstok = mysql_fetch_array($sqlstok);
      $jumstok = $rstok[0];
      
      echo "<select name='jml[$no]' onchange=\"this.form.submit()\">";
      for($i=1;$i<=$jumstok;$i++)
      {
         if($r[jumlah]==$i) { echo "<option value='$i' selected='yes'> $i </option>"; }
         else { echo "<option value='$i'> $i </option>"; }
      }
      echo "</select>";
      echo "</td>
              <td width='100px'>Rp $hargadisc</td>
              <td align='center' width='100px'>Rp $subtotal_rp</td>
              <td align=center width='50px'><a href='aksi.php?module=keranjang&act=hapus&id=$r[id_orders_temp]'><img src=images/kali.png border=0 class='tooltip' title='hapus?' onclick='return confirm(\"Hapus produk ini dari keranjang?\\n$r[nama_produk] - Rp $subtotal_rp\");'></a></td>
          </tr>";
    $no++; 
  } 
  echo "<tr class='barissubtotal' style='height:25px;'><td colspan=7 align=right valign='center'><b>SUBTOTAL : Rp. $total_rp,-</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</tr>
        <tr><td align='right' colspan='7'>(belum termasuk ongkos kirim) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
        <tr style='height:10px;'><td colspan='7'></td></tr>
        <tr><td colspan=2 align='center' valign='center'><a href=javascript:history.go(-1)><input style='width: 170px; height: 25px;' type=button  class=simplebtn value='LANJUTKAN BELANJA'></a></td>
        <td colspan=2><input style='width: 160px; height: 25px;' type=submit  class= simplebtn value='UPDATE KERANJANG'></td>
        <td colspan=3 align=right><a href='selesai-belanja.html#read'><input style='width: 170px; height: 25px;' type=button  class=simplebtn value='CHECKOUT / KE KASIR'></a></td></tr>
        </tbody>
  </table>";
echo "<br><hr><p>*   Apabila Anda mengubah jumlah (Qty), jangan lupa tekan tombol <b>Update Keranjang</b><br />
               **  Total harga di atas belum termasuk ongkos kirim.<br/>
               ***  Ongkos kirim akan kami informasikan <b>lewat SMS konfirmasi</b> kepada Anda, beserta <b>Grand Total</b> yang harus Anda bayarkan.<br/>
               **** Jadi, <b>JANGAN TRANSFER SEBELUM KAMI KONFIRMASI</b> lewat sms mengenai besar biaya yang harus ditransfer.</p><br />
              </div>
          </div>    
          </div>
            <div class='bottom_prod_box_big'></div>
           <div class='bottom_prod_box_big3'></div>
          </div>";             

}
}    


// Modul hubungi kami
elseif ($_GET['module']=='hubungikami'){
  echo "<div id='content'>          
          <div id='content-detail'>";
  echo "<h4 class='heading colr'>Kontak Kami</h4>"; 
  echo "<b> <div class='table5'>Hubungi kami secara online dengan mengisi form di bawah ini:</b>
        <table width=100% style='border: 0pt dashed #0000CC;padding: 10px;'>
        <form action=hubungi-aksi.html method=POST>
        <tr><td><span class='table4'>Nama:</td><td>  <input type=text class='isikoment3' name=nama size=40></td></tr>
        <tr><td><span class='table4'>Email:</td><td>  <input type=text class='isikoment3' name=email size=40></td></tr>
        <tr><td><span class='table4'>Subjek:</td><td>  <input type=text class='isikoment3' name=subjek size=55></td></tr>
        <tr><td valign=top><span class='table4'>Pesan:</td><td><textarea class='isikoment3' name=pesan  style='width: 315px; height: 100px;'></textarea></td></tr>
        <tr><td>&nbsp;</td><td><img src='config/captcha.php'></td></tr>
        <tr><td>&nbsp;</td><td><span class=isikomen>(masukkan 6 kode di atas)<br /><input type=text class='isikoment3' name=kode size=10 maxlength=6><br /></td></tr>
        </td><td colspan=2><p style='padding-top:15px ;'><input style=' width: 85px; height: 23px;' type=submit  class=simplebtn value='KIRIM PESAN'></td></tr>
        </form></table><br />";
  echo "</div>
    <div class='bottom_prod_box_big6'></div>
    </div>";            
}


// Modul hubungi aksi
elseif ($_GET['module']=='hubungiaksi'){
  echo "<div id='content'>          
          <div id='content-detail'>";

$nama=trim($_POST[nama]);
$email=trim($_POST[email]);
$subjek=trim($_POST[subjek]);
$pesan=trim($_POST[pesan]);

if (empty($nama)){
  echo "<span class='table8'>Anda belum mengisikan NAMA<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi!</b>";
}
elseif (empty($email)){
  echo "<span class='table8'>Anda belum mengisikan EMAIL<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi!</b>";
}
elseif (empty($subjek)){
  echo "<span class='table8'>Anda belum mengisikan SUBJEK<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi!</b>";
}
elseif (empty($pesan)){
  echo "<span class='table8'>Anda belum mengisikan PESAN<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi!</b>";
}
else{
	if(!empty($_POST['kode'])){
		if($_POST['kode']==$_SESSION['captcha_session']){

  mysql_query("INSERT INTO hubungi(nama,
                                   email,
                                   subjek,
                                   pesan,
                                   tanggal) 
                        VALUES('$_POST[nama]',
                               '$_POST[email]',
                               '$_POST[subjek]',
                               '$_POST[pesan]',
                               '$tgl_sekarang')");
  echo "<h4 class='heading colr'>Hubungi Kami</h4></span><br />"; 
  echo "<span class='table8'><p align=center><div class='table5'><b>Terima kasih telah menghubungi kami. <br /> Kami akan segera meresponnya.</b></p>";
		}else{
			echo "<span class='table8'>Kode yang Anda masukkan tidak cocok<br />
			      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
		}
	}else{
		echo "<span class='table8'>Anda belum memasukkan kode<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
	}
}
  echo "</div>
<div class='bottom_prod_box_big9'>
    </div>";            
}


// Modul hasil pencarian produk 
elseif ($_GET['module']=='hasilcari'){
  // menghilangkan spasi di kiri dan kanannya
  $kata = trim($_POST['kata']);
  // mencegah XSS
  $kata = htmlentities(htmlspecialchars($kata), ENT_QUOTES);

  // pisahkan kata per kalimat lalu hitung jumlah kata
  $pisah_kata = explode(" ",$kata);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;

  $cari = "SELECT * FROM produk WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "deskripsi LIKE '%$pisah_kata[$i]%' OR nama_produk LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }
  $cari .= " ORDER BY id_produk DESC LIMIT 20";
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);

  echo "<h4 class='heading colr'>Hasil Pencarian</h4>";

  if ($ketemu > 0){
  echo "<div><big>Ditemukan <b>$ketemu</b> produk dengan kata <font style='background-color:#FFFFC3'><b>$kata</b></font> <b>:</b> </big></div><br>";
    while($t=mysql_fetch_array($hasil)){
      $harga = format_rupiah($t[harga]);
       $disc     = ($t[diskon]/100)*$t[harga];
       $hargadisc     = number_format(($t[harga]-$disc),0,",",".");
       $stok=$t['stok'];
       $tombolbeli="<a class='prod_cart' href=\"aksi.php?module=keranjang&act=tambah&id=$t[id_produk]\">BELI</a>";
       $tombolhabis="<span class='prod_cart_habis'></span>";
         if ($stok!= "0"){
         $tombol=$tombolbeli;
         }else{
         $tombol=$tombolhabis;
         } 

       $d=$t['diskon'];
       $hargatetap="<div class='prod_price'>
                       <span class='price'></span>
                       <span class='price'> Rp. <b>$hargadisc,-</b></span>
                    </div>";
       $hargadiskon="<div class='prod_price'>
                        <div style='margin-bottom:4px;margin-top:4px;'><span style='text-decoration:line-through;' class='price2'>Rp. $harga,-</span> <br /></div>
                        <div class='s_price'><span class='s_currency s_before'> $t[diskon]% </span></div>
	                     <div><span class='price'>Rp. <b>$hargadisc,-</b></span></div>
	                  </div>";
         if ($d!= "0"){
         $divharga=$hargadiskon;
         $harganya = $hargadisc;
         $komen = "<b>DISKON $t[diskon]% !!</b>";
         }else{
         $divharga=$hargatetap;
         $harganya = $harga;
         $komen = "";
         } 

       $s=$t['stok'];
       $stoknya = "<div class='prod_stok'>Stok: $s</div>";
       $limitedStock = "";
       if($s<=3 && $s!=0)
       {
         if($komen=="")
         {
            $limitedStock = "<b>STOK TERBATAS..! ($s)</b>";
         }
         else
         {
            $limitedStock = "<br><b>STOK TERBATAS..! ($s)</b>";
         }
       }
       echo "<div class='prod_box'>
             <div class='top_prod_box'></div> 
             <div class='center_prod_box'>            
                <div class='product_title'><a href='produk-$t[id_produk]-$t[produk_seo].html#read'>$t[nama_produk]</a></div>
                <div class='product_img'>
                                <a href='produk-$t[id_produk]-$t[produk_seo].html#read'><a href='foto_produk/$t[gambar]' rel='clearbox[gallery=Koleksi Produk,,title=$t[nama_produk],,comment=<big>Harga : Rp. $harganya,- $komen</big>]'>
                  <img src='foto_produk/small/small_$t[gambar]' border='0' height=$tinggithumbnail   class='tooltip' title='klik untuk memperbesar gambar<br>$komen $limitedStock'></a>
                </div>
                $divharga
                $stoknya
                </div>
             <div class='bottom_prod_box'></div>
             <div class='prod_details_tab'>
                $tombol            
                <a href='produk-$t[id_produk]-$t[produk_seo].html#read' class='prod_details'>DETAIL</a> 
             </div>
             </div>
             ";
      }
      echo "<div class='clear'></div><br><div id='infoTambahan' align='center' valign='center'>
               <h4>Tidak menemukan produk yang dicari?<br/>Pastikan kata kunci yang diketikkan sudah benar.<hr style='margin:10px 0 10px 0;'><b>TIPS:</b> Anda juga bisa memasukkan kode yang ada di nama produk untuk pencarian yang lebih spesifik lagi.</h4>
            </div>";
    }                                                          
  else{
    echo "<p><div><big>Tidak ditemukan produk dengan kata <font style='background-color:#FFFFC3'><b>$kata</b></big></p></div>";
    echo "<div class='clear'></div><br><div id='infoTambahan' align='center' valign='center'>
               <h4>Tidak menemukan produk yang dicari?<br/>Pastikan kata kunci yang diketikkan sudah benar.<hr style='margin:10px 0 10px 0;'><b>TIPS:</b> Anda juga bisa memasukkan kode yang ada di nama produk untuk pencarian yang lebih spesifik lagi.</h4>
            </div>";
  }
}


// Modul selesai belanja
if ($_GET['module']=='selesaibelanja'){
  $sid = session_id();
  $sql = mysql_query("SELECT * FROM orders_temp, produk 
			                WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
  $ketemu=mysql_num_rows($sql);
  if($ketemu < 1){
  echo "<h4 class='heading colr'>Checkout / Selesai Belanja</h4>
          <form method=post action=aksi.php?module=keranjang&act=update>
          <table class='tabelkeranjang' width=670 border=0 cellpadding=0 cellspacing=1 align=center>
          <tbody>
         <tr background='images/bg_tab.jpg' align=center height=23><th>No</th><th>Produk</th><th>Nama Produk</th><th>Jumlah</th><th>Harga</th><th>Sub Total</th><th>Hapus</th></tr>
         <tr class='barissubtotal'><td align='center' colspan='7'><br><b>Maaf, keranjang belanja Anda masih kosong!<br><br>Silahkan berbelanja terlebih dahulu.<br>Klik tombol BELI pada produk yang diinginkan untuk memasukkannya ke keranjang belanja.</b><br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
         </tbody>
         </table>
         "; 
	}
	else{
	   // ambil total belanjaan
	   $csid = session_id();
	   $csqljml = mysql_query("SELECT SUM(jumlah) as totalitem FROM orders_temp, produk 
			                WHERE id_session='$csid' AND orders_temp.id_produk=produk.id_produk");
		$cdata=mysql_fetch_row($csqljml);
      $ctotalitem=$cdata[0];
      
      $csql = mysql_query("SELECT * FROM orders_temp, produk 
			                WHERE id_session='$csid' AND orders_temp.id_produk=produk.id_produk");
			                
      while($cr=mysql_fetch_array($csql)){
                   $cdisc        = ($cr[diskon]/100)*$cr[harga];
                   $chargadisc   = number_format(($cr[harga]-$cdisc),0,",",".");
                   $csubtotal    = ($cr[harga]-$cdisc) * $cr[jumlah];
                   $ctotal       = $ctotal + $csubtotal;  
                   $csubtotal_rp = format_rupiah($csubtotal);
                   $ctotal_rp    = format_rupiah($ctotal);
                   $charga       = format_rupiah($cr[harga]);
                   $csubtotalwidget+=$csubtotal;
                   $csubtotalwidget_rp = format_rupiah($csubtotalwidget);
      }
	?>
	   <h4 class='heading colr'>Checkout / Selesai Belanja</h4>
	   <div id="divCheckout">
	      <div id="langkah1" class="checkoutHeading">
	         Langkah 1 : Jumlah belanjaan Anda
	      </div>
	      <div id="isilangkah1" class="isiCheckout">
	         Terimakasih telah berbelanja di <?=$setting_namasitus?>,<br><br>Anda telah belanja sebanyak <?=$ctotalitem?> item, dengan subtotal harga Rp <?=$csubtotalwidget_rp?>,- <br>
	         Silahkan ikuti langkah-langkah berikutnya untuk menyelesaikan pesanan Anda.
	         <hr class="checkoutHr">
            <a href="javascript:void(0);" class="simplebtn" onclick='lanjut1()'> LANJUTKAN </a>
	      </div>
	      <div id="langkah2" class="checkoutHeading">
	         Langkah 2 : Isi Data Lengkap Anda (Alamat Pengiriman) &nbsp;&nbsp;<a href="javascript:void(0)" class="koreksi" id="koreksi2">[koreksi]</a>
	      </div>
	      <div id="isilangkah2" class="isiCheckout">
	         Data ini digunakan untuk pengiriman, jadi isi dengan selengkap-lengkapnya.<br>Semua kolom harus diisi.<br><br>
	         <table id="tabelCheckoutData" border="0" width="100%">
	            <tr>
	               <td width="150px">Nama</td>
	               <td width="5px">:</td>
	               <td><input id="csid" type="hidden" value="<?=$csid?>"><input id="cnama" type="text" size="50" title="isi dengan nama lengkap Anda" ></td>
	            </tr>
	            <tr>
	               <td width="150px">Email</td>
	               <td width="5px">:</td>
	               <td><input id="cemail" type="text" size="30" title="email harus valid"></td>
	            </tr>
	            <tr>
	               <td width="150px">No. Telp / HP</td>
	               <td width="5px">:</td>
	               <td><input id="ctelp" type="text" size="30" title="untuk konfirmasi"></td>
	            </tr>
	            <tr>
	               <td width="150px" valign="top">Alamat</td>
	               <td width="5px" valign="top">:</td>
	               <td><textarea id="calamat" title="isi dengan lengkap" rows="3"></textarea></td>
	            </tr>
	            <tr>
	               <td width="150px" valign="center">Provinsi</td>
	               <td width="5px" valign="center">:</td>
	               <td>
	                  <select id="provinsi" onChange="loadKota()">
	                     <option value="pilih"> - Pilih Provinsi - </option>
	                     <?php
	                        $prov = mysql_query("SELECT * FROM dataprovinsi ORDER BY provinsi");
	                        while($rprov=mysql_fetch_array($prov))
	                        {
	                           echo "<option value=".$rprov[id_provinsi].">".$rprov[provinsi]."</option>";
	                        }
	                     ?>
	                  </select>
	               </td>
	            </tr>
	            <tr>
	               <td width="150px" valign="top">Kota/Kabupaten</td>
	               <td width="5px" valign="top">:</td>
	               <td>
	                  <input type="hidden" id="kotanya" value="0">
	                  <select id="kota" onChange="getIdKota()">
	                     <option value="pilih"> - Pilih Provinsi Dulu! - </option>
	                  </select>
	               </td>
	            </tr>
	            <tr>
	               <td width="150px">Kode POS</td>
	               <td width="5px">:</td>
	               <td><input id="ckodepos" type="text" size="10" onkeypress="return harusangka(event)" title="harus diisi"></td>
	            </tr>
	         </table>
	         <hr class="checkoutHr">
	          <a href="javascript:void(0);" class="simplebtn" onclick='lanjut2()'> LANJUTKAN </a> &nbsp;&nbsp;<span id="langkah2loading"></span>
	      </div>
	      <div id="langkah3" class="checkoutHeading">
	         Langkah 3 : Ongkos Kirim &nbsp;&nbsp;<a href="javascript:void(0)" class="koreksi" id="koreksi3">[koreksi]</a>
	      </div>
	      <div id="isilangkah3" class="isiCheckout">
	         Besarnya ongkos kirim akan kami informasikan ke Anda melalui SMS.<br>Jadi pastikan Anda mengisi nomor HP Anda dengan benar.
	         <hr class="checkoutHr">
	         <a href="javascript:void(0);" class="simplebtn" onclick='lanjut3()'> LANJUTKAN </a>
	      </div>
	      <div id="langkah4" class="checkoutHeading">
	         Langkah 4 : Pembayaran &nbsp;&nbsp;<a href="javascript:void(0)" class="koreksi" id="koreksi4">[koreksi]</a>
	      </div>
	      <div id="isilangkah4" class="isiCheckout">
	         Pilih salah satu metode pembayaran berikut:
	         <div class="checkoutInfo">
	            <?php
	               $cbank = mysql_query("SELECT * FROM mod_bank");
	               while($rbank=mysql_fetch_array($cbank))
	               {
	                  echo "<input type=\"radio\" name=\"cbank1\" value='".$rbank[nama_bank]."'> &nbsp;Transfer ke rekening Bank ".$rbank[nama_bank]."<br>";
	               }
	            ?>
	         </div>
	         <hr class="checkoutHr">
	         <a href="javascript:void(0);" class="simplebtn" onclick='lanjut4()'> LANJUTKAN </a> &nbsp;&nbsp;<span id="langkah4loading"></span>
	      </div>
	      <div id="langkah5" class="checkoutHeading">
	         Langkah 5 : Konfirmasi & Selesai
	      </div>
	      <div id="isilangkah5" class="isiCheckout">
	         Order akan dikirim ke alamat Anda berikut ini :<br>
	         <div class="checkoutInfo2">
	            <span id="konfirmasiNama"></span> - <span id="konfirmasiTelp"></span><br>
	            <span id="konfirmasiAlamat"></span><br>
	            <span id="konfirmasiKota"></span>, <span id="konfirmasiKodepos"></span><br>
	            <span id="konfirmasiProvinsi"></span>
	         </div>
	         <br>Pilihan pembayaran Anda:
	         <div class="checkoutInfo">
	            Transfer ke Rekening Bank <span id="konfirmasiBank"></span>
	         </div>
	         <hr class="checkoutHr">
	         Apabila ada data yang salah, koreksi dengan meng-klik tulisan <b>[koreksi]</b> di bagian yang diinginkan.<br>Bila semua sudah benar, klik tombol KIRIM ORDER di bawah.
	         <br><br>
	         <a href="javascript:void(0);" class="simplebtn" onclick='lanjut5()'> DATA SUDAH BENAR, KIRIM ORDER INI </a> &nbsp;&nbsp;<span id="langkah5loading"></span>
	      </div>
	      
	      <div id="langkah6" class="checkoutHeading">
	         ORDER ANDA SUDAH TERSIMPAN
	      </div>
	      <div id="isilangkah6" class="isiCheckout" align="center">
	         <h4>Terimakasih, order Anda sudah tersimpan.. :)</h4>
	         <br>
	         Silahkan tunggu SMS konfirmasi & biaya ongkos kirim dari kami.<br>Atau Anda bisa kirim SMS ke kami sekarang dengan menyertakan nomor order Anda di bawah ini, dan kami akan segera memprosesnya. Lebih cepat lebih baik bukan? :)
	         <hr class="checkoutHr">
	         Beriku ini adalah informasi order Anda:<br>
	         <div class="checkoutInfo"><b>
	            Nomor Order: <span id="nomorOrder"></span><br>
	            Atas Nama: <span id="atasNama"></span><br>
	            Total belanja: Rp <?=$csubtotalwidget_rp?>,-<br>
	            </b><small>(belum termasuk ongkos kirim)</small>
	         </div>
	         <hr class="checkoutHr">
	         Kami juga telah mengirim sebuah email yang berisi detail order<br>ke alamat email Anda, <span id="emailAnda"></span>.<br><br>Terimakasih telah berbelanja di <?=$setting_namasitus?>
	      </div>
	      <?php
	         if($setting_fblike=="Y") {
	            ?><br>
	            <div class="janganLupa" id="infoTambahan" align="center" style="overflow:hidden;">
	               <h4>Jangan lupa untuk me-LIKE kami di Facebook :)</h4>
	            <?php
	            echo "<br><fb:like href=\"www.saharabutik.com\" send=\"true\" width=\"450\" show_faces=\"true\"></fb:like></div>";
	         }
	      ?>
	   </div>
	<?php                         
  }
}  


// Modul selesai belanja
if ($_GET['module']=='selesaibelanjaxx'){
  $sid = session_id();
  $sql = mysql_query("SELECT * FROM orders_temp, produk 
			                WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
  $ketemu=mysql_num_rows($sql);
  if($ketemu < 1){
  echo "<h4 class='heading colr'>Selesai Belanja</h4>
          <form method=post action=aksi.php?module=keranjang&act=update>
          <table class='tabelkeranjang' width=670 border=0 cellpadding=0 cellspacing=1 align=center>
          <tbody>
         <tr background='images/bg_tab.jpg' align=center height=23><th>No</th><th>Produk</th><th>Nama Produk</th><th>Jumlah</th><th>Harga</th><th>Sub Total</th><th>Hapus</th></tr>
         <tr class='barissubtotal'><td align='center' colspan='7'><br><b>Maaf, keranjang belanja Anda masih kosong!<br><br>Silahkan berbelanja terlebih dahulu.<br>Klik tombol BELI pada produk yang diinginkan untuk memasukkannya ke keranjang belanja.</b><br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
         </tbody>
         </table>
         "; 
	}
	else{


  echo "<h4 class='heading colr'>Selesai Belanja</h4>
      <form name=form action=simpan-transaksi.html method=POST onSubmit=\"return validasi(this)\">
      <table class='datapembeli' width=650px>
      <tr height='25px'><td width=150px>Nama</td><td>  <input type=text name=nama size=30></td></tr>
      <tr height='25px'><td  width=150px valign=top>Alamat Lengkap</td><td>  <textarea name=alamat rows=4 cols=60></textarea></td></tr>
      <tr height='25px'><td width=150px>Telpon/HP</td><td>  <input type=text name=telpon></td></tr>
      <tr height='25px'><td width=150px>Email</td><td>  <input type=text name=email></td></tr>
      <tr height='10px'><td colspan=2>&nbsp;</td></tr>
      <tr height='25px'><td colspan=2><input style='width: 60px; height: 25px; width:150px;' type=submit class= simplebtn value=PROSES></td></tr>
      </table>";
		  
     echo "<h4 class='heading colr'>Konfirmasi Keranjang Belanja Anda</h4>
          <table class='tabelkeranjang' width=670 border=0 cellpadding=0 cellspacing=1 align=center>
          <tbody>
         <tr background='images/bg_tab.jpg' align=center height=25><th>No</th><th>Nama Produk</th><th>Jumlah</th><th>Harga</th><th>Sub Total</th><th>Hapus</th></tr>";  
  
  $no=1;
  while($r=mysql_fetch_array($sql)){
    $disc        = ($r[diskon]/100)*$r[harga];
    $hargadisc   = number_format(($r[harga]-$disc),0,",",".");
    $subtotal    = ($r[harga]-$disc) * $r[jumlah];
    $total       = $total + $subtotal;  
    $subtotal_rp = format_rupiah($subtotal);
    $total_rp    = format_rupiah($total);
    $harga       = format_rupiah($r[harga]);
    
       echo "<tr class='bariskeranjang' align=center><td><span>$no</td><input type=hidden name=id[$no] value=$r[id_orders_temp]>
              <td height='23px'><a href='produk-$r[id_produk]-$r[produk_seo].html#read'>$r[nama_produk]</a></td>
              <td align='center' height='23px'><input type=text name='jml[$no]' value=$r[jumlah] size=3 onchange=\"this.form.submit()\" onkeypress=\"return harusangka(event)\"></td>
              <td width='150px' height='23px'>Rp $hargadisc</td>
              <td align='center' width='150px' height='23px'>Rp $subtotal_rp</td>
              <td align=center width='50px' height='23px'><a href='aksi.php?module=keranjang&act=hapus&id=$r[id_orders_temp]'><img src=images/kali.png border=0 class='tooltip' title='hapus?' onclick='return confirm(\"Hapus produk ini dari keranjang?\\n$r[nama_produk] - Rp $subtotal_rp\");'></a></td>
          </tr>";
    $no++; 
  } 
  echo "<tr class='barissubtotal' style='height:25px;'><td colspan=7 align=right valign='center'><b>SUBTOTAL : Rp. $total_rp,-</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</tr>
        <tr><td align='right' colspan='7'>(belum termasuk ongkos kirim) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
        <tr style='height:10px;'><td colspan='7'></td></tr>
        <tr><td colspan=2 align='center' valign='center'><a href=javascript:history.go(-1)><input style='width: 170px; height: 25px;' type=submit  class= simplebtn value='LANJUTKAN BELANJA'></a></td>
        <td colspan=2><input style='width: 160px; height: 25px;' type=submit  class= simplebtn value='UPDATE KERANJANG'></td>
        <td colspan=3 align=right><a href='selesai-belanja.html'><input style='width: 140px; height: 25px;' type=submit  class= simplebtn value='SELESAI BELANJA'></a></td></tr>
        </tbody>
  </table>
          </div></div></div>
        <div class='bottom_prod_box_bigx'></div>
        </div>";        
                 
                               
  }
}      


// Modul simpan transaksi
elseif ($_GET[module]=='simpantransaksi'){
$kar1=strstr($_POST[email], "@");
$kar2=strstr($_POST[email], ".");

if (empty($_POST[nama]) || empty($_POST[alamat]) || empty($_POST[telpon]) || empty($_POST[email]) || empty($_POST[kota])){
  echo "Data yang Anda isikan belum lengkap<br />
  	    <a href='selesai-belanja.html'><b>Ulangi Lagi</b>";
}
elseif (!ereg("[a-z|A-Z]","$_POST[nama]")){
  echo "Nama tidak boleh diisi dengan angka atau simbol.<br />
 	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
}
elseif (strlen($kar1)==0 OR strlen($kar2)==0){
  echo "Alamat email Anda tidak valid, mungkin kurang tanda titik (.) atau tanda @.<br />
 	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
}
else{
// fungsi untuk mendapatkan isi keranjang belanja
function isi_keranjang(){
	$isikeranjang = array();
	$sid = session_id();
	$sql = mysql_query("SELECT * FROM orders_temp WHERE id_session='$sid'");
	
	while ($r=mysql_fetch_array($sql)) {
		$isikeranjang[] = $r;
	}
	return $isikeranjang;
}

$tgl_skrg = date("Ymd");
$jam_skrg = date("H:i:s");

// simpan data pemesanan 
mysql_query("INSERT INTO orders(nama_kustomer, alamat, telpon, email, tgl_order, jam_order, id_kota) 
             VALUES('$_POST[nama]','$_POST[alamat]','$_POST[telpon]','$_POST[email]','$tgl_skrg','$jam_skrg','$_POST[kota]')");
  
// mendapatkan nomor orders
$id_orders=mysql_insert_id();

// panggil fungsi isi_keranjang dan hitung jumlah produk yang dipesan
$isikeranjang = isi_keranjang();
$jml          = count($isikeranjang);

// simpan data detail pemesanan  
for ($i = 0; $i < $jml; $i++){
  mysql_query("INSERT INTO orders_detail(id_orders, id_produk, jumlah) 
               VALUES('$id_orders',{$isikeranjang[$i]['id_produk']}, {$isikeranjang[$i]['jumlah']})");
}
  
// setelah data pemesanan tersimpan, hapus data pemesanan di tabel pemesanan sementara (orders_temp)
for ($i = 0; $i < $jml; $i++) {
  mysql_query("DELETE FROM orders_temp
	  	         WHERE id_orders_temp = {$isikeranjang[$i]['id_orders_temp']}");
}

  echo "<h4 class='heading colr'>Proses Transaksi Selesai</h4>";

    	  echo "<div class='prod_box_big'>
        	<div class='top_prod_box_big'></div>
        <div class='center_prod_box_big'>            
          <div class='details_big_cari'>
              <div>
      Data pemesan beserta ordernya adalah sebagai berikut: <br />
      <table>
      <tr><td>Nama           </td><td> : <b>$_POST[nama]</b> </td></tr>
      <tr><td>Alamat Lengkap </td><td> : $_POST[alamat] </td></tr>
      <tr><td>Telpon         </td><td> : $_POST[telpon] </td></tr>
      <tr><td>E-mail         </td><td> : $_POST[email] </td></tr></table><br />
      
      Nomor Order: <b> <span class='table6'>$id_orders</b><br /><br />";

      $daftarproduk=mysql_query("SELECT * FROM orders_detail,produk 
                                 WHERE orders_detail.id_produk=produk.id_produk 
                                 AND id_orders='$id_orders'");
echo "<table width=600 border=0 cellpadding=0 cellspacing=1 align=center>
        <tr background='images/bg_tab3.jpg' align=center height=23><th><span class='table'>No</th><th><span class='table'>Nama Produk</th><th><span class='table'>Berat(Kg)</th><th><span class='table'>Qty</th><th><span class='table'>Harga</th><th><span class='table'>Sub Total</th></tr>";

// Data email
    $sqlmail = mysql_query("SELECT * FROM setting WHERE tipe='email'");
    $rmail = mysql_fetch_array($sqlmail);
    $sqldari = mysql_query("SELECT * FROM setting WHERE tipe='namasitus'");
    $rdari = mysql_fetch_array($sqldari);
    
$pesan="Terimakasih telah melakukan pemesanan online di toko kami<br /><br />  
        Nama: $_POST[nama] <br />
        Alamat: $_POST[alamat] <br/>
        Telpon: $_POST[telpon] <br /><hr />
        
        Nomor Order: $id_orders <br />
        Data order Anda adalah sebagai berikut: <br /><br />";
        
$no=1;
while ($d=mysql_fetch_array($daftarproduk)){
   $subtotalberat = $d[berat] * $d[jumlah]; // total berat per item produk 
   $totalberat  = $totalberat + $subtotalberat; // grand total berat all produk yang dibeli

  
    $disc        = ($d[diskon]/100)*$d[harga];
    $hargadisc   = number_format(($d[harga]-$disc),0,",","."); 
    $subtotal    = ($d[harga]-$disc) * $d[jumlah];

   $total       = $total + $subtotal;
   $subtotal_rp = format_rupiah($subtotal);    
   $total_rp    = format_rupiah($total);    
   $harga       = format_rupiah($d['harga']);

   echo "<tr background='images/bg_tab2.jpg' align=center height=23><td>$no</td><td>$d[nama_produk]</td><td align=center>$d[berat]</td><td align=center>$d[jumlah]</td><td>Rp. $harga,-</td><td>Rp. $subtotal_rp,-</td></tr>";

   $pesan.="$d[jumlah] $d[nama_produk] -> Rp. $harga -> Subtotal: Rp. $subtotal_rp <br />";
   $no++;
}

$ongkos=mysql_fetch_array(mysql_query("SELECT ongkos_kirim FROM kota WHERE id_kota='$_POST[kota]'"));
$ongkoskirim1=$ongkos[ongkos_kirim];
$ongkoskirim = $ongkoskirim1 * $totalberat;

$grandtotal    = $total + $ongkoskirim; 

$ongkoskirim_rp = format_rupiah($ongkoskirim);
$ongkoskirim1_rp = format_rupiah($ongkoskirim1); 
$grandtotal_rp  = format_rupiah($grandtotal);  

$pesan.="<br /><br />Total : Rp. $total_rp,-
         <br />Ongkos Kirim untuk Tujuan Kota Anda : Rp. $ongkoskirim1_rp/Kg 
         <br />Total Berat : $totalberat Kg
         <br />Total Ongkos Kirim  : Rp. $ongkoskirim_rp		 
         <br />Grand Total : Rp. $grandtotal_rp,-
         <br /><br />Silahkan lakukan pembayaran ke Bank Mandiri sebanyak Grand Total yang tercantum, nomor rekeningnya <b>0312849389</b> a.n. Niken Sulanjari";

$subjek="Pemesanan Online Art Furniture";

// Kirim email dalam format HTML
$dari = "From: pesan@saharabutik.com \n";
$dari .= "Content-type: text/html \r\n";

// Kirim email ke kustomer
mail($_POST[email],$subjek,$pesan,$dari);


// Kirim email ke pengelola toko online
mail("pesan@saharabutik.com",$subjek,$pesan,$dari);

echo "<tr><td colspan=5 align=right>Total : Rp. </td><td align=right><b>$total_rp</b></td></tr>
      <tr><td colspan=5 align=right>Ongkos Kirim untuk Tujuan Kota Anda: Rp. </td><td align=right><b>$ongkoskirim1_rp</b>/Kg</td></tr>      
	    <tr><td colspan=5 align=right>Total Berat : </td><td align=right><b>$totalberat Kg</b></td></tr>
      <tr><td colspan=5 align=right>Total Ongkos Kirim : Rp. </td><td align=right><b>$ongkoskirim_rp</b></td></tr>      
      <tr><td colspan=5 align=right>Grand Total : Rp. </td><td align=right><b>$grandtotal_rp</b></td></tr>
      </table>";
echo "<br /><br /><br /><br /><p>- Data order dan nomor rekening transfer sudah terkirim ke email Anda. <br />
               - Apabila Anda tidak melakukan pembayaran dalam 3 hari, maka data order Anda akan terhapus (transaksi batal)</p><br />      
              </div>
          </div>    
          </div>
            <div class='bottom_prod_box_big10'></div>
          </div>";    
		  
}
}

// Modul Semua Kategori
elseif ($_GET[module]=='semuakategori'){
   echo "<span id='view'></span>";
   
   if($setting_kategorifeatured=="Y") {
      $featured = mysql_query("SELECT * FROM setting WHERE tipe='featured'");
      $rfeatured=mysql_fetch_array($featured); ?>
     <h4 class="heading colr"><?=$rfeatured[value3]?></h4>
     <div id="scrollerhomeFeatured">
     <?php
     $sql=mysql_query("SELECT * FROM produk WHERE featured='Y' ORDER BY rand() DESC LIMIT $setting_homefeatured_isi");
     while ($r=mysql_fetch_array($sql)){
       $harga = format_rupiah($r[harga]);
       $disc     = ($r[diskon]/100)*$r[harga];
       $hargadisc     = number_format(($r[harga]-$disc),0,",",".");
       $stok=$r['stok'];
       $tombolbeli="<a class='prod_cart' href=\"aksi.php?module=keranjang&act=tambah&id=$r[id_produk]\">BELI</a>";
       $tombolhabis="<span class='prod_cart_habis'></span>";
         if ($stok!= "0"){
         $tombol=$tombolbeli;
         }else{
         $tombol=$tombolhabis;
         } 

       $d=$r['diskon'];
       $hargatetap="<div class='prod_price'>
                       <span class='price'></span>
                       <span class='price'> Rp. <b>$hargadisc,-</b></span>
                    </div>";
       $hargadiskon="<div class='prod_price'>
                        <div style='margin-bottom:4px;margin-top:4px;'><span style='text-decoration:line-through;' class='price2'>Rp. $harga,-</span> <br /></div>
                        <div class='s_price'><span class='s_currency s_before'> $r[diskon]% </span></div>

	                     <div><span class='price'>Rp. <b>$hargadisc,-</b></span></div>
	                  </div>";
         if ($d!= "0"){
         $divharga=$hargadiskon;
         $harganya = $hargadisc;
         $komen = "<b>DISKON $r[diskon]% !!</b>";
         }else{
         $divharga=$hargatetap;
         $harganya = $harga;
         $komen = "";
         } 

       $s=$r['stok'];
       $stoknya = "<div class='prod_stok'>Stok: $s</div>";
       $limitedStock = "";
       if($s<=3 && $s!=0)
       {
         if($komen=="")
         {
            $limitedStock = "<b>STOK TERBATAS..! ($s)</b>";
         }
         else
         {
            $limitedStock = "<br><b>STOK TERBATAS..! ($s)</b>";
         }
       }
       echo "<div class='prod_box_scroll'>
             <div class='top_prod_box'></div> 
             <div class='center_prod_box'>            
                <div class='product_title'><a href='produk-$r[id_produk]-$r[produk_seo].html#read'>$r[nama_produk]</a></div>

                <div class='product_img'>
                                ";
   if($setting_thumbnail=="zoom") {
      echo "<a href='produk-$r[id_produk]-$r[produk_seo].html#read'><a href='foto_produk/$r[gambar]' rel='clearbox[gallery=Produk Terbaru,,title=$r[nama_produk],,comment=<big>Harga : Rp. $harganya,- $komen</big>]'>
                  <img src='foto_produk/small/small_$r[gambar]' border='0' height=$tinggithumbnail   class='tooltip' title='klik untuk memperbesar gambar<br>$komen $limitedStock'>";
   }
   else {
      echo "<a href='produk-$r[id_produk]-$r[produk_seo].html#read'>

                  <img src='foto_produk/small/small_$r[gambar]' border='0' height=$tinggithumbnail   class='tooltip' title='klik untuk melihat detail'>";
   }
   echo "</a>

                </div>
                $divharga
                $stoknya
                </div>

             <div class='bottom_prod_box'></div>
             <div class='prod_details_tab'>
                $tombol            
                <a href='produk-$r[id_produk]-$r[produk_seo].html#read' class='prod_details'>DETAIL</a> 

             </div>
             </div>";
        }    
        echo "</div>";
        echo "<div class='clear'>";
   }
   $skat = mysql_query("SELECT * FROM kategori ORDER BY id_kategori");
   while($rkat = mysql_fetch_array($skat)) {
     echo "<h4 class='heading colr'><big>Kategori: Koleksi $rkat[nama_kategori]</big></h4>"; ?>
     <div class="scrollerSemuaKategori">

  <?php
  $sql=mysql_query("SELECT * FROM produk WHERE id_kategori='$rkat[id_kategori]' ORDER BY rand() DESC LIMIT 6");
  while ($r=mysql_fetch_array($sql)){
    $harga = format_rupiah($r[harga]);
    $disc     = ($r[diskon]/100)*$r[harga];
    $hargadisc     = number_format(($r[harga]-$disc),0,",",".");
    $stok=$r['stok'];
    $tombolbeli="<a class='prod_cart' href=\"aksi.php?module=keranjang&act=tambah&id=$r[id_produk]\">BELI</a>";
    $tombolhabis="<span class='prod_cart_habis'></span>";
      if ($stok!= "0"){
      $tombol=$tombolbeli;
      }else{
      $tombol=$tombolhabis;
      } 

    $d=$r['diskon'];
    $hargatetap="<div class='prod_price'>

                    <span class='price'></span>
                    <span class='price'> Rp. <b>$hargadisc,-</b></span>

                 </div>";
    $hargadiskon="<div class='prod_price'>


                     <div style='margin-bottom:4px;margin-top:4px;'><span style='text-decoration:line-through;' class='price2'>Rp. $harga,-</span> <br /></div>

                     <div class='s_price'><span class='s_currency s_before'> $r[diskon]% </span></div>
	                  <div><span class='price'>Rp. <b>$hargadisc,-</b></span></div>


	               </div>";
      if ($d!= "0"){
      $divharga=$hargadiskon;
      $harganya = $hargadisc;
      $komen = "<b>DISKON $r[diskon]% !!</b>";
      }else{
      $divharga=$hargatetap;
      $harganya = $harga;
      $komen = "";
      } 

    $s=$r['stok'];
    $stoknya = "<div class='prod_stok'>Stok: $s</div>";
    $limitedStock = "";
    if($s<=3 && $s!=0)
    {
      if($komen=="")
      {
         $limitedStock = "<b>STOK TERBATAS..! ($s)</b>";
      }
      else
      {
         $limitedStock = "<br><b>STOK TERBATAS..! ($s)</b>";
      }
    }
    echo "<div class='$classsemuakategori'>
          <div class='top_prod_box'></div> 
          <div class='center_prod_box'>            
             <div class='product_title'><a href='produk-$r[id_produk]-$r[produk_seo].html#read'>$r[nama_produk]</a></div>
             <div class='product_img'>
                             ";
if($setting_thumbnail=="zoom") {
   echo "<a href='produk-$r[id_produk]-$r[produk_seo].html#read'><a href='foto_produk/$r[gambar]' rel='clearbox[gallery=Produk Terbaru,,title=$r[nama_produk],,comment=<big>Harga : Rp. $harganya,- $komen</big>]'>
               <img src='foto_produk/small/small_$r[gambar]' border='0' height=$tinggithumbnail   class='tooltip' title='klik untuk memperbesar gambar<br>$komen $limitedStock'>";
}
else {
   echo "<a href='produk-$r[id_produk]-$r[produk_seo].html#read'>
               <img src='foto_produk/small/small_$r[gambar]' border='0' height=$tinggithumbnail   class='tooltip' title='klik untuk melihat detail'>";
}
echo "</a>

             </div>
             $divharga
             $stoknya
             </div>
          <div class='bottom_prod_box'></div>
          <div class='prod_details_tab'>
             $tombol            
             <a href='produk-$r[id_produk]-$r[produk_seo].html#read' class='prod_details'>DETAIL</a> 
          </div>

          </div>";
     }    
     echo "</div><div class='clear'></div>
      <div id='infoTambahan' align='center' style='cursor:pointer;' onclick='location.href=\"kategori-$rkat[id_kategori]-$rkat[kategori_seo].html#read\"'><h4>Klik di sini untuk melihat semua koleksi $rkat[nama_kategori]</h4></div>
     ";
     echo "<div class='clear'></div><br>";
   }
   echo "<br></br>";
}

// Modul Produk ON-SALE
elseif ($_GET[module]=='onsale'){
  $onsale = mysql_query("SELECT * FROM setting WHERE stok<=$w_kategorionsale_isi AND stok!=0");
  $ronsale=mysql_fetch_array($onsale);
  
  // semua onsale
  if($_GET['halonsale']>1)
  {
   $halamannya=" - Halaman ".$_GET['halonsale'];
  }
  echo "<span id='view'></span>";
  echo "<h4 class='heading colr'><big>Produk ON SALE..!</big></h4>";
  // Tentukan berapa data yang akan ditampilkan per halaman (paging)
  $p      = new Pagingonsale;
  $batas  = $setting_semuajumlah;
  $posisi = $p->cariPosisi($batas);

  // Tampilkan semua produk
  $sql=mysql_query("SELECT * FROM produk WHERE stok<=$w_kategorionsale_isi AND stok!=0 ORDER BY id_produk DESC LIMIT $posisi,$batas");

  while ($r=mysql_fetch_array($sql)){
    $harga = format_rupiah($r[harga]);
    $disc     = ($r[diskon]/100)*$r[harga];
    $hargadisc     = number_format(($r[harga]-$disc),0,",",".");
    $stok=$r['stok'];
    $tombolbeli="<a class='prod_cart' href=\"aksi.php?module=keranjang&act=tambah&id=$r[id_produk]\">BELI</a>";
    $tombolhabis="<span class='prod_cart_habis'></span>";
      if ($stok!= "0"){
      $tombol=$tombolbeli;
      }else{
      $tombol=$tombolhabis;
      } 

    $d=$r['diskon'];
    $hargatetap="<div class='prod_price'>
                    <span class='price'></span>
                    <span class='price'> Rp. <b>$hargadisc,-</b></span>
                 </div>";
    $hargadiskon="<div class='prod_price'>
                     <div style='margin-bottom:4px;margin-top:4px;'><span style='text-decoration:line-through;' class='price2'>Rp. $harga,-</span> <br /></div>
                     <div class='s_price'><span class='s_currency s_before'> $r[diskon]% </span></div>
	                  <div><span class='price'>Rp. <b>$hargadisc,-</b></span></div>
	               </div>";
      if ($d!= "0"){
      $divharga=$hargadiskon;
      $harganya = $hargadisc;
      $komen = "<b>DISKON $r[diskon]% !!</b>";
      }else{
      $divharga=$hargatetap;
      $harganya = $harga;
      $komen = "";
      } 

    $s=$r['stok'];
    $stoknya = "<div class='prod_stok'>Stok: $s</div>";
    $limitedStock = "";
    if($s<=3 && $s!=0)
    {
      if($komen=="")
      {
         $limitedStock = "<b>STOK TERBATAS..! ($s)</b>";
      }
      else
      {
         $limitedStock = "<br><b>STOK TERBATAS..! ($s)</b>";
      }
    }
    echo "<div class='prod_box'>
          <div class='top_prod_box'></div> 
          <div class='center_prod_box'>            
             <div class='product_title'><a href='produk-$r[id_produk]-$r[produk_seo].html#read'>$r[nama_produk]</a></div>
             <div class='product_img'>
";
if($setting_thumbnail=="zoom") {
   echo "<a href='produk-$r[id_produk]-$r[produk_seo].html#read'><a href='foto_produk/$r[gambar]' rel='clearbox[gallery=Produk Terbaru,,title=$r[nama_produk],,comment=<big>Harga : Rp. $harganya,- $komen</big>]'>
               <img src='foto_produk/small/small_$r[gambar]' border='0' height=$tinggithumbnail   class='tooltip' title='klik untuk memperbesar gambar<br>$komen $limitedStock'>";
}
else {
   echo "<a href='produk-$r[id_produk]-$r[produk_seo].html#read'>
               <img src='foto_produk/small/small_$r[gambar]' border='0' height=$tinggithumbnail   class='tooltip' title='klik untuk melihat detail'>";
}
echo "</a>

             </div>
             $divharga
             $stoknya

             </div>
          <div class='bottom_prod_box'></div>
          <div class='prod_details_tab'>
             $tombol            

             <a href='produk-$r[id_produk]-$r[produk_seo].html#read' class='prod_details'>DETAIL</a> 
          </div>
          </div>";
  }  
    
  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM produk WHERE stok<=$w_kategorionsale_isi AND stok!=0"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halonsale], $jmlhalaman);
   
  echo "<div class='clear'></div><br/><div class='halaman'>Halaman : $linkHalaman </div>";
}
?>