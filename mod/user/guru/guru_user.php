<?php
if(ereg(basename (__FILE__), $_SERVER['PHP_SELF']))
{
	header("HTTP/1.1 404 Not Found");
	exit;
}
$admin = null;
if (!cek_login ()){
   $admin .='<p class="judul">Access Denied !!!!!!</p>';
   
}else{

global $koneksi_db,$PHP_SELF,$theme,$error;

if($_GET['aksi']=="change"){
$admin .='<div class="panel panel-info">
<div class="panel-heading"><b>Edit Password</b></div>';
if (isset($_POST["submit"])) {

$user		   = $_SESSION['UserName'];
$password0 = md5($_POST["password0"]);
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];

$hasil = $koneksi_db->sql_query( "SELECT password FROM useraura WHERE user='$user'" );
while ($data = $koneksi_db->sql_fetchrow($hasil)){
	$password=$data['password'];
}

if (!$password0)  $error .= "Error: Please enter your Old Password!<br />";
if (!$password1)  $error .= "Error: Please enter new password!<br />";
if (!$password2)  $error .= "Error: Please retype your your new password!<br />";
//if (!is_valid_email($email)) $error .= "Error, E-Mail address invalid!<br />";
if ($password0 != $password)  $error .= "Invalid old pasword, silahkan ulangi lagi.<br />";
if ($password1 != $password2)   $error .= "New password dan retype berbeda, silahkan ulangi.<br />";
//if ($koneksi_db->sql_numrows($koneksi_db->sql_query("SELECT email FROM useraura WHERE email='$email' and user!='$user'")) > 0) $error .= "Error: Email ".$email." sudah terdaftar , silahkan ulangi.<br />";

if ($error) {
$admin.='<div class="error">'.$error.'</div>';
} else {

$password3=md5($password1);
$hasil = $koneksi_db->sql_query( "UPDATE useraura SET password='$password3' WHERE user='$user'" );

$admin.='<div class="sukses"><b>Password telah di updated</b><br />Silahkan <a href="?aksi==logout" target="_top">Logout</a> kemudian <a href="?pilih=login" target="_top">Login</a> lagi!</div>';
}

}

$user =  $_SESSION['UserName'];
$hasil =  $koneksi_db->sql_query( "SELECT * FROM useraura WHERE user='$user'" );
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
	$id=$data['id'];
	$user=$data['user'];
	$nama=$data['nama'];
}


$admin .='

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

$admin .='</div>';
}

if($_GET['aksi']=="profil"){
$user =  $_SESSION['UserName'];
$admin .='<div class="panel panel-info">
<div class="panel-heading"><b>Edit Profil</b></div>';
if (isset($_POST["submit"])) {
$nama = $_POST['nama'];
//$email	      = text_filter($_POST['email']);
//$statusemail = $_POST['statusemail'];
//$statustelp = $_POST['statustelp'];
//$telp = $_POST['telp'];
//$mapel = $_POST['mapel'];
if (!is_valid_email($email)) $error .= "Error, E-Mail address invalid!<br />";
if ($error) {
$admin.='<div class="error">'.$error.'</div>';
} else {
$up = mysql_query ("UPDATE `useraura` SET `nama`='$nama' WHERE `user`='$user'");	
$admin.='<div class="sukses">Data '.$user.'  Berhasil Diupdate</div>';	
}
}
$s = mysql_query ("SELECT * FROM `useraura` WHERE `user`='$user'");	
$data = mysql_fetch_array($s);
$user = $data['user'];	
$level = $data['level'];	
$tipe = $data['tipe'];
$email = $data['email'];
$nama = $data['nama'];
$statusemail = $data['statusemail'];
$statustelp = $data['statustelp'];
$telp = $data['telp'];
$mapel = getmapel($data['mapel']);
$admin .= "<form method='post'>
<table style='width:100%;border:0' cellpadding='2' class='table table-striped table-hover'>
  <tr>
    <td width='30%' valign='top'>User </td>
    <td width='1%' valign='top'>:</td>
    <td width='69%' valign='top'><input type='text' name='user' size='20' class='form-control'value='$user' disabled='disabled' /></td>
  </tr>";
$admin .= "
  <tr>
    <td width='30%' valign='top'>Nama Lengkap </td>
    <td width='1%' valign='top'>:</td>
    <td width='69%' valign='top'><input type='text' name='nama' size='20'class='form-control'value='$nama' /></td>
  </tr>";  
  
$sel = '<select name="level"class="form-control">';
//$arrs = ''.substr ($arrs,4);
//$arr = eval( '$arr5 = array'.$arrs.';' );
$arr5 = array ('Administrator','Guru');
foreach ($arr5 as $k=>$v){
	if ($level == $v){
	$sel .= '<option value="'.$v.'" selected="selected">'.$v.'</option>';
	}else {
	$sel .= '<option value="'.$v.'">'.$v.'</option>';	
	}
}

$sel .= '</select>';  
  
$sel2 = '<select name="tipe"class="form-control">';
$arr2 = array ('aktif','pasif');
foreach ($arr2 as $kk=>$vv){
	if ($tipe == $vv){
	$sel2 .= '<option value="'.$vv.'" selected="selected">'.$vv.'</option>';
	}else {
	$sel2 .= '<option value="'.$vv.'">'.$vv.'</option>';	
	}
}

$sel2 .= '</select>';    
/**********************************************************/  
$sel3 = '<select name="statusemail"class="form-control">';
$arr3 = array ('sembunyikan','tampilkan');
foreach ($arr3 as $k2=>$v2){
	if ($statusemail == $v2){
	$sel3 .= '<option value="'.$v2.'" selected="selected">'.$v2.'</option>';
	}else {
	$sel3 .= '<option value="'.$v2.'">'.$v2.'</option>';	
	}
}
$sel3 .= '</select>';      
$sel4 = '<select name="statustelp"class="form-control">';
$arr4 = array ('sembunyikan','tampilkan');
foreach ($arr4 as $k3=>$v3){
	if ($statustelp == $v3){
	$sel4 .= '<option value="'.$v3.'" selected="selected">'.$v3.'</option>';
	}else {
	$sel4 .= '<option value="'.$v3.'">'.$v3.'</option>';
	}	
}
$sel4 .= '</select>';    
  
$admin .= "<tr>
    <td width='30%' valign='top'>Level </td>
    <td width='1%' valign='top'>:</td>
    <td width='69%' valign='top'>$level</td>
  </tr>";
  $admin .= "    <tr>
    <td width='30%' valign='top'>Mata Pelajaran </td>
    <td width='1%' valign='top'>:</td>
    <td width='69%' valign='top'>$mapel</td>
  </tr>";  

$admin .= "<tr><td width='30%'>&nbsp;</td>
    <td width='1%'>&nbsp;</td>
    <td width='69%'><br /><input type='submit' value='Update' name='submit' class='btn btn-success'/></td>
  </tr>
</table></form>";
$admin .= '</div>';
}

