<?php
if (!defined('AURACMS_admin')) {
    Header("Location: ../index.php");
    exit;
}

if (!cek_login()){
    header("location: index.php");
    exit;
} else{
$JS_SCRIPT.= <<<js
<script language="JavaScript" type="text/javascript">
$(document).ready(function() {
    $('#example').dataTable({
    "iDisplayLength":50});
} );
</script>
js;
$script_include[] = $JS_SCRIPT;
	
//$index_hal=1;	
$admin .= ' <div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="icon_group"></i> Users Manager</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="admin.php?pilih=user&amp;mod=yes">Home</a></li>
						<li><i class="icon_toolbox"></i>Settings</li>
						<li><i class="fa fa-list-alt"></i><a href="admin.php?pilih=user&amp;mod=yes&amp;aksi=add">Tambah Users</a></li>
					</ol>
				</div>
			</div>';	


if ($_GET['aksi'] == 'hapus' && is_numeric($_GET['id'])){
	$id = int_filter ($_GET['id']);
	$user = getuserguru($id);
$hasil = $koneksi_db->sql_query( "SELECT * FROM kursus_setting  where guru='$user'" );
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$idkursus     = $data['id'];  
$hapus = $koneksi_db->sql_query("DELETE FROM `soal` WHERE `ujian`='$idkursus'"); 
}
$hapus = mysql_query ("DELETE FROM `ujian` WHERE `guru`='$user'");	
$hapus = mysql_query ("DELETE FROM `kursus_setting` WHERE `guru`='$user'");	
$hapus = mysql_query ("DELETE FROM `useraura` WHERE `UserId`='$id' AND `user`!='admin'");	
if ($hapus){
$admin.='<div class="sukses">Data Berhasil Dihapus Dengan ID = '.$id.'</div>';	
}else {
$admin.='<div class="error">Data Gagal dihapus Dengan ID = '.$id.'</div>';	
}	
}

if (isset ($_POST['edit_users']) && is_numeric($_GET['id'])){
	$id = int_filter ($_GET['id']);
	$level = $_POST['level'];
	$tipe = $_POST['tipe'];
	$nama = $_POST['nama'];
//	$email	      = text_filter($_POST['email']);
//$statusemail = $_POST['statusemail'];
//$statustelp = $_POST['statustelp'];
//$telp = $_POST['telp'];
$mapel = $_POST['mapel'];
//if (!is_valid_email($email)) $error .= "Error, E-Mail address invalid!<br />";
if ($error) {
$admin.='<div class="alert alert-block alert-danger fade in">'.$error.'</div>';
} else {
$up = mysql_query ("UPDATE `useraura` SET `level`='$level',`tipe`='$tipe',`nama`='$nama',`mapel`='$mapel' WHERE `UserId`='$id'");	
$admin.='<div class="alert alert-success fade in">Data Berhasil Diupdate Dengan ID = '.$id.'</div>';	
}
}

