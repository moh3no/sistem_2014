<?php
    session_start();
    include("../php/koneksi.php");
	include("../php/fungsi.php");
	
	$id_usulan = $_GET['id_usulan'];
   
    $sql = "SELECT 
            	b.id_pegawai, b.nama_pegawai, b.nip, 
            	c.pangkat, c.gol_ruang,
            	d.jabatan, e.skpd 
            FROM
				tbl_detail_usul_pmk a 
            	LEFT JOIN tbl_pegawai b ON a.nip = b.nip 
            	LEFT JOIN ref_pangkat c ON b.id_pangkat = c.id_pangkat 
            	LEFT JOIN ref_jabatan d ON b.id_jabatan = d.id_jabatan 
            	LEFT JOIN ref_skpd e ON b.id_satuan_organisasi = e.id_skpd 
            WHERE 
            	a.id_usulan = '". $id_usulan ."'   
            ORDER BY 
                b.nama_pegawai ASC";
				
    $res = mysql_query($sql) or die(mysql_error());
	$num_row = mysql_num_rows($res);
	
		$no = 0;
		while($ds = mysql_fetch_array($res)){
			$no++;
		if(!is_tersedia_in_lampiran_sk_kenpang($ds['id_pegawai'])){	
			echo("<tr>");
            echo("<td align='center'>" . $no . "</td>");
            echo("<td align='center'>" . $ds["nama_pegawai"] . "</td>");
            echo("<td align='center'>" . $ds["nip"] . "</td>");
            echo("<td align='center'>" . $ds["pangkat"] . "</td>");
            echo("<td align='center'>" . $ds["gol_ruang"] . "</td>");
            echo("<td align='center'>" . $ds["jabatan"] . "</td>");
            echo("<td align='center'>" . $ds["skpd"] . "</td>");
            echo("<td>
                    <img src='image/Button Next_32.png' width='18px' class='linkimage' title='Pilih Pegawai ini' onclick='select_pegawai(\"" . $_GET["id_textbox"] . "\", \"" . $ds["nip"] . "\")' />
                  </td>");
			echo("</tr>");
		}
	}	
	// tambahkan total data 
?>