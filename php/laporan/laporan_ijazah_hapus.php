<?php
	include "../koneksi.php";
	include "../fungsi.php";
	
	$id_data = $_GET['id_data'];
	$filename = getFileIjazahPegawai($id_data);
	
	$dir = "../../sys_files/scan_sk_kenpang/".$filename;
	if(file_exists($dir)){
		unlink($dir);
	}
	
	$sql = "UPDATE tbl_riwayat_pangkat SET img_sk = '' WHERE id_riwayat_pangkat = '$id_data'";
	
	$query = mysql_query($sql) or die(mysql_error());
	
	if($query){
		echo "sukses";
	}else{
		echo "gagal";
	}
	