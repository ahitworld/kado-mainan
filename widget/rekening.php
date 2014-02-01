<!--========== WIDGET REKENING ==========-->
<div class="poll">
   <div class="small_heading">
      <h5>Bank Pembayaran </h5>
   </div>
   <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
         <td><div align="center"><span class="border_box">
            <?php
            $bank=mysql_query("SELECT * FROM mod_bank ORDER BY id_bank ASC");
            while($b=mysql_fetch_array($bank)){
            echo "<span class='bank'>Bank $b[nama_bank]</a></div>
            <div class='bank'>
            <img src='foto_banner/$b[gambar]' border='0' width='100px'>
            </a>
            </div>
            <div class='bank'><span class='bank'>No. Rek : $b[no_rekening]
            <div class='bank'><span class='bank'>an. $b[pemilik]</span></div><div class='clear'></div><span class='border_cart'></span>";
            }
            ?>
         </span></div></td>
      </tr>
   </table>
</div>
<!--========== /WIDGET REKENING ==========-->

