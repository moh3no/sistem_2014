<div id="navbar" class="navbar-collapse collapse">
<ul class="nav navbar-nav">
    <li><a href="?mod=">Beranda</a></li>
	<li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">Berita Dan Informasi <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
			<li><a href="?mod=berita_dan_informasi_adm">Daftar Berita Dan Informasi</a></li>
			<li class="divider"></li>
            <li><a href="?mod=list_ucapan_ultah"> Ucapan Selamat Ulang Tahun </a></li>
			<li><a href="?mod=ucapan_kenaikan_pangkat"> Ucapan Selamat Kenaikan Pangkat </a></li>
			<li><a href="?mod=ucapan_kenaikan_jabatan"> Ucapan Selamat Kenaikan Jabatan </a></li>
        </ul>
    </li>
    <li><a href="?mod=kata_sambutan_kaban_adm">Kata Sambutan Kepala Badan</a></li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">Download <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
            <li><a href="?mod=file_download_adm&tipe_fd=1">File Download</a></li>
            <li><a href="?mod=file_download_adm&tipe_fd=2">Tata Cara Penggunaan</a></li>
        </ul>
    </li>
	
	<li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">Laporan Data SK<span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
            <li><a href="?mod=pmk_daftar_sk_proses">SK Peninjauan Masa Kerja (PMK) </a></li>
			<li><a href="?mod=kenpang_daftar_sk_diusulkan">SK Kenaikan Pangkat </a></li>
			<li class="divider"></li>
			<li><b>&nbsp;&nbsp;&nbsp;Laporan-Laporan</b></li>
			<li><a href="?mod=laporan_sk_kenpang">Daftar SK Kepangkatan Yang di Upload Pegawai</a></li>
        </ul>
    </li>
	
	<li>
        <a href="?mod=daftar_usulan" >Data Surat Usulan</a>
    </li>
	
    <?php
        if(empty($_SESSION["simpeg_id_pegawai"])){
            echo("<li><a href='?mod=data_pegawai'>Data Pegawai</a></li>");
        }else {
    ?>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">Edit Data Pegawai <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                <?php
                    $ds_nama_pegawai_aktif = mysql_fetch_array(mysql_query("SELECT nama_pegawai, nip FROM tbl_pegawai WHERE id_pegawai='" . $_SESSION["simpeg_id_pegawai"] . "'"));
                ?>
                <li><a href="#" style="font-weight: bold; text-transform: uppercase;"><?php echo($ds_nama_pegawai_aktif["nip"] . "<br />(" . $ds_nama_pegawai_aktif["nama_pegawai"] . ")"); ?></a></li>
                <li class="divider"></li>
                <li><a href="php/unset_pegawai.php">Selesai Edit Data</a></li>
                <li class="divider"></li>
                <li><a href="?mod=edit_pegawai">Data Pribadi Pegawai</a></li>
                <li><a href="?mod=pengangkatan_cpns">Data Pengangkatan CPNS</a></li>
                <li><a href="?mod=pengangkatan_pns">Data Pengangkatan PNS</a></li>
                <li><a href="?mod=spv_riwayat_pangkat">Riwayat Pangkat</a></li>
                <li><a href="?mod=riwayat_jabatan">Riwayat Jabatan</a></li>
				<li><a href="?mod=riwayat_pendidikan">Riwayat Pendidikan</a></li>
            </ul>
        </li>
    <?php
        }
    ?>	
	 <li><a href="?mod=c_panel">Panel Admin</a></li>
</ul>
</div>
<div style="clear: both;"></div>