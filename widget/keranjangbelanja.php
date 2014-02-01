<!--========== /WIDGET KERANJANG BELANJA ==========-->
<div class="mycart">
   <div class="small_heading">
      <h5>Keranjang Belanja</h5>
   </div>
<?php
	$sid = session_id();
	$sql = mysql_query("SELECT * FROM orders_temp, produk 
			                WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
   $ketemu=mysql_num_rows($sql);
   if($ketemu < 1){
      $totalitem=0; $subtotalwidget_rp=0;
      ?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="80%" valign="center"><b>Keranjang belanja masih kosong!</b><span class='border_cart'></span></td>
          <td width="20%"><img src="images/keranjang.png" width="40"></td>
        </tr>
        <tr>
           <td colspan="2">
               Mulai belanja dengan meng-klik tombol BELI di produk yang diinginkan..
           </td>
        </tr>
      </table>
      <?php
    }
    else {
      $sqljml = mysql_query("SELECT SUM(jumlah) as totalitem FROM orders_temp, produk 
			                WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
		$data=mysql_fetch_row($sqljml);
      $totalitem=$data[0];
      ?>
      <table id="tabelCart" height="100%" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="80%" valign="center"><b>Ada <?=$totalitem?> item di keranjang belanja Anda:</b></span> <a href='javascript:void(0)' onclick='kosongkan()'>(kosongkan!)</a><span class='border_cart'></td>
          <td width="20%"><img src="images/keranjang.png" width="40"></td>
        </tr>
        <tr>
           <td colspan="2">
            <table class='widgetkeranjang' border='0' width='100%'>
             <?php
                while($r=mysql_fetch_array($sql)){
                   $disc        = ($r[diskon]/100)*$r[harga];
                   $hargadisc   = number_format(($r[harga]-$disc),0,",",".");
                   $subtotal    = ($r[harga]-$disc) * $r[jumlah];
                   $total       = $total + $subtotal;  
                   $subtotal_rp = format_rupiah($subtotal);
                   $total_rp    = format_rupiah($total);
                   $harga       = format_rupiah($r[harga]);
                   $subtotalwidget+=$subtotal;
                   $subtotalwidget_rp = format_rupiah($subtotalwidget);
                   echo "
                     <tr>
                        <td rowspan='2' align='center' valign='center' width='20px'>$r[jumlah] x</td>
                        <td colspan='2'>
                           <a href='produk-$r[id_produk]-$r[produk_seo].html#read'> $r[nama_produk]</a>
                        </td>
                     </tr>
                     <tr>
                        <td>@ Rp $hargadisc</td>
                        <td align='right'>
                           = Rp $subtotal_rp &nbsp;<a href='aksi.php?module=keranjang&act=hapus&id=$r[id_orders_temp]' onclick='return confirm(\"Hapus produk ini dari keranjang?\\n$r[nama_produk] - Rp $subtotal_rp\");'><img src='images/kali.png' class='tooltip' title='hapus?'></a>
                        </td>
                     </tr>
                     <tr>
                        <td colspan='3'>
                           <hr>
                        </td>
                     </tr>
                   ";
                }
             ?>
                     <tr>
                        <td colspan='2'>
                           <b>Sub Total</b>
                        </td>
                        <td align='right'>
                           = <b>Rp <?=$subtotalwidget_rp?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </td>
                     </tr>
                     <tr>
                        <td colspan='3'>
                           <hr>
                        </td>
                     </tr>
                     <tr>
                        <td colspan='3' align='center'>
                           (belum termasuk ongkos kirim)
                        </td>
                     </tr>
                     <tr>
                        <td colspan='3' align='center' valign='center'>
                           <img src='images/keranjang2.png'> <a style='font-weight:bold;' href='keranjang-belanja.html#read'>Lihat Keranjang</a> <img src='images/keranjang2.png'>
                        </td>
                     </tr>
                     <tr>
                        <td colspan='3' align='center' valign='center'>
                           <img src='images/keranjang2.png'> <a style='font-weight:bold;' href='selesai-belanja.html#read'>Checkout / Ke Kasir</a> <img src='images/keranjang2.png'>
                        </td>
                     </tr>
             </table>
           </td>
        </tr>
      </table>
      <?php
      }
?>
</div>
<!--========== /WIDGET KERANJANG BELANJA ==========-->

