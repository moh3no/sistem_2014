<?php

    include "../php/koneksi.php";
    include "../php/fungsi.php";
	//include "../php/mysqli_connect.php";
	
	$id_detail = mysql_real_escape_string($_GET['id_detail']);
	
	$sql = "SELECT * FROM tbl_detail_usulan_pangkat WHERE id_detail = '$id_detail'";
	$query = mysql_query($sql);
   
    $row = mysql_fetch_array($query);
	
	if($row['catatan'] != ''){
		echo "Catatan Penolakan : <br/>";
		echo $row['catatan'] . "<br/>";
	}else{
		echo "<center><b>Catatan Penolakan Kosong !!</b></center>";
	}
	
	
	
	
	