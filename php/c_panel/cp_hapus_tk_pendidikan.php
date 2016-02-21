<?php
	
	include "../mysqli_connect.php";
	
	$id = $_GET['id'];
	
	$sql = "DELETE FROM ref_tk_pendidikan WHERE id_tk_pendidikan = ?";
	
	$stm = $con->prepare($sql);
	
	$stm->bind_param('i', $id);
	
	$exc = $stm->execute();
	
	if($exc){
		header('Location:../../?mod=cp_manage_tk_pendidikan&msg=3');
	}else{
		header('Location:../../?mod=cp_manage_tk_pendidikan&msg=4');
	}
	