<?php
include "../config/library.php";
include "fungsi_indotgl.php";
include "../config/fungsi_combobox.php";
include "../config/class_paging.php";
include "../config/fungsi_rupiah.php";

// Bagian Home
if ($_GET[module]=='home'){
  if ($_SESSION['leveluser']=='admin'){
  echo "<h2 style='margin-top:-10px;'>Dashboard - $setting_namasitus</h2>
          <p>Hai <b>$_SESSION[namalengkap]</b>, selamat datang di halaman Administrator.<br> Silahkan klik menu pilihan yang berada di sebelah kiri untuk mengelola konten website anda. </p>
          <hr style='border:1px dashed #AE595E;'>
          <br/>
          <table class=tabelDashboard>
          ";  
$sqlorder = mysql_query("SELECT * FROM orders WHERE status_order='Baru' ORDER BY id_orders");
$roworder = mysql_num_rows($sqlorder);
if($roworder>0) {
   echo "
         <tr>
            <th> ORDER BARU ( $roworder )
            </th>
         </tr>
      ";
   $no=1;
   while($rorder=mysql_fetch_array($sqlorder)) {
      $sqljml = mysql_query("SELECT SUM(jumlah) as totalitem FROM orders_detail WHERE id_orders='$rorder[id_orders]'");
		$data=mysql_fetch_row($sqljml);
      $totalitem=$data[0];
      
      $sqldetail = mysql_query("SELECT * FROM orders_detail, produk WHERE id_orders='$rorder[id_orders]' AND orders_detail.id_produk=produk.id_produk");
      while($r=mysql_fetch_array($sqldetail)) {
         $disc        = ($r[diskon]/100)*$r[harga];
         $hargadisc   = number_format(($r[harga]-$disc),0,",",".");
         $subtotal    = ($r[harga]-$disc) * $r[jumlah];
         $total       = $total + $subtotal;  
         $subtotal_rp = format_rupiah($subtotal);
         $total_rp    = format_rupiah($total);
         $harga       = format_rupiah($r[harga]);
         $subtotalwidget+=$subtotal;
         $subtotalwidget_rp = format_rupiah($subtotalwidget);
      }
      echo "
         <tr>
            <td>$no. <a href='media.php?module=order&act=detailorder&id=$rorder[id_orders]'>".tgl_indo($rorder[tgl_order])." &nbsp;-&nbsp; $rorder[nama_kustomer] (Telp: $rorder[telpon]) &nbsp;-&nbsp; Belanja $totalitem item &nbsp;-&nbsp; Total Rp $subtotalwidget_rp </a>
            </td>
         </tr>
      ";
      $subtotalwidget=0;
      $no++;
   }
} else {
   echo "
         <tr>
            <th> ORDER BARU ( $roworder )
            </th>
         </tr>
      ";
}
      echo "</table>
            <table class=tabelDashboard>";
$sqltesti = mysql_query("SELECT * FROM testimoni WHERE status='B' ORDER BY id_testimoni");
$rowtesti = mysql_num_rows($sqltesti);
if($rowtesti>0) {
   echo "
         <tr>
            <th> TESTIMONI BARU ( $rowtesti )
            </th>
         </tr>
      ";
      $testidetail = mysql_query("SELECT * FROM testimoni WHERE status='B'");
      $no=1;
      while($r=mysql_fetch_array($testidetail)) {
         $isi = substr($r[isi],0,50);
         echo "
         <tr>
            <td>$no. <a href='media.php?module=testimoni&act=view&id=$r[id_testimoni]'>".tgl_indo($r[tanggal])." &nbsp;-&nbsp; Dari $r[nama] &nbsp;-&nbsp; Di $r[alamat] &nbsp;-&nbsp; $isi..</a>
            </td>
         </tr>
         ";
         $no++;
      }
} else {
   echo "
         <tr>
            <th> TESTIMONI BARU ( $rowtesti )
            </th>
         </tr>
      ";
}
  echo "</table>";
  echo "<hr style='border:1px dashed #AE595E;'><br/><p align=right>Login : $hari_ini, ";
  echo tgl_indo(date("Y m d")); 
  echo " | "; 
  echo date("H:i:s");
  echo " WIB</p>";
  }
}
elseif (!empty($_GET[module])){
  if ($_SESSION['leveluser']=='admin'){
   if($_GET[modul]!="home") {
      $incl = include "modul/mod_".$_GET[module]."/".$_GET[module].".php";
   }
  }
  if(!$incl)
   {
      echo "<p><b>MODUL BELUM ADA ATAU BELUM LENGKAP</b></p>";
   }
}

