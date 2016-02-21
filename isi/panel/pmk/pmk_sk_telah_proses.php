<script type="text/javascript">
$(document).ready(function(){
	$( "#dialog_cadis" ).dialog({
        autoOpen: false,
		height: 600,
		width: 800,
		modal: true,
        show: "fade",
		hide: "fade"
    });
	
	$("#lihat").click(function(){
		jAlert("TEST");
	});
});	
</script>

<!-- CONTROLLER -->
<script type="text/javascript">
<?php
    $data = array();
    $sql_data = "SELECT
                	a.*, b.pangkat, b.gol_ruang
                FROM
                	tbl_sk_pmk a
                	LEFT JOIN ref_pangkat b ON a.id_pangkat_ttd = b.id_pangkat
				WHERE 
					a.status = '3'
                ORDER BY
                	a.id_data ASC";
					
    $res_data = mysql_query($sql_data);
    while($ds_data = mysql_fetch_array($res_data)){
        $row_data["id_sk"] = $ds_data["id_data"];
        $row_data["no_sk"] = $ds_data["no_sk"];
        $row_data["tgl_sk"] = $ds_data["tgl_sk"];
        $row_data["jabatan_ttd_sk"] = $ds_data["jabatan_ttd_sk"];
        $row_data["nama_ttd_sk"] = $ds_data["pejabat_ttd"];
        $row_data["nip_ttd_sk"] = $ds_data["nip_pejabat_ttd"];
        $row_data["status"] = $ds_data["status"];
		$row_data["stats"] = status_supervisi($ds_data["status"]);
		$row_data["no_usul"] = $ds_data["no_usul_pmk"];
        $row_data["pangkat"] = $ds_data["pangkat"];
        $row_data["gol_ruang"] = $ds_data["gol_ruang"];
		$row_data["scan_sk"] = $ds_data["scan_sk"];
        array_push($data, $row_data);
    }
    echo("var data = " . json_encode($data) . ";\n");
?>
</script>
<!-- END OF CONTROLLER -->

<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">
	// kumpulan fungsi-fungsi
	
    function edit(id_sk){
        document.location.href = "?mod=kenpang_daftar_sk_edit&id_sk=" + id_sk;
    }
    
    function hapus(id_sk){
        jConfirm("Hapus data SK PMK dengan ID "+ id_sk +" ini ?", "PERHATIAN", function(r){
            if(r){
                document.location.href = "php/pmk/hapus_sk_pmk.php?id_sk=" + id_sk;
            }
        });
    }
	
	function cetak_sk(id_sk){
		document.location.href = "?mod=cetak_laporan_pmk&id_sk=" + id_sk;
	}
  
    function something_wrong(wrong){
		jAlert(wrong, "PERHATIAN");
	}
	
	function sukses(pesan){
		jAlert(pesan, "KONFIRMASI", function(r){
            if(r){
                document.location.href = "?mod=pmk_sk_telah_proses";
            }
        });
	}
	
	function kembali(){
		var id_level = "<?=$_SESSION['simpeg_id_level'];?>";
		if(id_level == 5){
			document.location.href='?mod=pmk_daftar_sk_proses';
		}else{
			document.location.href='?mod=pmk_daftar_sk';
		}
	}
	
	function list_pegawai(id_sk){
		$("#dialog_cadis").dialog("open");
		$.ajax({
			type: "GET",
			url: "ajax/pmk_sk_daftar_diusulkan.php",
			data: "id_surat=" + id_sk,
			success: function(r){
				$("#dialog_cadis").html(r);
			}
		});	
	}
	
</script>
<!-- END OF JAVASCRIPT PAGE -->

<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-align: left;">DAFTAR SK PENINJAUAN MASA KERJA YANG SUDAH DIPROSES (ACC) OLEH BKD</h3>
	
    <div class="bodypanel">
    <button type="button" class="btn btn-success" onclick="kembali();">
	<span class='glyphicon glyphicon-chevron-left'></span>&nbsp;&nbsp;Kembali</button>
    
	<div class="kelang"></div>
    <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
            <tr class="headertable">
                <th width='40px'>No.</th>
                <th>No. SK</th>
                <th width='100px'>Tgl. SK</th>
                <th width='200px'>Nama Pejabat<br />Penandatangan</th>
                <th width='200px'>NIP Pejabat<br />Penandatangan</th>
                <th width='200px'>Jabatan Pejabat<br />Penandatangan</th>
                <th width='200px'>Pangkat Pejabat<br />Penandatangan</th>
                <th width='50px'>&nbsp;</th>
                <th width='50px'>&nbsp;</th>
				<th width='50px'>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
		 <?php
			$sql = "SELECT 
							a.*, b.*, c.pangkat, c.gol_ruang 
						FROM 
							tbl_sk_pmk a 
						LEFT JOIN tbl_sk_pmk_detail b ON a.id_surat = b.id_sk 
						LEFT JOIN ref_pangkat c ON a.id_pangkat_ttd = c.id_pangkat 
					WHERE 
						a.status = 3
					ORDER BY 
						a.tgl_input ASC 
					";
			$rs = $con->query($sql);
			$no = 0;
			while($dt = $rs->fetch_assoc()){
				$no++;
				echo "<tr>";
				echo "<td style='text-align: center;'>".$no."</td>";
				echo "<td style='text-align: center;'>".$dt['no_sk']."</td>";
                echo "<td style='text-align: center;'>".$dt['tgl_surat']."</td>";
                echo "<td style='text-align: center;'>".$dt['pejabat_ttd']."</td>";
                echo "<td style='text-align: center;'>".$dt['nip_pejabat_ttd']."</td>";
			    echo "<td style='text-align: center;'>".$dt['jabatan_ttd_sk']."</td>";
                echo "<td style='text-align: center;'>".$dt['pangkat']." (".$dt['gol_ruang'].")</td>";
				echo "<td style='text-align: center;'><button type='button' title='Hapus Data' class='btn btn-sm btn-success' style='width: 100%;' onclick='hapus(".$dt['id_surat'].");'><span class='glyphicon glyphicon-trash'></span></button></td>";
			    echo "<td style='text-align: center;'><button type='button' title='Daftar Nama Pegawai Yang Diusulkan' class='btn btn-sm btn-success' style='width: 100%;' onclick='list_pegawai(".$dt['id_surat'].");'><span class='glyphicon glyphicon-bookmark'></span></button></td>";
				echo "<td style='text-align: center;'><button type='button' title='Cetak Laporan-laporan SK PMK' class='btn btn-sm btn-warning' style='width: 100%;' onclick='cetak_sk(".$dt['id_surat'].");'><span class='glyphicon glyphicon-print'></span></button></td>";
						
				echo "</tr>";
			}	
			$rs->close();
		?>		
        </tbody>
    </table>
    </div>
</div>
<!-- DIALOG JQUERY -->
<div id="dialog_cadis" title="LAMPIRAN DAFTAR PEGAWAI PADA SK PENINJAUAN MASA KERJA (PMK)" style="display: none;">
    
</div>