if($_GET['aksi'] == 'photo'){
$user =  $_SESSION['UserName'];
if (isset($_POST['submit'])){
define("GIS_GIF", 1);
define("GIS_JPG", 2);
define("GIS_PNG", 3);
define("GIS_SWF", 4);
include "includes/hft_image.php";

$username  		= $_POST['username'];
$namafile_name 	= $_FILES['gambar']['name'];
$extension = end(explode('.', $_FILES['gambar']['name']));
$error 	= '';
if ($extension!='jpg')  	$error .= "Error: Format ekstensi jpg<br />";
if ($error){
$admin.='<div class="error">'.$error.'</div>';

}else{

if (!empty ($namafile_name)){

    $files = $_FILES['gambar']['name'];
    $tmp_files = $_FILES['gambar']['tmp_name'];
    $tempnews 	= 'mod/user/temp/';
    $namagambar = $username .'.jpg';
    $uploaddir = $tempnews . $namagambar; 
    $uploads = move_uploaded_file($tmp_files, $uploaddir);
	if (file_exists($uploaddir)){
		@chmod($uploaddir,0644);
	}
	$tnews 		= 'mod/user/photo/';
    $small 	= $tnews . $namagambar;
	create_thumbnail ($uploaddir, $small, $new_width = 100, $new_height = 'auto', $quality = 85);
if ($jumlah){
$seftitle = $seftitle.$jumlah;
}
    //masukkan data
    //$tgl= date('Y-m-d H:i:s');
    $hasil = $koneksi_db->sql_query( "update useraura set photo ='$namagambar'where user='$username'" );
    if($hasil){
    $admin.='<div class="sukses">Berhasil Update Photo ...</div>';
			$style_include[] ='<meta http-equiv="refresh" content="1; url=admin.php?pilih=user&amp;mod=yes&amp;aksi=photo" />';	
}
}
}
}

$query 		= mysql_query ("SELECT * FROM `useraura` WHERE `user`='$user'");
$data 		= mysql_fetch_array($query);
$username = $data['user'];
$photo = $data['photo'];
if($photo){
$photo = '<img src="mod/user/photo/'.$photo.'">';
}else{
$photo = '<img src="mod/user/photo/default-photo.jpg">';
}
$admin .='<div class="panel panel-info">';
$admin .='<div class="panel-heading"><b>Upload Photo Profil</b></div>';
$admin .= '
<form method="post" action=""class="form-inline" enctype ="multipart/form-data">
<table border="0" cellspacing="0" cellpadding="0"class="table table-striped table-hover">
	<tr>
		<td></td>
		<td></td>
		<td>'.$photo.'</td>
	</tr>
	<tr>
		<td>Nama</td>
		<td>:</td>
		<td><input type="text" name="nama" value="'.$data['nama'].'" disabled class="form-control"></td>
	</tr>
	<tr>
		<td>Photo</td>
		<td>:</td>
		<td><input type="file" name="gambar" class="form-control"></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td>
		<input type="hidden" name="username" value="'.$username.'">
		<input type="submit" value="Upload" name="submit"class="btn btn-success"></td>
	</tr>
</table>
</form>';
$admin .= '</div>';
}


}


echo $admin;


?>