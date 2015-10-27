<?php
if (!defined('AURACMS_admin')) {
	Header("Location: ../index.php");
	exit;
}

//$index_hal = 1;
if (!cek_login ()){   
	
$admin .='<p class="judul">Access Denied !!!!!!</p>';
}else{
$admin .= '
<script language="javascript" type="text/javascript" src="mod/calendar/js/browserSniffer.js"></script>
<script language="javascript" type="text/javascript" src="mod/calendar/js/dynCalendar.js"></script>';
$tanggalmulai = <<<eof
<script language="JavaScript" type="text/javascript">
    
    /**
    * Example callback function
    */
    /*<![CDATA[*/
    function exampleCallback_ISO2(date, month, year)
    {
        if (String(month).length == 1) {
            month = '0' + month;
        }
    
        if (String(date).length == 1) {
            date = '0' + date;
        }    
        document.forms['posts'].tglmulai.value = year + '-' + month + '-' + date;
    }
    calendar2 = new dynCalendar('calendar2', 'exampleCallback_ISO2');
    calendar2.setMonthCombo(true);
    calendar2.setYearCombo(true);
/*]]>*/     
</script>
eof;
$tanggalakhir = <<<eof
<script language="JavaScript" type="text/javascript">
    
    /**
    * Example callback function
    */
    /*<![CDATA[*/
    function exampleCallback_ISO3(date, month, year)
    {
        if (String(month).length == 1) {
            month = '0' + month;
        }
    
        if (String(date).length == 1) {
            date = '0' + date;
        }    
        document.forms['posts'].tglakhir.value = year + '-' + month + '-' + date;
    }
    calendar3 = new dynCalendar('calendar3', 'exampleCallback_ISO3');
    calendar3.setMonthCombo(true);
    calendar3.setYearCombo(true);
/*]]>*/     
</script>
eof;

$JS_SCRIPT = <<<js
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
$style_include[] = '
<style type="text/css">
@import url("'.$url_situs.'/mod/calendar/css/dynCalendar.css");
<style type="text/css">
@import url("'.$url_situs.'/mod/daftaronline/typography.css");
</style>
<style type="text/css">
@import url("'.$url_situs.'/mod/daftaronline/properties.css");
</style>
';
$JS_SCRIPT.= <<<js
<script language="JavaScript" type="text/javascript">
$(document).ready(function() {
    $('#example').dataTable({
    "iDisplayLength":50});
} );
</script>
js;
$script_include[] = $JS_SCRIPT;
$admin .='<div class="bordermenu">Administrasi Tugas</div>';
$admin .='<div class="border">
<a href="?pilih=tugas&amp;mod=yes">Lihat Tugas</a> | 
<a href="?pilih=tugas&amp;mod=yes&amp;aksi=add">Tambah Tugas</a>';
$admin .='</div>';
$admin .='<div class="panel panel-info">';

if($_GET['aksi']== 'del'){    
	global $koneksi_db;    
	$id     = int_filter($_GET['id']);  
/*****************/
$hasila = $koneksi_db->sql_query( "SELECT * FROM tugassiswa WHERE tugas='$id'" );
while($data = mysql_fetch_array($hasila)){
    $idtugas =  $data['tugas'];
	$idfile =  $data['id'];
    $tempnews 	= 'mod/tugas/download/';
    $namagambar =  $data['file'];
    $uploaddir = $tempnews . $namagambar; 
	unlink($uploaddir);
	$hasilb = $koneksi_db->sql_query("DELETE FROM `tugassiswa` WHERE `id`='$idfile'"); 
}
/****************/	
	$hasilc = $koneksi_db->sql_query("DELETE FROM `tugas` WHERE `id`='$id'");    
	if($hasilc){    
		$admin.='<div class="sukses">Tugas berhasil dihapus! .</div>';    
		$style_include[] ='<meta http-equiv="refresh" content="1; url=admin.php?pilih=tugas&mod=yes" />';    
	}
}

if($_GET['aksi'] == 'edit'){
if(isset($_POST['batal'])){
		unset($judul);
		unset($ket);
		unset($tanggalmulai);
		unset($tanggalakhir);
				$style_include[] ='<meta http-equiv="refresh" content="1; url=admin.php?pilih=tugas&mod=yes" />';
}
$id = int_filter ($_GET['id']);
if(isset($_POST['submit'])){
	$judul 		= $_POST['judul'];
	$ket 		= $_POST['ket'];
	$tglmulai 		= $_POST['tglmulai'];
	$tglakhir 		= $_POST['tglakhir'];
$user   	= $_SESSION['UserName'];
	$error 	= '';
	if (!$judul)  	$error .= "Error: Silahkan Isi Nama judul<br />";
	if (!$tunjangan)  	$tunjangan ='0';	
if ($koneksi_db->sql_numrows($koneksi_db->sql_query("SELECT judul FROM tugas WHERE judul='$judul' and id<>'$id'")) > 0) $error .= "Error: judul ".$judul." sudah terdaftar , silahkan ulangi.<br />";
	if ($error){
		$tengah .= '<div class="error">'.$error.'</div>';
	}else{
		$hasil  = mysql_query( "UPDATE `tugas` SET `judul`='$judul',`ket`='$ket',`tglmulai`='$tglmulai',`tglakhir`='$tglakhir' WHERE `id`='$id'" );
		if($hasil){
			$admin .= '<div class="sukses"><b>Berhasil di Update.</b></div>';
			$style_include[] ='<meta http-equiv="refresh" content="1; url=admin.php?pilih=tugas&amp;mod=yes" />';	
		}else{
			$admin .= '<div class="error"><b>Gagal di Update.</b></div>';
		}
	}

}
$query 		= mysql_query ("SELECT * FROM `tugas` WHERE `id`='$id'");
$data 		= mysql_fetch_array($query);
$admin .='<div class="panel-heading"><b>Edit Tugas</b></div>';
$admin .= '
<form method="post" action=""class="form-inline" id="posts">
<table border="0" cellspacing="0" cellpadding="0"class="table table-striped table-hover">
	<tr>
		<td>Judul</td>
		<td>:</td>
		<td><input type="text" name="judul" value="'.$data['judul'].'" size="25"class="form-control"></td>
	</tr>
	<tr>
		<td>Keterangan</td>
		<td>:</td>
		<td><textarea name="ket" id="textarea1">'.$data['ket'].'</textarea></td>
	</tr>';
$admin .='
<tr>
    <td width="30%" valign="top">Tanggal Mulai</td>
    <td width="1%" valign="top">:</td>
    <td width="69%" valign="top">
	<input type="text" size="10" name="tglmulai" value="'.$data['tglmulai'].'" required class="form-control">&nbsp;'.$tanggalmulai.'
	</td>
  </tr>';
$admin .='
<tr>
    <td width="30%" valign="top">Tanggal Akhir</td>
    <td width="1%" valign="top">:</td>
    <td width="69%" valign="top">
	<input type="text" size="10" name="tglakhir" value="'.$data['tglakhir'].'" required class="form-control">&nbsp;'.$tanggalakhir.'
	</td>
  </tr>';	
	
$admin.='<td></td>
		<td></td>
		<td>&nbsp;
		<input type="submit" value="Edit" name="submit"class="btn btn-success" ></td>
	</tr>
</table>
</form>';	
}

if($_GET['aksi']=="add"){
if(isset($_POST['batal'])){
		unset($judul);
		unset($ket);
		unset($tanggalmulai);
		unset($tanggalakhir);
				$style_include[] ='<meta http-equiv="refresh" content="1; url=admin.php?pilih=tugas&mod=yes" />';
}
if(isset($_POST['submit'])){
	$judul 		= $_POST['judul'];
	$ket 		= $_POST['ket'];
	$tglmulai 		= $_POST['tglmulai'];
	$tglakhir 		= $_POST['tglakhir'];
$user   	= $_SESSION['UserName'];
	$error 	= '';
	if (!$judul)  	$error .= "Error: Silahkan Isi judul<br />";
if ($koneksi_db->sql_numrows($koneksi_db->sql_query("SELECT judul FROM tugas WHERE judul='$judul'")) > 0) $error .= "Error: judul ".$judul." sudah terdaftar , silahkan ulangi.<br />";
	if ($error){
		$admin .= '<div class="error">'.$error.'</div>';
	}else{
		$hasil  = mysql_query( "INSERT INTO `tugas` (`judul`,`ket`,`tglmulai`,`tglakhir`,`user`) VALUES ('$judul','$ket','$tglmulai','$tglakhir','$user')" );
		if($hasil){
			$admin .= '<div class="sukses"><b>Berhasil di Buat.</b></div>';
		}else{
			$admin .= '<div class="error"><b> Gagal di Buat.</b></div>';
		}
		unset($judul);
		unset($ket);
		unset($tglmulai);
		unset($tglakhir);
	}

}
$tglnow = date("Y-m-d");
$judul     		= !isset($judul) ? '' : $judul;
$ket     		= !isset($ket) ? '' : $ket;
$tglmulai     		= !isset($tglmulai) ? $tglnow : $tglmulai;
$tglakhir     		= !isset($tglakhir) ? $tglnow : $tglakhir;
$admin .='<div class="panel-heading"><b>Tambah Tugas</b></div>';
$admin .= '
<form method="post" action="" class="form-inline"id="posts">
<table class="table table-striped table-hover">
	<tr>
		<td>Judul</td>
		<td>:</td>
		<td><input type="text" name="judul" value="'.$judul.'" required class="form-control"></td>
	</tr>
	<tr>
		<td>Keterangan</td>
		<td>:</td>
		<td><textarea name="ket" id="textarea1">'.$ket.'</textarea></td>
	</tr>';
$admin .='
<tr>
    <td width="30%" valign="top">Tanggal Mulai</td>
    <td width="1%" valign="top">:</td>
    <td width="69%" valign="top">
	<input type="text" size="10" name="tglmulai" value="'.$tglmulai.'" required class="form-control">&nbsp;'.$tanggalmulai.'
	</td>
  </tr>';
$admin .='
<tr>
    <td width="30%" valign="top">Tanggal Akhir</td>
    <td width="1%" valign="top">:</td>
    <td width="69%" valign="top">
	<input type="text" size="10" name="tglakhir" value="'.$tglakhir.'" required class="form-control">&nbsp;'.$tanggalakhir.'
	</td>
  </tr>';	
	
$admin.='<td></td>
		<td></td>
		<td>&nbsp;
		<input type="submit" value="Tambah" name="submit"class="btn btn-success" ></td>
	</tr>
</table>
</form>';	
}

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
<th width="180px">Aksi</th>
</tr></thead><tbody>';
$no = 1;
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$judul=$data['judul'];
$tglmulai=$data['tglmulai'];
$tglakhir=$data['tglakhir'];
$admin .='<tr>
<td><b>'.$no.'</b></td>
<td>'.$judul.'</td>
<td>'.$tglmulai.'</td>
<td>'.$tglakhir.'</td>
<td><a href="?pilih=tugas&amp;mod=yes&amp;aksi=del&amp;id='.$data['id'].'" onclick="return confirm(\'Apakah Anda Yakin Ingin Menghapus Data Ini ?\')"><span class="btn btn-danger">Hapus</span></a> <a href="?pilih=tugas&amp;mod=yes&amp;aksi=edit&amp;id='.$data['id'].'"><span class="btn btn-warning">Edit</span></a> <a href="?pilih=tugas&amp;mod=yes&amp;aksi=detail&amp;id='.$data['id'].'"><span class="btn btn-success">File</span></a></td>
</tr>';
$no++;
}
$admin .= '</tbody></table>';
/************************************/
}

