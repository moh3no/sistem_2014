<!-- CONTROLLER -->
<script type="text/javascript">
<?php
    $list_pegawai = array();
    $sql_list_pegawai = "SELECT
                        	e.id_usulan, e.no_usulan, e.catatan_penolakan, a.id_pegawai, a.nama_pegawai, a.nip,
                        	b.pangkat, b.gol_ruang,
                        	c.jabatan, d.skpd
                        FROM
                        	tbl_pegawai a
                        	LEFT JOIN ref_pangkat b ON a.id_pangkat = b.id_pangkat
                        	LEFT JOIN ref_jabatan c ON a.id_jabatan = c.id_jabatan
                        	LEFT JOIN ref_skpd d ON a.id_satuan_organisasi = d.id_skpd
                        	INNER JOIN tbl_usulan_cuti e ON (a.id_pegawai = e.id_pegawai AND e.diproses=0)
                        ORDER BY
                        		e.no_usulan ASC, d.kode_skpd ASC";
    $res_list_pegawai = mysql_query($sql_list_pegawai);
    $no_list_pegawai = 0;
    while($ds_list_pegawai = mysql_fetch_array($res_list_pegawai)){
        $no_list_pegawai++;
        $row_pegawai["no"] = $no_list_pegawai;
        $row_pegawai["id_usulan"] = $ds_list_pegawai["id_usulan"];
        $row_pegawai["id_pegawai"] = $ds_list_pegawai["id_pegawai"];
        $row_pegawai["nama_pegawai"] = $ds_list_pegawai["nama_pegawai"];
        $row_pegawai["no_usulan"] = $ds_list_pegawai["no_usulan"];
        $row_pegawai["catatan_penolakan"] = $ds_list_pegawai["catatan_penolakan"];
        $row_pegawai["nip"] = $ds_list_pegawai["nip"];
        $row_pegawai["pangkat"] = $ds_list_pegawai["pangkat"];
        $row_pegawai["gol_ruang"] = $ds_list_pegawai["gol_ruang"];
        $row_pegawai["jabatan"] = $ds_list_pegawai["jabatan"];
        $row_pegawai["skpd"] = $ds_list_pegawai["skpd"];
        array_push($list_pegawai, $row_pegawai);
    }
    echo("var list_pegawai = " . json_encode($list_pegawai) . ";\n");
    echo("var qs_id_surat = " . $_GET["id_surat"] . ";\n")
?>
</script>
<!-- END OF CONTROLLER -->

<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">
$(document).ready(function(){
    $( "#catatan" ).dialog({
            autoOpen: false,
    		height: "auto",
    		width: "800",
    		modal: true,
            show: "fade",
    		hide: "fade"
        });
    
    $( "#riwayat_cuti" ).dialog({
            autoOpen: false,
    		height: "auto",
    		width: "900",
    		modal: true,
            show: "fade",
    		hide: "fade"
        });
});
function kembali(){
    document.location.href="?mod=cuti_sk_daftar_pegawai&id_surat=" + qs_id_surat;
}
function tolak(id_usulan){
    $("#id_usulan").val(id_usulan);
    $( "#catatan" ).dialog("open");
    
}
function terima(id_usulan){
    document.location.href="?mod=cuti_sk_tambah_pegawai_dari_usulan&id_usulan=" + id_usulan + "&id_surat=" + qs_id_surat;
}
function proses_tolak(){
    var id_usulan = $("#id_usulan").val();
    var isi_catatan = $("#isi_catatan").val();
    if(isi_catatan == "")
        jAlert("Isikan catatan penolakan", "PERHATIAN");
    else{
        document.location.href="php/cuti/cuti_proses_tolak.php?id_usulan=" + id_usulan + "&isi_catatan=" + isi_catatan + "&id_surat=" + qs_id_surat;
    }
}

function riwayat_cuti(id_usulan){
    $("#isi_riwayat_cuti").html("Loading ...");
    $( "#riwayat_cuti" ).dialog("open");
    $.ajax({
        type : "post",
        url : "ajax/riwayat_cuti.php",
        data : "id_usulan=" + id_usulan,
        success : function(r){
            $("#isi_riwayat_cuti").html(r);
        }
    });
}
</script>
<!-- END OF JAVASCRIPT PAGE -->

<div class="panelcontainer panelform" style="width: 100%;">
    <h3 style="text-align: left;">DAFTAR PEGAWAI YANG DISULKAN CUTI</h3>
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
            <tr class="headertable">
                <th width='40px'>No.</th>
                <th>NO. USULAN</th>
                <th>NAMA PEGAWAI</th>
                <th width='150px'>NIP</th>
                <th width='150px'>JABATAN</th>
                <th width='300px'>SKPD</th>
                <th width='150px'>PANGKAT</th>
                <th width='50px'>&nbsp;</th>
                <th width='80px'>&nbsp;</th>
                <th width='80px'>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <script type="text/javascript">
        var text = "";
        $.each(list_pegawai, function(i, item){
            text += "<tr>";
                text += "<td style='text-align:center;'>" + item.no + "</td>";
                text += "<td>" + item.no_usulan + "</td>";
                text += "<td>" + item.nama_pegawai + "</td>";
                text += "<td style='text-align:center;'>" + item.nip + "</td>";
                text += "<td>" + item.jabatan + "</td>";
                text += "<td>" + item.skpd + "</td>";
                text += "<td style='text-align:center;'>" + item.pangkat + " (" + item.gol_ruang + ")</td>";
                text += "<td><button type='button' class='btn btn-sm btn-info' style='width:100%;' onclick='riwayat_cuti(" + item.id_usulan + ")' title='Lihat Riwayat Cuti'><span class='glyphicon glyphicon-th'></span></btn></td>";
                text += "<td><button type='button' class='btn btn-sm btn-warning' style='width:100%;' onclick='tolak(" + item.id_usulan + ");' title='Tolak'><span class='glyphicon glyphicon-remove'></span>&nbsp;&nbsp;Tolak</btn></td>";
                text += "<td><button type='button' class='btn btn-sm btn-success' style='width:100%;' onclick='terima(" + item.id_usulan + ")' title='Terima'><span class='glyphicon glyphicon-ok'></span>&nbsp;&nbsp;Terima</btn></td>";
            text += "</tr>";
        });
        document.write(text);
        </script>
        </tbody>
        </table>
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <button type="button" class="btn btn-success" onclick="kembali();"><span class='glyphicon glyphicon-chevron-left'></span>&nbsp;&nbsp;Kembali</button>
                </td>
            </tr>
        </table>
    </div>
</div>

<!-- DIALOG JQUERY -->
<div id="catatan" title="CATATAN PENOLAKAN" style="display: none;">
<input type="hidden" id="id_usulan" />
<div class="panelcontainer" style="width: 100%;">
    <div class="bodypanel bodyfilter">
        <textarea class="form-control" id="isi_catatan" placeholder=":::: Isikan Catatan Penolakan ::::"></textarea>
        <div class="kelang"></div>
        <button type="button" class="btn btn-info" onclick="proses_tolak();">Simpan</button>
    </div>
</div>
</div>

<div id="riwayat_cuti" title="RIWAYAT CUTI PEGAWAI" style="display: none;">
<input type="hidden" id="id_usulan" />
<div class="panelcontainer" style="width: 100%;">
    <div class="bodypanel bodyfilter" id="isi_riwayat_cuti">
        
    </div>
</div>
</div>
<!-- END OF DIALOG JQUERY -->