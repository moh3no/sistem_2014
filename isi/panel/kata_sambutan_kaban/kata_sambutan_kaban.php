<?php
    $ds = mysql_fetch_array(mysql_query("SELECT * FROM tbl_kata_sambutan_kaban"));
?>
<div class="panelcontainer panelform" style="width: 100%;">
    <h3 style="text-align: left;">KATA SAMBUTAN KEPALA BADAN</h3>
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <?php echo($ds["kata_sambutan_kaban"]); ?>
    </div>
</div>