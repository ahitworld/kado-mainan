<div class="rotating_banner">
   <div class="anythingSlider">
      <div class="wrapper">
         <ul>
<?php
$header=mysql_query("SELECT * FROM header ORDER BY id_header DESC LIMIT 4");
while($b=mysql_fetch_array($header)){
  echo "<li><img width='690px' height='210px' src='header/$b[gambar]'></li>";
}?>
         </ul>
      </div>
   </div>
</div>
