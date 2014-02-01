<!--========== WIDGET FEATURED ==========-->
<?php
   $featured = mysql_query("SELECT * FROM setting WHERE tipe='featured'");
   $rfeatured=mysql_fetch_array($featured);
?>
<div class="poll">
 <div class="small_heading">
  <h5>Produk <?=$rfeatured[value2]?></h5>
     </div>
     <div class="productscroll">
     <ul id="produkterbaru">
<?php
  $sql=mysql_query("SELECT * FROM produk, kategori WHERE produk.featured='Y' AND kategori.id_kategori=produk.id_kategori ORDER BY rand() desc LIMIT $w_featured_isi");
  while ($r=mysql_fetch_array($sql)){
    $harga = format_rupiah($r[harga]);
    $disc     = ($r[diskon]/100)*$r[harga];
    $hargadisc     = number_format(($r[harga]-$disc),0,",",".");
    $stok=$r['stok'];
    $apadiskon="";
    $hargalama="";
    if($r[diskon]!=0)
    {
      $apadiskon = "<span class='bold'>Diskon $r[diskon]% !</span><br>";
      $hargalama = "<span style='text-decoration:line-through;'>(Rp $harga)</span>";
    }
    echo "
    <li class='tooltip' title='<center><img src=\"foto_produk/small/small_$r[gambar]\" width=\"150px\"><br>klik untuk melihat detail</center>' onClick='location.href=\"produk-$r[id_produk]-$r[produk_seo].html#read\"'>
      <span class='bold'>
         <a href='produk-$r[id_produk]-$r[produk_seo].html#read'>$r[nama_produk]</a>
      </span>
      <br>
      <small>Kategori: $r[nama_kategori]</small><br>
      $apadiskon
      Harga: Rp $hargadisc $hargalama
    </li>";
  }
?>
     </ul>
     <div class='clear'></div>
     <br>
     <center><a class='simplebtn' href='featured.html#read'> Lihat Semua <?=$rfeatured[value2]?> </a></center>
   </div>
</div>
<!--========== /WIDGET FEATURED ==========-->

