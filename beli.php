<?php 
  error_reporting(0);
  include 'config/koneksi.php';
  include 'config/settings.php';
  include 'config/fungsi_indotgl.php';
  include 'config/fungsi_rupiah.php';
  include 'config/fungsi_seo.php';

  $id = $_GET[id];
  $detail=mysql_query("SELECT * FROM produk,kategori WHERE kategori.id_kategori=produk.id_kategori AND id_produk='$id'");
  $d   = mysql_fetch_array($detail);
  $num = mysql_num_rows($detail);

  $tgl = tgl_indo($d[tanggal]);
  $harga = format_rupiah($d[harga]);
  $disc     = ($d[diskon]/100)*$d[harga];
  $hargadisc     = number_format(($d[harga]-$disc),0,",",".");

  $linkproduk = "./produk-$id-".seo_title($d[nama_produk]).".html#read";
  $linkadd = "./aksi.php?module=keranjang&act=tambah&id=$id";

  if ($num>0) {
    
    ?>
      
      <!DOCTYPE html>
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="description" content="Harga Rp. <?=$hargadisc?>, hanya ada di <?=$setting_namasitus?>">
            <title>Beli <?=$d[nama_kategori]?> murah <?=$d[nama_produk]?> hanya Rp. <?=$hargadisc?> di <?=$setting_namasitus?></title>
            <link rel="stylesheet" href="css/beli.css">
        </head>
        <body>
          
        <div class="divnya">
          Beli Sekarang!
        </div>

        <div class="divnya">
          <table>
              <tr>
                <td>
                  <img class="gbr" src='foto_produk/small/small_<?=$d[gambar]?>'>
                </td>
                <td>
                  <p class="judul">
                    <?=$d[nama_produk]?>
                  </p>
                  <p class="harga">
                    Harga: Rp. <?=$hargadisc?>
                  </p>
                  <p>
                    <?php 
                      $detil = substr(strip_tags($d[deskripsi]), 0, 100);
                      echo "$detil...";
                    ?>
                  </p>
                  <a class="btlink" href="<?=$linkproduk?>" target="_parent">Lihat Detail Produk</a>
                  <br><a class="btadd" href="<?=$linkadd?>" target="_parent">Masukkan ke Cart</a>
                </td>
              </tr>
          </table>
        </div>

        </body>
      </html>

    <?php

  } else {

    ?>
<!DOCTYPE html>
  <head>
      <META http-equiv='refresh' content='3;URL=http://<?=$setting_alamatsitus?>'>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title><?=$setting_namasitus?> - <?=$setting_tagline?></title>
  </head>
  <body>
    <?=$setting_namasitus?> - <?=$setting_tagline?>
  </body>
</html>
    <?php
  }

    //  if($d[diskon]!=0)
    //  {
    //     $diskonnya ="<div class='s_price'><span class='s_currency s_before'> $d[diskon]% </span></div>";
    //     $hargadiskoncoret = "<div style='font-size:10px;text-decoration:line-through;' class='table7'>Rp. $harga,-</span></div>";
    //  }
    // echo "<h4 id='namaproduknya' class='heading colr'>Detail Produk : <big>$d[nama_produk]</big></h4></div>";
    //  if($setting_detail_fblike=="Y")
    //  {
    //     echo "<fb:like send=\"true\" width=\"600\" show_faces=\"false\"></fb:like>";
    //  }
    // echo"<div class='feat_prod_box_details'>";
    // if ($d[gambar]!='')
    // {
    //   echo "<div class='prod_img3'><a href='foto_produk/$d[gambar]' rel='clearbox[gallery=Koleksi Produk]' title='$d[nama_produk]'><img src='foto_produk/medium/medium_$d[gambar]' width=300  class='tooltip' title='klik untuk memperbesar gambar' border='0' rel='clearbox[gallery=Koleksi Produk]' title='$d[nama_produk]'/></a>
    //   <br>
    //   ( Klik gambar untuk memperbesar )
    //   <br>
    //   <br>
    //   $hargadiskoncoret
    //     <div style='font-size:16px;' class='table6'>Rp. $hargadisc,-</span></div>
    //   $diskonnya
    //   <br>
    //   </div>";
    //  }
    // echo"<div class='details_big_box'>
    //           <div class='product_title_big'>Deskripsi Produk</div>
    //           <div class='details'>$d[deskripsi]</div><br />
    //           <div class='table6'>&bull; HARGA: <span class='table7'>Rp. $hargadisc,-</span></div>
    //           <div class='table6'>&bull; STOK:<span class='table7'> $d[stok] item</span></div><br />";
    //  if($d[stok]!=0)
    //  {
    //     echo "<a href='aksi.php?module=keranjang&act=tambah&id=$d[id_produk]' class='more'><img src='images/belibutton_$setting_tema.png' alt='' width='170px' title='' border='0' /></a>";
    //  }
    //  else
    //  {
    //     echo "<img src='images/habisbutton_$setting_tema.png' alt='' width='170px' title='' border='0' />";
    //  }
?>