<?php
if (!defined('AURACMS_CONTENT')) {
	Header("Location: ../index.php");
	exit;
}
$JS_SCRIPT.= <<<js
<script language="JavaScript" type="text/javascript">
$(document).ready(function() {
    $('#example').dataTable({
    "iDisplayLength":50});
} );
</script>
js;
$script_include[] = $JS_SCRIPT;
$index_hal=1;
$admin .='<div class="bordermenu">Kumpul Tugas</div>';
$admin .='<div class="border">
<a href="?pilih=tugas&amp;mod=yes">Lihat Tugas</a>';
$admin .='</div>';
$admin .='<div class="panel panel-info">';
if($_GET['aksi']==""){
/************************************/

$hasil = $koneksi_db->sql_query( "SELECT * FROM tugas order by id desc" );
$admin .='<div class="panel-heading"><b>Data Tugas</b></div>';
$admin .= '<table id="example" class="table table-striped table-hover">
<thead><tr>
<th>No</th>
<th>Tugas</th>
<th>TglMulai</th>
<th>TglAkhir</th>
<th width="150px">Aksi</th>
</tr></thead><tbody>';
$no = 1;
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$judul=$data['judul'];
$tglmulai=$data['tglmulai'];
$tglakhir=$data['tglakhir'];
$tglnow = date("Y-m-d");
$haritelat = gethariterlambat($tglakhir,$tglnow);
if($haritelat > '0'){
$uploadbutton ='<span class="btn btn-danger">Disable</span>';
}else{
$uploadbutton ='<a href="?pilih=tugas&amp;mod=yes&amp;aksi=kumpul&amp;id='.$data['id'].'"><span class="btn btn-success">Upload</span></a>';
}
$admin .='<tr>
<td><b>'.$no.'</b></td>
<td>'.$judul.'</td>
<td>'.$tglmulai.'</td>
<td>'.$tglakhir.'</td>
<td>'.$uploadbutton.' <a href="?pilih=tugas&amp;mod=yes&amp;aksi=lihat&amp;id='.$data['id'].'"><span class="btn btn-warning">Lihat Data</span></a></td>
</tr>';
$no++;
}
$admin .= '</tbody></table>';
/************************************/
}

if($_GET['aksi']=="kumpul"){
if (isset($_POST['submit'])){
$namafile_name 	= $_FILES['tugas']['name'];
$nama     		= $_POST['nama'];
$kelas     		= $_POST['kelas'];
$idtugas     		= $_POST['idtugas'];
 $tugas_size = $_FILES['tugas']['size'];
if ($tugas_size > 2048000)  $error .= "Error: Upload File ukuran melebihi batas.<br />";
if (empty ($namafile_name))  $error .= "Error: Upload File tidak boleh kosong.<br />";
if ($error){
$admin.='<div class="error">'.$error.'</div>';
}else{
    $files = $_FILES['tugas']['name'];
    $tmp_files = $_FILES['tugas']['tmp_name'];
    $tempnews 	= 'mod/tugas/download/';
	move_uploaded_file($tmp_files, "$tempnews/$files");
    $hasil = $koneksi_db->sql_query( "insert into tugassiswa values('','$idtugas','$nama','$kelas','$files')" );
$style_include[] ='<meta http-equiv="refresh" content="1; url=?pilih=tugas&mod=yes" />';
}
}
$id = int_filter ($_GET['id']);
$admin .='<div class="panel-heading"><b>Kumpulkan Tugas</b></div>';
$query 		= mysql_query ("SELECT * FROM `tugas` WHERE `id`='$id'");
$data 		= mysql_fetch_array($query);
$idtugas=$data['id'];
$admin .= '
<form method="post" action=""class="form-inline" id="posts" enctype ="multipart/form-data">
<table border="0" cellspacing="0" cellpadding="0"class="table table-striped table-hover">
	<tr>
		<td>Judul Tugas</td>
		<td>:</td>
		<td><input type="text" name="judul" value="'.$data['judul'].'" size="25"class="form-control" disabled></td>
	</tr>
	<tr>
		<td>Tanggal Dikumpulkan</td>
		<td>:</td>
		<td><input type="text" name="judul" value="'.$data['tglakhir'].'" size="25"class="form-control" disabled></td>
	</tr>
	<tr>
		<td>Nama</td>
		<td>:</td>
		<td><input type="text" name="nama" value="'.$nama.'" size="25"class="form-control" required></td>
	</tr>
	<tr>
		<td>Kelas</td>
		<td>:</td>
		<td><input type="text" name="kelas" value="'.$kelas.'" size="25"class="form-control"required></td>
	</tr>
	<tr>
		<td>Upload File</td>
		<td>:</td>
		<td><input type="file" name="tugas" class="form-control"required></td>
	</tr>
	';
$admin .='
	<tr>
		<td></td>
		<td></td>
		<td>
		<input type="hidden" name="idtugas" value="'.$idtugas.'">
		<input type="submit" value="Upload" name="submit"class="btn btn-success" ></td>
	</tr>
	';
$admin .='</table></form>';
}

if($_GET['aksi']=="lihat"){
$admin .='<div class="panel-heading"><b>Data Tugas</b></div>';
$id = int_filter ($_GET['id']);
$query 		= mysql_query ("SELECT * FROM `tugas` WHERE `id`='$id'");
$data 		= mysql_fetch_array($query);
$idtugas = $data['id'];
$admin .= '
<table border="0" cellspacing="0" cellpadding="0"class="table table-striped table-hover">
	<tr>
		<td>Judul Tugas</td>
		<td>:</td>
		<td><input type="text" name="judul" value="'.$data['judul'].'" size="25"class="form-control" disabled></td>
	</tr>
	<tr>
		<td>Tanggal Dikumpulkan</td>
		<td>:</td>
		<td><input type="text" name="judul" value="'.$data['tglakhir'].'" size="25"class="form-control" disabled></td>
	</tr>
</table>
	';
$hasil = $koneksi_db->sql_query( "SELECT * FROM tugassiswa where tugas='$idtugas' order by id desc" );
$admin .='<div class="panel-heading"><b>Data Tugas</b></div>';
$admin .= '<table id="example" class="table table-striped table-hover">
<thead><tr>
<th width="20px">No</th>
<th>Nama</th>
<th>Kelas</th>
<th>File</th>
</tr></thead><tbody>';
$no = 1;
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$nama=$data['nama'];
$kelas=$data['kelas'];
$file=$data['file'];
$ukuranfile = filesize('mod/tugas/download/'.$file.'');
$admin .='<tr>
<td><b>'.$no.'</b></td>
<td>'.$nama.'</td>
<td>'.$kelas.'</td>
<td>'.$file.' ('.formatSizeUnits($ukuranfile).')</td>
</tr>';
$no++;
}
$admin .= '</tbody></table>';
}

$admin .='</div>';
echo $admin;
?>