if($_GET['aksi']=="detail"){
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
$admin .='<div class="panel-heading"><b>Data File Tugas</b></div>';
$admin .= '<table id="example" class="table table-striped table-hover">
<thead><tr>
<th>No</th>
<th>Nama</th>
<th>Kelas</th>
<th>Ket</th>
<th width="240px">Aksi</th>
</tr></thead><tbody>';
$no = 1;
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$nama=$data['nama'];
$kelas=$data['kelas'];
$file=$data['file'];
$ket=$data['ket'];
$ukuranfile = filesize('mod/tugas/download/'.$file.'');
$admin .='<tr>
<td><b>'.$no.'</b></td>
<td>'.$nama.'</td>
<td>'.$kelas.'</td>
<td>'.limittxt($ket,200).'</td>
<td><a href="?pilih=tugas&amp;mod=yes&amp;aksi=delfile&amp;id='.$data['id'].'" onclick="return confirm(\'Apakah Anda Yakin Ingin Menghapus Data Ini ?\')"><span class="btn btn-danger">Hapus</span></a> <a href="mod/tugas/download/'.$data['file'].'"target="new"><span class="btn btn-success">Download</span></a> <a href="?pilih=tugas&amp;mod=yes&amp;aksi=komentar&amp;id='.$data['id'].'"target=""><span class="btn btn-primary">Komentar</span></a></td>
</tr>';
$no++;
}
$admin .= '</tbody></table>';
}

