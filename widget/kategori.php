<!--========== WIDGET KATEGORI ==========-->
<div class="myaccount">
   <div class="small_heading">
      <h5>Kategori Produk </h5>
   </div>
   <?php
      if($w_kategori_isi=="Y") {
         $jmlsemua="";$jmlfeatured=""; $jmlonsale;
         $semua = mysql_query("SELECT count(produk.id_produk) as jml from produk");
         $rsemua = mysql_fetch_array($semua);
         $countfeatured = mysql_query("SELECT count(produk.id_produk) as jml from produk WHERE featured='Y'");
         $rcountfeatured = mysql_fetch_array($countfeatured);
         $onsale = mysql_query("SELECT * FROM produk WHERE stok<=$w_kategorionsale_isi AND stok!=0");
         $ronsale = mysql_num_rows($onsale);
         if($setting_countcat=="Y")
         {
            $jmlsemua = "<small>($rsemua[jml])</small>";
            $jmlfeatured = "<small>($rcountfeatured[jml])</small>";
            $jmlonsale = "<small>($ronsale)</small>";
         }
      }
   ?>
   <ul>
   <li><a href='semua-produk.html#read'> Lihat Semua Produk <?=$jmlsemua?></a></li>
   <?php
   if($w_kategorispesial==="Y")
   {
      $featured = mysql_query("SELECT * FROM setting WHERE tipe='featured'");
      $rfeatured=mysql_fetch_array($featured);
      echo "<li><a href='featured.html#read'> ".ucwords(strtolower($rfeatured[value1]))." $jmlfeatured</a></li>";
   }
   if($w_kategorionsale==="Y")
   {
      echo "<li><a href='on-sale.html#read'> ON-SALE..! $jmlonsale</a></li>";
   }
   $kategori=mysql_query("select nama_kategori, kategori.id_kategori, kategori_seo,
   count(produk.id_produk) as jml 
   from kategori left join produk 
   on produk.id_kategori=kategori.id_kategori 
   group by nama_kategori");
   $no=1;
   while($k=mysql_fetch_array($kategori)){
   if($w_kategori_isi=="Y") {
      $jmlcat="";
      if($setting_countcat=="Y") { $jmlcat = "<small>($k[jml])</small>"; }
   }
   echo "<li><a href='kategori-$k[id_kategori]-$k[kategori_seo].html#read'> ".ucwords(strtolower($k[nama_kategori]))." $jmlcat </a></li>";
   $no++;
   }
   if($w_semuakategori==="Y")
   {
      echo "<li><a href='semua-kategori.html#read'> Produk Per Kategori</a></li>";
   }
   ?>
   </ul>
</div>
<!--========== /WIDGET KATEGORI ==========-->

