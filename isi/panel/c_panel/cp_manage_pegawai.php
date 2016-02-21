<script type="text/javascript">
$(document).ready(function(){
    $("#expand").click(function(){
        $("#bodyfilter").slideToggle(500);
    });
    
	
	$("#alert_add").click(function(){
			$(this).fadeOut('slow');
		});
});

function hapus(id){
    jConfirm("Anda yakin akan menghapus pengguna ini?", "PERHATIAN", function(r){
        if(r)
            document.location.href = "php/c_panel/cp_hapus_pengguna.php?id_user=" + id;
    });
}

function editdata(id){
    document.location.href = "?mod=edit_data_pengguna&id=" + id;
}
</script>
<form name="frm" action="?mod=<?php echo $mod = (isset($_GET["mod"])) ? $_GET["mod"] : ""; ?>" method="post">
<div class="panelcontainer" style="width: 100%;">
    <h3><div style="display: block; float: left;"><div style="clear: both;"></div>FILTER DATA PENCARIAN</div><input type="button" value="+" style="float: right; display: block; font-weight: bold;" id="expand" /><div style="clear: both;"></div></h3>
	<br/>
	<?php
		if(isset($_GET['msg'])){
			if($_GET['msg'] ==  1){
				echo "<div class='alert alert-success' role='alert' id='alert_add' title='Klik Blok Notif ini untuk menghilangkan notifikasi'>";
				echo "<center><img src='image/icn_alert_success.png' width='18px;' />&nbsp;&nbsp;";
				echo "Data Pegawai Berhasil Dihapus.</center>";
				echo "</div>";
			}else if($_GET['msg'] == 2){
				echo "<div class='alert alert-danger' role='alert' id='alert_add'  title='Klik Blok Notif ini untuk menghilangkan notifikasi'>";
				echo "<center><img src='image/icn_alert_warning.png' width='18px;' />&nbsp;&nbsp;";
				echo "Maaf, Proses error, terjadi kesalahan proses.</center>";
				echo "</div>";
			}
		}
	?>
	
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='50%'>
                    <input type="text" name="nama" placeholder="Cari Nama Pegawai" title="Nama Pegawai" value="<?php 
					$nama_pegawai = (isset($_POST["nama"]) ? $_POST["nama"] : "");
					echo  $nama_pegawai;
					?>" />
                </td>
                <td>
                    <input type="text" name="nip" placeholder="Cari Berdasarkan Username (NIP) " title="Username atau NIP Pegawai" value="<?php 
					$nip = (isset($_POST["nip"]) ? $_POST["nip"] : ""); 
					echo $nip;
					
					?>" />
                </td>
            </tr>
        </table>
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='20%'>
            <tr>
                <td width='50%'><input type="submit" value='Filter' style="width: 100%;" class="btn btn-success"/></td>
                <td width='50%'><input type="reset" value='Reset' style="width: 100%;" class="btn btn-info"/></td>
            </tr>
        </table>
    </div>
</div>
</form>
<div class="kelang"></div><div class="kelang"></div>
<div class="panelcontainer" style="width: 100%;">
    <h3>DAFTAR PENGGUNA</h3>
    <div class="bodypanel">
        <input type="button" value="TAMBAH PENGGUNA" onclick="document.location.href='?mod=cp_tambah_pengguna';" style="height:45px; width:160px;" class="btn btn-success" /> &nbsp;&nbsp;
		  <input type="button" value="KEMBALI" onclick="document.location.href='?mod=c_panel';" style="height:45px; width:160px;" class="btn btn-info" />
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
        <tr class="headertable">
            <th width='40px'>No.</th>
            <th width='180'>Nama Pegawai</th>
            <th width='180'>Username</th>
            <th width='100'>Akses Level</th>
            <th width='25px'>&nbsp;</th>
            <th width='25px'>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <?php
		if(isset($_POST['nama']) || isset($_POST['nip'])){
				$whr = "";
				
				if(isset($_POST['nama'])){
					$whr = " WHERE a.nama LIKE '%".$_POST['nama']."%' ";
				}else if(isset($_POST['nip'])){
					$whr = " WHERE a.username LIKE '%".$_POST['nip']."%' ";
				}
			
				$res = mysql_query("SELECT 
										a.*, b.modul_pengguna as modul  
										FROM tbl_pengguna a
										LEFT JOIN 
											ref_modul_pengguna b ON  b.id_modul_pengguna = a.modul  
										".$whr."") or die(mysql_error());
            
				$ctr = 0;
				while($ds = mysql_fetch_array($res)){
					$ctr++;
				
        ?>
				<tr>
					<td align='center'><?php echo($ctr); ?></td>
					<td><?php echo($ds["nama"]); ?></td>
					<td><?php echo($ds["username"]); ?></td>
					<td><?php echo $ds["modul"]; ?></td>
					<td align='center'>
						<img src='image/Edit-32.png' width='18px' class='linkimage' title='Edit' onclick='editdata(<?php echo($ds["id_user"]); ?>);' />
					</td>
					<td>
						<img src='image/Delete-32.png' width='18px' class='linkimage' title='Hapus Pengguna' onclick='hapus(<?php echo($ds["id_user"]); ?>);' />
					</td>
				</tr>
        <?php
				}
		}		
        ?>
        </tbody>
        </table>
    </div>
</div>