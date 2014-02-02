<!--========== WIDGET KONTAK SIDE ==========-->
<div class="poll">
   <div class="small_heading">
      <h5>Kontak <?=$setting_namasitus?></h5>
   </div>
   <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
         <td>
         <div align="center">
               
               <?php 
                  // hp
                  if ($setting_nohp1_tampil!="" || $setting_nohp2_tampil!="") {
                     echo "
                        <span class='bold' style='font-size:15px;'>Via SMS</span><br>
                     ";
                     if (!empty($setting_nohp1)) {
                        echo "
                           <img src='images/tel.gif'> <span class='bold' style='font-size:15px;'> $setting_nohp1</span><br>
                        ";
                     }
                     if (!empty($setting_nohp2)) {
                        echo "
                           <img src='images/tel.gif'> <span class='bold' style='font-size:15px;'> $setting_nohp2</span><br>
                        ";
                     }
                     echo "<br>";
                  }

                  // bb
                  if ($setting_pinbb_tampil!="" || $setting_pinbb2_tampil!="") {
                     echo "
                        <span class='bold' style='font-size:15px;'>PIN BB</span><br>
                     ";
                     if (!empty($setting_pinbb)) {
                        echo "
                           <img src='images/bb.png'> <span class='bold' style='font-size:15px;'> $setting_pinbb</span><br>
                        ";
                     }
                     if (!empty($setting_pinbb2)) {
                        echo "
                           <img src='images/bb.png'> <span class='bold' style='font-size:15px;'> $setting_pinbb2</span><br>
                        ";
                     }
                     echo "<br>";
                  }

                  // ym
                  if ($setting_ym1_tampil!="" || $setting_ym2_tampil!="") {
                     echo "
                        <span class='bold' style='font-size:15px;'><img src='images/ym.png'> Yahoo Messenger</span><br>
                     ";
                     if (!empty($setting_ym1)) {
                        echo "
                           <span class='bold' style='font-size:15px;'> $setting_ym1</span><br>
                           <a href='ymsgr:sendim?$setting_ym1'><img border=0 src='http://opi.yahoo.com/online?u=$setting_ym1&amp;m=g&amp;t=2' /> </a> <br>
                        ";
                     }
                     if (!empty($setting_ym2)) {
                        echo "
                           <span class='bold' style='font-size:15px;'> $setting_ym2</span><br>
                           <a href='ymsgr:sendim?$setting_ym2'><img border=0 src='http://opi.yahoo.com/online?u=$setting_ym2&amp;m=g&amp;t=2' /> </a> <br>
                        ";
                     }
                     echo "<br>";
                  }

                  // wa
                  if ($setting_wa_tampil!="") {
                     echo "
                        <span class='bold' style='font-size:15px;'>WhatsApp</span><br>
                        <img src='images/whatsapp-16.png'> <span class='bold' style='font-size:15px;'> $setting_wa</span><br> <br>
                     ";
                  }

                  // wechat
                  if ($setting_wechat_tampil!="") {
                     echo "
                        <span class='bold' style='font-size:15px;'>WeChat</span><br>
                        <img src='images/wechat-16.png'> <span class='bold' style='font-size:15px;'> $setting_wechat</span><br><br>
                     ";
                  }

                  // kakao
                  if ($setting_kakao_tampil!="") {
                     echo "
                        <span class='bold' style='font-size:15px;'>Kakao Talk</span><br>
                        <img src='images/kakao-16.png'> <span class='bold' style='font-size:15px;'> $setting_kakao</span><br><br>
                     ";
                  }

                  // line
                  if ($setting_line_tampil!="") {
                     echo "
                        <span class='bold' style='font-size:15px;'>Line</span><br>
                        <img src='images/line-16.png'> <span class='bold' style='font-size:15px;'> $setting_line</span><br><br>
                     ";
                  }
               ?>

         </div>
         </td>
      </tr>
   </table>
</div>
<!--========== /WIDGET KONTAK SIDE ==========-->

