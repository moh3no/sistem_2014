<!-- CONTROLLER -->
<script type="text/javascript">
<?php
    $list_pegawai = array();
    $sql_list_pegawai = "SELECT
                            	e.id_usulan, e.status, e.keterangan, a.id_pegawai, a.nama_pegawai, a.nip,
                            	b.pangkat, b.gol_ruang,
                            	c.jabatan, d.skpd,
                            	CASE
                            		WHEN f.sub_jenis_disiplin IS NULL THEN ''
                            		ELSE f.sub_jenis_disiplin
                            	END AS sub_jenis_disiplin,
                            	CASE
                            		WHEN g.jenis_disiplin IS NULL THEN ''
                            		ELSE g.jenis_disiplin
                            	END AS jenis_disiplin,
                                e.scan_sk
                            FROM
                            	tbl_pegawai a
                            	LEFT JOIN ref_pangkat b ON a.id_pangkat = b.id_pangkat
                            	LEFT JOIN ref_jabatan c ON a.id_jabatan = c.id_jabatan
                            	LEFT JOIN ref_skpd d ON a.id_satuan_organisasi = d.id_skpd
                            	LEFT JOIN tbl_usulan_hukuman_disiplin e ON (a.id_pegawai = e.id_pegawai AND e.pemisah_hukuman = 2 AND e.status > 1)
                            	LEFT JOIN ref_sub_jenis_disiplin f ON e.id_sub_jenis_disiplin = f.id_sub_jenis_disiplin
                            	LEFT JOIN ref_jenis_disiplin g ON e.id_jenis_disiplin = g.id_jenis_disiplin
                            WHERE
                            	e.id_pegawai IS NOT NULL
                            ORDER BY
                            		e.id_usulan DESC";
    $res_list_pegawai = mysql_query($sql_list_pegawai);
    $no = 0;
    while($ds_list_pegawai = mysql_fetch_array($res_list_pegawai)){
        $no++;
        $row_list_pegawai["no"] = $no;
        $row_list_pegawai["id_usulan"] = $ds_list_pegawai["id_usulan"];
        $row_list_pegawai["status"] = $ds_list_pegawai["status"];
        $row_list_pegawai["keterangan"] = $ds_list_pegawai["keterangan"];
        $row_list_pegawai["sub_jenis_disiplin"] = $ds_list_pegawai["sub_jenis_disiplin"];
        $row_list_pegawai["jenis_disiplin"] = $ds_list_pegawai["jenis_disiplin"];
        $row_list_pegawai["id_pegawai"] = $ds_list_pegawai["id_pegawai"];
        $row_list_pegawai["nama_pegawai"] = $ds_list_pegawai["nama_pegawai"];
        $row_list_pegawai["nip"] = $ds_list_pegawai["nip"];
        $row_list_pegawai["pangkat"] = $ds_list_pegawai["pangkat"];
        $row_list_pegawai["gol_ruang"] = $ds_list_pegawai["gol_ruang"];
        $row_list_pegawai["jabatan"] = $ds_list_pegawai["jabatan"];
        $row_list_pegawai["skpd"] = $ds_list_pegawai["skpd"];
        $row_list_pegawai["scan_sk"] = $ds_list_pegawai["scan_sk"];
        array_push($list_pegawai, $row_list_pegawai);
    }
    echo("var list_pegawai = " . json_encode($list_pegawai) . ";\n");
?>
</script>
<?php
    //echo($sql_list_pegawai);
?>
<!-- END OF CONTROLLER -->

<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">
$(document).ready(function(){
    $( "#pnl_upload" ).dialog({
            autoOpen: false,
    		height: "auto",
    		width: "800",
    		modal: true,
            show: "fade",
    		hide: "fade"
        });
});

function tambah(){
    document.location.href="?mod=hdr_skpd_tambah";
}
function edit(id_usulan){
    document.location.href="?mod=hdsb_kesdip_edit&id_usulan=" + id_usulan;
}
function hapus(id_usulan){
    jConfirm("Anda yakin akan menghapus usulan ini?", "PERHATIAN", function(r){
        if(r){
            document.location.href="php/hukuman_disiplin/hdr_skpd_hapus.php?id_usulan=" + id_usulan;
        }
    });
}
function proses_selesai(id_usulan){
    jConfirm("Anda yakin akan data hukuman disiplin ini telah selesai?", "PERHATIAN", function(r){
        if(r){
            document.location.href="php/hukuman_disiplin/hdsb_kesdip_proses_selesai.php?id_usulan=" + id_usulan;
        }
    });
}

function upload_scan_sk(id_usulan){
    $("#id_usulan").val(id_usulan);
    $("#pnl_upload").dialog("open");
}

function lihat_scan_sk(scan_sk){
    if(scan_sk == "")
        jAlert("File Scan SK Belum diupload", "PERHATIAN");
    else
        window.open("sk_uploaded/hukuman_disiplin/" + scan_sk);
}

