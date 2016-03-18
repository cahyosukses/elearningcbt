<?php
if (!defined('AURACMS_admin')) {
	Header("Location: ../index.php");
	exit;
}

$admin = '';

if (!cek_login ()){
   $admin .='<h4 class="bg">Access Denied !!!!!!</h4>';
}else{

global $koneksi_db,$PHP_SELF,$theme,$error,$url_situs;
$admin .='<section class="content-header">
          <h1>
            Setting Website
            <small>Mengatur Website</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="./admin.php?pilih=settingwebsite&mod=yes"><i class="fa fa-dashboard"></i>Home</a></li>
			<li>Settings</li>
            <li class="active">Setting Website</li>
          </ol>
        </section>';
$admin .='
<section class="content-header">
<a class="btn btn-default btn-flat" href="./admin.php?pilih=settingwebsite&mod=yes" >
<i class="fa fa-plug">&nbsp;</i> Setting <span class="badge bg-green"></span></a>
<a class="btn btn-default btn-flat" href="./admin.php?pilih=settingwebsite&mod=yes&aksi=logo" > <i class="fa fa-photo">&nbsp;</i>Logo Website</span></a>
<a class="btn btn-default btn-flat" href="./admin.php?pilih=settingwebsite&mod=yes&aksi=icon" > <i class="fa fa-paw">&nbsp;</i>Icon Website</span></a>
</section>';
$admin .='
<section class="content">';
if($_GET['aksi']==""){

if (isset($_POST["submit"])) {
$judul_situs = $_POST["judul_situs"];
$slogan = $_POST["slogan"];
$email_master = $_POST["email_master"];
$description = $_POST["description"];
$keywords = $_POST["keywords"];
$error = '';
if (!$judul_situs)  $error .= "Error: Judul Situs tidak boleh kosong!<br />";
if (!$slogan)  $error .= "Error: Slogan Situs tidak boleh kosong!<br />";
if (!$email_master)  $error .= "Error: Email Master Situs tidak boleh kosong!<br />";
if (!$description)  $error .= "Error: Description Situs tidak boleh kosong!<br />";
if (!$keywords)  $error .= "Error: Keyword Situs tidak boleh kosong!<br />";
if ($error) {

    $admin.='<div class="alert alert-warning fade in">
                                  <button data-dismiss="alert" class="close close-sm" type="button">
                                      <i class="icon-remove"></i>
                                  </button>
                                  <strong>Error !</strong> <br>'.$error.'.
                              </div>';

} else {

$password3=md5($password1);
$hasil = $koneksi_db->sql_query( "UPDATE situs SET judul_situs='$judul_situs', slogan='$slogan', email_master='$email_master', description='$description', keywords='$keywords' WHERE id='1'" );

    $admin.='<div class="alert alert-success fade in">
                                  <button data-dismiss="alert" class="close close-sm" type="button">
                                      <i class="icon-remove"></i>
                                  </button>
                                  <strong>Success !</strong> Website berhasil di Update.
                              </div>';
}
}
$user =  $_SESSION['UserName'];
$hasil =  $koneksi_db->sql_query( "SELECT * FROM situs WHERE id='1'" );
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
	$id=$data[0];
	$judul_situs=$data['judul_situs'];
	$slogan=$data['slogan'];
	$email_master=$data['email_master'];
	$description=$data['description'];
	$keywords=$data['keywords'];
	$webmastercode=$data['webmastercode'];
	$analyticcode=$data['analyticcode'];
}
$admin .= '<div class="box">
                <div class="box-header">
                  <h3 class="box-title">Settings Website</h3>
                </div><!-- /.box-header -->
                <div class="box-body">';
$admin.='<form method="post" action="">';
$admin .= '<div class="form-group">
<label class="col-sm-2 control-label">Judul Situs</label>
<div class="col-sm-10">
<input type="text" size="80" name="judul_situs" value="'.$judul_situs.'" class="form-control"/>
<span class="help-block"></span>
</div>
</div>';
$admin .= '<div class="form-group">
<label class="col-sm-2 control-label">Slogan Situs</label>
<div class="col-sm-10">
<input type="text" size="80" name="slogan" value="'.$slogan.'" class="form-control"/>
<span class="help-block"></span>
</div>
</div>';
$admin .= '<div class="form-group">
<label class="col-sm-2 control-label">Email Master</label>
<div class="col-sm-10">
<input type="text" size="80" name="email_master" value="'.$email_master.'" class="form-control"/>
<span class="help-block">Setiap Kontak pada halaman web akan di teruskan ke email master</span>
</div>
</div>';
$admin .= '<div class="form-group">
<label class="col-sm-2 control-label">Deskripsi</label>
<div class="col-sm-10">
<input type="text" size="80" name="description" value="'.$description.'" class="form-control"/>
<span class="help-block"></span>
</div>
</div>';
$admin .= '<div class="form-group">
<label class="col-sm-2 control-label">Keywords</label>
<div class="col-sm-10">
<input type="text" size="80" name="keywords" value="'.$keywords.'" class="form-control"/>
<span class="help-block"></span>
</div>
</div>';
$admin .= '<div class="form-group">
<label class="col-sm-2 control-label"><input type="hidden" name="id" value="'.$id.'" /></label>
<div class="col-sm-10"><input type="submit" name="submit" value="Simpan" class="btn btn-success" /></div>
</div>';
$admin .= '</form>';
$admin .= '</div><!-- /.box-body -->
</div><!-- /.box -->';

}

