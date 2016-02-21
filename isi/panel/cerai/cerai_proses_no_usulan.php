<!-- CONTROLLER -->
<script type="text/javascript">
<?php
    $list_norut = array();
    $sql_list_norut = "SELECT
                        	e.no_usulan, e.tgl_usulan, COUNT(e.no_usulan) AS jumlah
                        FROM
                        	tbl_pegawai a
                        	LEFT JOIN ref_pangkat b ON a.id_pangkat = b.id_pangkat
                        	LEFT JOIN ref_jabatan c ON a.id_jabatan = c.id_jabatan
                        	LEFT JOIN ref_skpd d ON a.id_satuan_organisasi = d.id_skpd
                        	LEFT JOIN tbl_usulan_cerai e ON (a.id_pegawai = e.id_pegawai AND e.diproses = 0)
                        WHERE
                        	e.id_pegawai IS NOT NULL
                        GROUP BY
                        	e.no_usulan
                        ORDER BY
                        		e.tgl_usulan";
    $res_list_norut = mysql_query($sql_list_norut);
    $nomor = 0;
    while($ds_list_norut = mysql_fetch_array($res_list_norut)){
        $nomor++;
        $row_norut["nomor"] = $nomor;
        $row_norut["no_usulan"] = $ds_list_norut["no_usulan"];
        $row_norut["tgl_usulan"] = $ds_list_norut["tgl_usulan"];
        $row_norut["jumlah"] = $ds_list_norut["jumlah"];
        array_push($list_norut, $row_norut);
    }
    echo("var list_norut = " . json_encode($list_norut) . ";");
?>
</script>
<!-- END OF CONTROLLER -->

<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">
function proses(no_usulan){
    document.location.href="?mod=cerai_proses_daftar_pegawai&no_usulan=" + no_usulan;
}
</script>
<!-- END OF JAVASCRIPT PAGE -->

<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-align: left;">DAFTAR USULAN PERCERAIAN YANG PERNAH DIBUAT</h3>
    <div class="bodypanel">
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
            <tr class="headertable">
                <th width='40px'>No.</th>
                <th>No. Usulan</th>
                <th width='100px'>Tgl. Usulan</th>
                <th width='200px'>Jumlah Pegawai<br />Yg Belum Diproses</th>
                <th width='100px'>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <script type="text/javascript">
        var text = "";
        $.each(list_norut, function(i, item){
           text += "<tr>";
                text += "<td style='text-align:center;'>" + item.nomor + "</td>";
                text += "<td style='text-align:center;'>" + item.no_usulan + "</td>";
                text += "<td style='text-align:center;'>" + item.tgl_usulan + "</td>";
                text += "<td style='text-align:center;'>" + item.jumlah + " Pegawai</td>";
                text += "<td><button type='button' class='btn btn-sm btn-info' style='width:100%;' onclick='proses(\"" + item.no_usulan + "\");'>Proses <span class='glyphicon glyphicon-chevron-right'></span></button></td>";
           text += "</tr>"; 
        });
        document.write(text);
        </script>
        </tbody>
        </table>
    </div>
</div>