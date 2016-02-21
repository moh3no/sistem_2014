<?php

	include "../koneksi.php";
	include "../fungsi.php";
	include "../mysqli_connect.php";
	
	$id_sk = $_POST['id_sk'];
	$id_detail = get_id_detail_sk_pmk();
	
	$nip = $_POST['nip_2'];
	$id_pegawai = detail_pegawai_by_nip($nip, "id_pegawai");

	$tmt = $_POST['tmt2'];
	$status = 1;
	
	$sql = "INSERT INTO tbl_sk_pmk_detail VALUES(?,?,?,?,?)";
	
	$stm = $con->prepare($sql);
	
	$stm->bind_param('iiisi', $id_detail, $id_sk, $id_pegawai, $tmt, $status);
	
	$query = $stm->execute();
	
	if($query){
		echo "
			<script>
				alert('Tambah Data Pegawai Sukses !!');
				document.location.href='../../?mod=sk_pmk_tambah_pegawai&id_data=".$id_sk."';
			</script>	
		";
	}else{
		echo "
			<script>
				alert('Maaf, Tambah Data Gagal !!');
				document.location.href='../../?mod=sk_pmk_tambah_pegawai&id_data=".$id_sk."';
			</script>	
		";
	}
	
			
	
	
	