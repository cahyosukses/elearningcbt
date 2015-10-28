<?php
include "includes/session.php";
include "includes/config.php";
include "includes/mysql.php";
include "includes/configsitus.php";
ob_start();
global $koneksi_db;
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="themes/administrator/css/login.css" type="text/css" />
<link rel="stylesheet" href="includes/bootstrap/css/bootstrap.css" type="text/css">
<link rel="shortcut icon" href="favicon.ico" >
<title><?php echo $judul_situs?>: Login</title>
</head>

<body onload="setFocus();">
<center>

<?php
$login  ='';
if (isset ($_POST['submit_login']) && @$_POST['loguser'] == 1){
$login .= aura_login ();

}

if (!cek_login ()){
?>
<div class="header">
<?php echo $judul_situs?>
</div>
<div id="ctr" align="center">
<center>
<div class="login">
<div class="login-form">
<form action="" method="post" name="login" id="loginForm">
<div class="form-block">
<div class="inputlabel"><p>Username</p></div>
<div><input name="username" type="text" class="form-control"  /></div>
<div class="inputlabel"><p>Password</p></div>
<div><input name="password" type="password" class="form-control"  /><input type="hidden" value="1" name="loguser" /></div><br>
<div align="left"><input type="submit" name="submit_login" class="btn btn-primary" value="Login" /></div>
</div>
</form>
</div>
<div class="login-text">
<div class="ctr"><img src="images/logo.png" width="100" height="auto" alt="security" /></div>
<p>Use only the right <strong>ID</strong> and <strong>Password</strong> to access the page.</p>
</div>
<div class="clr"></div>
</div>
</center>
</div>
<div class="footer">
Hak Cipta &copy; <script language="JavaScript" type="text/javascript">
    now = new Date
    theYear = now.getYear()
    if (theYear < 1900)
    theYear = theYear + 1900
    document.write(theYear)
</script> Tim TIK SMAK Frateran Surabaya
</div>
<?php

}else{
/*
if (session_is_registered ('LevelAkses') &&  $_SESSION['LevelAkses']=="Administrator"){
header("location:admin.php?pilih=main");
exit;
}*/
if (isset ($_SESSION['LevelAkses'])){
header("location:admin.php?pilih=main");
exit;
}
} //akhir cek login
echo $login;
?>
</center>
</body>
</html>
