<?php
if (!defined('AURACMS_CONTENT')) {
	Header("Location: ../index.php");
	exit;
}
$index_hal=1;
$JS_SCRIPT.= <<<js
<script language="JavaScript" type="text/javascript">
$(document).ready(function() {
    $('#example').dataTable({
    "iDisplayLength":50});
} );
</script>
js;
$JS_SCRIPT .= <<<js
<!-- TinyMCE -->
<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
        selector: "textarea",
        plugins: [
                "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons template textcolor paste  textcolor filemanager"
        ],

        toolbar1: "| bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
		toolbar2: "| cut copy paste pastetext | searchreplace | outdent indent blockquote | undo redo | link unlink anchor image code jbimages | forecolor backcolor",
		toolbar3: "| table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",

        menubar: false,
        toolbar_items_size: 'small',
		image_advtab: true,
forced_root_block : false,
    force_p_newlines : 'false',
    remove_linebreaks : false,
    force_br_newlines : true,
    remove_trailing_nbsp : false,
    verify_html : false,
        templates: [
                {title: 'Test template 1', content: 'Test 1'},
                {title: 'Test template 2', content: 'Test 2'}
        ]
		
});</script>
<!-- /TinyMCE -->
js;
$script_include[] = $JS_SCRIPT;
$admin .='<br><div class="border">
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
<th width="160px">Aksi</th>
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
<td>'.$uploadbutton.' <a href="?pilih=tugas&amp;mod=yes&amp;aksi=lihat&amp;id='.$data['id'].'"><span class="btn btn-warning">Lihat</span></a></td>
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
$ket     		= $_POST['ket'];
$idtugas     		= $_POST['idtugas'];
$tugas_size = $_FILES['tugas']['size'];
 
if ($tugas_size > 2048000)  $error .= "Error: Upload File ukuran melebihi batas.<br />";
if (empty ($namafile_name))  $error .= "Error: Upload File tidak boleh kosong.<br />";
if (empty ($ket))  $error .= "Error: Keterangan tidak boleh kosong.<br />";
if ($error){
$admin.='<div class="error">'.$error.'</div>';
}else{
    $files = $_FILES['tugas']['name'];
    $tmp_files = $_FILES['tugas']['tmp_name'];
    $tempnews 	= 'mod/tugas/download/';
	move_uploaded_file($tmp_files, "$tempnews/$files");
    $hasil = $koneksi_db->sql_query( "insert into tugassiswa values('','$idtugas','$nama','$kelas','$files','$ket')" );
$style_include[] ='<meta http-equiv="refresh" content="1; url=?pilih=tugas&mod=yes" />';
}
}
$id = int_filter ($_GET['id']);
$admin .='<div class="panel-heading"><b>Tugas</b></div>';
$query 		= mysql_query ("SELECT * FROM `tugas` WHERE `id`='$id'");
$data 		= mysql_fetch_array($query);
$idtugas=$data['id'];
$kettugas=$data['ket'];
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
		<td>Keterangan Tugas</td>
		<td>:</td>
		<td>'.$kettugas.'</td>
	</tr></table>';
$admin .='<div class="panel-heading"><b>Upload Tugas</b></div>';	
$admin .= '	
<table border="0" cellspacing="0" cellpadding="0"class="table table-striped table-hover">
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
		<td>Abstrak Tugas</td>
		<td>:</td>
		<td><textarea name="ket" id="textarea1" class="form-control" rows="3"></textarea></td>
	</tr>
	</tr>
	<tr>
		<td>Upload File</td>
		<td>:</td>
		<td><input type="file" name="tugas" class="form-control"></td>
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
<th>Aksi</th>
</tr></thead><tbody>';
$no = 1;
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$nama=$data['nama'];
$kelas=$data['kelas'];
$file=$data['file'];
$ukuranfile = filesize('mod/tugas/download/'.$file.'');
$ukuranfile = formatSizeUnits($ukuranfile);
$detailbutton ='<a href="?pilih=tugas&amp;mod=yes&amp;aksi=detail&amp;id='.$data['id'].'"><span class="btn btn-success">Detail</span></a>';
$admin .='<tr>
<td><b>'.$no.'</b></td>
<td>'.$nama.'</td>
<td>'.$kelas.'</td>
<td>'.$detailbutton.'</td>
</tr>';
$no++;
}
$admin .= '</tbody></table>';
}

