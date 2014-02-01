<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_testimoni/aksi_testimoni.php";
switch($_GET[act]){
  // Tampil Produk
  default:
      $sqltesti = mysql_query("SELECT * FROM testimoni WHERE status='B' ORDER BY id_testimoni");
      $rowtesti = mysql_num_rows($sqltesti);
      echo "<h2>Testimoni Customer</h2> 
         <a href='media.php?module=testimoni&act=denied'>Tampilkan Testimoni yg Ditolak ( )</a><br/><br/>
      <table class=tabelDashboard>";
      if($rowtesti>0) {
            echo "
               <tr>
                  <th> TESTIMONI BARU ( $rowtesti )
                  </th>
               </tr>
            ";
            $testidetail = mysql_query("SELECT * FROM testimoni WHERE status='B'");
            $no=1;
            while($r=mysql_fetch_array($testidetail)) {
               $isi = substr($r[isi],0,50);
               echo "
               <tr>
                  <td>$no. <a href='media.php?module=testimoni&act=view&id=$r[id_testimoni]'>".tgl_indo($r[tanggal])." &nbsp;-&nbsp; Dari $r[nama] &nbsp;-&nbsp; Di $r[alamat] &nbsp;-&nbsp; $isi..</a>
                  </td>
               </tr>
               ";
               $no++;
            }
      } else {
         echo "
               <tr>
                  <th> TESTIMONI BARU ( $rowtesti )
                  </th>
               </tr>
            ";
      }
      echo "</table>";
      
      $p      = new Paging;
      $batas  = 15;
      $posisi = $p->cariPosisi($batas);
    
      $sqltesti = mysql_query("SELECT * FROM testimoni WHERE status!='B' ORDER BY id_testimoni");
      $rowtesti = mysql_num_rows($sqltesti);
      echo "<table class=tabelDashboard>";
      if($rowtesti>0) {
            echo "
               <tr>
                  <th colspan='2'> TESTIMONI DITERIMA ( $rowtesti )
                  </th>
               </tr>
            ";
            $testidetail = mysql_query("SELECT * FROM testimoni WHERE status!='B' LIMIT $posisi,$batas");
            $no = $posisi+1;
            while($r=mysql_fetch_array($testidetail)) {
               $isi = substr($r[isi],0,50);
               echo "
               <tr>
                  <td>$no. <a href='media.php?module=testimoni&act=view&id=$r[id_testimoni]'>".tgl_indo($r[tanggal])." &nbsp;-&nbsp; Dari $r[nama] &nbsp;-&nbsp; Di $r[alamat] &nbsp;-&nbsp; $isi..</a>
                  </td>
                  <td> <a href='media.php?module=testimoni&act=view&id=$r[id_testimoni]'>Baca</a> | <a href='media.php?module=testimoni&act=terima&id=$r[id_testimoni]'>Terima</a> | <a href='media.php?module=testimoni&act=tolak&id=$r[id_testimoni]' onclick='return confirm(\"Hapus testimoni ini?\");'>Tolak?</a>
                  </td>
               </tr>
               ";
               $no++;
            }
      } else {
         echo "
               <tr>
                  <th> TESTIMONI DITERIMA ( $rowtesti )
                  </th>
               </tr>
            ";
      }
      echo "</table>";
      
      $jmldata = mysql_num_rows(mysql_query("SELECT * FROM testimoni WHERE status!='B'"));   
      $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
      $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

      echo "<div id=paging>Hal: $linkHalaman</div><br>Total: $jmldata testimoni lama";
  
    break;
    
  case "view":
      $sql  = mysql_query("SELECT * FROM testimoni WHERE id_testimoni='$_GET[id]'");
      $r    = mysql_fetch_array($sql);

    echo "<h2>View Testimoni</h2>
          <form method=POST action=media.php?module=testimoni&act=update>
          <input type=hidden name=id value=$r[id_testimoni]>
          <table>
         <tr><td width='100px'>Dari</td><td>: $r[nama]</td></tr>
         <tr><td width='100px'>Alamat</td><td>: $r[alamat]</td></tr>
         <tr><td width='100px'>Email</td><td>: $r[email]</td></tr>
         <tr><td width='100px'>Tanggal</td><td>: ".tgl_indo($r[tanggal])."</td></tr>
         <tr><td width='100px'>Ubah Status</td><td>: 
         ";
         
          $pilihan_status = array('B','Y','N');
          $statusnya = '';
          foreach ($pilihan_status as $status) {
	         $statusnya .= "<option value=$status";
	         if ($status == $r[status]) {
		          $statusnya .= " selected";
	         }
	         if($status=="B") $status="Baru";
	         elseif($status=="Y") $status="Diterima";
	         elseif($status=="N") $status="Ditolak";
	         $statusnya .= ">$status</option>\r\n";
          }
          
    echo "
         <select name='status'>$statusnya</select> (Klik tombol 'Update' di bawah untuk menyimpan status)
         </td></tr>
         <tr><td colspan=2> </td></tr>
         <tr><td>Isi Testimoni</td><td>: <div style='padding:5px 5px 5px 15px; width:95%; overflow:hidden; display:inline-block; background:#fff7f7;'>$r[isi]</div></td></tr>
         <tr><td colspan=2><input type=submit class='tombol' value=Update></td></tr>
         </form></table>";
    break;
    
    case "update":
       mysql_query("UPDATE testimoni SET status='$_POST[status]' WHERE id_testimoni='$_POST[id]'");
     echo "
      <p>Status testimoni berhasil diupdate</p>
      <p><a href='media.php?module=testimoni'>[ klik untuk kembali ]</a></p>
     ";
    break;
}
}
?>
