<?php
    $tipe_fd = "";
    if($_GET["tipe_fd"] == 1)
        $tipe_fd = "FILE DOWNLOAD";
    else if($_GET["tipe_fd"] == 2)
        $tipe_fd = "TATA CARA PENGGUNAAN";
        
    $ds_file = mysql_fetch_array(mysql_query("SELECT judul, keterangan FROM tbl_file_download WHERE MD5(id_file)='" . $_GET["id_file"] . "'"));
?>
<form name="frm" id="frm" action="php/file_download/file_download_adm_tambah.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="tipe_fd" value="<?php echo($_GET["tipe_fd"]); ?>" />
<input type="hidden" name="id_file" value="<?php echo($_GET["id_file"]); ?>" />
<div class="panelcontainer panelform" style="width: 100%;">
    <h3 style="text-align: left;">TAMBAH DATA <?php echo($tipe_fd); ?></h3>
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <?php
            if(isset($_GET["err"])){
        ?>
                <div class="alert alert-danger" role="alert">
                    <strong>Upload Gagal!</strong> <?php echo($_GET["err"]); ?>
                </div>
        <?php
            }
        ?>
        <button type="button" class="btn btn-lg btn-info" onclick="document.location.href='?mod=file_download_adm&tipe_fd=<?php echo($_GET["tipe_fd"]); ?>';">Kembali</button>
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td>
                    <label>Judul :</label>
                    <input placeholder=":: Judul ::" type="text" name="judul" id="judul" value="<?php echo($ds_file["judul"]); ?>" />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Keterangan :</label>
                    <input placeholder=":: Keterangan ::" type="text" name="keterangan" id="keterangan" value="<?php echo($ds_file["keterangan"]); ?>" />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Pilih File Yang Akan Di Upload : <?php if($_GET["id_file"] != "0"){echo("(Kosongkan jika tidak ingin merubah file yang lama)");} ?></label>
                    <input type="file" name="file" placeholder=":: Pilih File ::" />
                </td>
            </tr>
        </table>
        <div class="kelang"></div>
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td style="text-align: left;">
                    <button type="submit" class="btn btn-lg btn-success">Upload</button>
                    <button type="submit" class="btn btn-lg btn-default">Reset</button>
                </td>
            </tr>
        </table>
    </div>
</div>
</form>