if($_GET['aksi']=="detail"){
$admin .='<div class="panel-heading"><b>Data Tugas</b></div>';
$id = int_filter ($_GET['id']);
$query 		= mysql_query ("SELECT * FROM `tugassiswa` WHERE `id`='$id'");
$data 		= mysql_fetch_array($query);
$idtugas = $data['tugas'];
$tugassiswa = $data['id'];
$downloadfile = '<a href="mod/tugas/download/'.$data['file'].'" target="new"><span class="btn btn-success">Download</span></a>';
$admin .= '
<table border="0" cellspacing="0" cellpadding="0"class="table table-striped table-hover">
	<tr>
		<td width="120px">Nama</td>
		<td>:</td>
		<td>'.$data['nama'].'</td>
	</tr>
	<tr>
		<td>Kelas</td>
		<td>:</td>
		<td>'.$data['kelas'].'</td>
	</tr>
	<tr>
		<td>Download File</td>
		<td>:</td>
		<td>'.$downloadfile.'</td>
	</tr>
	<tr>
		<td>Keterangan</td>
		<td>:</td>
		<td>'.$data['ket'].'</td>
	</tr>
</table>
	';
/********** KOMENTAR ************/
if (isset($_POST['comment'])){
$nama     		= $_POST['nama'];
$kelas     		= $_POST['kelas'];
$komentar     		= $_POST['komentar'];
$tugassiswa     		= $_POST['tugassiswa'];
$tglnow = date("Y-m-d");
	if (!$komentar)  	$error .= "Error: Silahkan Isi Komentar<br />";
if ($error){
		$admin .= '<div class="error">'.$error.'</div>';
	}else{
		$hasil  = mysql_query( "INSERT INTO `tugaskomentar` VALUES ('','$tglnow','$tugassiswa','$nama','$kelas','$komentar')" );
		if($hasil){
			$admin .= '<div class="sukses"><b>Berhasil Menambah Komentar.</b></div>';
			header("location:?pilih=tugas&mod=yes&aksi=detail&id=$tugassiswa");
		}else{
			$admin .= '<div class="error"><b>Gagal Menambah Komentar.</b></div>';
		}
		unset($nama);
		unset($kelas);
		unset($komentar);
	}
}
$admin .='<div class="panel-heading"><b>Isi Komentar</b></div>';
$admin .= '
<form method="post" action=""class="form-inline" id="posts" enctype ="multipart/form-data">
<table border="0" cellspacing="0" cellpadding="0"class="table table-striped table-hover">
	<tr>
		<td width="120px">Nama</td>
		<td>:</td>
		<td><input type="text" name="nama" value="'.$nama.'" size="25"class="form-control" required></td>
	</tr>
	<tr>
		<td>Kelas</td>
		<td>:</td>
		<td><input type="text" name="kelas" value="'.$kelas.'" size="25"class="form-control" required></td>
	</tr>
	<tr>
		<td>Komentar</td>
		<td>:</td>
		<td><textarea class="form-control" rows="3"name="komentar"></textarea></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td><input type="hidden" name="tugassiswa" value="'.$tugassiswa.'">
		<input type="submit" value="Submit" name="comment" class="btn btn-success"></td>
	</tr>
</table>

</form>';
/************************************/

$hasil = $koneksi_db->sql_query( "SELECT * FROM tugaskomentar where tugassiswa = '$tugassiswa' order by tgl desc" );
$admin .='<div class="panel-heading"><b>Data Komentar</b></div>';
$admin .= '<table id="example" class="table table-striped table-hover">
<thead><tr>
<th width="100px">Tgl</th>
<th width="100px">Nama</th>
<th width="100px">Kelas</th>
<th>Komentar</th>
</tr></thead><tbody>';
$no = 1;
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$tgl=$data['tgl'];
$nama=$data['nama'];
$kelas=$data['kelas'];
$komentar=$data['komentar'];
$admin .='<tr>
<td>'.$tgl.'</td>
<td>'.$nama.'</td>
<td>'.$kelas.'</td>
<td>'.$komentar.'</td>
</tr>';
$no++;
}
$admin .= '</tbody></table>';
/************************************/
}


$admin .='</div>';
echo $admin;
?>