if ($_GET['aksi'] == 'add'){
	
	
if (isset($_POST['add_users'])){
	
$user = cleantext($_POST['user']);	
$level = cleantext($_POST['level']);	
$tipe = cleantext($_POST['tipe']);
$password = cleantext($_POST['password']);
//$email = cleantext($_POST['email']);
$nama = cleantext($_POST['nama']);
//$statusemail = $_POST['statusemail'];
//$statustelp = $_POST['statustelp'];
//$telp = $_POST['telp'];
$mapel = $_POST['mapel'];

if (empty($_POST['nama']))  $error .= "Error: Formulir nama belum diisi , silahkan ulangi.<br />";
if (empty($_POST['user']))  $error .= "Error: Formulir user belum diisi , silahkan ulangi.<br />";
//if (empty($_POST['email']))  $error .= "Error: Formulir email belum diisi , silahkan ulangi.<br />";
if (empty($_POST['password']))  $error .= "Error: Formulir Password belum diisi , silahkan ulangi.<br />";
if (!$user || preg_match("/[^a-zA-Z0-9_-]/", $user)) $error .= "Error: Karakter Username tidak diizinkan kecuali a-z,A-Z,0-9,-, dan _<br />";
if (strlen($user) > 10) $error .= "Username Terlalu Panjang Maksimal 10 Karakter<br />";
if (strrpos($user, " ") > 0) $error .= "Username Tidak Boleh Menggunakan Spasi";
if ($koneksi_db->sql_numrows($koneksi_db->sql_query("SELECT user FROM useraura WHERE user='$user'")) > 0) $error .= "Error: Username ".$user." sudah terdaftar , silahkan ulangi.<br />";
//if ($koneksi_db->sql_numrows($koneksi_db->sql_query("SELECT email FROM useraura WHERE email='$email'")) > 0) $error .= "Error: Email ".$email." sudah terdaftar , silahkan ulangi.<br />";
//if ($email and !is_valid_email($email)) $error .= "Error: E-Mail address invalid!<br />";
if ($error){
        $admin.='<div class="alert alert-block alert-danger fade in">'.$error.'</div>';
}else{
$query = mysql_query ("INSERT INTO `useraura` (`user`,`password`,`level`,`tipe`,`nama`,`mapel`) VALUES ('$user',md5('$password'),'$level','$tipe','$nama','$mapel')");	
$admin .= '<div class="alert alert-success fade in">Data Berhasil Di add</div>';
}
	
}	
	
	

$ss = mysql_query ("SHOW FIELDS FROM useraura");
while ($as = mysql_fetch_array ($ss)){
	 $arrs = $as['Type'];
	
	if (substr($arrs,0,4) == 'enum' && $as['Field'] == 'level') break;
}

if (isset ($_GET['offset']) && isset ($_GET['pg']) && isset ($_GET['stg'])) {
$qss = "&pg=$pg&stg=$stg&offset=$offset";
}	
$admin.='<section class="panel">
                          <header class="panel-heading">
                              Tambah User
                          </header>';
$admin.= "<form method='post' action='#'>
<table  class='table table-condensed'>
  <tr>
    <td width='30%' valign='top'>User </td>
    <td width='1%' valign='top'>:</td>
    <td width='69%' valign='top'><input type='text' name='user' size='20' class='form-control'required/></td>
  </tr> 
  <tr>
    <td width='30%' valign='top'>Password </td>
    <td width='1%' valign='top'>:</td>
    <td width='69%' valign='top'><input type='text' name='password' class='form-control'size='20' required/></td>
  </tr>
  <tr>
    <td width='30%' valign='top'>Nama Lengkap </td>
    <td width='1%' valign='top'>:</td>
    <td width='69%' valign='top'><input type='text' name='nama' size='20' class='form-control'required/></td>
  </tr> ";
  
  
$sel = '<select name="level" class="form-control">';
//$arrs = ''.substr ($arrs,4);
//$arr = eval( '$arr5 = array'.$arrs.';' );
$arr5 = array ('Guru','Administrator');
foreach ($arr5 as $k=>$v){
	$sel .= '<option value="'.$v.'">'.$v.'</option>';	
	
}

$sel .= '</select>';  
  
$sel2 = '<select name="tipe"class="form-control">';
$arr2 = array ('aktif','pasif');
foreach ($arr2 as $kk=>$vv){
	$sel2 .= '<option value="'.$vv.'">'.$vv.'</option>';	
}
$sel2 .= '</select>'; 
/**********************************************************/   
$admin .= "<tr>
    <td width='30%' valign='top'>Level </td>
    <td width='1%' valign='top'>:</td>
    <td width='69%' valign='top'>$sel</td>
  </tr>";

$admin .= "<tr>
    <td width='30%' valign='top'>Status</td>
    <td width='1%' valign='top'>:</td>
    <td width='69%' valign='top'>$sel2</td>
  </tr>";  
  $admin .= '<tr>
		<td>Mata Pelajaran</td>
		<td>:</td>
		<td>
<select name="mapel" class="form-control">';
$hasil = $koneksi_db->sql_query("SELECT * FROM mapel ORDER BY mapel");
$admin .= '<option value="">== Semua ==</option>';
while ($datas =  $koneksi_db->sql_fetchrow ($hasil)){
$admin .= '<option value="'.$datas['id'].'" '.$pilihan.'>'.$datas['mapel'].'</option>';
}
$admin .='</select></td>
	</tr>';
$admin .= "<tr><td width='30%'>&nbsp;</td>
    <td width='1%'>&nbsp;</td>
    <td width='69%'><br /><input type='submit' value='Simpan' name='add_users' class='btn btn-success'/></td>
  </tr>
</table></form>";	
	
	
	
}

