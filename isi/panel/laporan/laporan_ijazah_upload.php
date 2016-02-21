<script type="text/javascript">
$(document).ready(function(){
    $( "#spv_sk_kenpang" ).dialog({
        autoOpen: false,
		height: 350,
		width: 650,
		modal: true,
        show: "fade",
		hide: "fade"
    });
	
	$("#expand").click(function(){
        $("#bodyfilter").slideToggle(500);
    });
	
});

function hapus(id_data){
	jConfirm("Hapus File Ijazah Pegawai ini ?", "KONFIRMASI", function(ac){
		if(ac){		
			$.ajax({
					type: "GET",
					url: "php/laporan/laporan_ijazah_hapus.php",
					data: "id_data=" + id_data,
					success: function(data){
						if(data == "sukses"){
							 jAlert("Hapus data file Ijazah Pegawai Sukses", "KONFIRMASI", function(r){
									if(r){
											document.location.href = "?mod=laporan_ijazah_upload";
									}		
							});
						}else{
							jAlert("Maaf, Proses Query gagal !!", "ERROR PROSES", function(r){
									if(r){
											document.location.href = "?mod=laporan_ijazah_upload";
									}		
							});
						}
					}
			});	
		 }	
        });
}


</script>
<form name="frm" action="?mod=laporan_ijazah_upload" method="post">
    <div class="panelcontainer" style="width: 100%;">
        <h3><div style="display: block; float: left;"><div style="clear: both;"></div>FILTER DATA PENCARIAN</div><input type="button" value="+" style="float: right; display: block; font-weight: bold;" id="expand" /><div style="clear: both;"></div></h3>
        <div class="bodypanel" id="bodyfilter">
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td width='20%'>Nama Pegawai</td>
                    <td width='10px'>&nbsp;</td>
                    <td><input type="text" name="nama" id="nama" placeholder="Cari Berdasarkan Nama Pegawai"/></td>
                </tr>
                <tr>
                    <td width='20%'>NIP</td>
                    <td width='10px'>&nbsp;</td>
                    <td>
                        <input type="text" name="nip" id="nip" placeholder="Cari Berdasarkan NIP"/>
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
    <h3 style="text-align: left;">DAFTAR LAPORAN IJAZAH PEGAWAI (YANG DI UPLOAD)</h3>
    <div class="bodypanel">
	<button type="button" class="btn btn-success" onclick="document.location.href='?mod=';"><span class='glyphicon glyphicon-chevron-left'></span>&nbsp;&nbsp;Kembali</button>
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
            <tr class="headertable">
                <th width='40px'>No.</th>
				<th width='180px'>NIP</th>
                <th width='200px'>Nama Pegawai</th>
				<th width='200px'>Unit Kerja / SKPD</th>
                <th width='180px'>No. Ijazah</th>
                <th width='100px'>Tgl. Ijazah</th>
                <th width='20px'>&nbsp;</th>
                <th width='20px'>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?php
			$whr = "";
			if(isset($_POST['nama'])){
				$whr .= " AND b.nama_pegawai LIKE '%".$_POST['nama']."%' ";
			}else if(isset($_POST['nip'])){
				$whr .= " AND b.nip LIKE '%".$_POST['nip']."%' ";
			}
			
            $res = mysql_query("SELECT 
                                	a.*, b.nama_pegawai, c.skpd 
                                FROM
                                	tbl_riwayat_pendidikan a
                                	LEFT JOIN tbl_pegawai  b ON a.nip = b.nip
									LEFT JOIN ref_skpd c ON b.id_satuan_organisasi = c.id_skpd 
								WHERE 
									a.scan_ijazah <> '' AND a.supervisi = 3 ".$whr." 
                                ORDER BY
                                	b.nama_pegawai ASC LIMIT 100") or die(mysql_error());
            $no = 0;
			
            while($ds = mysql_fetch_array($res)){
                $no++;
                echo("<tr>");
                    echo("<td align='center'>" . $no . "</td>");
                    echo("<td align='center'>" . $ds["nip"] . "</td>");
                    echo("<td align='center'>" . $ds["nama_pegawai"] . "</td>");
                    echo("<td align='center'>" . $ds["skpd"] . "</td>");
					echo("<td align='center'>" . $ds["no_ijazah"] . "</td>");
					echo("<td align='center'>" . $ds["tgl_ijazah"] . "</td>");
                    echo("<td><a href='ijazah_uploaded/riwayat_pendidikan/".$ds["scan_ijazah"]."' target='_blank'>
                            <img src='image/pdf.png' width='18px' class='linkimage' title='Cetak Upload SK' /><a/>
                        </td>");
                    echo("<td>
                            <img src='image/Delete-32.png' width='18px' class='linkimage' title='Hapus' onclick='hapus(".$ds["id_data_rp"].");' />
                        </td>");
                    
                echo("</tr>");
            }
        ?>
        </tbody>
        </table>
    </div>
</div>

