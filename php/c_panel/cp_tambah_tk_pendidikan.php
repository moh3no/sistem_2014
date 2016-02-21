<?php

	include "../mysqli_connect.php";
	
	// data POST
	$kode = $_POST['kode'];
	$tk = $_POST['nama'];
	
	if($kode == "" || $tk == "" || ($kode == "" && $tk == "")){
		header('Location:../../?mod=cp_manage_tk_pendidikan&msg=5');
		exit;
	}
	
	$sql = " INSERT INTO ref_tk_pendidikan(id_tk_pendidikan, kode, namaTkPendidikan) 
			 VALUES(?,?,?) ";
			 
	$st = $con->prepare($sql);
	$st->bind_param('iss', $id, $kode, $tk);
	
	$query = $st->execute();

	if($query){
		header('Location:../../?mod=cp_manage_tk_pendidikan&msg=1');
	}else{
		header('Location:../../?mod=cp_manage_tk_pendidikan&msg=4');
	}	