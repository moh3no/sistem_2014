<?php
	session_start();
	include "koneksi.php";
	/* INFORMASI MENGENAI FILE YANG DI UPLOAD */
	/* OLEH MASING-MASING PEGAWAI            */
	
	$fname = $_FILES['file_sc']['name'];
	$ftype = $_FILES['file_sc']['type'];
	$source = $_FILES['file_sc']['tmp_name'];
		
	$id_pangkat = $_POST['id_pangkat'];
	$id_pegawai = $_SESSION['simpeg_id_pegawai'];
	
	if($source == ""){
		echo "
				<script>
					alert('Maaf, pilih file anda dahulu!!');
					document.location.href = '../?mod=riwayat_pangkat';
				</script>	
			";
		exit;	
	}
	
	$fname = $id_pangkat . "-" . $id_pegawai . ".pdf";
	
	// dir tujuan
	$dest = "../sys_files/scan_sk_kenpang/" . $fname;
	
	if(file_exists($dest)){
		$dest = "../sys_files/scan_sk_kenpang/" . $fname;
	}
	
	// cek dan konversi jenis file dan tipe file
	if($ftype == "application/pdf"){
		
		$upload = move_uploaded_file($source, $dest);
		
		if($upload){
			mysql_query("UPDATE tbl_riwayat_pangkat SET img_sk = '$fname' WHERE id_pegawai = '$id_pegawai' AND id_pangkat = '$id_pangkat'") or die(mysql_error());
			echo "
				<script>
					alert('Upload File SK Sukses !!');
					document.location.href = '../?mod=riwayat_pangkat';
				</script>	
			";
		}else{
			echo "
				<script>
					alert('Maaf, Upload File Gagal !!');
					document.location.href = '../?mod=riwayat_pangkat';
				</script>	
			";
		}
	}else{
		echo "
			<script>
				alert('Maaf, Tipe File Harus PDF !!');
				document.location.href = '../?mod=riwayat_pangkat';
			</script>
		";
		exit;
	}
	
	