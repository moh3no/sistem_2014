<div class="panelcontainer panelform" style="width: 100%;">
    <h3 style="text-align: left;">DATA PERIODE <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nip"))); ?>)</h3>
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <?php
            $ds = mysql_fetch_array(mysql_query("SELECT
                                	a.*, b.nama_pegawai AS nama_pegawai_penilai, b.nip AS nip_penilai, 
                                	c.nama_pegawai AS nama_pegawai_atasan_penilai, c.nip AS nip_atasan_penilai,
                                	d.pangkat AS pangkat_penilai, d.gol_ruang AS gol_ruang_penilai,
                                	e.pangkat AS pangkat_atasan_penilai, e.gol_ruang AS gol_ruang_atasan_penilai,
                                	f.skpd AS skpd_penilai, g.skpd AS skpd_atasan_penilai,
                                	h.jabatan AS jabatan_penilai, i.jabatan AS jabatan_atasan_penilai
                                FROM
                                	tbl_skp a
                                	LEFT JOIN tbl_pegawai b ON a.id_pegawai_penilai = b.id_pegawai
                                	LEFT JOIN tbl_pegawai c ON a.id_atasan_pegawai_penilai = c.id_pegawai
                                	LEFT JOIN ref_pangkat d ON b.id_pangkat = d.id_pangkat
                                	LEFT JOIN ref_pangkat e ON c.id_pangkat = e.id_pangkat
                                	LEFT JOIN ref_skpd f ON b.id_satuan_organisasi = f.id_skpd
                                	LEFT JOIN ref_skpd g ON c.id_satuan_organisasi = g.id_skpd
                                	LEFT JOIN ref_jabatan h ON b.id_jabatan = h.id_jabatan
                                	LEFT JOIN ref_jabatan i ON c.id_jabatan = i.id_jabatan
                                WHERE
                                	a.id_skp='" . $_GET["id"] . "'
                                ORDER BY
                                	a.dari ASC
                                "));
        ?>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='150px'>Periode</td>
                <td width='5px'>:</td>
                <td style="text-transform: uppercase;"><b><?php echo(tglindonesia($ds["dari"]) . " S/D " . tglindonesia($ds["sampai"])); ?></b></td>
                <td width='150px'>&nbsp;</td>
                <td width='5px'>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Pejabat Penilai</td>
                <td>:</td>
                <td style="text-transform: uppercase;">
                    <b>
                        <?php echo($ds["nama_pegawai_penilai"]); ?><br />
                        NIP : <?php echo($ds["nip_penilai"]); ?><br />
                        Pangkat : <?php echo($ds["pangkat_penilai"]); ?><br />
                        Jabatan : <?php echo($ds["jabatan_penilai"]); ?><br />
                        SKPD : <?php echo($ds["skpd_penilai"]); ?>
                    </b>
                </td>
                
                <td>Atasan Pejabat Penilai</td>
                <td>:</td>
                <td style="text-transform: uppercase;">
                    <b>
                        <?php echo($ds["nama_pegawai_atasan_penilai"]); ?><br />
                        NIP : <?php echo($ds["nip_atasan_penilai"]); ?><br />
                        Pangkat : <?php echo($ds["pangkat_atasan_penilai"]); ?><br />
                        Jabatan : <?php echo($ds["jabatan_atasan_penilai"]); ?><br />
                        SKPD : <?php echo($ds["skpd_atasan_penilai"]); ?>
                    </b>
                </td>
            </tr>
        </table>
    </div>
</div>
<div class="kelang"></div>
<form name="frm" id="frm" action="php/skp/dp3_isi.php" method="post">
<?php
    $ds_dp3 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_skp_dp3 WHERE id_skp='" . $_GET["id"] . "'"));
?>
<input type="hidden" name="id_skp" value="<?php echo($_GET["id"]); ?>" />
<div class="panelcontainer panelform" style="width: 100%;">
    <h3 style="text-align: left;">ISI DATA PENILAIAN PERILAKU PEGAWAI <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($_SESSION["simpeg_id_pegawai"], "nip"))); ?>)</h3>
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <input type="button" value="Kembali" onclick="document.location.href='?mod=dp3_pilih_periode';" />
        <input type="button" value="Cetak Output Realisasi SKP" onclick="window.open('cetak/cetak_realisasi_skp.php?id_skp=<?php echo($_GET["id"]); ?>');" />
        <input type="button" value="Lihat / Cetak DP3" onclick="window.open('cetak/cetak_dp3.php?id_skp=<?php echo($_GET["id"]); ?>');" />
    </div>
</div>
</form>