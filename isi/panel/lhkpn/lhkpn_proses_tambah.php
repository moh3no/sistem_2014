<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">

    $(document).ready(function(){
        ambil_tanggal("tgl_lapor");
    });
    
    function form_submit(){
        $("#frm").submit();
    }
    
    function kembali(){
        document.location.href="?mod=lhkpn_proses_riwayat&id_pegawai=<?php echo($_GET["id_pegawai"]); ?>";
    }

</script>
<!-- END OF JAVASCRIPT PAGE -->

<!-- JAVASCRIPT FROM CHILD -->
<script type="text/javascript">

    function something_wrong(what_is_wrong){
        jAlert(what_is_wrong, "PERHATIAN");
    }
    function success(){
        jAlert("Data pelaporan LHKPN telah disimpan.", "PERHATIAN", function(r){
            document.location.href="?mod=lhkpn_proses_riwayat&id_pegawai=<?php echo($_GET["id_pegawai"]); ?>";
        });
    }
    
</script>
<!-- END OF JAVASCRIPT FROM CHILD -->

<form name="frm" id="frm" action="php/lhkpn/lhkpn_proses_tambah.php" method="post" target="sbm_target" enctype="multipart/form-data">
<input type="hidden" name="id_pegawai" value="<?php echo($_GET["id_pegawai"]); ?>" />
<div class="panelcontainer panelform" style="width: 100%;">
    <h3 style="text-align: left;">TAMBAH DATA LHKPN</h3>
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <label>Nomor NHK :</label>
                    <input type="text" name="no_nhk" id="no_nhk" class="form-control" />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Jenis Form LHKPN :</label>
                    <select name="jenis_form" id="jenis_form" class="form-control">
                        <option value="1">Form A (Pertama mengisi LHKPN)</option>
                        <option value="2">Form B (Sudah pernah mengisi LHKPN sebelumnya)</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Tanggal Lapor :</label>
                    <input type="text" name="tgl_lapor" id="tgl_lapor" class="form-control" />
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <button type="button" class="btn btn-success btn-lg" onclick="form_submit();">Simpan</button>
                    <button type="reset" class="btn btn-info btn-lg">Reset</button>
                    <button type="button" class="btn btn-warning btn-lg" onclick="kembali();">Kembali</button>
                </td>
            </tr>
        </table>
    </div>
</div>
</form>

<!-- IFRAME. THE FORM WILL BE SUBMITED IN THIS WAY -->
<iframe name="sbm_target" style="display: none;"></iframe>
<!-- END OF IFRAME -->