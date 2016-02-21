<?php
	include "../php/koneksi.php";					
?>

<form name="frm_add_tk_pendidikan" id="frm_add_tk_pendidikan" action="php/c_panel/cp_tambah_tk_pendidikan.php" method="POST">
<div class="panelcontainer" style="width: 100%;">
    <div class="bodypanel bodyfilter" id="bodyfilter">
        <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='50%'>
					<label>Kode Tingkat Pendidikan</label>
                    <input type="text" id="kode" name="kode" />
                </td>
            </tr>
        </table>
		<table border="0px" cellspacing='0' cellpadding='0' width='100%'>
            <tr>
                <td width='50%'>
					<label>Nama Tingkat Pendidikan</label>
                    <input type="text" id="nama" name="nama" />
                </td>
            </tr>
        </table>
        <table border="0px" cellspacing='0' cellpadding='0' width='20%'>
            <tr>
                <td width='50%'><input type="submit" value='SIMPAN' style="height: 30px; width: 100px;"  /></td>
				 <td width='50%'><input type="reset" value='RESET' style="height: 30px; width: 100px;"/></td>
            </tr>
        </table>
    </div>
</div>
</form>