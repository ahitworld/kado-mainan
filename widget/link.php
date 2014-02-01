<!--========== WIDGET LINK ==========-->
<div class="poll">
   <div class="small_heading">
      <h5>Link Terkait</h5>
   </div>
   <table width="51%" border="0" cellspacing="0" cellpadding="0">
      <tr>
         <td><div align="center"><span class="banner_adds">
         <?php
         $banner=mysql_query("SELECT * FROM banner ORDER BY id_banner DESC LIMIT 4");
         while($b=mysql_fetch_array($banner)){
         echo "<p align='left'><a href='$b[url]'' target='_blank' title='$b[judul]'><img width=200 src='foto_banner/$b[gambar]' border=0></a></p>";
         }
         ?>
         </span></div></td>
      </tr>
   </table>
</div>
<!--========== /WIDGET LINK ==========-->
