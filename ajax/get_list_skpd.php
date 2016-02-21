<?php
    session_start();
    include("../php/koneksi.php");
	include("../php/fungsi.php");
	
	$filter = $_GET['filter'];
   
    $sql = "SELECT * FROM ref_skpd WHERE skpd LIKE '%". $filter ."%'";
				
    $res = mysql_query($sql) or die(mysql_error());
	
	$num_row = mysql_num_rows($res);
	
		$no = 0;
		while($ds = mysql_fetch_array($res)){
			$no++;
			echo("<tr>");
            echo("<td align='center'>" . $no . "</td>");
            echo("<td align='center'>" . $ds["kode_skpd"] . "</td>");
            echo("<td align='center'>" . $ds["skpd"] . "</td>");
            echo("<td align='center'>" . $ds["alamat_skpd"] . "</td>");
			$s_skpd = $ds["id_skpd"] ;
            echo("<td>
                    <img src='image/Button Next_32.png' width='18px' class='linkimage' title='Pilih Data ini' onclick='pilih_skpd(".$s_skpd.");' />
                  </td>");
			echo("</tr>");
	}	
		
			echo "<tr>";
			echo "<td colspan='5'><span>HASIL PENCARIAN : <b>".$num_row."</b> Data. </span></td>";	
			echo "</tr>";
?>