if($_GET['aksi']=="logo"){
if (isset($_POST['submit'])){
define("GIS_GIF", 1);
define("GIS_JPG", 2);
define("GIS_PNG", 3);
define("GIS_SWF", 4);
include "includes/hft_image.php";
$namafile_name 	= $_FILES['gambar']['name'];
if (!empty ($namafile_name)){
    $files = $_FILES['gambar']['name'];
    $tmp_files = $_FILES['gambar']['tmp_name'];
    $tempnews 	= 'images/';
    $namagambar = 'logo.png';
    $uploaddir = $tempnews . $namagambar; 
    $uploads = move_uploaded_file($tmp_files, $uploaddir);
	if (file_exists($uploaddir)){
		@chmod($uploaddir,0644);
	}
	$gnews 		= '';
	$nsmall = $gnews . $namagambar;
	create_thumbnail ($uploaddir, $nsmall, $new_width = 'auto', $new_height = 'auto', $quality = 70);
	
    $admin.='<div class="alert alert-success fade in">
                                  <button data-dismiss="alert" class="close close-sm" type="button">
                                      <i class="icon-remove"></i>
                                  </button>
                                  <strong>Success !</strong> Website berhasil di Update.
                              </div>';
$style_include[] ='<meta http-equiv="refresh" content="1; url=?pilih=admin_info&aksi=logo" />';
}
}
$admin .= '<div class="box">
                <div class="box-header">
                  <h3 class="box-title">Logo Website</h3>
                </div><!-- /.box-header -->
                <div class="box-body">';
$admin.='<form method="post" action=""enctype ="multipart/form-data" id="posts">';
$admin .= '<div class="form-group">
<label class="col-sm-2 control-label">Preview Logo</label>
<div class="col-sm-10">
<img src="'.$url_situs.'/images/logo.png" height="75" style="padding:3px; border:1px solid #dddddd;">
<span class="help-block"></span>
</div>
</div>';
$admin .= '<div class="form-group">
<label class="col-sm-2 control-label">Upload Logo</label>
<div class="col-sm-10">
<input type="file" name="gambar" size="53">
<span class="help-block">Upload Logo dengan Extensi .PNG</span>
</div>
</div>';
$admin .= '<div class="form-group">
<label class="col-sm-2 control-label"><input type="hidden" name="id" value="'.$id.'" /></label>
<div class="col-sm-10"><input type="submit" name="submit" value="Simpan" class="btn btn-success" /></div>
</div>';
$admin .= '</form>';
$admin .= '</div><!-- /.box-body -->
</div><!-- /.box -->';	
}

if($_GET['aksi']=="icon"){
if (isset($_POST['submit'])){
define("GIS_GIF", 1);
define("GIS_JPG", 2);
define("GIS_PNG", 3);
define("GIS_SWF", 4);
include "includes/hft_image.php";
$namafile_name 	= $_FILES['gambar']['name'];
if (!empty ($namafile_name)){
    $files = $_FILES['gambar']['name'];
    $tmp_files = $_FILES['gambar']['tmp_name'];
    $tempnews 	= ''.$_SERVER["DOCUMENT_ROOT"].'/';
    $namagambar = 'favicon.ico';
    $uploaddir = $tempnews . $namagambar; 
    $uploads = move_uploaded_file($tmp_files, $uploaddir);
	if (file_exists($uploaddir)){
		@chmod($uploaddir,0644);
	}
	$gnews 		= '';
	$nsmall = $gnews . $namagambar;
	create_thumbnail ($uploaddir, $nsmall, $new_width = 100, $new_height = 100, $quality = 100);
	
$admin.='<div class="sukses">Berhasil update favicon</div>';
$style_include[] ='<meta http-equiv="refresh" content="1; url=?pilih=admin_info&aksi=favicon" />';
}
}
$admin .= '<div class="box">
                <div class="box-header">
                  <h3 class="box-title">Icon Website</h3>
                </div><!-- /.box-header -->
                <div class="box-body">';
$admin.='<form method="post" action=""enctype ="multipart/form-data" id="posts">';
$admin .= '<div class="form-group">
<label class="col-sm-2 control-label">Preview Favicon</label>
<div class="col-sm-10">
<img src="'.$url_situs.'/favicon.ico" style="padding:3px; border:1px solid #dddddd;">
<span class="help-block"></span>
</div>
</div>';
$admin .= '<div class="form-group">
<label class="col-sm-2 control-label">Upload Favicon</label>
<div class="col-sm-10">
<input type="file" name="gambar" size="53">
<span class="help-block">Upload Logo dengan Extensi .ICO</span>
</div>
</div>';
$admin .= '<div class="form-group">
<label class="col-sm-2 control-label"><input type="hidden" name="id" value="'.$id.'" /></label>
<div class="col-sm-10"><input type="submit" name="submit" value="Simpan" class="btn btn-success" /></div>
</div>';
$admin .= '</form>';
$admin .= '</div><!-- /.box-body -->
</div><!-- /.box -->';	
}
$admin .= '</section>';
}
echo $admin;
?>