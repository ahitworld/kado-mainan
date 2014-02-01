<!--========== WIDGET STATISTIK ==========-->
<div class="poll">
   <div class="small_heading">
      <h5>Statistik Pengunjung</h5>
   </div>
   <table width="111%" border="0" cellspacing="0" cellpadding="0">
      <tr>
         <td width="11%">&nbsp;</td>
         <td width="89%">
         <div align="left">
<?php
 // Statistik user
 $ip= $_SERVER['REMOTE_ADDR']; // Mendapatkan IP komputer user
 $tanggal = date("Ymd"); // Mendapatkan tanggal sekarang
 $waktu = time(); // 

 // Mencek berdasarkan IPnya, apakah user sudah pernah mengakses hari ini 
 $s = mysql_query("SELECT * FROM statistik WHERE ip='$ip' AND tanggal='$tanggal'");
 // Kalau belum ada, simpan data user tersebut ke database
 if(mysql_num_rows($s) == 0){
 mysql_query("INSERT INTO statistik(ip, tanggal, hits, online) VALUES('$ip','$tanggal','1','$waktu')");
 } 
 else{
 mysql_query("UPDATE statistik SET hits=hits+1, online='$waktu' WHERE ip='$ip' AND tanggal='$tanggal'");
 }

 $pengunjung = mysql_num_rows(mysql_query("SELECT * FROM statistik WHERE tanggal='$tanggal' GROUP BY ip"));
 $totalpengunjung= mysql_result(mysql_query("SELECT COUNT(hits) FROM statistik"), 0); 
 $hits = mysql_fetch_assoc(mysql_query("SELECT SUM(hits) as hitstoday FROM statistik WHERE tanggal='$tanggal' GROUP BY tanggal")); 
 $totalhits= mysql_result(mysql_query("SELECT SUM(hits) FROM statistik"), 0); 
 $tothitsgbr = mysql_result(mysql_query("SELECT SUM(hits) FROM statistik"), 0); 
 $bataswaktu = time() - 300;
 $pengunjungonline = mysql_num_rows(mysql_query("SELECT * FROM statistik WHERE online > '$bataswaktu'"));

 $path = "counter/";
 $ext = ".png";

 $tothitsgbr = sprintf("%06d", $tothitsgbr);
 for ( $i = 0; $i <= 9; $i++ ){
 $tothitsgbr = str_replace($i, "<img src='$path$i$ext' alt='$i'>", $tothitsgbr);
 }

 echo "<p align='center'>
 <span class='pengunjung'><img src=counter/online.png> Pengunjung Online : $pengunjungonline <br />
 <span class='pengunjung'><img src=counter/hariini.png> Pengunjung Hari Ini : $pengunjung <br />
  <span class='pengunjung'><img src=counter/hariini.png> Total Pengunjung : $totalpengunjung <br />
 <span class='pengunjung'><img src=counter/hariini.png> Pageview Hari Ini : $hits[hitstoday] <br />
 </p>";
 ?>
      </div></td></tr>
   </table>
</div>
<!--========== /WIDGET STATISTIK ==========-->

