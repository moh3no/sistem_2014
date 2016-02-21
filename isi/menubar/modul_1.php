<div id="navbar" class="navbar-collapse collapse">
<ul class="nav navbar-nav">
    <li><a href="?mod=berita_dan_informasi_list">Berita Dan Informasi</a></li>
	<li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">Pesan Ucapan Selamat <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
            <li><a href="?mod=ucapan_ultah_personal">Ucapan Selamat Ulang Tahun 
				<?php
					$jum_pesan_ultah = get_pesan_ultah_masuk($_SESSION["simpeg_id_pegawai"]);
					if($jum_pesan_ultah > 0){
						echo " (<span style='color:red;'>".$jum_pesan_ultah . "</span> pesan masuk)";
					}
				?>
			</a></li>
			 <li><a href="?mod=ucapan_kenpang_personal">Ucapan Selamat Kenaikan Pangkat
			 <?php
				$jkp = jumlahUcapanKenpangMasuk($_SESSION["simpeg_username"]);
				if($jkp > 0){
					echo " (<span style='color:red;'>".$jkp . "</span> pesan masuk)";
				}
			 ?>
			 </a></li>
			 <li><a href="?mod=ucapan_jabatan_personal">Ucapan Selamat Kenaikan Jabatan
			  <?php
				$jnj = jumlahUcapanJabatanMasuk($_SESSION["simpeg_username"]);
				if($jnj > 0){
					echo " (<span style='color:red;'>".$jnj . "</span> pesan masuk)";
				}
			  ?>
			  </a></li>
        </ul>
    </li>
    <li><a href="?mod=kata_sambutan_kaban">Kata Sambutan Kepala Badan</a></li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">Download <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
            <li><a href="?mod=file_download&tipe_fd=1">File Download</a></li>
            <li><a href="?mod=file_download&tipe_fd=2">Tata Cara Penggunaan</a></li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">Data Pegawai <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
            <li><a href="?mod=pengangkatan_cpns">Data Pengangkatan CPNS</a></li>
            <li><a href="?mod=pengangkatan_pns">Data Pengangkatan PNS</a></li>
            <li><a href="?mod=riwayat_pangkat">Riwayat Pangkat</a></li>
            <li><a href="?mod=riwayat_jabatan">Riwayat Jabatan</a></li>
			<li><a href="?mod=riwayat_pendidikan_pegawai">Riwayat Pendidikan</a></li>
        </ul>
    </li>
</ul>
</div>
<div style="clear: both;"></div>