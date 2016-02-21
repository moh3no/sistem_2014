<script type="text/javascript">
$(document).ready(function(){
	$("#expand").click(function(){
        $("#bodyfilter").slideToggle(500);
    });
	
	$( "#catatan" ).dialog({
			autoOpen: false,
			height: 300,
			width: 500,
			modal: true,
			show: "fade",
			hide: "fade"
	});
		
	ambil_tanggal("tgl_sk");
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
    
    function proses_ke_bkd(id_sk){
		jConfirm("Proses ke BKD Data SK PMK dengan ID "+ id_sk +" ini ?", "PERHATIAN", function(r){
            if(r){
                document.location.href = "php/pmk/pmk_sk_proses_bkd.php?id_sk=" + id_sk;
            }
        });
    }
    
    function daftar_diusulkan(id_sk){
        document.location.href = "?mod=pmk_daftar_sk_diusulkan&id_sk=" + id_sk;
    }
	
	 function cetak_daftar_usulan(id_usulan){
        window.open("cetak/sk/pmk/lampiran_sk_pmk.php?id_surat=" + id_usulan);
    }
	
	 function print_sk(id_sk){
        window.open("cetak/sk/pmk/petikan_sk.php?id_surat=" + id_sk);
    }
	
	function lihat_catatan(id_sk){
		$("#catatan").dialog("open");
			$.ajax({
					type: "GET",
					url: "ajax/catatan_supervisi_sk_pmk.php",
					data: "id_surat=" + id_sk,
					success: function(r){
						$("#catatan").html(r);
					}
			});	
		
    }
	
	function add_peg(id_sk){
		document.location.href = "?mod=sk_pmk_tambah_pegawai&id_data=" + id_sk;
	}
</script>
<!-- END OF JAVASCRIPT PAGE -->
<form name="frm" action="?mod=pmk_daftar_sk" method="post">
    <div class="panelcontainer" style="width: 100%;">
        <h3><div style="display: block; float: left;"><div style="clear: both;"></div>FILTER DATA PENCARIAN</div><input type="button" value="+" style="float: right; display: block; font-weight: bold;" id="expand" /><div style="clear: both;"></div></h3>
        <div class="bodypanel" id="bodyfilter">
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td width='20%'>Nomor Surat Keputusan (SK)</td>
                    <td width='10px'>:</td>
                    <td><input type="text" name="no_sk" value="<?=isset($_POST["no_sk"]) ? $_POST['no_sk'] : ""; ?>" /></td>
                </tr>
                <tr>
                    <td width='20%'>Tanggal Surat</td>
                    <td width='10px'>:</td>
                    <td>
                        <input type="text" name="tgl_sk" id="tgl_sk" class="ufilter" value="<?=isset($_POST["tgl_sk"]) ? $_POST["tgl_sk"] : ""; ?>" />
					</td>
                </tr>
                
            </table>
            <div class="kelang"></div>
            <table border="0px" cellspacing='0' cellpadding='0' width='40%'>
                <tr>
                    <td width='50%'><input type="submit" value='Filter' style="width: 100%;" class="btn btn-success" /></td>
                    <td width='50%'><input type="reset" value='Reset' style="width: 100%;" class="btn btn-warning"/></td>
                </tr>
            </table>
        </div>
    </div>
</form>
<div class="kelang"></div>
<div class="kelang"></div>
<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-align: left;">DAFTAR SK PENINJAUAN MASA KERJA (PMK) </h3>
    <div class="bodypanel">
    <button type="button" class="btn btn-success" onclick="document.location.href='?mod=pmk_daftar_sk_tambah';"><span class='glyphicon glyphicon-plus'></span>&nbsp;&nbsp;Tambah SK</button>
    <button type="button" class="btn btn-info" onclick="document.location.href='?mod=pmk_sk_telah_proses';"><span class='glyphicon glyphicon-min'></span>&nbsp;Daftar SK Telah Diproses</button>
	<div class="kelang"></div>
    <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
            <tr class="headertable">
				<th width='8px'>&nbsp;</th>
                <th width='40px'>No.</th>
                <th width='120px'>No. SK</th>
                <th width='100px'>Tgl. SK</th>
				<th width='100px'>Tgl. Input</th>
                <th width='150px'>Nama Pejabat<br />Penandatangan</th>
                <th width='120px'>NIP Pejabat<br />Penandatangan</th>
				<th width='150px'>Jabatan Pejabat<br />Penandatangan</th>
                <th width='120px'>Pangkat Pejabat<br />Penandatangan</th>
                <th width='20px'>&nbsp;</th>
                <th width='20px'>&nbsp;</th>
                <th width='20px'>&nbsp;</th>
                <th width='20px'>&nbsp;</th>
				<th width='20px'>&nbsp;</th>
				<th width='20px'>&nbsp;</th>
				<th width='50px'>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
		 <?php
			$sql = "";
			if(isset($_POST['no_sk']) && $_POST['no_sk'] <> ''){
				$sql = "SELECT
						a.*, b.pangkat, b.gol_ruang
					FROM
						tbl_sk_pmk a
						LEFT JOIN ref_pangkat b ON a.id_pangkat_ttd = b.id_pangkat
					WHERE
						a.no_sk LIKE '%". $_POST['no_sk'] ."%'
					ORDER BY
						a.id_surat ASC";
			}else if(isset($_POST['tgl_sk']) && $_POST['tgl_sk'] <> ''){
				$sql = "SELECT
						a.*, b.pangkat, b.gol_ruang
					FROM
						tbl_sk_pmk a
						LEFT JOIN ref_pangkat b ON a.id_pangkat_ttd = b.id_pangkat
					WHERE
						a.tgl_sk LIKE '%". $_POST['tgl_sk'] ."%'	
					ORDER BY
						a.id_surat ASC";
			}else{	
				$sql = "SELECT
						a.*, b.pangkat, b.gol_ruang
					FROM
						tbl_sk_pmk a
						LEFT JOIN ref_pangkat b ON a.id_pangkat_ttd = b.id_pangkat
					WHERE
						a.status = '1'
					ORDER BY
						a.id_surat ASC";
			}
			
			$rs = $con->query($sql);
			$rs->data_seek(0);
			$no = 0;
			while($row = $rs->fetch_assoc()){
				$no++;
				echo "<tr>";
				echo "<td style='text-align: center;'>".status_supervisi($row['status'])."</td>";
				echo "<td style='text-align: center;'>".$no."</td>";
				echo "<td style='text-align: center;'>".$row['no_sk']."</td>";
				echo "<td style='text-align: center;'>".$row['tgl_surat']."</td>";
				echo "<td style='text-align: center;'>".$row['tgl_input']."</td>";
				echo "<td style='text-align: center;'>".$row['pejabat_ttd']."</td>";
				echo "<td style='text-align: center;'>".$row['nip_pejabat_ttd']."</td>";
				echo "<td style='text-align: center;'>".$row['jabatan_ttd_sk']."</td>";
				echo "<td style='text-align: center;'>".$row['pangkat']." (".$row['gol_ruang'].")</td>";
				if($row['status'] == 1){
					echo "<td style='text-align: center;'><button type='button' title='Edit Data' class='btn btn-sm btn-success' style='width: 100%;' onclick='edit(".$row['id_surat'].");'><span class='glyphicon glyphicon-edit'></span></button></td>";
					echo "<td style='text-align: center;'><button type='button' title='Hapus Data' class='btn btn-sm btn-success' style='width: 100%;' onclick='hapus(".$row['id_surat'].");'><span class='glyphicon glyphicon-trash'></span></button></td>";
					echo "<td style='text-align: center;'><button type='button' title='Tambah Daftar Pegawai Pada Lampiran SK' class='btn btn-sm btn-success' style='width: 100%;' onclick='add_peg(".$row['id_surat'].")'><span class='glyphicon glyphicon-plus'></span></button></td>";
					echo "<td style='text-align: center;'><button type='button' title='Cetak Lampiran SK Peninjauan Masa Kerja' class='btn btn-sm btn-success' style='width: 100%;' onclick='cetak_daftar_usulan(".$row['id_surat'].");'><span class='glyphicon glyphicon-print'></span></button></td>";
					echo "<td style='text-align: center;'><button type='button' title='Cetak Petikan SK Peninjauan Mas Kerja' class='btn btn-sm btn-info' style='width: 100%;' onclick='print_sk(".$row['id_surat'].");'><span class='glyphicon glyphicon-print'></span></button></td>";
					echo "<td style='text-align: center;'><button type='button' title='Proses Ke BKD' class='btn btn-sm btn-success' style='width: 100%;' onclick='proses_ke_bkd(".$row['id_surat'].");'><span class='glyphicon glyphicon-cog'></span></button></td>";
					
					if($row['catatan'] == "" || $row['catatan'] == "-"){
							echo "<td style='text-align: center;'>&nbsp;</td>";
						}else{
							echo "<td><img src='image/icon-disposisi.png' width='18px' class='linkimage' title='Lihat Catatan Penolakan' onclick='lihat_catatan(".$row['id_surat'].");'/></td>";
						}
				}else{
						echo "<td style='text-align: center;'>&nbsp;</td>";
						echo "<td style='text-align: center;'>&nbsp;</td>";
                        echo "<td style='text-align: center;'>&nbsp;</td>";
						echo "<td style='text-align: center;'>&nbsp;</td>";
						echo "<td style='text-align: center;'>&nbsp;</td>";
						echo "<td style='text-align: center;'>&nbsp;</td>";
						echo "<td style='text-align: center;'>&nbsp;</td>";
				}
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
<div id="dialog_cadis" title="DAFTAR PEGAWAI PADA SK PENINJAUAN MASA KERJA (PMK)" style="display: none;">
    
</div>
<!-- DIALOG JQUERY -->
<div id="catatan" title="Catatan Supervisi Data SK PMK" style="display: none;">
   
</div>
<!-- ------------- -->