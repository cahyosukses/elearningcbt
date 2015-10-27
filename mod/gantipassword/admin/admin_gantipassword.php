<?php
if (!defined('AURACMS_admin')) {
	Header("Location: ../index.php");
	exit;
}

$script_include[] = $JS_SCRIPT;
$admin = '';

if (!cek_login ()){
   $admin .='<h4 class="bg">Access Denied !!!!!!</h4>';
}else{

global $koneksi_db,$PHP_SELF,$theme,$error;

if($_GET['aksi']==""){

$admin .='<div class="panel panel-info">
<div class="panel-heading"><b>Edit Password</b></div>';

if (isset($_POST["submit"])) {

$user		   = text_filter($_POST['user']);
$password0 = md5($_POST["password0"]);
$password1 = $_POST["password1"];
$password2 = $_POST["password2"];


$hasil = $koneksi_db->sql_query( "SELECT password FROM useraura WHERE user='$user'" );
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
	$password=$data['password'];
	}
$error = '';
if (!$password0)  $error .= "Error: Please enter your Old Password!<br />";
if (!$password1)  $error .= "Error: Please enter new password!<br />";
if (!$password2)  $error .= "Error: Please retype your your new password!<br />";
if ($password0 != $password)  $error .= "Invalid old pasword, silahkan ulangi lagi.<br />";
if ($password1 != $password2)   $error .= "New password dan retype berbeda, silahkan ulangi.<br />";


if ($error) {

$admin .='<div class="error">'.$error.'</div>';

} else {

$password3=md5($password1);
$hasil = $koneksi_db->sql_query( "UPDATE useraura SET user='$user', password='$password3' WHERE user='$user'" );

$admin.='<div class="border"><table width="100%" class="bodyline"><tr><td align="left"><img src="images/info.gif" border="0"></td><td align="center"><font class="option"><b>Infromasi Admin telah di updated</b><br />Silahkan <a href="?aksi=logout" target="_top">Logout</a> kemudian <a href="?pilih=login" target="_top">Login</a> lagi!<br /></font></td><td align="right"><img src="images/info.gif" border="0"></td></tr></table></div>';
}

}

$user =  $_SESSION['UserName'];
$hasil =  $koneksi_db->sql_query( "SELECT * FROM useraura WHERE user='$user'" );
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
	$id=$data[0];
	$user=$data[1];
}

$admin .='
<form method="post" action="">
    <table class="table">
        <tr>
            <td>Username</td>
            <td>'.$user.'</td>
        </tr>
        <tr>
            <td>Old Password</td>
            <td><input type="password" size="10" name="password0" class="form-control"/></td>
        </tr>
        <tr>
            <td>New Password</td>
            <td><input type="password" size="10" name="password1" class="form-control"/></td>
        </tr>
        <tr>
            <td>Retype New Password</td>
            <td><input type="password" size="10" name="password2" class="form-control"/></td>
        </tr>
        <tr>
            <td></td><td colspan="2">
            <input type="hidden" name="user" value="'.$user.'" />
            <input type="submit" name="submit" value="Update" class="btn btn-success" />
            </td>
        </tr>
    </table>
</form> ';
$admin .='</div>';
}


}
echo $admin;
?>