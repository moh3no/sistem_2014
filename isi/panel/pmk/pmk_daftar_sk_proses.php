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
	});
</script>
<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">

    function edit(id_sk){
        document.location.href = "?mod=pmk_daftar_sk_edit&id_sk=" + id_sk;
    }
    
    function hapus(id_sk){
        jConfirm("Hapus data SK PMK dengan ID "+ id_sk +" ini ?", "PERHATIAN", function(r){
            if(r){
                document.location.href = "php/pmk/pmk_daftar_sk_hapus.php?id_sk=" + id_sk;
            }
        });
    }
    
    function proses(id_sk){
		jConfirm("Proses ke BKD Data SK PMK dengan ID "+ id_sk +" ini ?", "PERHATIAN", function(r){
            if(r){
                document.location.href = "?mod=proses_sk_pmk&id_sk=" + id_sk;
            }
        });
    }
   
	 function cetak_daftar_usulan(id_surat){
        //window.open("cetak/sk/pmk/lampiran_sk_pmk.php?id_surat=" + id_surat);
    }
	
	function daftar_pegawai(id_surat){
		$("#dialog_cadis").dialog("open");
			$.ajax({
				type: "GET",
				url: "ajax/pmk_sk_daftar_diusulkan.php",
				data: "id_surat=" + id_surat,
				success: function(r){
						$("#dialog_cadis").html(r);
				}
			});	
	}
    
</script>
<!-- END OF JAVASCRIPT PAGE -->

<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-align: left;">SUPERVISI SK PENINJAUAN MASA KERJA (PMK)</h3>
    <div class="bodypanel">
    <button type="button" class="btn btn-success" onclick="document.location.href='?mod=';"><span class='glyphicon glyphicon-chevron-left'></span>&nbsp;&nbsp;KEMBALI</button>
    <button type="button" class="btn btn-info" onclick="document.location.href='?mod=pmk_sk_telah_proses';"><span class='glyphicon glyphicon-min'></span>&nbsp;Daftar SK Telah Diproses</button>
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
						a.status = 2 
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
			    echo "<td style='text-align: center;'><button type='button' title='Daftar Nama Pegawai Yang Diusulkan' class='btn btn-sm btn-success' style='width: 100%;' onclick='daftar_pegawai(".$dt['id_surat'].");'><span class='glyphicon glyphicon-bookmark'></span></button></td>";
				echo "<td style='text-align: center;'><button type='button' title='ACC (Proses) Data SK ini' class='btn btn-sm btn-success' style='width: 100%;' onclick='proses(".$dt['id_surat'].");'><span class='glyphicon glyphicon-cog'></span></button></td>";
						
				echo "</tr>";
			}	
			$rs->close();
		?>
        </tbody>
    </table><br/>
	<span style="font-size:13px; font-weight:bold;">*) - Keterangan Kolom Status pada tabel diatas, jika berwarna <span style="color:yellow;">kuning</span> 
		berarti belum diproses oleh BKD.<br/>  - Jika berwarna <span style="color:green;">hijau</span> berarti sudah di ACC oleh Admin BKD.<br/>  - Dan jika berwarna 
		<span style="color:red;">merah</span> berarti sudah di proses ke BKD, namun belum di ACC (Proses) oleh admin BKD.</span><br/>
    </div>
</div>
<!-- DIALOG JQUERY -->
<div id="dialog_cadis" title="DATA PEGAWAI USULAN KENAIKAN PANGKAT" style="display: none;">
    
</div>