/*
// Bagian Modul
elseif ($_GET[module]=='modul'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_modul/modul.php";
  }
}

// Bagian Kategori
elseif ($_GET[module]=='kategori'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_kategori/kategori.php";
  }
}

// Bagian Produk
elseif ($_GET[module]=='produk'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_produk/produk.php";
  }
}
// Bagian Best Seller
elseif ($_GET[module]=='bestseller'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_bestseller/bestseller.php";
  }
}


// Bagian Order
elseif ($_GET[module]=='order'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_order/order.php";
  }
}

// Bagian Profil
elseif ($_GET[module]=='profil'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_profil/profil.php";
  }
}

// Bagian Order
elseif ($_GET[module]=='hubungi'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_hubungi/hubungi.php";
  }
}

// Bagian Cara Pembelian
elseif ($_GET[module]=='carabeli'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_carabeli/carabeli.php";
  }
}

// Bagian Cara Pembayaran
elseif ($_GET[module]=='carabayar'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_carabayar/carabayar.php";
  }
}

// Modul bank
elseif ($_GET[module]=='bank'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_bank/bank.php";
  }
}

// Bagian Banner
elseif ($_GET[module]=='banner'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_banner/banner.php";
  }
}


// Bagian Header
elseif ($_GET[module]=='header'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_header/header.php";
  }
}

// Bagian Menu Utama
elseif ($_GET['module']=='menuutama'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_menuutama/menuutama.php";
  }
}


// Bagian Sub Menu
elseif ($_GET['module']=='submenu'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_submenu/submenu.php";
  }
}


// Bagian Kota/Ongkos Kirim
elseif ($_GET[module]=='ongkoskirim'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_ongkoskirim/ongkoskirim.php";
  }
}

// Bagian Password
elseif ($_GET[module]=='password'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_password/password.php";
  }
}

// Bagian Laporan
elseif ($_GET[module]=='laporan'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_laporan/laporan.php";
  }
}


elseif ($_GET['module']=='jasapengiriman'){
if ($_SESSION['leveluser']=='admin'){
  require_once "modul/mod_pengiriman/pengiriman.php";
  }
}


// Bagian YM
elseif ($_GET[module]=='ym'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_ym/ym.php";
  }
}

// Bagian Selamat Datang
elseif ($_GET[module]=='welcome'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_welcome/welcome.php";
  }
}

// Bagian Jasa Kirim
elseif ($_GET['module']=='jasapengiriman'){
if ($_SESSION['leveluser']=='admin'){
  require_once "modul/mod_pengiriman/pengiriman.php";
  }
}

// Bagian Download
elseif ($_GET['module']=='download'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_download/download.php";
  }
}
// Bagian Sekilas Info
elseif ($_GET['module']=='sekilasinfo'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_sekilasinfo/sekilasinfo.php";
  }
}

// Bagian Poling
elseif ($_GET['module']=='poling'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_poling/poling.php";
  }
}

// Bagian Shoutbox
elseif ($_GET['module']=='shoutbox'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_shoutbox/shoutbox.php";
  }
}

// Apabila modul tidak ditemukan
else{
  echo "<p><b>MODUL BELUM ADA ATAU BELUM LENGKAP</b></p>";
}
*/
?>
