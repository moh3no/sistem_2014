<form name="frmlogin" action="php/login.php" method="post">
<center>
    <div class="panelcontainer" style="width: 600px; margin: 50px 0px;">
        <h3 style="text-align: left;">LOGIN PENGGUNA</h3>
        <div class="bodypanel">
            <?php
		if(isset($_GET["galog"])){	
                if($_GET["galog"] == 1){
            ?>
                <div class="alert alert-info" role="alert">
                    <strong>Maaf !!!</strong> Username dan password tidak ditemukan
                </div>
            <?php
                }
			}	
            ?>
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <?php
                    if(isset($_GET["err_code"])){
                ?>
                    <tr>
                        <td colspan="3"><span class="err_msg"><?php echo($_GET["err_code"]) ?></span></td>
                    </tr>
                <?php
                    }
                ?>
                <tr>
                    <td><input type="text" name="username" placeholder="Username" /></td>
                </tr>
                <tr>
                    <td><input type="password" name="password" placeholder="Password" /></td>
                </tr>
            </table>
            <div class="kelang"></div>
            <table border="0px" cellspacing='0' cellpadding='0' width='100%'>
                <tr>
                    <td><button type="submit" class="btn btn-lg btn-default">Proses Login</button></td>
                </tr>
            </table>
        </div>
    </div>
</center>
</form>