if ($_GET['aksi'] == 'edit'){
global $qss;
$id = int_filter($_GET['id']);
$s = mysql_query ("SELECT * FROM `useraura` WHERE `UserId`='$id'");	
$data = mysql_fetch_array($s);
$user = $data['user'];	
$level = $data['level'];	
$tipe = $data['tipe'];
//$email = $data['email'];
$nama = $data['nama'];
//$statusemail = $data['statusemail'];
//$statustelp = $data['statustelp'];
//$telp = $data['telp'];
$mapel = $data['mapel'];
$ss = mysql_query ("SHOW FIELDS FROM useraura");
while ($as = mysql_fetch_array ($ss)){
	 $arrs = $as['Type'];
if (substr($arrs,0,4) == 'enum' && $as['Field'] == 'level') break;
}

if (isset ($_GET['offset']) && isset ($_GET['pg']) && isset ($_GET['stg'])) {
$qss = "&amp;pg=$pg&amp;stg=$stg&amp;offset=$offset";
}	
$admin.='<section class="panel">
                          <header class="panel-heading">
                              Edit User
                          </header>';
$admin .= "<form method='post' action='admin.php?pilih=user&amp;mod=yes&amp;id=$id$qss'>
<table  class='table table-condensed'>
  <tr>
    <td width='30%' valign='top'>User </td>
    <td width='1%' valign='top'>:</td>
    <td width='69%' valign='top'><input type='text' name='user' size='20' class='form-control'value='$user' disabled='disabled' /></td>
  </tr>";
$admin .= "
  <tr>
    <td width='30%' valign='top'>Nama Lengkap </td>
    <td width='1%' valign='top'>:</td>
    <td width='69%' valign='top'><input type='text' name='nama' size='20' class='form-control'value='$nama' /></td>
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
  
$admin .= "<tr>
    <td width='30%' valign='top'>Level </td>
    <td width='1%' valign='top'>:</td>
    <td width='69%' valign='top'>$sel</td>
  </tr>";

$admin .= "<tr>
    <td width='30%' valign='top'>Status</td>
    <td width='1%' valign='top'>:</td>
    <td width='69%' valign='top'>$sel2</td>
  </tr>";  
  $admin .= '<tr>
		<td>Mata Pelajaran</td>
		<td>:</td>
		<td>
<select name="mapel" class="form-control">';
$hasil = $koneksi_db->sql_query("SELECT * FROM mapel ORDER BY mapel");
$admin .= '<option value="">== Semua ==</option>';
while ($datas =  $koneksi_db->sql_fetchrow ($hasil)){
		if ($datas['id'] == $mapel){
			$pilihan ='selected';
		}else{
			$pilihan ='';
}
$admin .= '<option value="'.$datas['id'].'" '.$pilihan.'>'.$datas['mapel'].'</option>';
}
$admin .='</select></td>
	</tr>';  

$admin .= "<tr><td width='30%'>&nbsp;</td>
    <td width='1%'>&nbsp;</td>
    <td width='69%'><br /><input type='submit' value='Simpan' name='edit_users' class='btn btn-success'/></td>
  </tr>
</table></form>";	
}

