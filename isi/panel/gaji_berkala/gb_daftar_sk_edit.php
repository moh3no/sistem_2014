<!-- CONTROLLER -->
<script type="text/javascript">
<?php
    require_once("php/model/sk_gaji_berkala_model.php");
    
    $pangkat = array();
    $sql_pangkat = "SELECT * FROM ref_pangkat";
    $res_pangkat = mysql_query($sql_pangkat);
    while($ds_pangkat = mysql_fetch_array($res_pangkat)){
        $row_pangkat["id_pangkat"] = $ds_pangkat["id_pangkat"];
        $row_pangkat["gol_ruang"] = $ds_pangkat["gol_ruang"];
        $row_pangkat["pangkat"] = $ds_pangkat["pangkat"];
        array_push($pangkat, $row_pangkat);
    }
    echo("var pangkat = " . json_encode($pangkat) . ";\n");
    
    $obj = new SKGajiBerkala_Model();
    $obj->Record($_GET["id_sk"]);
    $record["id_sk"] = $obj->id_sk;
    $record["no_sk"] = $obj->no_sk;
    $record["tgl_sk"] = $obj->tgl_sk;
    $record["jabatan_ttd_sk"] = $obj->jabatan_ttd_sk;
    $record["nama_ttd_sk"] = $obj->nama_ttd_sk;
    $record["nip_ttd_sk"] = $obj->nip_ttd_sk;
    $record["id_pangkat_ttd_sk"] = $obj->id_pangkat_ttd_sk;
    echo("var record = " . json_encode($record) . ";\n");
?>
</script>
<!-- END OF CONTROLLER -->

<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">

    $(document).ready(function(){
        ambil_tanggal("tgl_sk");
        preload();
    });
    
    function preload(){
        $("#id_sk").val(record.id_sk);
        $("#no_sk").val(record.no_sk);
        $("#tgl_sk").val(record.tgl_sk);
        $("#jabatan_ttd_sk").val(record.jabatan_ttd_sk);
        $("#nama_ttd_sk").val(record.nama_ttd_sk);
        $("#nip_ttd_sk").val(record.nip_ttd_sk);
        $("#id_pangkat_ttd_sk").val(record.id_pangkat_ttd_sk);
    }
    
    function simpan(){
        $("#frm").submit();
    }
    
    function kembali(){
        document.location.href="?mod=gb_daftar_sk";
    }
    
</script>
<!-- END OF JAVASCRIPT PAGE -->

<!-- JAVASCRIPT FROM CHILD -->
<script type="text/javascript">

    function something_wrong(what_is_wrong){
        jAlert(what_is_wrong, "PERHATIAN");
    }
    
    function success(){
        jAlert("Data SK kenaikan gaji berkala telah disimpan", "PERHATIAN", function(r){
            document.location.href="?mod=gb_daftar_sk";
        });
    }

</script>
<!-- END OF JAVASCRIPT FROM CHILD -->

<form name="frm" id="frm" action="php/gaji_berkala/gb_daftar_sk_edit.php" method="post" target="sbm_target">
<div class="panelcontainer panelform" style="width: 100%;">
    <h3 style="text-align: left;">EDIT SK PENGUSULAN KENAIKAN GAJI BERKALA</h3>
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='50%'>
                    <label>NO. SK :</label>
                    <input type="text" name="no_sk" id="no_sk" class="form-control" />
                    <input type="hidden" name="id_sk" id="id_sk" class="form-control" />
                </td>
                <td>
                    <label>Tgl. SK :</label>
                    <input type="text" name="tgl_sk" id="tgl_sk" class="form-control" />
                </td>
            </tr>
            <tr>
                <td width='50%'>
                    <label>Nama Pejabat Penandatangan :</label>
                    <input type="text" name="nama_ttd_sk" id="nama_ttd_sk" class="form-control" />
                </td>
                <td>
                    <label>NIP Pejabat Penandatangan :</label>
                    <input type="text" name="nip_ttd_sk" id="nip_ttd_sk" class="form-control" />
                </td>
            </tr>
            <tr>
                <td width='50%'>
                    <label>Jabatan Pejabat Penandatangan :</label>
                    <input type="text" name="jabatan_ttd_sk" id="jabatan_ttd_sk" class="form-control" />
                </td>
                <td>
                    <label>Pangkat Pejabat Penandatangan :</label>
                    <select name="id_pangkat_ttd_sk" id="id_pangkat_ttd_sk" class="form-control">
                        <option value="0">----- Pilih Pangkat -----</option>
                        <script type="text/javascript">
                        $.each(pangkat, function(i, item){
                            document.write("<option value='" + item.id_pangkat + "'>" + item.pangkat + " (" + item.gol_ruang + ")</option>");
                        });
                        </script>
                    </select>
                </td>
            </tr>
        </table>
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td align='left'>
                    <button type="button" class="btn btn-lg btn-success" onclick="simpan();"><span class='glyphicon glyphicon-floppy-disk'></span>&nbsp;&nbsp;Tambah</button>
                    <button type="button" class="btn btn-lg btn-warning" onclick="kembali();"><span class='glyphicon glyphicon-chevron-left'></span>&nbsp;&nbsp;Kembali</button>
                </td>
            </tr>
        </table>
    </div>
</div>
</form>
<div class="kelang"></div>
<iframe src="" style="display: none;" id="sbm_target" name="sbm_target"></iframe>