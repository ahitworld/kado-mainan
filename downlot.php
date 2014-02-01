<?php
if(empty($_GET['warning']))
{ /*
   include "config/koneksi.php";

   $direktori = "files/"; // folder tempat penyimpanan file yang boleh didownload
   $filename = $_GET['file'];

   $file_extension = strtolower(substr(strrchr($filename,"."),1));

   switch($file_extension){
     case "pdf": $ctype="application/pdf"; break;
     case "exe": $ctype="application/octet-stream"; break;
     case "zip": $ctype="application/zip"; break;
     case "rar": $ctype="application/rar"; break;
     case "doc": $ctype="application/msword"; break;
     case "xls": $ctype="application/vnd.ms-excel"; break;
     case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
     case "gif": $ctype="image/gif"; break;
     case "png": $ctype="image/png"; break;
     case "jpeg":
     case "jpg": $ctype="image/jpg"; break;
     default: $ctype="application/proses";
   }

   if ($file_extension=='php'){
     echo "<h1>Access forbidden!</h1>
           <p>Maaf, file yang Anda download sudah tidak tersedia atau filenya (direktorinya) telah diproteksi. <br />
           Silahkan hubungi <a href='mailto:rizal_fzl@yahoo.com'>webmaster</a>.</p>";
     exit; 
   }
   else{
     mysql_query("update download set hits=hits+1 where nama_file='$filename'");

     header("Content-Type: octet/stream");
     header("Pragma: private"); 
     header("Expires: 0");
     header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
     header("Cache-Control: private",false); 
     header("Content-Type: $ctype");
     header("Content-Disposition: attachment; filename=\"".basename($filename)."\";" );
     header("Content-Transfer-Encoding: binary");
     header("Content-Length: ".filesize($direktori.$filename));
     readfile("$direktori$filename");
     exit();   
   } */ echo "<pre>:)</pre>";
}
else
{
   // Download check............
   echo base64_decode("
      PHRpdGxlPldhcm5pbmchPC90aXRsZT48L2hlYWQ+PHAgY2xhc3M9Indhcm5pbmciIH
      N0eWxlPSJwYWRkaW5nOjIwcHg7IG1hcmdpbjogMjBweDsgdGV4dC1hbGlnbjpjZW50
      ZXI7IGJvcmRlcjogMnB4IGRvdHRlZCAjMDAwMGZmOyBmb250LWZhbWlseTphcmlhbD
      sgZm9udC13ZWlnaHQ6Ym9sZDsgYmFja2dyb3VuZDogI2ZmZjsgY29sb3I6ICMwMDAw
      ZmY7Ij5VcHMuLiBTZXBlcnRpbnlhIGFkYSB5YW5nIHNhbGFoLi48YnIvPjxici8+RG
      ltb2hvbiB1bnR1ayB0aWRhayBtZW5naGFwdXMgYXRhdSBtZW5nZ2FudGkgdHVsaXNh
      biBrcmVkaXQgJiBsaW5rIHlhbmcgYWRhIHBhZGEgZm9vdGVyLjxici8+QW5kYSBtYX
      NpaCBiaXNhIG1lbmFtYmFoa2FuIGtyZWRpdCAmIGxpbmsgbWlsaWsgQW5kYSBrb2ss
      IHRhcGkgamFuZ2FuIG1lbmdoYXB1cyBhdGF1IG1lbmd1YmFoIHlhbmcgc2ViZWx1bW
      55YS48YnIvPldlYnNpdGUgYWthbiBiaXNhIGRpYWtzZXMgbGFnaSBzZXRlbGFoIGty
      ZWRpdCAmIGxpbmsgeWFuZyBhc2xpIGRpa2VtYmFsaWthbi48YnIvPjxici8+TWFyaS
      BraXRhIGJ1ZGF5YWthbiB1bnR1ayBtZW5naGFyZ2FpIGthcnlhIG9yYW5nIGxhaW4s
      IGRhbiBtZW5qdW5qdW5nIHRpbmdnaSBzZW1hbmdhdCBiZWxhamFyIGRhbiBzYWxpbm
      cgbWVsZW5na2FwaS48YnIvPkJ1a2FuIG1lbWJ1ZGF5YWthbiB5YW5nIHNlcmJhIGlu
      c3RhbiA6KTxici8+PGJyLz48YnIvPkA8YSBzdHlsZT0idGV4dC1kZWNvcmF0aW9uOm
      5vbmU7ImhyZWY9Imh0dHA6Ly9nb2ppLndlYi5pZCIgdGFyZ2V0PSJibGFuayI+Z29q
      aWdlamU8L2E+PC9wPg==
   ");
}
?>
