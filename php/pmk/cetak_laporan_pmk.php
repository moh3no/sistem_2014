<?php
	error_reporting(0);
	ob_start();
	require_once "../dompdf_config.inc.php"; 
	include "../koneksi.php";
	include "../fungsi.php";
		
	$filename = empty($_POST['filename']) ? "LAPORAN_SIMPEG_PMK" : $_POST['filename'];
	
	if($_POST['jenis'] == '1'){
		$id_surat = $_POST['id_surat'];
		include "../../cetak/sk/pmk/dynamic/lampiran_sk_pmk.php";
	
	}else if($_POST['jenis'] == '2'){
		$id_surat = $_POST['id_surat'];
		include "../../cetak/sk/pmk/dynamic/petikan_sk.php";
		
	}else if($_POST['jenis'] == '3'){
		$id_surat = $_POST['id_surat'];
		include "../../cetak/sk/pmk/usul_pmk.php";
		
	}else{
		header("Location:../../?mod=cetak_laporan_pmk");
	}	

		// SET Format output file
		if($_POST['format'] == '2') {
			header("Content-type: application/x-msdownload");
			header("Content-Disposition: attachment; filename=".$filename.".doc");
			header("Pragma: no-cache");
			header("Expires: 0");
			echo $html;
		}
		elseif($_POST['format'] == '3') {
			header("Content-type: application/x-msdownload");
			header("Content-Disposition: attachment; filename=".$filename.".xls");
			header("Pragma: no-cache");
			header("Expires: 0");
			echo $html;
		}else if($_POST['format'] == '1'){
			$dompdf = new DOMPDF();
			$dompdf->load_html($html);
			$dompdf->set_paper("folio", "portrait");
			$dompdf->render();

			$dompdf->stream("". $filename .".pdf", array("Attachment" => false));
		}else{
		
			header("Location:../../?mod=cetak_laporan_pmk&gal=1");
			
		}