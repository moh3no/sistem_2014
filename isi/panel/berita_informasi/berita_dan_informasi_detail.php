<?php
    $ds = mysql_fetch_array(mysql_query("SELECT * FROM tbl_berita_informasi WHERE id_berita_informasi='" . $_GET["id_berita_informasi"] . "'"));
?>
<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-align: left;"><?php echo(strtoupper($ds["judul"])); ?></h3>
    <div class="bodypanel">
        <input type="button" value="Kembali" onclick="document.location.href='?mod=berita_dan_informasi_list';" />
        <div class="kelang"></div>
        <div class="intro_berita"><?php echo($ds["isi"]); ?></div>
    </div>
</div>