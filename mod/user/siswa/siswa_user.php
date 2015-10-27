<?php
if(ereg(basename (__FILE__), $_SERVER['PHP_SELF']))
{
	header("HTTP/1.1 404 Not Found");
	exit;
}
$tengah = null;

global $koneksi_db,$error;

if($_GET['aksi']=="change"){

if (!cek_login ()){
   $tengah .='<p class="judul">Access Denied !!!!!!</p>';
   
}else{

global $koneksi_db,$PHP_SELF,$theme,$error;

$tengah .='<div class="panel panel-info">
<div class="panel-heading"><b>Edit Password</b></div>';
if (isset($_POST["submit"])) {

$user		   = $_SESSION['UserName'];
//$email	      = text_filter($_POST['email']);
$password0 = md5($_POST["password0"]);
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];

$hasil = $koneksi_db->sql_query( "SELECT password,email FROM useraura WHERE user='$user'" );
while ($data = $koneksi_db->sql_fetchrow($hasil)){
	$password=$data['password'];
	$email0=$data['email'];
}

if (!$password0)  $error .= "Error: Please enter your Old Password!<br />";
if (!$password1)  $error .= "Error: Please enter new password!<br />";
if (!$password2)  $error .= "Error: Please retype your your new password!<br />";
//if (!is_valid_email($email)) $error .= "Error, E-Mail address invalid!<br />";
if ($password0 != $password)  $error .= "Invalid old pasword, silahkan ulangi lagi.<br />";
if ($password1 != $password2)   $error .= "New password dan retype berbeda, silahkan ulangi.<br />";
//if ($koneksi_db->sql_numrows($koneksi_db->sql_query("SELECT email FROM useraura WHERE email='$email' and user!='$user'")) > 0) $error .= "Error: Email ".$email." sudah terdaftar , silahkan ulangi.<br />";

if ($error) {
$tengah.='<div class="error">'.$error.'</div>';
} else {

$password3=md5($password1);
$hasil = $koneksi_db->sql_query( "UPDATE useraura SET password='$password3' WHERE user='$user'" );

$tengah.='<div class="sukses"><b>Password telah di updated</b><br />Silahkan <a href="?aksi=logout" target="_top">Logout</a> kemudian <a href="?pilih=login" target="_top">Login</a> lagi!</div>';
}

}

$user =  $_SESSION['UserName'];
$hasil =  $koneksi_db->sql_query( "SELECT * FROM useraura WHERE user='$user'" );
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
	$id=$data['id'];
	$user=$data['user'];
	$nama=$data['nama'];
}


$tengah .='

<form method="post" action="#">
    <table class="table">
        <tr>
            <td>Username</td>
            <td>'.$user.'</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>'.$nama.'</td>
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
            <input type="hidden" name="id" value="'.@$UserId.'" />
            <input type="hidden" name="user" value="'.@$user.'" />
            <input type="submit" name="submit" value="Update" class="btn btn-success" />
            </td>
        </tr>
    </table>
</form> ';
$tengah .='</div>';
}
}

echo $tengah;


?>