<!-- CONTROLLER -->
<script type="text/javascript">
<?php  
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
    
	// JSON data daftar pegawai yang satu unit/SKPD
	$pegawai = array();
	$s = "SELECT 
				a.id_pegawai, a.nip, a.nama_pegawai
			FROM
				tbl_pegawai a
				LEFT JOIN ref_skpd b ON a.id_satuan_organisasi = b.id_skpd
			WHERE 
				b.kode_skpd = '". $_SESSION["simpeg_kode_skpd"] ."'
			ORDER BY
				a.nama_pegawai ASC
				";
	$rs = mysql_query($s);
	while($dt = mysql_fetch_array($rs)){
		$obj["id_pegawai"] = $dt["id_pegawai"];
		$obj["nama"] = $dt["nama_pegawai"];
		$obj["nip"] = $dt["nip"];
		array_push($pegawai, $obj);
	}
	 echo("var pegawai = " . json_encode($pegawai) . ";\n");
?>
</script>
<!-- END OF CONTROLLER -->

<!-- JAVASCRIPT PAGE -->
<script type="text/javascript">

    $(document).ready(function(){
        ambil_tanggal("tgl_usulan");
    });
  
    function simpan(){
        $("#frm").submit();
    }
    
    function kembali(){
		var id_level = "<?=$_SESSION['simpeg_id_level'];?>";
		if(id_level == "5"){
			document.location.href="?mod=daftar_usulan_kpk_sedang_diproses";
		}else{
			document.location.href="?mod=daftar_kpk";
		}	
    }
    
</script>
<!-- END OF JAVASCRIPT PAGE -->

<!-- JAVASCRIPT FROM CHILD -->
<script type="text/javascript">

    function something_wrong(what_is_wrong){
        jAlert(what_is_wrong, "PERHATIAN");
    }
    
    function sukses_edit(pesan_sukses){
        jAlert(pesan_sukses, "KONFIRMASI", function(r){
            document.location.href="?mod=daftar_kpk";
        });
    }

</script>
<!-- END OF JAVASCRIPT FROM CHILD -->

<form name="frm" id="frm" action="php/kpk/usulan_pangkat_edit.php" method="POST" target="sbm_target">
<div class="panelcontainer panelform" style="width: 100%;">
	<?php
		$id = mysql_real_escape_string($_GET['id_usulan']); // prevent sql injection
		$qs = "SELECT * FROM tbl_usulan_pangkat WHERE id_usulan = '". $id ."'";
		$exec = mysql_query($qs) or die(mysql_error());
		$row = mysql_fetch_array($exec);

	?>
    <h3 style="text-align: left;">EDIT DATA SURAT USULAN KENAIKAN PANGKAT (ID DATA : <?=$row['id_usulan'];?>)</h3>
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='50%'>
                    <label>NO. Surat Usulan :</label>
					<input type="hidden" name="id_usulan" id="id_usulan" value="<?=$row['id_usulan'];?>"/>
					<input type="hidden" name="no_usulan_lama" id="no_usulan_lama" value="<?=$row['no_usulan'];?>" />
                    <input type="text" name="no_usulan" id="no_usulan" class="form-control" value="<?=$row['no_usulan'];?>"/>
                </td>
                <td>
                    <label>Tgl. Surat Usulan :</label>
                    <input type="text" name="tgl_usulan" id="tgl_usulan" class="form-control" value="<?=$row['tgl_usulan'];?>"/>
                </td>
            </tr>
            <tr>
                <td width='50%'>
                    <label>Nama Pejabat Penandatangan :</label>
                    <input type="text" name="nama_pejabat_ttd" id="nama_pejabat_ttd" class="form-control" value="<?=$row['nama_pejabat_ttd'];?>"/>
                </td>
                <td>
                    <label>NIP Pejabat Penandatangan :</label>
                    <input type="text" name="nip_pejabat_ttd" id="nip_pejabat_ttd" class="form-control" value="<?=$row['nip_pejabat_ttd'];?>"/>
                </td>
            </tr>
            <tr>
                <td width='50%'>
                    <label>Jabatan Pejabat Penandatangan :</label>
                    <input type="text" name="jabatan_ttd" id="jabatan_ttd" class="form-control" value="<?=$row['jabatan_ttd'];?>"/>
                </td>
                <td>
                    <label>Pangkat Pejabat Penandatangan :</label>
                    <select name="id_pangkat_ttd" id="id_pangkat_ttd" class="form-control">
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
                    <button type="button" class="btn btn-lg btn-success" onclick="simpan();"><span class='glyphicon glyphicon-floppy-disk'></span>&nbsp;&nbsp;Simpan</button>
                    <button type="button" class="btn btn-lg btn-warning" onclick="kembali();"><span class='glyphicon glyphicon-chevron-left'></span>&nbsp;&nbsp;Kembali</button>
                </td>
            </tr>
        </table>
    </div>
</div>
</form>
<div class="kelang"></div>
<iframe src="" style="display: none;" id="sbm_target" name="sbm_target"></iframe>