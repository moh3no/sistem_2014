<script type="text/javascript">
$(document).ready(function(){
// here is where we call the CKEditor & hold it with CKFinder =================================
	   var editor = CKEDITOR.replace("isi");
	   CKFinder.setupCKEditor(editor, "ckfinder") ;
//=============================================================================================

    $("#frm").submit(function(){
        var judul = frm.judul.value;
        var intro = frm.intro.value;
        var isi = frm.isi.value;
        if(judul == "" || intro == "")
            jAlert("Maaf, input harus lengkap. Semua input harus diisi", "PERHATIAN");
        else{
            jConfirm("Anda yakin akan memposting berita / informasi ini?", "PERHATIAN", function(r){
               if(r){
                    frm.submit();
               }else{
                    return false;
               }
            });
        }
        return false;
    });
});
</script>
<?php
    $ket = "";
    if($_GET["id_berita_informasi"] == 0)
        $ket = "TAMBAH";
    else
        $ket = "EDIT";
    $ds = mysql_fetch_array(mysql_query("SELECT * FROM tbl_berita_informasi WHERE id_berita_informasi='" . $_GET["id_berita_informasi"] . "'"));
?>
<form name="frm" id="frm" action="php/berita_informasi/berita_dan_informasi_adm_tambah.php" method="post">
<input type="hidden" name="id_berita_informasi" value="<?php echo($_GET["id_berita_informasi"]); ?>" />
<div class="panelcontainer panelform" style="width: 100%;">
    <h3 style="text-align: left;"><?php echo($ket); ?> BERITA DAN INFORMASI</h3>
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <input type="button" value="Kembali" onclick="document.location.href='?mod=berita_dan_informasi_adm';" />
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <label>Judul Berita / Informasi</label>
                    <input placeholder=":: Judul Berita / Informasi ::" type="text" name="judul" id="judul" value="<?php echo($ds["judul"]); ?>" />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Intro Text</label>
                    <textarea name="intro" id="intro" placeholder=":: Intro Teks ::"><?php echo($ds["intro"]); ?></textarea>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Isi Berita / Informasi</label>
                    <textarea name="isi" id="isi"><?php echo($ds["isi"]); ?></textarea>
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td style="text-align: left;">
                    <input type="submit" value="SIMPAN" style="width: 150px; height: 40px;" />
                    <input type="reset" value="RESET" style="width: 150px; height: 40px;" />
                </td>
            </tr>
        </table>
    </div>
</div>
</form>