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
$admin .='<div class="bordermenu">Administrasi Pengumuman</div>';
$admin .='<div class="panel panel-info">';

if($_GET['aksi']== 'del'){    
	global $koneksi_db;    
	$id     = int_filter($_GET['id']);    
	$hasil = $koneksi_db->sql_query("DELETE FROM `kelas` WHERE `id`='$id'");    
	if($hasil){    
		$admin.='<div class="sukses">Kelas berhasil dihapus! .</div>';    
		$style_include[] ='<meta http-equiv="refresh" content="1; url=admin.php?pilih=kelas&mod=yes" />';    
	}
}

if($_GET['aksi'] == 'edit'){
$id = int_filter ($_GET['id']);
if(isset($_POST['submit'])){
	$kelas 		= $_POST['kelas'];

	$error 	= '';
	if (!$kelas)  	$error .= "Error: Silahkan Isi Nama Kelas<br />";
	if (!$tunjangan)  	$tunjangan ='0';	
if ($koneksi_db->sql_numrows($koneksi_db->sql_query("SELECT kelas FROM kelas WHERE kelas='$kelas' and id<>'$id'")) > 0) $error .= "Error: Kelas ".$kelas." sudah terdaftar , silahkan ulangi.<br />";
	if ($error){
		$tengah .= '<div class="error">'.$error.'</div>';
	}else{
		$hasil  = mysql_query( "UPDATE `kelas` SET `kelas`='$kelas' WHERE `id`='$id'" );
		if($hasil){
			$admin .= '<div class="sukses"><b>Berhasil di Update.</b></div>';
			$style_include[] ='<meta http-equiv="refresh" content="1; url=admin.php?pilih=kelas&amp;mod=yes" />';	
		}else{
			$admin .= '<div class="error"><b>Gagal di Update.</b></div>';
		}
	}

}
$query 		= mysql_query ("SELECT * FROM `kelas` WHERE `id`='$id'");
$data 		= mysql_fetch_array($query);
$admin .='<div class="panel-heading"><b>Edit Kelas</b></div>';
$admin .= '
<form method="post" action=""class="form-inline">
<table border="0" cellspacing="0" cellpadding="0"class="table table-striped table-hover">
	<tr>
		<td>Kelas</td>
		<td>:</td>
		<td><input type="text" name="kelas" value="'.$data['kelas'].'" size="25"class="form-control"></td>
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
	$kelas 		= $_POST['kelas'];
	$error 	= '';
	if (!$kelas)  	$error .= "Error: Silahkan Isi Kelas<br />";
if ($koneksi_db->sql_numrows($koneksi_db->sql_query("SELECT kelas FROM kelas WHERE kelas='$kelas'")) > 0) $error .= "Error: Kelas ".$kelas." sudah terdaftar , silahkan ulangi.<br />";
	if ($error){
		$admin .= '<div class="error">'.$error.'</div>';
	}else{
		$hasil  = mysql_query( "INSERT INTO `kelas` (`kelas`) VALUES ('$kelas')" );
		if($hasil){
			$admin .= '<div class="sukses"><b>Berhasil di Buat.</b></div>';
		}else{
			$admin .= '<div class="error"><b> Gagal di Buat.</b></div>';
		}
		unset($kelas);
	}

}
$kelas     		= !isset($kelas) ? '' : $kelas;
$admin .='<div class="panel-heading"><b>Tambah Kelas</b></div>';
$admin .= '
<form method="post" action="" class="form-inline">
<table class="table table-striped table-hover">
	<tr>
		<td>Kelas</td>
		<td>:</td>
		<td><input type="text" name="kelas" value="'.$kelas.'" size="30" class="form-control"></td>
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
$hasil = $koneksi_db->sql_query( "SELECT * FROM kelas order by kelas asc" );
$admin .='<div class="panel-heading"><b>Data Kelas</b></div>';
$admin .= '<table id="example" class="table table-striped table-hover">
<thead><tr>
<th>No</th>
<th>Kelas</th>
<th>Aksi</th>
</tr></thead><tbody>';
$no = 1;
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$kelas=$data['kelas'];
$admin .='<tr>
<td><b>'.$no.'</b></td>
<td>'.$kelas.'</td>
<td><a href="?pilih=kelas&amp;mod=yes&amp;aksi=del&amp;id='.$data['id'].'" onclick="return confirm(\'Apakah Anda Yakin Ingin Menghapus Data Ini ?\')"><span class="btn btn-danger">Hapus</span></a> <a href="?pilih=kelas&amp;mod=yes&amp;aksi=edit&amp;id='.$data['id'].'"><span class="btn btn-warning">Edit</span></a></td>
</tr>';
$no++;
}
$admin .= '</tbody></table>';
/************************************/
}
$admin .='</div>';
echo $admin;

?>