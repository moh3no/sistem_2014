<div id="navbar" class="navbar-collapse collapse">
<ul class="nav navbar-nav">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">Berita Dan Informasi <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
			<li><a href="?mod=berita_dan_informasi_list">Daftar Berita Dan Informasi</a></li>
			<li class="divider"></li>
			<li><a href="?mod=list_ucapan_ultah"> Ucapan Selamat Ulang Tahun </a></li>
			<li><a href="?mod=ucapan_kenaikan_pangkat"> Ucapan Selamat Kenaikan Pangkat </a></li>
			<li><a href="?mod=ucapan_kenaikan_jabatan"> Ucapan Selamat Kenaikan Jabatan </a></li>
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
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">Kepangkatan <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
            <li><a href="?mod=gb_daftar_usulan">Usulan Kenaikan Gaji Berkala</a></li>
            <li><a href="?mod=pi_daftar_usulan">Usulan Penyesuaian Ijazah</a></li>
            <li><a href="?mod=pg_daftar_usulan">Usulan Pencantuman Gelar</a></li>
			<li><a href="?mod=daftar_kpk">Usulan Kenaikan Pangkat</a></li>
			<li><a href="?mod=pmk_daftar_usulan">Usulan Peninjauan Masa Kerja</a></li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">Kesejahteraan dan Disiplin <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
            <li><a href="?mod=cuti_daftar_usulan">Permohonan Ijin Cuti</a></li>
            <li><a href="?mod=cerai_daftar_usulan">Permohonan Ijin Perceraian</a></li>
            <li class="divider"></li>
            <li><a href="#" style="font-weight: bold; text-transform: uppercase;">----- Hukuman Disiplin -----</a></li>
            <li><a href="?mod=hdr_skpd_daftar">Hukuman Disiplin Ringan</a></li>
            <li><a href="?mod=hdsb_skpd_daftar">Usulan Hukuman Sedang dan Berat ke BKD</a></li>
            <li class="divider"></li>
            <li><a href="?mod=sl_daftar_usulan">Usulan Satya Lancana</a></li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">Supervisi Data Pegawai <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
            <!--<li><a href="?mod=edit_pegawai">Data Pribadi Pegawai</a></li>
            <li><a href="#">Data Pengangkatan CPNS</a></li>
            <li><a href="#">Data Pengangkatan PNS</a></li>-->
            <?php
                if(isset($_SESSION["simpeg_id_pegawai"])){
                    $ds_nama_pegawai_aktif = mysql_fetch_array(mysql_query("SELECT nama_pegawai, nip FROM tbl_pegawai WHERE id_pegawai='" . $_SESSION["simpeg_id_pegawai"] . "'"));
            ?>
            <li><a href="#" style="font-weight: bold; text-transform: uppercase;"><?php echo($ds_nama_pegawai_aktif["nip"] . "<br />(" . $ds_nama_pegawai_aktif["nama_pegawai"] . ")"); ?></a></li>
            <li class="divider"></li>
            <li><a href="php/unset_pegawai.php?mod=spv_data_pegawai_pilih_pegawai">Selesai Supervisi</a></li>
            <li class="divider"></li>
            <li><a href="?mod=spv_pengangkatan_cpns">Data Pengangkatan CPNS</a></li>
            <li><a href="?mod=spv_pengangkatan_pns">Data Pengangkatan PNS</a></li>
            <li><a href="?mod=spv_riwayat_pangkat">Riwayat Pangkat</a></li>
            <li><a href="?mod=spv_riwayat_jabatan">Riwayat Jabatan</a></li>
            <?php
                }else{
            ?>
            <li><a href="?mod=spv_pilih_pegawai">Pilih Pegawai Yang Akan Disupervisi</a></li>
            <?php
                }
            ?>
            
        </ul>
    </li>
</ul>
</div>
<div style="clear: both;"></div>