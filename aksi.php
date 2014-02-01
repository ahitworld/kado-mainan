<?php
session_start();
error_reporting(0);
include "config/koneksi.php";
include "config/library.php";

$module=$_GET[module];
$act=$_GET[act];

if ($module=='keranjang' AND $act=='tambah'){

	$sid = session_id();

	$sql2 = mysql_query("SELECT stok FROM produk WHERE id_produk='$_GET[id]'");
	$r=mysql_fetch_array($sql2);
	$stok=$r[stok];
  
  if ($stok == 0){
      echo "stok habis";
  }
  else{
	// check if the product is already
	// in cart table for this session
	$sql = mysql_query("SELECT t.id_produk, t.jumlah, p.stok FROM orders_temp t, produk p
			WHERE t.id_produk='$_GET[id]' AND id_session='$sid' AND t.id_produk=p.id_produk");
	$ketemu=mysql_num_rows($sql);
   $r = mysql_fetch_array($sql);
	if ($ketemu==0){
		// put the product in cart table
		mysql_query("INSERT INTO orders_temp (id_produk, jumlah, id_session, tgl_order_temp, jam_order_temp, stok_temp)
				VALUES ('$_GET[id]', 1, '$sid', '$tgl_sekarang', '$jam_sekarang', '$stok')");
	} else {
	   if($r[jumlah]==$r[stok]) {
	      //echo "jumlah yang dibeli melebihi stok maksimal";
	   } else {
	      // update product quantity in cart table
		   mysql_query("UPDATE orders_temp 
		           SET jumlah = jumlah + 1
				   WHERE id_session ='$sid' AND id_produk='$_GET[id]'");		
	   }
	}	
	deleteAbandonedCart();
	header('Location:keranjang-belanja.html');
  }				
}

elseif ($module=='keranjang' AND $act=='hapus'){
	mysql_query("DELETE FROM orders_temp WHERE id_orders_temp='$_GET[id]'");
	header('Location:keranjang-belanja.html');				
}

elseif ($module=='keranjang' AND $act=='kosongkan'){
   $sid = session_id();
	$kosongkan = mysql_query("DELETE FROM orders_temp WHERE id_session='$sid'");
	if($kosongkan){ echo "oke"; }
	//header('Location:index.php');				
}

elseif ($module=='keranjang' AND $act=='update'){
  $id       = $_POST[id];
  $jml_data = count($id);
  $jumlah   = $_POST[jml]; // quantity
  for ($i=1; $i <= $jml_data; $i++){
	$sql2 = mysql_query("SELECT stok_temp FROM orders_temp	WHERE id_orders_temp='".$id[$i]."'");
	while($r=mysql_fetch_array($sql2)){
if ($jumlah[$i] > $r[stok_temp]){
echo "<script>window.alert('Jumlah yang dibeli melebihi stok yang ada');
window.location=('keranjang-belanja.html')</script>";
}
elseif($jumlah[$i] == 0){
echo "<script>window.alert('Anda tidak boleh menginputkan angka 0 atau mengkosongkannya!');
window.location=('keranjang-belanja.html')</script>";
} // tambahan update ada disini
else{
mysql_query("UPDATE orders_temp SET jumlah = '".$jumlah[$i]."'
WHERE id_orders_temp = '".$id[$i]."'");
header('Location:keranjang-belanja.html');
    }
  }
  }
}

// Modul isi testimoni
elseif ($module=='isitestimoni') {
   if (isset($_COOKIE["testimonisahara"])) {
      echo "<br>Maaf..<br>Anda sudah mengisi testimoni hari ini.<br><br>Anda bisa mengisi testimoni lagi setelah 24 jam.<br><br>Happy shopping @ SaharaButik.com :)<br><br>Klik tombol untuk kembali<br><br><a class='simplebtn' onclick='selesaiTestimoni();'>Kembali</a>";
   }
   else
   {
      $nama=trim($_POST[n]);
      $alamat=trim($_POST[a]);
      $email=trim($_POST[e]);
      $isi=trim($_POST[i]);
      $captcha=trim($_POST[c]);
      
      if(empty($nama) || empty($alamat) || empty($email) || empty($isi) || empty($captcha))
      {
         echo "<br><br>Ada kolom yang belum diisi.<br><br>Semua kolom harus diisi.<br><br>Silahkan ulangi lagi dengan menekan tombol berikut ini:<br><br><a class='simplebtn tombolulangitestimoni' onclick='ulangiTestimoni();'>Ulangi</a>";
      }
      else
      {
         if($captcha==$_SESSION['captcha_session']){
            setcookie("testimonisahara", "sudah testimoni", time() + 3600 * 24);
            // insert
             $testi = mysql_query("INSERT INTO testimoni(tanggal,
                                      nama,
                                      alamat,
                                      email,
                                      isi,
                                      status) 
                           VALUES('$tgl_sekarang',
                                  '$nama',
                                  '$alamat',
                                  '$email',
                                  '$isi',
                                  'B')");
             if($testi)
             {
               echo "<br>Terima kasih.<br>Testimoni Anda sudah tersimpan di sistem.<br><br>Kami akan melakukan review terlebih dahulu sebelum menampilkan testimoni Anda tersebut.<br><br>Happy shopping @ SaharaButik.com :)<br><br><br>Klik tombol untuk selesai:<br><br><a class='simplebtn' onclick='selesaiTestimoni();'>Selesai</a>";
             }
         }
         else
         {
            echo "<br><br>Kode yang dimasukkan salah..<br><br>Silahkan ulangi lagi dengan menekan tombol berikut ini:<br><br><a class='simplebtn tombolulangitestimoni' onclick='ulangiTestimoni();'>Ulangi</a>";
         }
      }
   }
}

/*
	Delete all cart entries older than one day
*/
function deleteAbandonedCart(){
	$kemarin = date('Y-m-d', mktime(0,0,0, date('m'), date('d') - 1, date('Y')));
	mysql_query("DELETE FROM orders_temp 
	        WHERE tgl_order_temp < '$kemarin'");
}
?>
