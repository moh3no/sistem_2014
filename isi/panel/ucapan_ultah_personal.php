<?php
	$query = mysql_query("UPDATE tbl_ucapan_ultah_pegawai SET lihat = '2' WHERE tujuan = '".$_SESSION['simpeg_id_pegawai']."'");
?>
<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-align: left;">Daftar Ucapan Ulang Tahun Masuk Buat <?=$username;?></h3>
    <div class="bodypanel">
    <?php
        $sql = "SELECT a.* , b.nama_pegawai as 'dari' 
		
				FROM tbl_ucapan_ultah_pegawai a
				LEFT JOIN tbl_pegawai b ON a.dari = b.id_pegawai
				WHERE 
					a.tujuan = '". $_SESSION['simpeg_id_pegawai'] ."' 
					ORDER BY tgl_post DESC";
        $res = mysql_query($sql);
		$no = 1;
        while($ds = mysql_fetch_array($res)){
            echo("<div class='judul_berita'>Ucapan ke - " . $no . "</div>");
            echo("<div class='tgl_berita'>Dikirim oleh ". ($ds["dari"] == "" ? "Admin Simpeg /SKPD" : $ds["dari"] ) ." pada : " . tglindonesia($ds["tgl_submit"]) . "</div>");
            echo("<div class='intro_berita'>" . $ds["pesan"] . "</div>");
            echo("<div class='kelang_border'></div><br/>");
			$no++;
        }
    ?>
    </div>
</div>