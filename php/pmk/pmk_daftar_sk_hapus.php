<?php
	session_start();
	include "../koneksi.php";
	include "../fungsi.php";
	
	// notification process function
	 function something_wrong($what_is_wrong){
        echo("
            <script type='text/javascript'>
                window.parent.window.something_wrong(\"" . $what_is_wrong . "\");
            </script>
        ");
    }
	
    function success($pesan_sukses){
        echo("
            <script type='text/javascript'>
                window.parent.window.sukses(\"" . $pesan_sukses . "\");
            </script>
        ");
    }
	
	$id_surat = mysql_real_escape_string($_GET['id_sk']);
	
	$sql = "DELETE FROM tbl_sk_pmk WHERE id_surat = '".$id_surat."'";
	
	$query = mysql_query($sql);
	
	if($query){
		$pesan = "Data SK PMK dengan ID " . $id_usul . " telah dihapus ";
		success($pesan);
	}else{
		something_wrong("QUERY ERROR, proses delete data SK PMK gagal !! ");
	}
	
	mysql_close();
	