<script type="text/javascript">
function realisasi(id_uraian_skp){
    //document.location.href="?mod=skp_realisasi&id_skp=<?php echo($_GET["id"]); ?>&id_uraian_skp=" + id_uraian_skp;
    alert("Maaf, Konten ini telah dipindahkan ke modul lain");
}
function edit(id_uraian_skp){
    document.location.href='?mod=skp_uraian_tambah&id_skp=<?php echo($_GET["id"]); ?>&id_uraian_skp=' + id_uraian_skp;
}
function hapus(id_uraian_skp){
    jConfirm("Anda yakin akan menghapus data uraian target SKP ini?", "PERHATIAN", function(r){
        if(r){
            document.location.href="php/skp/skp_uraian_hapus.php?id_skp=<?php echo($_GET["id"]); ?>&id_uraian_skp=" + id_uraian_skp;
        }
    })
}
</script>
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
                                	a.id_skp='" . $_GET["id_skp"] . "'
                                ORDER BY
                                	a.dari ASC
                                "));
        ?>
<div class="panelcontainer panelform" style="width: 100%;">
    <h3 style="text-align: left;">DATA SKP <?php echo(strtoupper(detail_pegawai($ds["id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($ds["id_pegawai"], "nip"))); ?>)</h3>
    <div class="bodypanel bodyfilter" id="bodyfilter">
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
<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-align: left;">URAIAN DATA SKP PEGAWAI <?php echo(strtoupper(detail_pegawai($ds["id_pegawai"], "nama_pegawai"))); ?> (NIP : <?php echo(strtoupper(detail_pegawai($ds["id_pegawai"], "nip"))); ?>)</h3>
    <div class="bodypanel">
        <input type="button" value="Kembali" onclick="document.location.href='?mod=spv_skp_target';" />
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
            <tr class="headertable">
                <th width='40px'>No.</th>
                <th>Kegiatan / Tugas Jabatan</th>
                <th width='50px'>AK</th>
                <th width='150px'>Kuantitas / Output</th>
                <th width='150px'>Kualitas / Mutu</th>
                <th width='150px'>Waktu (Bulan)</th>
                <th width='150px'>Biaya</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $res_data = mysql_query("SELECT
                                	a.*, b.satuan_waktu
                                FROM
                                	tbl_uraian_skp a
                                    LEFT JOIN ref_satuan_waktu b ON a.id_satuan_waktu = b.id_satuan_waktu
                                WHERE
                                	a.id_skp = '" . $_GET["id_skp"] . "'");
            $no = 0;
            while($ds_data = mysql_fetch_array($res_data)){
                $no++;
                echo("<tr>");
                    echo("<td align='center'>" . $no . "</td>");
                    echo("<td>" . $ds_data["kegiatan"] . "</td>");
                    echo("<td align='center'>" . ($ds_data["ak"] * $ds_data["kuantitas"]) . "</td>");
                    echo("<td align='center'>" . $ds_data["kuantitas"] . " " . $ds_data["satuan_kuantitas"] . "</td>");
                    echo("<td align='center'>" . $ds_data["kualitas"] . " %</td>");
                    echo("<td align='center'>" . $ds_data["waktu"] . " " . $ds_data["satuan_waktu"] . "</td>");
                    echo("<td align='center'>" . number_format($ds_data["biaya"], 0, ".", ",") . "</td>");
                echo("</tr>");
            }
        ?>
        </tbody>
        </table>
    </div>
</div>
<div class="kelang"></div>
<form name="frm" id="frm" action="php/skp/spv_skp_target_proses.php" method="post">
<input type="hidden" name="id_skp" value="<?php echo($_GET["id_skp"]); ?>" />
<input type="hidden" name="id_tujuan" value="<?php echo($ds["id_pegawai"]); ?>" />
<div class="panelcontainer panelform" style="width: 100%;">
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <textarea placeholder="Catatan Supervisi" name="catatan"></textarea>
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td style="text-align: left;">
                    <input type="submit" name="terima" value="TERIMA" style="width: 150px; height: 40px;" />
                    <input type="submit" name="tolak" value="TOLAK" style="width: 150px; height: 40px;" />
                </td>
            </tr>
        </table>
    </div>
</div>
</form>