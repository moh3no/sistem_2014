<div class="linktop">
<span style="float:left; font-family:verdana; font-size:12px; margin-bottom:15px;">
<marquee onmouseover='this.stop()' onmouseout='this.start()'>
<?php

	$curr_date = getdate();
	$cur_tgl = $curr_date['year'] . "-" . $curr_date['mon'] . "-" . $curr_date['mday'];
	
	// cek token string
	$pecah = explode('-', $cur_tgl);
	$bulan = ($pecah[1] < 10) ? "0" . $pecah[1] : $pecah[1];
	$token = $bulan ."-". $pecah[2];
	
	$sql = "SELECT * from tbl_pegawai WHERE RIGHT(tanggal_lahir, 5) = '$token' AND id_satuan_organisasi LIKE '".  $_SESSION["simpeg_id_skpd"]. "%'";
	$query = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_array($query);
	$num = mysql_num_rows($query);
	
		if($num == 1){

			echo "Saudara <b>".$row['nama_pegawai']."</b> berulang tahun hari ini. Kirim Pesan anda di 
				<a href='?mod=ucapan_ultah' id='klik_pesan'>sini</a>.";

		}else if($num > 1){
		
			echo "Saudara <b>". $row['nama_pegawai'] ."</b> dan <b>". ($num - 1) ." orang lainnya</b>
			berulang tahun hari ini. Kirim Pesan anda di <a href='?mod=ucapan_ultah' id='klik_pesan'>sini</a>.";
			
		}
?>
</marquee>		
</span>
</div>
<div style="clear: both;"></div>
<div class="linktop">
    <a href="php/logout.php" class="linktopnav"><img src="image/logout.png" style="width:25px; vertical-align:middle;" title="Log out Sistem"/> Logout</a>
</div>

<div class="linktop">
   <a href='<?=($_SESSION["simpeg_id_level"] == 1) ? "?mod=pengguna" : "?mod=";?>' class='linktopnav'><img src='image/Business Man Blue_32.png' style='width:25px; vertical-align:middle;' title="Profil Pengguna"/> Profil Pengguna</a>	
  <!--  <a href="" class="linktopnav"><img src="image/Business Man Blue_32.png" style="width:25px; vertical-align:middle;" /> Profil Pengguna</a>-->
</div>

<?php
    if($_SESSION["simpeg_id_level"] == 9){
?>
<div class="linktop">
    <a href="php/unset_pegawai.php" class="linktopnav"><img src="image/List-Bullets-Blue-32.png" style="width:25px; vertical-align:middle;" /> Pilih Pegawai</a>
</div>
<?php
    }
?>

<div style="clear: both;"></div>