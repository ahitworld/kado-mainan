$(document).ready(function(){
		$.easy.tooltip();
		$('input[title!=""]').hint();
		$('textarea[title!=""]').hint();
		$().UItoTop({ easingType: 'easeOutQuart' });
		$("#footer").hover(
        function () {
          $("#promosi").slideDown(500);
        }, 
        function () {
          $("#promosi").slideUp(250);
        }
      );

//=============== TESTIMONI ===============//
		$('#tombolisitestimoni').click(function(){
		   $('.divtestimoni').fadeOut(500,function(){
		      $('.divisitestimoni').fadeIn(500);
		   });
		});
		
		$('#tombolbataltestimoni').click(function(){
		   $('.divisitestimoni').fadeOut(500,function(){
		      $('.divtestimoni').fadeIn(500);
		   });
		});
		
		$('#tombolinputtestimoni').click(function(){
		   $('.divisitestimoni').fadeOut(100,function(){
		      $('.divtunggutestimoni').fadeIn(500);
		   });
		   var testimoninama = $('#testimoninama').val();
		   var testimonialamat = $('#testimonialamat').val();
		   var testimoniemail = $('#testimoniemail').val();
		   var testimoniisi = $('#testimoniisi').val();
		   var testimonicaptcha = $('#testimonicaptcha').val();
		   
		   $.ajax({
		      type:"POST",
		      url:"aksi.php?module=isitestimoni",
		      data: "n=" + testimoninama + "&a=" + testimonialamat + "&e=" + testimoniemail + "&i=" + testimoniisi + "&c=" +testimonicaptcha,
		      success: function(data) {
		         $('.divtunggutestimoni').fadeOut(500,function(){
	              	$('.divhasiltestimoni').fadeIn(500,function(){
	              	   $('.divtunggutestimoni').hide();
	              		$("#divisihasiltestimoni").html(data);
	              	});
	         	});
		      }
		   });
		});

//=============== CHECKOUT ===============//
		$('#isilangkah1').hide().delay(300).slideDown(500);
		$('#isilangkah2').hide();
		$('#isilangkah3').hide();
		$('#isilangkah4').hide();
		$('#isilangkah5').hide();
		$('#isilangkah6').hide();
		$('#langkah6').hide();
		$('.janganLupa').hide();
		
		$('#koreksi2').click(function(){
		   $('#isilangkah2').slideDown(500);
		   $('#isilangkah3').slideUp(500);
		   $('#isilangkah4').slideUp(500);
		   $('#isilangkah5').slideUp(500);
		   
		   $('#koreksi3').hide();
		   $('#koreksi4').hide();
		});
		$('#koreksi3').click(function(){
		   $('#isilangkah2').slideUp(500);
		   $('#isilangkah3').slideDown(500);
		   $('#isilangkah4').slideUp(500);
		   $('#isilangkah5').slideUp(500);
		   
		   $('#koreksi4').hide();
		});
		$('#koreksi4').click(function(){
		   $('#isilangkah2').slideUp(500);
		   $('#isilangkah3').slideUp(500);
		   $('#isilangkah4').slideDown(500);
		   $('#isilangkah5').slideUp(500);
		});
});
//=============== TESTIMONI ===============//
function ulangiTestimoni() {
   $('.divhasiltestimoni').fadeOut(500,function(){
      $('#divisihasiltestimoni').html("");
      $('.divisitestimoni').fadeIn(500);
   });
}
function selesaiTestimoni() {
   $('.divhasiltestimoni').fadeOut(500,function(){
      $('.divtestimoni').fadeIn(500);
      $('#divisihasiltestimoni').html("");
   });
}
//=============== PROMO BLINK ===============//
function promoBlink(){
   $('.blinker').fadeOut(300).fadeIn(300).fadeOut(300).fadeIn(300).fadeOut(300).fadeIn(300).fadeOut(300).fadeIn(300);
}
setInterval(promoBlink,7000);
//=============== KOSONGKAN ===============//
function kosongkan() {
   var kosong = confirm("Kosongkan keranjang belanja Anda?");
   if(kosong) {
      $.ajax({
			type: 'GET',
			url: 'aksi.php',
			data: 'module=keranjang&act=kosongkan',
			dataType: 'html',
			success: function(response) {
				if(response=="oke") {
				   $('#tabelCart').delay(200).fadeOut(500,function(){
				      $('#tabelCart').fadeIn(500);
                  $('#tabelCart').replaceWith('<table width="100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td width="80%" valign="center"><b>Keranjang belanja masih kosong!</b><span class="border_cart"></span></td><td width="20%"><img src="images/keranjang.png" width="40"></td></tr><tr><td colspan="2">Mulai belanja dengan meng-klik tombol BELI di produk yang diinginkan..</td></tr></tbody></table>');
                  $('#topPanelTotal').replaceWith('<li>Halo, selamat berbelanja.. :)</li>');
   		         $('#topPanelGoto').hide();
               });
				}
			}
		});
   }
}
//=============== CHECKOUT ===============//
function lanjut1() {
   $('#isilangkah1').slideUp(500);
   $('#isilangkah2').slideDown(500);
}
function loadKota() {
      var idpro = $('#provinsi').val();
		$.ajax({
			type: 'GET',
			url: 'config/kota.php',
			data: 'idprov=' + idpro,
			dataType: 'html',
			beforeSend: function() {
				$('#kota').html('<option value="pilih"> Loading... </option>');	
			},
			success: function(response) {
				$('#kota').html(response);
			}
		});
}
function getIdKota() {
   var cidkotanya = $('#kota').val();
		$.ajax({
			type: 'GET',
			url: 'config/kotaprovinsi.php',
			data: 'modul=idkota&id=' + cidkotanya,
			dataType: 'html',
			success: function(response) {
				$('#kotanya').val(response);
			}
		});
}
function validEmail(emailAddress) {
    var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
}
function lanjut2() { 
   var cnama = $('#cnama').val();
   var cemail = $('#cemail').val();
   var ctelp = $('#ctelp').val();
   var calamat = $('#calamat').val();
   var cprov = $('#provinsi').val();
   var ckota = $('#kota').val();
   var ckodepos = $('#ckodepos').val();

   if( $('#cnama').val() == "isi dengan nama lengkap Anda" ){ alert('Anda belum mengisikan Nama'); $('#cnama').focus(); return(false);}
   if( $('#cemail').val() == "email harus valid" ){ alert('Anda belum mengisikan Email'); $('#cemail').focus(); return(false);}
   if( !validEmail( cemail )) { alert('Alamat Email tidak valid!'); $('#cemail').focus(); return(false); }
   if( $('#ctelp').val() == "untuk konfirmasi" ){ alert('Anda belum mengisikan Nomor Telp/HP'); $('#ctelp').focus(); return(false);}
   if( $('#calamat').val() == "isi dengan lengkap" ){ alert('Anda belum mengisikan Alamat'); $('#calamat').focus(); return(false);}
   if( $('#provinsi').val() == "pilih" ){ alert('Anda belum memilih Provinsi'); $('#cprov').focus(); return(false);}
   if( $('#kota').val() == "pilih" ){ alert('Anda belum memilih Kota/Kabupaten'); $('#ckota').focus(); return(false);}
   if( $('#ckodepos').val() == "" ){ alert('Anda belum mengisikan Kode POS'); $('#ckodepos').focus(); return(false);}
   else {
      $.ajax({
			type: 'GET',
			url: 'config/kotaprovinsi.php',
			data: 'modul=provinsi&id=' + cprov,
			dataType: 'html',
			beforeSend: function() {
			   $('#langkah2loading').show();
				$('#langkah2loading').html("<img src='images/loading.gif' height='15px'> memproses..");
			},
			success: function(response) {
				$('#konfirmasiProvinsi').html(response);
			}
		});
      $('#konfirmasiNama').html(cnama);
      $('#konfirmasiTelp').html(ctelp);
      $('#konfirmasiAlamat').html(calamat);
      $('#konfirmasiKota').html(ckota);
      $('#konfirmasiKodepos').html(ckodepos);
      $('#langkah2loading').fadeOut(500,function(){
            $('#isilangkah2').slideUp(500);
            $('#isilangkah3').slideDown(500);
            $('#koreksi2').fadeIn(500);
         })
   }          
}
function lanjut3() {
   $('#isilangkah3').slideUp(500);
   $('#isilangkah4').slideDown(500);
   $('#koreksi3').fadeIn(500);
}
function lanjut4() {
    if (!$("input[@name='cbank1']:checked").val()) {
          alert('Anda belum memilih bank pembayaran!');
          return false;
       }
       else {
          var cbank = $("input:radio[name='cbank1']:checked").val();
          $('#langkah4loading').show();
          $('#konfirmasiBank').html(cbank);
          $('#langkah4loading').html("<img src='images/loading.gif' height='15px'> memproses..");
          $('#langkah4loading').fadeOut(500,function(){
            $('#isilangkah4').slideUp(500);
            $('#isilangkah5').slideDown(500);
            $('#koreksi4').fadeIn(500);
         })
       }
}
function lanjut5() {
   var cnama = $('#cnama').val();
   var cemail = $('#cemail').val();
   var ctelp = $('#ctelp').val();
   var calamat = $('#calamat').val();
   var cprov = $('#provinsi').val();
   var ckota = $('#kota').val();
   var ckodepos = $('#ckodepos').val();
   var csid = $('#csid').val();
   var cidkota = $('#kotanya').val();
   
   $.ajax({
			type: 'POST',
			url: 'config/kirim_order.php',
			data: 'nama=' + cnama + '&alamat=' + calamat + '&telpon=' + ctelp + '&email=' + cemail + '&kota=' + cidkota + '&sid=' + csid,
			dataType: 'html',
			beforeSend: function() {
				$('#langkah5loading').html("<img src='images/loading.gif' height='15px'> memproses..");
			},
			success: function(response) {
			   $('#langkah5loading').delay(500).fadeOut(500,function(){
			      $('#nomorOrder').html(response);
			      $('#atasNama').html(cnama);
			      $('#emailAnda').html(cemail);
			      $('#isilangkah1').slideUp(500);
				   $('#isilangkah2').slideUp(500);
		         $('#isilangkah3').slideUp(500);
		         $('#isilangkah4').slideUp(500);
		         $('#isilangkah5').slideUp(500);
		         $('#langkah1').slideUp(500);
				   $('#langkah2').slideUp(500);
		         $('#langkah3').slideUp(500);
		         $('#langkah4').slideUp(500);
		         $('#langkah5').slideUp(500);
		         $('#langkah6').slideDown(500);
		         $('#isilangkah6').slideDown(500);
		         $('.janganLupa').slideDown(500);
		         $('#tabelCart').replaceWith('<table id="tabelCart" height="100%" width="100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td width="80%" valign="center"><b>Order sudah terkirim :)</b><span class="border_cart"></span></td><td width="20%"><img src="images/keranjang.png" width="40"></td></tr><tr><td colspan="2">Silahkan tunggu konfirmasi SMS dari kami..<br><br>Terimakasih telah berbelanja di SaharaButik.com..</td></tr></tbody></table>');
		         $('#tabelCart').delay(1000).fadeOut(300).fadeIn(300).fadeOut(300).fadeIn(300).delay(500).fadeOut(300).fadeIn(300).fadeOut(300).fadeIn(300).fadeOut(300).fadeIn(300).delay(500).fadeOut(300).fadeIn(300).fadeOut(300).fadeIn(300).fadeOut(300).fadeIn(300);
		         $('#topPanelTotal').replaceWith('<li>Order sudah terkirim</li>');
		         $('#topPanelGoto').replaceWith('<li>Tunggu SMS konfirmasi</li>');
			   });
			}
		});
}
