<div class="panelcontainer" style="width: 100%;">
    <h3 style="text-align: left;">BERITA DAN INFORMASI</h3>
    <div class="bodypanel">
    <?php
        $sql = "SELECT * FROM tbl_berita_informasi ORDER BY id_berita_informasi DESC";
        $res = mysql_query($sql);
        while($ds = mysql_fetch_array($res)){
            echo("<div class='judul_berita'>" . $ds["judul"] . "</div>");
            echo("<div class='tgl_berita'>Dipost pada : " . tglindonesia($ds["tgl_post"]) . "</div>");
            echo("<div class='intro_berita'>" . $ds["intro"] . "</div>");
            echo("<div class='selengkapnya_berita'><a href='?mod=berita_dan_informasi_detail&id_berita_informasi=" . $ds["id_berita_informasi"] . "'>Berita Selengkapnya</a></div>");
            echo("<div class='kelang_border'></div>");
        }
    ?>
    </div>
</div>