if($_GET['aksi']=="komentar"){

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
if (isset($_POST['delcomment'])){
$idkomentar     = $_POST['idkomentar'];
$tot     = $_POST['tot'];
			for($i=1;$i<=$tot;$i++)
			{
				$check = $_POST['check'.$i] ;
				if($check <> "")
				{
					$pcheck .= $check . ",";
				}
			}
$pcheck = substr_replace($pcheck, "", -1, 1);

if (!$idkomentar)  	$error .= "Error: Silahkan Pilih Komentar yang akan dihapus<br />";
if ($error){
$admin .= '<div class="error">'.$error.'</div>';
}else{
if ($idkomentar)  $sukses .= "Sukses: Komentar dengan id $idkomentar  Telah di hapus !<br />";
$koneksi_db->sql_query("DELETE FROM tugaskomentar WHERE id in($idkomentar)");
if ($sukses){
$admin.='<div class="sukses">'.$sukses.'</div>';
}
}
}

$hasil = $koneksi_db->sql_query( "SELECT * FROM tugaskomentar where tugassiswa = '$tugassiswa' order by tgl desc" );
$admin .='<div class="panel-heading"><b>Data Komentar</b></div>';
$admin .='<form method="post" action=""class="form-inline" id="posts" enctype ="multipart/form-data">';
$admin .= '<table id="example" class="table table-striped table-hover">
<thead><tr>
<th width="100px">Tgl</th>
<th width="100px">Nama</th>
<th width="100px">Kelas</th>
<th>Komentar</th>
<th>Aksi</th>
</tr></thead><tbody>';
$no = 1;
$jumlah = $koneksi_db->sql_numrows( $hasil );
while ($data = $koneksi_db->sql_fetchrow($hasil))
{
$id=$data['id'];
$tgl=$data['tgl'];
$nama=$data['nama'];
$kelas=$data['kelas'];
$komentar=$data['komentar'];
$admin .='<tr>
<td>'.$tgl.'</td>
<td>'.$nama.'</td>
<td>'.$kelas.'</td>
<td>'.$komentar.'</td>
<td>
<input type=hidden name="idkomentar" value="'.$id.'">
<input type="submit" value="Hapus" name="delcomment" class="btn btn-danger"></td>
</tr>';
$no++;
}
$admin .="<input type=hidden name='tot' value='$jumlah'>";
$admin .= '</tbody></table>';
$admin .= 'jumlah = '.$jumlah.' <input type="submit" value="Hapus" name="delcomment" class="btn btn-danger"></td>
</form>';
/************************************/
}



if($_GET['aksi']=="delfile"){
$id = int_filter ($_GET['id']);
$query 		= mysql_query ("SELECT * FROM `tugassiswa` WHERE `id`='$id'");
$data 		= mysql_fetch_array($query);
    $idtugas =  $data['tugas'];
    $tempnews 	= 'mod/tugas/download/';
    $namagambar =  $data['file'];
    $uploaddir = $tempnews . $namagambar; 
	unlink($uploaddir);
$koneksi_db->sql_query("delete from tugassiswa WHERE id='$id'");
$admin.='<div class="error">File Tugas telah di Hapus</div>';
header("location:?pilih=tugas&mod=yes&aksi=detail&id=$idtugas");
exit;
}
}
$admin .='</div>';
echo $admin;

?>