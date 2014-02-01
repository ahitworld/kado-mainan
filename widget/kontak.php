<!--========== WIDGET KONTAK SIDE ==========-->
<div class="poll">
   <div class="small_heading">
      <h5>Kontak <?=$setting_namasitus?></h5>
   </div>
   <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
         <td>
         <div align="center">
               <span class="bold" style="font-size:15px;">(SMS Only)</span><br>
               
            	<?php
            	   if(!empty($setting_nohp1))
            	   {
            	      ?>
            	         <img src='images/tel.gif'> <span class="bold" style="font-size:15px;"><?=$setting_nohp1?></span><br>
            	      <?php
            	   }
            	?>
            	<?php
            	   if(!empty($setting_nohp2))
            	   {
            	      ?>
            	         <img src='images/tel.gif'> <span class="bold" style="font-size:15px;"><?=$setting_nohp2?></span><br>
            	      <?php
            	   }
            	?>
            	<br>
            	<?php
            	   if(!empty($setting_pinbb))
            	   {
            	      ?>
            	         <img src='images/bb.png'> <span class="bold" style="font-size:15px;">PIN BB:<br> <big><?=$setting_pinbb?></big></span><br>
            	      <?php
            	   }
            	?>
               <br>
               <img src='images/ym.png'> <span class="bold" style="font-size:15px;">YM kami:<br>saharabutik@ymail.com</span><br>
               <a href="ymsgr:sendim?saharabutik@ymail.com"><img border=0 src="http://opi.yahoo.com/online?u=saharabutik@ymail.com&amp;m=g&amp;t=2" /> </a>
         </div>
         </td>
      </tr>
   </table>
</div>
<!--========== /WIDGET KONTAK SIDE ==========-->