if (!in_array($_GET['aksi'],array('add','edit','hint','addhint','editpassword','photo'))){

$hasil = $koneksi_db->sql_query( "SELECT * FROM `useraura`where level <>'Siswa' and user<>'superadmin'" );
$admin.='<section class="panel">
                          <header class="panel-heading">
                              Daftar User
                          </header>';
$admin .="<form method='post' action=''>";
$admin.='
<table id="example" class="table">
<thead><tr>
    <td align="center"><b>User</b></td>
    <td align="center"><b>Nama</b></td>
    <td align="center"><b>Level</b></td>
    <td align="center"><b>Mapel</b></td>
    <td align="center" width="270px"><b>Actions</b></td>
  </tr></thead><tbody>';

while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$photo = $data['photo'];
if($photo){
$linkphoto = '<a href="?pilih=user&amp;mod=yes&amp;aksi=photo&amp;id='.$data['UserId'].$qss.'"><span class="btn btn-success">Photo</span></a>';
}else{
$linkphoto = '<a href="?pilih=user&amp;mod=yes&amp;aksi=photo&amp;id='.$data['UserId'].$qss.'"><span class="btn btn-default">Photo</span></a>';
}
	$admin.='
  <tr>
    <td>'.$data['user'].'</td>
    <td>'.$data['nama'].'</td>
    <td>'.$data['level'].'</td>
    <td>'.getmapel($data['mapel']).'</td>
    <td>
     <a href="?pilih=user&amp;mod=yes&amp;aksi=hapus&amp;id='.$data['UserId'].$qss.'" onclick="return confirm(\'Apakah Anda Yakin Ingin Menghapus User Ini ?\')"><span class="btn btn-danger">Hapus</span></a>
	 <a href="?pilih=user&amp;mod=yes&amp;aksi=edit&amp;id='.$data['UserId'].$qss.'"><span class="btn btn-warning">Edit</span></a>
	 <a href="?pilih=user&amp;mod=yes&amp;aksi=editpassword&amp;id='.$data['UserId'].$qss.'"><span class="btn btn-primary">Password</span></a>
	 '.$linkphoto.'
	 </td>
  </tr>';  
}
$admin .= '<tbody></table>';
$admin .="</form>";
}

if($_GET['aksi'] == 'editpassword'){
$id = int_filter ($_GET['id']);
if(isset($_POST['submit'])){
	$password 		= $_POST['password'];

	$error 	= '';
	if (!$password)  	$error .= "Error: Silahkan Isi password<br />";
	if ($error){
		$tengah .= '<div class="alert alert-block alert-danger fade in">'.$error.'</div>';
	}else{
		$hasil  = mysql_query( "UPDATE `useraura` SET `password`=md5('$password') WHERE `UserId`='$id'" );
		if($hasil){
			$admin .= '<div class="alert alert-success fade in"><b>Password Berhasil di Update.</b></div>';
			$style_include[] ='<meta http-equiv="refresh" content="1; url=admin.php?pilih=user&amp;mod=yes" />';	
		}else{
			$admin .= '<div class="alert alert-block alert-danger fade in"><b>Gagal di Update.</b></div>';
		}
	}

}
$query 		= mysql_query ("SELECT * FROM `useraura` WHERE `UserId`='$id'");
$data 		= mysql_fetch_array($query);
$admin.='<section class="panel">
                          <header class="panel-heading">
                              Edit Pasword User
                          </header>';
$admin .= '
<form method="post" action=""class="form-inline">
<table class="table table-condensed">
	<tr>
		<td>Nama</td>
		<td>:</td>
		<td><input type="text" name="nama" value="'.$data['nama'].'" disabled class="form-control"></td>
	</tr>
	<tr>
		<td>Password</td>
		<td>:</td>
		<td><input type="password" name="password" class="form-control"></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td>
		<input type="submit" value="Simpan" name="submit"class="btn btn-success"></td>
	</tr>
</table>
</form>';
}

if($_GET['aksi'] == 'photo'){
$id = int_filter ($_GET['id']);
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
$admin.='<div class="alert alert-block alert-danger fade in">'.$error.'</div>';

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
    $admin.='<div class="alert alert-success fade in">Berhasil Update Photo ...</div>';

unlink($uploaddir);
}
}
}
}

$query 		= mysql_query ("SELECT * FROM `useraura` WHERE `UserId`='$id'");
$data 		= mysql_fetch_array($query);
$username = $data['user'];
$photo = $data['photo'];
if($photo){
$photo = '<img src="mod/user/photo/'.$photo.'">';
}else{
$photo = '<img src="mod/user/photo/default-photo.jpg">';
}
$admin.='<section class="panel">
                          <header class="panel-heading">
                              Profil Picture User
                          </header>';
$admin .= '
<form method="post" action=""class="form-inline" enctype ="multipart/form-data">
<table class="table table-striped table-hover">
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

}



$admin .='</div>';
}
echo $admin;
?>
