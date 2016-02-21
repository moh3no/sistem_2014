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
    $ds = mysql_fetch_array(mysql_query("SELECT * FROM tbl_kata_sambutan_kaban"));
?>
<form name="frm" id="frm" action="php/kata_sambutan_kaban/kata_sambutan_kaban_adm.php" method="post">
<div class="panelcontainer panelform" style="width: 100%;">
    <h3 style="text-align: left;">KATA SAMBUTAN KEPALA BADAN</h3>
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <?php
            if(isset($_GET["sukses"])){
				if($_GET["sukses"] == 1){
					echo "<div class='alert alert-success' role='alert'>
						<strong>Selesai!</strong> Data Kata Sambutan Kepala Badan Telah Disimpan
					</div>";
				}
			}	
        ?>
        <textarea name="isi" id="isi"><?php echo($ds["kata_sambutan_kaban"]); ?></textarea><br />
        <button type="submit" class="btn btn-lg btn-primary">Simpan</button>
        <button type="reset" class="btn btn-lg btn-default">Reset</button>
    </div>
</div>
</form>