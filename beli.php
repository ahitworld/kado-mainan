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

        <div class="divnya center">
          Order Sekarang! <?php if (!empty($setting_nohp1) || !empty($setting_nohp2)) {
            echo "via SMS ";
          } if (!empty($setting_pinbb) || !empty($setting_pinbb2)) {
            echo "atau BBM!";
          }?>
          <br>
          <p class="ketik">
          <?php 
            if (!empty($setting_nohp1)) {
              echo "<img src='images/tel.gif'> <b>$setting_nohp1</b> ";
            }
            if (!empty($setting_nohp2)) {
              echo " ~ <b>$setting_nohp2</b> ";
            }

            if (!empty($setting_pinbb)) {
              echo "&nbsp; <img src='images/bb.png'> <b>$setting_pinbb</b> ";
            }
          ?> 
          <br>
          <span class="ketiknya">Ketik: ORDER [spasi] KODE/NAMA PRODUK [spasi] NAMA & ALAMAT ANDA</span>
        </p>
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
                    Harga: Rp. <?=$hargadisc?> <?php if ($d[diskon]!=0) {
                      echo "<br><span class='hargadiskon'>Normal: <s>Rp $harga</s></span>";
                    } ?>
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
?>