function cetak_sk(id_usulan){
    window.open("cetak/sk/hukuman_disiplin/sk_hd.php?id_usulan=" + id_usulan);
}
</script>
<!-- END OF JAVASRIPT PAGE -->

<!-- JAVASCRIPT FROM CHILD -->
<script type="text/javascript">
function something_wrong_upload(what_is_wrong){
    jAlert(what_is_wrong, "PERHATIAN");
}
function debug(what_is_wrong){
    alert(what_is_wrong, "PERHATIAN");
}
function success_upload(){
    jAlert("File scan SK telah diupload", "PERHATIAN", function(r){
        document.location.href="?mod=hdsb_kesdip_daftar";
    });
}
</script>
<!-- END OF JAVASCRIPT FROM CHILD -->

<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-align: left;">DAFTAR PEGAWAI YANG DIUSULKAN UNTUK DIKENAI HUKUMAN DISIPLIN SEDANG DAN BERAT OLEH SKPD YANG BERSANGKUTAN</h3>
    <div class="bodypanel">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
            <tr class="headertable">
                <th width='40px'>No.</th>
                <th width='140px'>NIP</th>
                <th width='120px'>Nama Pegawai</th>
                <th width='120px'>Jabatan</th>
                <th width='150px'>SKPD</th>
                <th width='120px'>Pangkat</th>
                <th width='150px'>Jenis<br />Hukuman</th>
                <th width='150px'>Sub Jenis<br />Hukuman</th>
                <th>Keterangan</th>
                <th width='50px'>&nbsp;</th>
                <th width='50px'>&nbsp;</th>
                <th width='50px'>&nbsp;</th>
                <th width='50px'>&nbsp;</th>
                <th width='50px'>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <script type="text/javascript">
            var text = "";
            $.each(list_pegawai, function(i, item){
                text += "<tr>";
                    text += "<td align='center'>" + item.no + "</td>";
                    text += "<td>" + item.nip + "</td>";
                    text += "<td>" + item.nama_pegawai + "</td>";
                    text += "<td>" + item.jabatan + "</td>";
                    text += "<td>" + item.skpd + "</td>";
                    text += "<td>" + item.pangkat + " (" + item.gol_ruang + ")</td>";
                    text += "<td align='center'>" + item.jenis_disiplin + "</td>";
                    text += "<td align='center'>" + item.sub_jenis_disiplin + "</td>";
                    text += "<td>" + item.keterangan + "</td>";
                    text += "<td><button title='Cetak SK' type='button' class='btn btn-sm btn-success' style='width:100%;' onclick='cetak_sk(" + item.id_usulan + ");'><span class='glyphicon glyphicon-print'></span></button></td>";
                    text += "<td><button title='Upload SK' type='button' class='btn btn-sm btn-success' style='width:100%;' onclick='upload_scan_sk(" + item.id_usulan + ");'><span class='glyphicon glyphicon-open'></span></button></td>";
                    text += "<td><button title='Lihat Scan SK' type='button' class='btn btn-sm btn-info' style='width:100%;' onclick='lihat_scan_sk(\"" + item.scan_sk + "\");'><span class='glyphicon glyphicon-file'></span></button></td>";
                    text += "<td><button title='Edit Data' type='button' class='btn btn-sm btn-success' style='width:100%;' onclick='edit(" + item.id_usulan + ");'><span class='glyphicon glyphicon-edit'></span></button></td>";
                    if(item.status < 3) 
                        text += "<td><button title='Proses Selesai' type='button' class='btn btn-sm btn-info' style='width:100%;' onclick='proses_selesai(" + item.id_usulan + ");'><span class='glyphicon glyphicon-cog'></span></button></td>";
                    else
                        text += "<td>&nbsp;</td>";                    
                text += "</tr>";
            });
            document.write(text);
        </script>
        </tbody>
        </table>
        <div class="kelang"></div>
        *) hanya data yang belum diproses selesai yang bisa diproses. Tetapi penguploadan tetap bisa dilakukan kapan saja
    </div>
</div>

<!-- DIALOG BOX -->
<div id="pnl_upload" title="UPLOAD HASIL SCAN SK" style="display: none;">
<form method="post" name="frm_upload" id="frm_upload" action="php/hukuman_disiplin/hd_upload_sk.php" enctype="multipart/form-data" target="sbm_target">
<input type="hidden" id="id_usulan" name="id_usulan" />
<div class="panelcontainer" style="width: 100%;">
    <div class="bodypanel bodyfilter">
        <input type="file" name="scan_sk" />
        <div class="kelang"></div>
        <button type="submit" class="btn btn-success"><span class='glyphicon glyphicon-open'></span>&nbsp;&nbsp;Upload Scan SK</button>
    </div>
</div>
</form>
</div>
<!-- END OF DIALOG BOX -->

<!-- SUBMIT TARGET -->
<iframe src="" name="sbm_target" style="display: none;"></iframe>
<!-- END OF SUBMIT TARGET -->