<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_produk/aksi_produk.php";
switch($_GET[act]){
  // Tampil Produk
  default:
    $featured = mysql_query("SELECT * FROM setting WHERE tipe='featured'");
    $rfeatured=mysql_fetch_array($featured);
    echo "<h2>Kelola Produk</h2>
          <input type=button class='tombol' value=' Tambah Produk Baru ' onclick=\"window.location.href='?module=produk&act=tambahproduk';\"><b> &nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;<a href='?module=produk&act=featured'>Tampilkan $rfeatured[value2] saja</a> &nbsp;&nbsp;
          <form method='POST' action='media.php?module=produk&act=cari'>Cari berdasarkan Nama Produk : <input name=cari size=40 title=' Ketik produk yg dicari lalu tekan ENTER'><input type=submit class='tombol' value=' Cari! '></form></b>
          <table>
          <tr><th>No</th><th>Nama Produk</th><th>Berat(kg)</th><th>Harga</th><th>Diskon</th><th>Stok</th><th>Tgl. Masuk</th><th>Aksi</th></tr>";

    $p      = new Paging;
    $batas  = 20;
    $posisi = $p->cariPosisi($batas);

    $tampil = mysql_query("SELECT * FROM produk ORDER BY id_produk DESC LIMIT $posisi,$batas");
  
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
      $tanggal=tgl_indo($r[tgl_masuk]);
      $harga=format_rupiah($r[harga]);
      echo "<tr><td>$no</td>
                <td><a href=?module=produk&act=editproduk&id=$r[id_produk]>$r[nama_produk]</a></td>
                <td align=center>$r[berat]</td>
                <td>Rp $harga</td>
				<td align=center>$r[diskon]%</td>
                <td align=center>$r[stok]</td>
                <td>$tanggal</td>
		            <td><a href=?module=produk&act=editproduk&id=$r[id_produk]><b>Edit</b></a> | 
		                <a href=$aksi?module=produk&act=hapus&id=$r[id_produk] onclick='return confirm(\"Hapus produk ini dari website?\\n$r[nama_produk] ?\");'><b>Hapus</a></b></td>
		        </tr>";
      $no++;
    }
    echo "</table>";

    $jmldata = mysql_num_rows(mysql_query("SELECT * FROM produk"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<div id=paging>Hal: $linkHalaman</div><br>Total: $jmldata produk";
 
    break;
  
  case "featured":
    $featured = mysql_query("SELECT * FROM setting WHERE tipe='featured'");
    $rfeatured=mysql_fetch_array($featured);
    echo "<h2>Kelola Produk \"$rfeatured[value2]\"</h2>
          <input type=button class='tombol' value=' Tambah Produk Baru ' onclick=\"window.location.href='?module=produk&act=tambahproduk';\"><b> &nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;<a href='?module=produk'>Tampilkan Semua Produk</a> &nbsp;&nbsp;
          <form method='POST' action='media.php?module=produk&act=cari'>Cari berdasarkan Nama Produk : <input name=cari size=40 title=' Ketik produk yg dicari lalu tekan ENTER'><input type=submit class='tombol' value=' Cari! '></form></b>
          <table>
          <tr><th>No</th><th>Nama Produk</th><th>Berat(kg)</th><th>Harga</th><th>Diskon</th><th>Stok</th><th>Tgl. Masuk</th><th>Aksi</th></tr>";

    $p      = new Paging;
    $batas  = 15;
    $posisi = $p->cariPosisi($batas);

    $tampil = mysql_query("SELECT * FROM produk WHERE featured='Y' ORDER BY id_produk DESC LIMIT $posisi,$batas");
  
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
      $tanggal=tgl_indo($r[tgl_masuk]);
      $harga=format_rupiah($r[harga]);
      echo "<tr><td>$no</td>
                <td><a href=?module=produk&act=editproduk&id=$r[id_produk]>$r[nama_produk]</a></td>
                <td align=center>$r[berat]</td>
                <td>Rp $harga</td>
				<td align=center>$r[diskon]%</td>
                <td align=center>$r[stok]</td>
                <td>$tanggal</td>
		            <td><a href=?module=produk&act=editproduk&id=$r[id_produk]><b>Edit</b></a> | 
		                <a href=$aksi?module=produk&act=hapus&id=$r[id_produk] onclick='return confirm(\"Hapus produk ini dari website?\\n$r[nama_produk] ?\");'><b>Hapus</a></b></td>
		        </tr>";
      $no++;
    }
    echo "</table>";

    $jmldata = mysql_num_rows(mysql_query("SELECT * FROM produk WHERE featured='Y'"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<div id=paging>Hal: $linkHalaman</div><br>Total: $jmldata produk";
 
    break;
  
  case "tambahproduk":
    $featured = mysql_query("SELECT * FROM setting WHERE tipe='featured'");
    $rfeatured=mysql_fetch_array($featured);
    echo "<h2>Tambah Produk</h2>
          <form method=POST action='$aksi?module=produk&act=input' enctype='multipart/form-data'>
          <table>
          <tr><td width=80>Nama Produk</td>     <td> : <input type=text name='nama_produk' size=60></td></tr>
          <tr><td>Kategori</td>  <td> : 
          <select name='kategori'>
            <option value=0 selected>- Pilih Kategori -</option>";
            $tampil=mysql_query("SELECT * FROM kategori ORDER BY nama_kategori");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[id_kategori]>$r[nama_kategori]</option>";
            }
    echo "</select></td></tr>
          <tr><td colspan=2>Masukkan produk ke '$rfeatured[value2]'? <input type=radio name='featured' value='Y'>Y  
                                      <input type=radio name='featured' value='N' checked>N
          </td></tr>
          <tr><td>Berat</td>     <td> : <input type=text name='berat' size=3> kg (kosongi jika tidak perlu)</td></tr>
          <tr><td>Harga</td>     <td> : <input type=text name='harga' size=10> (tulis langsung tanpa titik | Mis: 100000, 150000, 75000)</td></tr>
		  <tr><td>Diskon</td>     <td> : <input type=text name='diskon' size=3> % (kosongi jika tanpa diskon)</td></tr>
          <tr><td>Stok</td>     <td> : <input type=text name='stok' size=3> pcs (harus diisi, jika dikosongi maka dianggap stok kosong)</td></tr>
          <tr><td>Deskripsi</td>  <td> <textarea name='deskripsi' style='width: 600px; height: 350px;'></textarea></td></tr>
          <tr><td>Gambar</td>      <td> : <input type=file name='fupload' size=40> 
                                          <br>Tipe gambar harus JPG/JPEG dan ukuran lebar maks: 400 px</td></tr>
          <tr><td colspan=2><input type=submit class='tombol' value=Simpan>
                            <input type=button class='tombol' value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
    
  case "editproduk":
    $featured = mysql_query("SELECT * FROM setting WHERE tipe='featured'");
    $rfeatured=mysql_fetch_array($featured);
    $edit = mysql_query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Edit Produk</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=produk&act=update>
          <input type=hidden name=id value=$r[id_produk]>
          <table>
          <tr><td width=80>Nama Produk</td>     <td> : <input type=text name='nama_produk' size=60 value='$r[nama_produk]'></td></tr>
          <tr><td>Kategori</td>  <td> : <select name='kategori'>";
 
          $tampil=mysql_query("SELECT * FROM kategori ORDER BY nama_kategori");
          if ($r[id_kategori]==0){
            echo "<option value=0 selected>- Pilih Kategori -</option>";
          }   

          while($w=mysql_fetch_array($tampil)){
            if ($r[id_kategori]==$w[id_kategori]){
              echo "<option value=$w[id_kategori] selected>$w[nama_kategori]</option>";
            }
            else{
              echo "<option value=$w[id_kategori]>$w[nama_kategori]</option>";
            }
          }
    echo "</select> (pilih kategori utama)</td></tr>";
    if($r[featured]=="Y") {
      echo "<tr><td colspan=2>Masukkan produk ke '$rfeatured[value2]'? <input type=radio name='featured' value='Y' checked>Y <input type=radio name='featured' value='N'>N
          </td></tr>";
    } else {
      echo "<tr><td colspan=2>Masukkan produk ke '$rfeatured[value2]'? <input type=radio name='featured' value='Y'>Y <input type=radio name='featured' value='N' checked>N
          </td></tr>";
    }
    echo "<tr><td>Berat</td>     <td> : <input type=text name='berat' value=$r[berat] size=3> kg (kosongi jika tidak perlu)</td></tr>
          <tr><td>Harga</td>     <td> : <input type=text name='harga' value=$r[harga] size=10> (tulis langsung tanpa titik | Mis: 100000, 150000, 75000)</td></tr>
		  <tr><td>Diskon</td>     <td> : <input type=text name='diskon' value=$r[diskon] size=3> % (kosongi jika tanpa diskon)</td></tr>
          <tr><td>Stok</td>     <td> : <input type=text name='stok' value=$r[stok] size=3> pcs (harus diisi, jika dikosongi maka dianggap stok kosong)</td></tr>
          <tr><td>Deskripsi</td>   <td> <textarea name='deskripsi' style='width: 600px; height: 350px;'>$r[deskripsi]</textarea></td></tr>
          <tr><td>Gambar</td>       <td> :  
          <img src='../foto_produk/small/small_$r[gambar]'></td></tr>
          <tr><td>Ganti Gbr</td>    <td> : <input type=file name='fupload' size=30> *)</td></tr>
          <tr><td colspan=2>*) Apabila gambar tidak diubah, dikosongkan saja.</td></tr>
          <tr><td colspan=2><input type=submit class='tombol' value=Update>
                            <input type=button class='tombol' value=Batal onclick=self.history.back()></td></tr>
         </table></form>";
    break;  
    
  case "cari":
    $featured = mysql_query("SELECT * FROM setting WHERE tipe='featured'");
    $rfeatured=mysql_fetch_array($featured);
    echo "<h2>Kelola Produk</h2>
          <input type=button class='tombol' value=' Tambah Produk Baru ' onclick=\"window.location.href='?module=produk&act=tambahproduk';\"><b> &nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;<a href='?module=produk&act=featured'>Tampilkan $rfeatured[value2] saja</a> &nbsp;&nbsp;
          <form method='POST' action='media.php?module=produk&act=cari'>Cari berdasarkan Nama Produk : <input name=cari size=40><input type=submit class='tombol' value=' Cari! '></form></b>
          ";
        $jmldata = mysql_num_rows(mysql_query("SELECT * FROM produk WHERE nama_produk like '%$_POST[cari]%'"));
    echo "<div id=paging>Ditemukan $jmldata produk dengan kata kunci \"$_POST[cari]\"</div><br>";
    echo "
          <form method='POST' action='?module=produk&act=cariproduk'>
          <table>
          <tr><th>No</th><th>Nama Produk</th><th>Berat(kg)</th><th>Harga</th><th>Diskon</th><th>Stok</th><th>Tgl. Masuk</th><th>Aksi</th></tr>";

    $tampil = mysql_query("SELECT * FROM produk WHERE nama_produk like '%$_POST[cari]%' ORDER BY id_produk DESC");
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
      $tanggal=tgl_indo($r[tgl_masuk]);
      $harga=format_rupiah($r[harga]);
      echo "<tr><td>$no</td>
                <td><a href=?module=produk&act=editproduk&id=$r[id_produk]>$r[nama_produk]</a></td>
                <td align=center>$r[berat]</td>
                <td>Rp $harga</td>
				<td align=center>$r[diskon]%</td>
                <td align=center>$r[stok]</td>
                <td>$tanggal</td>
		            <td><a href=?module=produk&act=editproduk&id=$r[id_produk]><b>Edit</b></a> | 
		                <a href=$aksi?module=produk&act=hapus&id=$r[id_produk] onclick='return confirm(\"Hapus produk ini dari website?\\n$r[nama_produk] ?\");'><b>Hapus</a></b></td>
		        </tr>";
      $no++;
    }
    echo "</table>";

 
    break;
}
}
?>
