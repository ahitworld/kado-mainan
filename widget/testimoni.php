<?php
$sekilasall=mysql_query("SELECT * FROM testimoni");
$j=mysql_num_rows($sekilasall);
$sekilas=mysql_query("SELECT * FROM testimoni WHERE status='Y' ORDER BY id_testimoni DESC LIMIT 7");
if ($sekilas > 0){
echo "<div class='category divtestimoni'>";
  echo "<div class='small_heading'>

        </div><ul id='listticker'>";
  while($s=mysql_fetch_array($sekilas)){
   echo "<li>
         Dari <b>$s[nama]</b> di <b>$s[alamat]</b>:<br>
         $s[isi]<br>
         </li>";
  }
}
echo "</ul><a href='javascript:void(0);' class='simplebtn' id='tombolisitestimoni'>Isi Testimoni</a> <span style='float:right;'>Total: $j testimoni</span>";
echo "<div class='clear'></div><div class='left_botm2'>&nbsp;</div></div>";
?>
<div class="category divisitestimoni">
   <div class="small_heading">
   <form action="isi-testimoni.html" method="POST">
   <table border=0 width=100%>
      <tr height="25px">
         <td align='center' height="20px"><b>Isi Testimonial</b><br>Semua kolom berikut harus diisi:<br>
         <input type="text" title="nama" id="testimoninama" name="testimoninama" size="20" style="width:100%;text-align:center;">
         </td>
      </tr>
      <tr height="20px">
         <td align='center' height="20px">
         <input type="text" title="alamat" id="testimonialamat" name="testimonialamat" size="20" style="width:100%;text-align:center;">
         </td>
      </tr>
      <tr height="20px">
         <td align='center' height="20px">
         <input type="text" title="email" id="testimoniemail" name="testimoniemail" size="20" style="width:100%;text-align:center;">
         </td>
      </tr>
      <tr height="25px">
         <td align='center'>Isi Testimoni :<br>
         <textarea title="isi testimoni Anda" id="testimoniisi" name="testimoniisi" style="width:100%;padding:3px;" rows="4"></textarea>
         </td>
      </tr>
      <tr height="25px">
         <td align='center' height="20px">
         <img src="config/captcha.php" width="120px"><br>
         <input type="text" title="isikan 6 kode tsb di sini" id="testimonicaptcha" name="testimonicaptcha" size="20" style="width:100%;text-align:center;">
         </td>
      </tr>
   </table>
   </form>
   <br>
   <a class='simplebtn' id='tombolinputtestimoni'>Kirim Testimoni</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <a href='javascript:void(0);' class='simplebtn' id='tombolbataltestimoni'>Batal</a>
</div>
</div>

<div class="category divhasiltestimoni">
   <div class="small_heading">
      <div id="divisihasiltestimoni">
      </div>
   </div>
</div>

<div class="category divtunggutestimoni">
   <div class="small_heading">
      <center>
      <br><br><br><br><br>
      <img src="images/loading.gif">
      </center>
   </div>
</div>
