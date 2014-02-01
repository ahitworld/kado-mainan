<?php
   $cekorder = mysql_query("SELECT * FROM orders WHERE status_order='Baru'");
   $order = mysql_num_rows($cekorder);
   $cektesti = mysql_query("SELECT * FROM testimoni WHERE status='B'");
   $testi = mysql_num_rows($cektesti);
   
   $jum = $order+$testi;
   if($jum!=0) {$notif = "( $jum )"; } else { $notif=""; }
   if($order!=0) {$notiforder = "($order)"; } else { $notiforder=""; }
   if($testi!=0) {$notiftesti = "($testi)"; } else { $notiftesti=""; }
?>
<li><a id="menutoko" href="#">TOKO ONLINE &nbsp;<?=$notif?></a>
   <ul id="ultoko">
      <li><a href='?module=produk'><b>Kelola Produk</b></a></li>
      <li><a href='?module=kategori'><b>Kelola Kategori Produk</b></a></li>
      <li><a href='?module=order'><b>Lihat Order Masuk &nbsp;<?=$notiforder?></b></a></li>
      <li><a href='?module=laporan'><b>Lihat Laporan Transaksi</b></a></li>
      <li><a href='?module=jasakirim'><b>Edit Jasa Pengiriman</b></a></li>
      <li><a href='?module=ongkoskirim'><b>Edit Ongkos Kirim</b></a></li>
      <li><a href='?module=testimoni'><b>Lihat Testimonial &nbsp;<?=$notiftesti?></b></a></li>
	</ul>
</li>

