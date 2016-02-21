<!-- CONTROLLER -->
<?php
    $sql_data = "SELECT * FROM tbl_bapertarum WHERE id_pegawai='" . $_GET["id_pegawai"] . "'";
    $res_data = mysql_query($sql_data);
    $ds_data = mysql_fetch_array($res_data);
?>
<script type="text/javascript">
    var tgl_lapor = "<?php echo($ds_data["tgl_lapor"]); ?>";
    
    function preload(){
        $("#tgl_lapor").val(tgl_lapor);
    }
</script>
<!-- END OF CONTROLLER -->

<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">
$(document).ready(function(){
    ambil_tanggal("tgl_lapor");
    preload();
});

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
    jAlert("Data pelaporan Bapertarum telah disimpan.", "PERHATIAN", function(r){
        document.location.href="?mod=bapertarum_daftar";
    });
}
</script>
<!-- END OF JAVASCRIPT FROM CHILD -->

<form name="frm" id="frm" action="php/bapertarum/bapertarum_proses.php" method="post" target="sbm_target" enctype="multipart/form-data">
<input type="hidden" name="id_pegawai" value="<?php echo($_GET["id_pegawai"]); ?>" />
<div class="panelcontainer panelform" style="width: 100%;">
    <h3 style="text-align: left;">PROSES DATA BAPERTARUM</h3>
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <label>Tanggal Lapor Bapertarum :</label>
                    <input type="text" name="tgl_lapor" id="tgl_lapor" class="form-control" />
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <button type="button" class="btn btn-success btn-lg" onclick="form_submit();">Simpan</button>
                    <button type="reset" class="btn btn-info btn-lg">Reset</button>
                    <button type="button" class="btn btn-warning btn-lg" onclick="document.location.href='?mod=bapertarum_daftar';">Kembali</button>
                </td>
            </tr>
        </table>
    </div>
</div>
</form>

<!-- IFRAME. THE FORM WILL BE SUBMITED IN THIS WAY -->
<iframe name="sbm_target" style="display: none;"></iframe>
<!-- END OF IFRAME -->