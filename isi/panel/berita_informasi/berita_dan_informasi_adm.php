<script type="text/javascript">
function edit(id_berita_informasi){
    document.location.href='?mod=berita_dan_informasi_adm_tambah&id_berita_informasi=' + id_berita_informasi;
}

function hapus(id_berita_informasi){
    jConfirm("Anda yakin akan menghapus data berita / informasi ini?", "PERHATIAN", function(r){
       if(r){
            document.location.href="php/berita_informasi/berita_dan_informasi_adm_hapus.php?id_berita_informasi=" + id_berita_informasi;
        } 
    });
}
</script>
<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-align: left;">DAFTAR BERITA DAN INFORMASI</h3>
    <div class="bodypanel">
        <input type="button" value="Tambah Berita Dan Informasi" onclick="document.location.href='?mod=berita_dan_informasi_adm_tambah&id_berita_informasi=0';" />
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%' class="listingtable">
        <thead>
            <tr class="headertable">
                <th width='40px'>No.</th>
                <th width='300px'>Judul</th>
                <th>Intro Teks</th>
                <th width='150px'>Tgl. Posting</th>
                <th width='20px'>&nbsp;</th>
                <th width='20px'>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $res = mysql_query("SELECT * FROM tbl_berita_informasi ORDER BY id_berita_informasi ASC") or die(mysql_error());
            $no = 0;
			$num_row  = mysql_num_rows($res);
			if($num_row <= 0){
				echo("<tr colspan='6'>
						<center><span style='color:grey; font-size:24px;'>TIDAK ADA BERITA YANG TELAH DI POSTING</span></center>
					  </tr>	
				");
			}else{
				while($ds = mysql_fetch_array($res)){
					$no++;
					echo("<tr>");
						echo("<td align='center'>" . $no . "</td>");
						echo("<td align='center'>" . $ds["judul"] . "</td>");
						echo("<td  align='justify'>" . $ds["intro"] . "</td>");
						echo("<td  align='center'>" . tglindonesia($ds["tgl_post"]) . "</td>");
						echo("<td>
                            <img src='image/Edit-32.png' width='18px' class='linkimage' title='Edit' onclick='edit(" . $ds["id_berita_informasi"] . ");' />
							</td>");
						echo("<td>
                            <img src='image/Delete-32.png' width='18px' class='linkimage' title='Hapus' onclick='hapus(" . $ds["id_berita_informasi"] . ");' />
                        </td>");
					echo("</tr>");
				}
			}	
        ?>
        </tbody>
        </table>
    </div>
</div>