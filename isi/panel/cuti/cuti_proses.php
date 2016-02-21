<!-- CONTROLLER -->
<script type="text/javascript">
<?php
    $jenis_cuti = array();
    $res_jenis_cuti = mysql_query("SELECT * FROM ref_jenis_cuti ORDER BY id_jenis_cuti ASC");
    while($ds_jenis_cuti = mysql_fetch_array($res_jenis_cuti)){
        $row_jenis_cuti["id_jenis_cuti"] = $ds_jenis_cuti["id_jenis_cuti"];
        $row_jenis_cuti["jenis_cuti"] = $ds_jenis_cuti["jenis_cuti"];
        array_push($jenis_cuti, $row_jenis_cuti);
    }
    echo("var jenis_cuti = " . json_encode($jenis_cuti) . ";");
?>
</script>
<!-- -->

<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">
$(document).ready(function(){
    ambil_tanggal("dari");
    ambil_tanggal("tgl_sk ");
});
function tes(){
    alert("i called by iframe");
}
function form_submit(){
    $("#frm").submit();
}
</script>
<!-- END OF JAVASCRIPT PAGE -->

<!-- JAVASCRIPT FROM CHILD -->
<script type="text/javascript">
function something_wrong(what_is_wrong){
    jAlert(what_is_wrong, "PERHATIAN");
}
function success(){
    jAlert("Data cuti telah disimpan.", "PERHATIAN", function(r){
        document.location.href="?mod=cuti_proses_daftar_pegawai&no_usulan=<?php echo($_GET["no_usulan"]); ?>";
    });
}
</script>
<!-- END OF JAVASCRIPT FROM CHILD -->

<form name="frm" id="frm" action="php/cuti/cuti_proses.php" method="post" target="sbm_target" enctype="multipart/form-data">
<input type="hidden" name="id_usulan" value="<?php echo($_GET["id_usulan"]); ?>" />
<div class="panelcontainer panelform" style="width: 100%;">
    <h3 style="text-align: left;">PROSES DATA CUTI</h3>
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='33%'>
                    <label>Jenis Cuti :</label>
                    <select name="id_jenis_cuti" id="id_jenis_cuti" class="form-control">
                        <option value="0">:::: Pilih Jenis Cuti ::::</option>
                        <script type="text/javascript">
                            var text = "";
                            $.each(jenis_cuti, function(i, item){
                                text += "<option value='" + item.id_jenis_cuti + "'>" + item.jenis_cuti + "</option>";
                            });
                            document.write(text);
                        </script>
                    </select>
                </td>
                <td width='33%'>
                    <label>Lama Cuti (dalam hari) :</label>
                    <input type="text" name="lama" id="lama" class="form-control" />
                </td>
                <td>
                    <label>Tanggal Mulai Cuti :</label>
                    <input type="text" name="dari" id="dari" class="form-control" />
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='33%'>
                    <label>No. SK Cuti :</label>
                    <input type="text" name="no_sk" id="no_sk" class="form-control" />
                </td>
                <td width='33%'>
                    <label>Tanggal SK Cuti :</label>
                    <input type="text" name="tgl_sk" id="tgl_sk" class="form-control" />
                </td>
                <td>
                    <label>Pejabat Penandatangan SK :</label>
                    <input type="text" name="pejabat_sk" id="pejabat_sk" class="form-control" />
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <label>Upload File Scan SK Cuti (Harus Berformat PDF)</label>
                    <input type="file" name="scan_sk" id="scan_sk"  />
                </td>
            </tr>
        </table>
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <button type="button" class="btn btn-success btn-lg" onclick="form_submit();">Simpan</button>
                    <button type="reset" class="btn btn-info btn-lg">Reset</button>
                    <button type="button" class="btn btn-warning btn-lg" onclick="document.location.href='?mod=cuti_proses_daftar_pegawai&no_usulan=<?php echo($_GET["no_usulan"]); ?>';">Kembali</button>
                </td>
            </tr>
        </table>
    </div>
</div>
</form>

<!-- IFRAME. THE FORM WILL BE SUBMI IN THIS WAY -->
<iframe name="sbm_target" style="display: none;"></iframe>
<!-- END OF IFRAME -->