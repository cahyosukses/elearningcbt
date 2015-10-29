<?php
if (!defined('AURACMS_admin')) {
	Header("Location: ../index.php");
	exit;
}

//$index_hal = 1;
if (!cek_login ()){   
	
$admin .='<p class="judul">Access Denied !!!!!!</p>';
}else{
$JS_SCRIPT.= <<<js
<script language="JavaScript" type="text/javascript">
$(document).ready(function() {
    $('#example').dataTable({
    "iDisplayLength":50});
} );
</script>
js;
$script_include[] = $JS_SCRIPT;
	$admin .= '<div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-list-alt"></i> Mata Pelajaran</h3>
					<ol class="breadcrumb">
					<li><i class="fa fa-home"></i><a href="admin.php?pilih=mapel&amp;mod=yes">Home</a></li>
					</ol>
				</div>
			</div>';
			

$temp = 'mod/mapel/temp/';
$thumb = 'mod/mapel/';
if($_GET['aksi']== 'del'){    
	global $koneksi_db;    
	$id     = int_filter($_GET['id']);    
	$cek  = $koneksi_db->sql_query( "SELECT icon FROM mapel WHERE id=$id" );
while($data = mysql_fetch_array($cek)){ 
$icon = $data['icon'];
$uploaddir2 = $thumb . $icon;
unlink($uploaddir2);
}
	$hasil = $koneksi_db->sql_query("DELETE FROM `mapel` WHERE `id`='$id'");    
	if($hasil){    
		$admin.='<div class="sukses">Mata Pelajaran berhasil dihapus! .</div>';    
		$style_include[] ='<meta http-equiv="refresh" content="1; url=admin.php?pilih=mapel&mod=yes" />';    
	}
}

if($_GET['aksi'] == 'edit'){
$id = int_filter ($_GET['id']);
if(isset($_POST['submit'])){
define("GIS_GIF", 1);
define("GIS_JPG", 2);
define("GIS_PNG", 3);
define("GIS_SWF", 4);
include "includes/hft_image.php";
$mapel 		= $_POST['mapel'];
$icon = $_FILES['icon']['name'];
$icon_lama = text_filter($_POST['icon_lama']);
	$error 	= '';
	if (!$mapel)  	$error .= "Error: Silahkan Isi Nama mapel<br />";
	if (!$tunjangan)  	$tunjangan ='0';	
if ($koneksi_db->sql_numrows($koneksi_db->sql_query("SELECT mapel FROM mapel WHERE mapel='$mapel' and id<>'$id'")) > 0) $error .= "Error: mapel ".$mapel." sudah terdaftar , silahkan ulangi.<br />";
	if ($error){
		$tengah .= '<div class="error">'.$error.'</div>';
	}else{
	if (!empty ($icon)){
$files     = $_FILES['icon']['name'];
$tmp_files = $_FILES['icon']['tmp_name'];
$simpan    = md5 (rand(1,100).$files) .'.jpg';
$uploaddir = $temp . $simpan; 
$uploads   = move_uploaded_file($tmp_files, $uploaddir);
	if (file_exists($uploaddir)){
		@chmod($uploaddir,0644);
	}
$small = $thumb . $simpan;
$large = $normal . $simpan;
create_thumbnail ($uploaddir, $small, $new_width = 150, $new_height = auto, $quality = 100);	
		$hasil  = mysql_query( "UPDATE `mapel` SET `mapel`='$mapel', `icon`='$simpan'  WHERE `id`='$id'" );
		}else{
		$hasil  = mysql_query( "UPDATE `mapel` SET `mapel`='$mapel'  WHERE `id`='$id'" );
		}
		if($hasil){
			$admin .= '<div class="sukses"><b>Berhasil di Update.</b></div>';
			$style_include[] ='<meta http-equiv="refresh" content="1; url=admin.php?pilih=mapel&amp;mod=yes" />';	
unlink($uploaddir);
$timg = $thumb . $icon_lama;
unlink($timg);
		}else{
			$admin .= '<div class="error"><b>Gagal di Update.</b></div>';
		}
	}

}
$query 		= mysql_query ("SELECT * FROM `mapel` WHERE `id`='$id'");
$data 		= mysql_fetch_array($query);
$admin .='<div class="panel-heading"><b>Edit mapel</b></div>';
$admin .= '
<form method="post" action=""class="form-inline" enctype ="multipart/form-data">
<table border="0" cellspacing="0" cellpadding="0"class="table table-striped table-hover">
	<tr>
		<td>mapel</td>
		<td>:</td>
		<td><input type="text" name="mapel" value="'.$data['mapel'].'" size="25"class="form-control"></td>
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

if($_GET['aksi']==""){

if(isset($_POST['submit'])){
define("GIS_GIF", 1);
define("GIS_JPG", 2);
define("GIS_PNG", 3);
define("GIS_SWF", 4);
$mapel 		= $_POST['mapel'];
$icon = $_FILES['icon']['name'];	
	$error 	= '';
	if (!$mapel)  	$error .= "Error: Silahkan Isi mapel<br />";
if ($koneksi_db->sql_numrows($koneksi_db->sql_query("SELECT mapel FROM mapel WHERE mapel='$mapel'")) > 0) $error .= "Error: mapel ".$mapel." sudah terdaftar , silahkan ulangi.<br />";
	if ($error){
		$admin .= '<div class="error">'.$error.'</div>';
	}else{
$files     = $_FILES['icon']['name'];
$tmp_files = $_FILES['icon']['tmp_name'];
$simpan    = md5 (rand(1,100).$files) .'.jpg';
$uploaddir = $temp . $simpan; 
$uploads   = move_uploaded_file($tmp_files, $uploaddir);
	if (file_exists($uploaddir)){
		@chmod($uploaddir,0644);
	}
$small = $thumb . $simpan;
create_thumbnail ($uploaddir, $small, $new_width = 150, $new_height = auto, $quality = 100);

		$hasil  = mysql_query( "INSERT INTO `mapel` (`mapel`,`icon`) VALUES ('$mapel','$simpan')" );
		if($hasil){
		$admin .= '<div class="sukses"><b>Berhasil di Buat.</b></div>';
	//	unlink($uploaddir);
		unset($mapel);
		}else{
			$admin .= '<div class="error"><b> Gagal di Buat.</b></div>';
	//	unlink($uploaddir);
		unset($mapel);
		}

	}
unlink($uploaddir);
}
$mapel     		= !isset($mapel) ? '' : $mapel;
$icon     		= !isset($icon) ? '' : $icon;
$admin .='<div class="panel-heading"><b>Tambah Mapel</b></div>';
$admin .= '
<form method="post" action="" class="form-inline"enctype ="multipart/form-data">
<table class="table table-striped table-hover">
	<tr>
		<td>Mapel</td>
		<td>:</td>
		<td><input type="text" name="mapel" value="'.$mapel.'" size="30" class="form-control" required></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td>
		<input type="submit" value="Tambah" name="submit"class="btn btn-success" ></td>
	</tr>
</table>
</form>';	
}

/************************************/
$hasil = $koneksi_db->sql_query( "SELECT * FROM mapel order by mapel asc" );
$admin .='<div class="panel-heading"><b>Data mapel</b></div>';
$admin .= '<table id="example" class="table table-striped table-hover">
<thead><tr>
<th>No</th>
<th>Mata Pelajaran</th>
<th>Aksi</th>
</tr></thead><tbody>';
$no = 1;
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$mapel=$data['mapel'];
$icon=$data['icon'];
if(!$icon){
$icon='default.jpg';
}
$admin .='<tr>
<td><b>'.$no.'</b></td>
<td>'.$mapel.'</td>
<td><a href="?pilih=mapel&amp;mod=yes&amp;aksi=del&amp;id='.$data['id'].'" onclick="return confirm(\'Apakah Anda Yakin Ingin Menghapus Data Ini ?\')"><span class="btn btn-danger">Hapus</span></a> <a href="?pilih=mapel&amp;mod=yes&amp;aksi=edit&amp;id='.$data['id'].'"><span class="btn btn-warning">Edit</span></a></td>
</tr>';
$no++;
}
$admin .= '</tbody></table>';
/************************************/
}
$admin .='</div>';
echo $admin;

?>