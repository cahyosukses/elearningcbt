<?php
if (!defined('AURACMS_admin')) {
	Header("Location: ../index.php");
	exit;
}

//$index_hal = 1;
if (!cek_login ()){   
	
$admin .='<p class="judul">Access Denied !!!!!!</p>';
}else{

$JS_SCRIPT = <<<js
<!-- TinyMCE -->
<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
        selector: "textarea",
        plugins: [
                "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking youTube preview",
                "table contextmenu directionality emoticons template textcolor paste  textcolor filemanager"
        ],

        toolbar1: "| bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
		toolbar2: "| cut copy paste pastetext | searchreplace | outdent indent blockquote | undo redo | link unlink anchor image code jbimages | forecolor backcolor | youTube preview",
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
$JS_SCRIPT.= <<<js
<script type="text/javascript">
  $(function() {
$( "#tgl" ).datepicker({ dateFormat: "yy-mm-dd" } );
  });
  </script>
js;
$JS_SCRIPT.= <<<js
<script language="JavaScript" type="text/javascript">
$(document).ready(function() {
    $('#example').dataTable({
    "iDisplayLength":50});
} );
</script>
js;
$JS_SCRIPT.= <<<js
<script language="JavaScript" type="text/javascript">
jQuery(function(){
         jQuery('#showall').click(function(){
               jQuery('.targetDiv').show();
        });
        jQuery('.btnsoal').click(function(){
              jQuery('.targetDiv').hide();
              jQuery('#div'+$(this).attr('target')).show();
        });
});
</script>
js;

$script_include[] = $JS_SCRIPT;
    $temp 	= 'mod/ujian/download/';
$admin .='<div class="bordermenu">Administrasi Ujian</div>';
$admin .= '<div class="bordermenu2"><a href="admin.php?pilih=ujian&amp;mod=yes">Home</a> | <a href="admin.php?pilih=ujian&amp;mod=yes&amp;aksi=nilaiujian">Lihat Nilai</a>';
$admin .= '</div>';
$admin .='<div class="panel panel-info">';
$user =  $_SESSION['UserName'];
$levelakses=$_SESSION['LevelAkses'];

if($_GET['aksi']==""){
$hasil = $koneksi_db->sql_query( "SELECT * FROM kursus_setting  where guru='$user' order by guru asc" );
$admin .='<div class="panel-heading"><b>Daftar Kursus</b></div>';
$admin .= '<table id="example" class="table table-striped table-hover">
<thead><tr>
<th>No</th>
<th>Guru</th>
<th>Mata Pelajaran</th>
<th>Tahun Ajaran</th>
<th>Nama Kursus</th>
<th>Aksi</th>
</tr></thead><tbody>';
$no = 1;
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$idkursus     = $data['id']; 
$guru     = $data['guru'];  
$cekjmlujian  = cekjmlujian2($idkursus); 
$getkelasid_ks = getkelasid_ks($data['id']);
if($getkelasid_ks != ''){
$tambahujian = '<a href="?pilih=ujian&amp;mod=yes&amp;aksi=addujian&amp;id='.$data['id'].'"><span class="btn btn-warning">Tambah Ujian</span></a>&nbsp;';
}else{
$tambahujian = '';
}
$admin .='<tr>
<td><b>'.$no.'</b></td>
<td>'.getnamaguru($data['guru']).'</td>
<td>'.getmapel($data['mapel']).'</td>
<td>'.$data['tahun'].'</td>
<td>'.$data['judul'].'</td>
<td>'.$tambahujian.'';
if($cekjmlujian>0){
$admin .='<a href="?pilih=ujian&amp;mod=yes&amp;aksi=listujian&amp;id='.$data['id'].'"><span class="btn btn-primary">Daftar Ujian ('.$cekjmlujian.')</span></a>';
}else{
$admin .='<a href="#"><span class="btn btn-danger">Data Kosong</span></a>';
}
$admin .='</td>
</tr>';
$no++;
}
$admin .= '</tbody></table>';
/************************************/
}

if($_GET['aksi']== 'del'){    
	global $koneksi_db;    
	$id     = int_filter($_GET['id']);  
	$idkursus     = int_filter($_GET['idkursus']);   	
	$hasil = $koneksi_db->sql_query("DELETE FROM `ujian` WHERE `id`='$id'");    
		$hasil = $koneksi_db->sql_query("DELETE FROM `soal` WHERE `ujian`='$id'");  
	if($hasil){    
		$admin.='<div class="sukses">Ujian berhasil dihapus! .</div>';    
		$style_include[] ='<meta http-equiv="refresh" content="1; url=admin.php?pilih=ujian&mod=yes&aksi=listujian&id='.$idkursus.'" />';    
	}
}

if($_GET['aksi'] == 'edit'){
$id = int_filter ($_GET['id']);
$idkursus     = int_filter($_GET['idkursus']);
$admin .='<div class="panel-heading"><b>Nama Kursus</b></div>';
$hasil =  $koneksi_db->sql_query( "SELECT * FROM kursus_setting where id='$idkursus' " );
$data = $koneksi_db->sql_fetchrow($hasil);
$idkursus=$data['id'];
$guru=$data['guru'];
$mapel =$data['mapel'];
$tahun =$data['tahun'];
$admin .= '
<table cellspacing="0" cellpadding="0"class="table table-striped table-hover">
	<tr>
		<td>Nama Guru</td>
		<td>:</td>
		<td>'.getnamaguru($guru).'</td>
		<td>Tahun</td>
		<td>:</td>
		<td>'.$tahun.'</td>
	</tr>
	<tr>
		<td>Mata Pelajaran</td>
		<td>:</td>
		<td>'.getmapel($mapel).'</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
</table>';

if(isset($_POST['submit'])){
$pertemuan     		= addslashes($_POST['pertemuan']);
$tgl     		= $_POST['tgl'];
$tipe     		= $_POST['tipe'];		
$status     	= $_POST['status'];	
$idkursus     	= $_POST['idkursus'];	
$jumlahsoal   	= $_POST['jumlahsoal'];	
$pointbenar		=$_POST['pointbenar'];
$pointsalah		=$_POST['pointsalah'];
$pointkosong	=$_POST['pointkosong'];
$petunjuk	=addslashes($_POST['petunjuk']);
$cekjumlahsoal = cekjumlahsoal($id);
$tipeujian	=$_POST['tipeujian'];
$error 	= '';
if($cekjumlahsoal>$jumlahsoal){
$error = "Soal yang terbentuk lebih besar dari jumlah Soal yang akan di Edit.<br>Harap menghapus beberapa Soal $cekjumlahsoal / $jumlahsoal";
}
if ($error){
$admin .= '<div class="error">'.$error.'</div>';
}else{
$hasil  = mysql_query( "update `ujian` set  pertemuan='$pertemuan',tipe = '$tipe',status='$status',jumlahsoal='$jumlahsoal',pointbenar='$pointbenar',pointsalah='$pointsalah',pointkosong='$pointkosong',petunjuk='$petunjuk',tipeujian='$tipeujian' where id='$id'" );
if($hasil){
$admin .= '<div class="sukses"><b>Berhasil di Update.</b></div>';
header("location:?pilih=ujian&mod=yes&aksi=listujian&id=$idkursus");
}else{
$admin .= '<div class="error"><b> Gagal di Update.</b></div>';
header("location:?pilih=ujian&mod=yes&aksi=listujian&id=$idkursus");
}
unset($tipe);
unset($status);
unset($jumlahsoal);
unset($petunjuk);
unset($tipeujian);
unset($pertemuan);
}

}
/*************************************************/
$hasil =  $koneksi_db->sql_query( "SELECT * FROM ujian where id='$id'" );
$data = $koneksi_db->sql_fetchrow($hasil);
$pertemuan=$data['pertemuan'];
$judul=$data['judul'];
$tipe=$data['tipe'];
$status=$data['status'];
$jumlahsoal=$data['jumlahsoal'];
$pointbenar=$data['pointbenar'];
$pointsalah=$data['pointsalah'];
$pointkosong=$data['pointkosong'];
$petunjuk=$data['petunjuk'];
$tglnow = date("Y-m-d");
$tipeujian=$data['tipeujian'];
$tgl 		= !isset($tgl) ? $tglnow : $tgl;
$sel = '<select name="tipe" class="form-control" required>';
$arr = array ('urut','random');
foreach ($arr as $k=>$v){
	if ($tipe == $v){
	$sel .= '<option value="'.$v.'" selected="selected">'.$v.'</option>';
	}else {
	$sel .= '<option value="'.$v.'">'.$v.'</option>';	
	}
}
$sel .= '</select>';   

$sel2 = '<select name="status" class="form-control" required>';
$arr2 = array ('enabled','disabled');
foreach ($arr2 as $kk=>$vv){
	if ($status == $vv){
	$sel2 .= '<option value="'.$vv.'" selected="selected">'.$vv.'</option>';
	}else {
	$sel2 .= '<option value="'.$vv.'">'.$vv.'</option>';	
	}
}
$sel2 .= '</select>'; 

$sel3 = '<select name="tipeujian" class="form-control" required>';
$arr3 = array ('latihan','ujian');
foreach ($arr3 as $kk=>$vv){
	if ($tipeujian == $vv){
	$sel3 .= '<option value="'.$vv.'" selected="selected">'.$vv.'</option>';
	}else {
	$sel3 .= '<option value="'.$vv.'">'.$vv.'</option>';	
	}
}
$sel3 .= '</select>'; 
 
$admin .='<div class="panel-heading"><b>Edit Ujian</b></div>';
$admin .= '
<form method="post" action="" class="form-inline" id="posts">
<table class="table table-striped table-hover">';
$admin .="<tr><td>Kelas</td>
		<td>:</td>
		<td>";
$getkelasid_ks = getkelasid_ks($idkursus);
$qry_kelas=mysql_query("SELECT * from kelas where id in($getkelasid_ks)");
$no=1;
while($datas=mysql_fetch_array($qry_kelas)){
$idkelas = $datas["idkelas"];
$kelas = $datas["kelas"];
$admin .="<input type='checkbox' name='kelas$no' value='$idkelas' checked disabled /> $kelas </label>&nbsp;";
$no++;
}
$admin .= '</td></tr>';
$admin .= '<tr>
		<td>Pertemuan</td>
				<td>:</td>
		<td>
<select name="pertemuan" class="form-control" required>';
$hasil = $koneksi_db->sql_query("SELECT * FROM pertemuan where idkursus = '$idkursus' ORDER BY pertemuan");
$admin .= '<option value="">== Pilih Pertemuan ==</option>';
while ($datas =  $koneksi_db->sql_fetchrow ($hasil)){
	$pilihan = ($datas['id']==$pertemuan)?"selected":'';
$admin .= '<option value="'.$datas['id'].'" '.$pilihan.'>'.$datas['pertemuan'].'</option>';
}
$admin .='</select></td>
	</tr>';
$admin.='
		<tr>
		<td>Tanggal</td>
		<td>:</td>
		<td><input type="text" id="tgl" name="tgl" value="'.$tgl.'" size="30" class="form-control"></td>
	</tr>
		<tr>
		<td>Judul</td>
		<td>:</td>
		<td><input type="text" name="judul" value="'.$judul.'" size="30" class="form-control"></td>
	</tr>
		<tr>
		<td>Point Benar</td>
		<td>:</td>
		<td><input type="text" name="pointbenar" value="'.$pointbenar.'" size="30" class="form-control" required></td>
	</tr>
		<tr>
		<td>Point Salah</td>
		<td>:</td>
		<td><input type="text" name="pointsalah" value="'.$pointsalah.'" size="30" class="form-control" required></td>
	</tr>
		<tr>
		<td>Point Kosong</td>
		<td>:</td>
		<td><input type="text" name="pointkosong" value="'.$pointkosong.'" size="30" class="form-control" required></td>
	</tr>
		<tr>
		<td>Jumlah Soal</td>
		<td>:</td>
		<td><input type="text" name="jumlahsoal" value="'.$jumlahsoal.'" size="30" class="form-control" required></td>
	</tr>
	<tr>
		<td>Tipe Soal</td>
		<td>:</td>
		<td>'.$sel.'</td>
	</tr>
	<tr>
		<td>Status Ujian</td>
		<td>:</td>
		<td>'.$sel2.'</td>
	</tr>
	<tr>
		<td>Tipe Ujian</td>
		<td>:</td>
		<td>'.$sel3.'</td>
	</tr>	
	
	';
$admin .='<tr>
            <td valign="top">Petunjuk Ujian&nbsp;:</td>
			<td>:</td>
            <td><textarea class="form-control" name="petunjuk" cols="40">'.$petunjuk.'</textarea></td>
        </tr>';	
	
$admin.='	<tr>
		<td></td>
		<td></td>
		<td>';
$admin .= "
<input type='hidden' name='guru' value='$guru'>
<input type='hidden' name='idkursus' value='$idkursus'>
";
$admin .= '
		<input type="submit" value="Simpan" name="submit"class="btn btn-success" >&nbsp;';
$admin.="<a href='?pilih=ujian&mod=yes&aksi=listujian&id=$idkursus'><span class='btn btn-primary'>BACK</span></a>";		
		$admin.='</td>
	</tr>
</table>
</form>';	
}

if($_GET['aksi']=="addujian"){

$id     = int_filter($_GET['id']);
$admin .='<div class="panel-heading"><b>Nama Kursus</b></div>';
$hasil =  $koneksi_db->sql_query( "SELECT * FROM kursus_setting where id='$id' " );
$data = $koneksi_db->sql_fetchrow($hasil);
$idkursus=$data['id'];
$guru=$data['guru'];
$mapel =$data['mapel'];
$tahun =$data['tahun'];
$admin .= '
<table cellspacing="0" cellpadding="0"class="table table-striped table-hover">
	<tr>
		<td>Nama Guru</td>
		<td>:</td>
		<td>'.getnamaguru($guru).'</td>
		<td>Tahun</td>
		<td>:</td>
		<td>'.$tahun.'</td>
	</tr>
	<tr>
		<td>Mata Pelajaran</td>
		<td>:</td>
		<td>'.getmapel($mapel).'</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
</table>';

if(isset($_POST['submit'])){
$pertemuan     		= $_POST['pertemuan'];
$tgl     		= $_POST['tgl'];	
$guru     		= $_POST['guru'];	
$judul     		= addslashes($_POST['judul']);	
$pointbenar     		= $_POST['pointbenar'];	
$pointsalah     		= $_POST['pointsalah'];	
$pointkosong     		= $_POST['pointkosong'];	
$tipe     		= $_POST['tipe'];	
$jumlahsoal     		= $_POST['jumlahsoal'];	
$tipejawaban     		= $_POST['tipejawaban'];	
$status     		= $_POST['status'];	
$idkursus     		= $_POST['idkursus'];	
$petunjuk     		= addslashes($_POST['petunjuk']);	
$tipeujian     		= $_POST['tipeujian'];	
if (!$judul)  	$error .= "Error: Silahkan Isi Judul<br />";
if ($koneksi_db->sql_numrows($koneksi_db->sql_query("SELECT judul,guru FROM ujian WHERE guru='$guru' and judul='$judul'")) > 0) $error .= "Error: Ujian dengan Judul $judul dengan Guru $guru sudah terdaftar , silahkan ulangi.<br />";
if ($error){
$admin .= '<div class="error">'.$error.'</div>';
}else{
$hasil  = mysql_query( "INSERT INTO `ujian` VALUES ('','$pertemuan','$tgl','$judul','$pointbenar','$pointsalah','$pointkosong','$tipe','$jumlahsoal','$tipejawaban','$status','$guru','$idkursus','$petunjuk','$tipeujian')" );
if($hasil){
$admin .= '<div class="sukses"><b>Berhasil di Buat.</b></div>';
		$style_include[] ='<meta http-equiv="refresh" content="1; url=admin.php?pilih=ujian&aksi=&aksi=listujian&mod=yes&id='.$idkursus.'" />'; 
}else{
$admin .= '<div class="error"><b> Gagal di Buat.</b></div>';
}
unset($pertemuan);
unset($judul);
unset($pointbenar);
unset($pointsalah);
unset($pointkosong);
unset($jumlahsoal);
unset($tipejawaban);
unset($petunjuk);
unset($tipeujian);
}
}
$pertemuan     		= !isset($pertemuan) ? '' : $pertemuan;
$judul     		= !isset($judul) ? '' : $judul;
$waktu     		= !isset($waktu) ? '60' : $waktu;
$pointbenar     		= !isset($pointbenar) ? '10' : $pointbenar;
$pointsalah     		= !isset($pointsalah) ? '0' : $pointsalah;
$pointkosong     		= !isset($pointkosong) ? '0' : $pointkosong;
$jumlahsoal     		= !isset($jumlahsoal) ? '10' : $jumlahsoal;
$tipejawaban     		= !isset($tipejawaban) ? 'a,b,c,d,e' : $tipejawaban;
$tglnow = date("Y-m-d");
$tgl 		= !isset($tgl) ? $tglnow : $tgl;
$petunjuk     		= !isset($petunjuk) ? '' : $petunjuk;
$sel = '<select name="tipe"class="form-control" required>';
$arr = array ('urut','random');
foreach ($arr as $kk=>$vv){
	$sel .= '<option value="'.$vv.'">'.$vv.'</option>';	

}
$sel .= '</select>';   
$sel2 = '<select name="status" class="form-control" required>';
$arr2 = array ('enabled','disabled');
foreach ($arr2 as $kk=>$vv){
	$sel2 .= '<option value="'.$vv.'">'.$vv.'</option>';	

}
$sel2 .= '</select>';   
$sel3 = '<select name="tipeujian" class="form-control" required>';
$arr3 = array ('latihan','ujian');
foreach ($arr3 as $kk=>$vv){
	$sel3 .= '<option value="'.$vv.'">'.$vv.'</option>';	

}
$sel3 .= '</select>';   
$admin .='<div class="panel-heading"><b>Tambah Ujian</b></div>';
$admin .= '
<form method="post" action="" class="form-inline" id="posts">
<table class="table table-striped table-hover">';
$admin .="<tr><td>Kelas</td>
		<td>:</td>
		<td>";
$getkelasid_ks = getkelasid_ks($id);
$qry_kelas=mysql_query("SELECT * from kelas where id in($getkelasid_ks)");
$no=1;
while($datas=mysql_fetch_array($qry_kelas)){
$idkelas = $datas["idkelas"];
$kelas = $datas["kelas"];
$admin .="<input type='checkbox' name='kelas$no' value='$idkelas' checked disabled /> $kelas </label>&nbsp;";
$no++;
}
$admin .= '</td></tr>';
$admin .= '<tr>
		<td>Pertemuan</td>
				<td>:</td>
		<td>
<select name="pertemuan" class="form-control" required>';
$hasil = $koneksi_db->sql_query("SELECT * FROM pertemuan where idkursus = '$idkursus' ORDER BY pertemuan");
$admin .= '<option value="">== Pilih Pertemuan ==</option>';
while ($datas =  $koneksi_db->sql_fetchrow ($hasil)){
	$pilihan = ($datas['id']==$pertemuan)?"selected":'';
$admin .= '<option value="'.$datas['id'].'" '.$pilihan.'>'.$datas['pertemuan'].'</option>';
}
$admin .='</select></td>
	</tr>';
$admin.='<tr>
		<td>Tanggal</td>
		<td>:</td>
		<td><input type="text" name="tgl"  id="tgl" value="'.$tgl.'" size="30" class="form-control" required></td>
	</tr>
		<tr>
		<td>Judul</td>
		<td>:</td>
		<td><input type="text" name="judul" value="'.$judul.'" size="30" class="form-control" required></td>
	</tr>
	<tr>
		<td>Point Benar</td>
		<td>:</td>
		<td><input type="text" name="pointbenar" value="'.$pointbenar.'" size="30" class="form-control" required> </td>
	</tr>
	<tr>
		<td>Point Salah</td>
		<td>:</td>
		<td><input type="text" name="pointsalah" value="'.$pointsalah.'" size="30" class="form-control" required> </td>
	</tr>
	<tr>
		<td>Point Kosong</td>
		<td>:</td>
		<td><input type="text" name="pointkosong" value="'.$pointkosong.'" size="30" class="form-control" required> </td>
	</tr>
	<tr>
		<td>Tipe Soal</td>
		<td>:</td>
		<td>'.$sel.'</td>
	</tr>
	<tr>
		<td>Jumlah Soal</td>
		<td>:</td>
		<td><input type="text" name="jumlahsoal" value="'.$jumlahsoal.'" size="30" class="form-control" required> </td>
	</tr>
	<tr>
		<td>Tipe Jawaban</td>
		<td>:</td>
<td><select name="tipejawaban" class="form-control" required>';
$admin .= '<option value="a,b,c,d,e" selected> A - E </option>';
$admin .= '<option value="a,b,c,d"> A - D </option>';
$admin .='</select></td>
	</tr>
	<tr>
		<td>Status Ujian</td>
		<td>:</td>
		<td>'.$sel2.'</td>
	</tr>';
$admin .='
	<tr>
		<td>Tipe Ujian</td>
		<td>:</td>
		<td>'.$sel3.'</td>
	</tr>';
$admin .='<tr>
            <td valign="top">Petunjuk Ujian&nbsp;:</td>
			<td>:</td>
            <td><textarea class="form-control" name="petunjuk" cols="40">'.$petunjuk.'</textarea></td>
        </tr>';
$admin .= "	<tr>
		<td></td>
		<td></td>
		<td>
<input type='hidden' name='guru' value='$guru'>
<input type='hidden' name='idkursus' value='$idkursus'>
";
$admin .= '
		<input type="submit" value="Simpan" name="submit"class="btn btn-success" > ';
$admin.="<a href='?pilih=ujian&mod=yes'><span class='btn btn-primary'>BACK</span></a>";		
$admin.='</td>
	</tr>
</table>
</form>';	
}

if($_GET['aksi']=="addsoal"){

$id     = int_filter($_GET['id']);

//$admin .='<div class="panel-heading"><b>Daftar Kursus</b></div>';
$hasil =  $koneksi_db->sql_query( "SELECT * FROM kursus_setting where guru='$user' and id='$id' " );
$data = $koneksi_db->sql_fetchrow($hasil);
$idkursus=$data['id'];
$guru=$data['guru'];
$mapel =$data['mapel'];
$tahun =$data['tahun'];
/*
$admin .= '
<table cellspacing="0" cellpadding="0"class="table table-striped table-hover">
	<tr>
		<td>Nama Guru</td>
		<td>:</td>
		<td>'.getnamaguru($guru).'</td>
		<td>Tahun</td>
		<td>:</td>
		<td>'.$tahun.'</td>
	</tr>
	<tr>
		<td>Mata Pelajaran</td>
		<td>:</td>
		<td>'.getmapel($mapel).'</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
</table>';
*/
$idujian     = int_filter($_GET['idujian']);
$admin .='<div class="panel-heading"><b>Daftar Ujian</b></div>';
$hasil2 =  $koneksi_db->sql_query( "SELECT * FROM ujian where id='$idujian' " );
$data2 = $koneksi_db->sql_fetchrow($hasil2);
$judul=$data2['judul'];
$tipe =$data2['tipe'];
$jumlahsoal =$data2['jumlahsoal'];
$status =$data2['status'];
$guru =$data2['guru'];
$admin .= '
<table cellspacing="0" cellpadding="0"class="table table-striped table-hover">
	<tr>
		<td>Judul</td>
		<td>:</td>
		<td>'.$judul.'</td>
		<td>Jumlah Soal</td>
		<td>:</td>
		<td>'.$jumlahsoal.'</td>
	</tr>
	<tr>
		<td>Nama Guru</td>
		<td>:</td>
		<td>'.getnamaguru($guru).'</td>
		<td>Tipe / Status Soal</td>
		<td>:</td>
		<td>'.$tipe.'/'.$status.'</td>
	</tr>
</table>';
/******************************/
if(isset($_POST['submit'])){
$namafile_name 	= $_FILES['gambar']['name'];
	$konten 		= addslashes($_POST['konten']);
	$idujian 		= $_POST['idujian'];	
	$kunci 		= $_POST['kunci'];	
	$error 	= '';
	$tot=$_POST['tot'];
	$ppil ='';
			for($i=1;$i<=$tot;$i++)
			{
				$pilihan = $_POST['pilihan'.$i] ;
				if($pilihan <> "")
				{
					$ppil .= $pilihan . "#";
				}
			}
	$ppil = substr_replace($ppil, "", -1, 1);
	if (!$konten)  	$error .= "Error: Silahkan Isi Soal<br />";
$cekjmlsoalujian = cekjmlsoalujian($idujian);	
$getjumlahsoal = getjumlahsoal($idujian);
if($getjumlahsoal>=$cekjmlsoalujian) $error .= "Error: Jumlah maksimal Soal yang diperbolehkan ".$cekjmlsoalujian.".<br />";
if ($koneksi_db->sql_numrows($koneksi_db->sql_query("SELECT soal FROM soal WHERE konten='$konten'")) > 0) $error .= "Error: Soal ".$konten." sudah ada , silahkan ulangi.<br />";
	if ($error){
		$admin .= '<div class="error">'.$error.'</div>';
	}else{
	if (!empty ($namafile_name)){
	   $files = $_FILES['gambar']['name'];
    $tmp_files = $_FILES['gambar']['tmp_name'];
	$simpan    = md5 (rand(1,100).$files) .'.jpg';
	$uploaddir = $temp . $simpan; 
	$uploads   = move_uploaded_file($tmp_files, $uploaddir);
		$hasil  = mysql_query( "INSERT INTO `soal` VALUES ('','$idujian','$konten','$ppil','$kunci','$simpan')" );
		if($hasil){
			$admin .= "<div class='sukses'><b>Soal Berhasil di Buat.</b></div>";
		}else{
			$admin .= '<div class="error"><b>Soal Gagal di Buat.</b></div>';
		}
	}else{
		$hasil  = mysql_query( "INSERT INTO `soal` VALUES ('','$idujian','$konten','$ppil','$kunci','')" );
		if($hasil){
			$admin .= "<div class='sukses'><b>Soal Berhasil di Buat.</b></div>";
	//		header("location:?pilih=ujian&mod=yes&aksi=addsoal&idujian=$idujian&id=$idkursus");
		}else{
			$admin .= '<div class="error"><b>Soal Gagal di Buat.</b></div>';
	//		header("location:?pilih=ujian&mod=yes&aksi=addsoal&idujian=$idujian&id=$idkursus");
		}
	}
	}

}

/******************************/
$tipejawaban = getjumlahjawaban($idujian);
$jawaban = explode(",", $tipejawaban);
$jml_jawaban = count($jawaban);
/**/
$sel = '<select name="kunci" class="form-control" required>';
for ($i = 0; $i < $jml_jawaban; $i++) {
$sel .= '<option value="'.$jawaban[$i].'">'.$jawaban[$i].'</option>';	
}
$sel .= '</select>'; 
/**/
$admin .='<div class="panel-heading"><b>Tambah Soal</b></div>';
$admin .="
<form method='post' action='' id='posts' enctype ='multipart/form-data'>
<table class='table table-striped table-hover'>";
$admin.="
	<tr>
		<td>Soal</td>
		<td></td>
		<td><textarea name='konten' id='textarea1'></textarea></td>
	</tr>";
$admin.="
	<tr>
		<td>Pilihan</td>
		<td></td>
		<td>";
		$no=1;
for ($i = 0; $i < $jml_jawaban; $i++) {
$admin .="
    <div class='input-group'>
      <div class='input-group-addon'>$jawaban[$i].</div><input type='text' name='pilihan$no' class='form-control'required /></div>";
$no++;
}
$admin .="
<input type='hidden' name='tot' value='$no' />";
$admin .="</td>
	</tr>";
$admin.="
	<tr>
		<td>Jawaban</td>
		<td></td>
		<td>$sel</td>
	</tr>";
$admin .="<tr><td><label><b>File Materi  </b></label></td>
		<td></td>
<td><input type='file' name='gambar'></td></tr>";
$admin .="
<tr><td></td><td></td><td>
<input type='hidden' name='idujian' value='$idujian'>
<input type='submit'class='btn btn-success' value='Simpan' name='submit'> ";
$admin.="<a href='?pilih=ujian&mod=yes&aksi=listujian&id=$idkursus'><span class='btn btn-primary'>BACK</span></a>";	
$admin.="
</td>";
$admin.="</tr></table>
</form>";
	
}
//$hasil =  $koneksi_db->sql_query( "SELECT * FROM kursus_setting where guru='$user' and id='$id' " );

if($_GET['aksi']=="editsoal"){

$id     = int_filter($_GET['id']);
//$admin .='<div class="panel-heading"><b>Daftar Kursus</b></div>';
$hasil =  $koneksi_db->sql_query( "SELECT * FROM kursus_setting where guru='$user' and id='$id' " );
$data = $koneksi_db->sql_fetchrow($hasil);
$idkursus=$data['id'];
$guru=$data['guru'];
$mapel =$data['mapel'];
$tahun =$data['tahun'];
/*
$admin .= '
<table cellspacing="0" cellpadding="0"class="table table-striped table-hover">
	<tr>
		<td>Nama Guru</td>
		<td>:</td>
		<td>'.getnamaguru($guru).'</td>
		<td>Tahun</td>
		<td>:</td>
		<td>'.$tahun.'</td>
	</tr>
	<tr>
		<td>Mata Pelajaran</td>
		<td>:</td>
		<td>'.getmapel($mapel).'</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
</table>';
*/
$idujian     = int_filter($_GET['idujian']);
$admin .='<div class="panel-heading"><b>Daftar Ujian</b></div>';
$hasil2 =  $koneksi_db->sql_query( "SELECT * FROM ujian where id='$idujian' " );
$data2 = $koneksi_db->sql_fetchrow($hasil2);
$judul=$data2['judul'];
$tipe =$data2['tipe'];
$jumlahsoal =$data2['jumlahsoal'];
$status =$data2['status'];
$guru =$data2['guru'];
$admin .= '
<table cellspacing="0" cellpadding="0"class="table table-striped table-hover">
	<tr>
		<td>Judul</td>
		<td>:</td>
		<td>'.$judul.'</td>
		<td>Jumlah Soal</td>
		<td>:</td>
		<td>'.$jumlahsoal.'</td>
	</tr>
	<tr>
		<td>Nama Guru</td>
		<td>:</td>
		<td>'.getnamaguru($guru).'</td>
		<td>Tipe / Status Soal</td>
		<td>:</td>
		<td>'.$tipe.'/'.$status.'</td>
	</tr>
</table>';
/******************************/
/******************************/
if(isset($_POST['submit'])){
	$konten 		= addslashes($_POST['konten']);
	$idujian 		= $_POST['idujian'];
	$idsoal 		= $_POST['idsoal'];	
	$kunci 		= $_POST['kunci'];	
$fileslama     		= $_POST['fileslama'];
$namafile_name 	= $_FILES['gambar']['name'];
	$error 	= '';
	$tot=$_POST['tot'];
	$ppil ='';
			for($i=1;$i<=$tot;$i++)
			{
				$pilihan = $_POST['pilihan'.$i] ;
				if($pilihan <> "")
				{
					$ppil .= $pilihan . "#";
				}
			}
	$ppil = substr_replace($ppil, "", -1, 1);
	if (!$konten)  	$error .= "Error: Silahkan Isi Soal<br />";
	if ($error){
		$admin .= '<div class="error">'.$error.'</div>';
	}else{
		if (!empty ($namafile_name)){
			if($fileslama){
		unlink('mod/ujian/download/'.$fileslama);
		}
	   $files = $_FILES['gambar']['name'];
    $tmp_files = $_FILES['gambar']['tmp_name'];
	$simpan    = md5 (rand(1,100).$files) .'.jpg';
	$uploaddir = $temp . $simpan; 
	$uploads   = move_uploaded_file($tmp_files, $uploaddir);
		$hasil  = mysql_query( "update `soal` set soal='$konten',pilihan='$ppil',kunci='$kunci',files='$simpan' where id='$idsoal'" );
		if($hasil){
			$admin .= "<div class='sukses'><b>Soal Berhasil di Buat.</b></div>";
		}else{
			$admin .= '<div class="error"><b>Soal Gagal di Buat.</b></div>';
		}
	}else{
		$hasil  = mysql_query( "update `soal` set soal='$konten',pilihan='$ppil',kunci='$kunci' where id='$idsoal'" );
		if($hasil){
			$admin .= '<div class="sukses"><b>Soal Berhasil di Buat.</b></div>';
			header("location:?pilih=ujian&mod=yes&aksi=addsoal&idujian=$idujian&id=$idkursus");
		}else{
			$admin .= '<div class="error"><b>Soal Gagal di Buat.</b></div>';
			header("location:?pilih=ujian&mod=yes&aksi=addsoal&idujian=$idujian&id=$idkursus");
		}
		}
	}

}

/******************************/
$idujian     = int_filter($_GET['idujian']);
$tipejawaban = getjumlahjawaban($idujian);
$jawaban = explode(",", $tipejawaban);
$jml_jawaban = count($jawaban);
$idsoal     = int_filter($_GET['idsoal']);
$hasil =  $koneksi_db->sql_query( "SELECT * FROM soal where id='$idsoal'" );
$data = $koneksi_db->sql_fetchrow($hasil);
$konten=$data['soal'];
$kunci=$data['kunci'];
$pilihansoal = explode("#", $data["pilihan"]);
$jml_pil = count($pilihansoal);
/**/
$sel = '<select name="kunci" class="form-control" required>';
for ($i = 0; $i < $jml_jawaban; $i++) {
if($jawaban[$i]==$kunci){
	$sel .= '<option value="'.$jawaban[$i].'" selected="selected">'.$jawaban[$i].'</option>';
}else{
	$sel .= '<option value="'.$jawaban[$i].'">'.$jawaban[$i].'</option>';
$selected ='';
}
}
$sel .= '</select>'; 
/**/
$admin .='<div class="panel-heading"><b>Edit Soal</b></div>';
$admin .="
<form method='post' action='' id='posts'  enctype ='multipart/form-data'>
<table class='table table-striped table-hover'>";
$admin.="
	<tr>
		<td>Soal</td>
		<td></td>
		<td><textarea name='konten' id='textarea1'>$konten</textarea></td>
	</tr>";
$admin.="
	<tr>
		<td>Pilihan</td>
		<td></td>
		<td>";
		$no=1;
for ($i = 0; $i < $jml_jawaban; $i++) {
$admin .="
    <div class='input-group'>
      <div class='input-group-addon'>$jawaban[$i].</div><input type='text' name='pilihan$no' class='form-control'required value='$pilihansoal[$i]' /></div>";
$no++;
}
$admin .="
<input type='hidden' name='tot' value='$no' />";
$admin .="</td>
	</tr>";
$admin.="
	<tr>
		<td>Jawaban</td>
		<td></td>
		<td>$sel</td>
	</tr>";
	/***************************/
	$filesgambar=$data['files'];
if($filesgambar){
$gambar = "<img src='mod/ujian/download/$filesgambar' max-width='500px'><br>";
}else{
$gambar = '';
}
$admin.="
	<tr>
		<td>File Soal</td>
		<td></td>
		<td><input type='file' name='gambar'>
		<br>$gambar<input type='hidden' name='fileslama' value='$filesgambar'></td>
	</tr>";	
	/****************************/
$admin .="
<tr><td></td><td></td><td>
<input type='hidden' name='idsoal' value='$idsoal'>
<input type='hidden' name='idujian' value='$idujian'>
<input type='submit'class='btn btn-success' value='Simpan' name='submit'> ";
$admin.="<a href='?pilih=ujian&mod=yes&aksi=listujian&id=$idkursus'><span class='btn btn-primary'>BACK</span></a>";	
$admin.="
</td>";
$admin.="</tr></table>
</form>";
	
}

if($_GET['aksi']== 'delsoal'){    
	global $koneksi_db;    
	$id     = int_filter($_GET['id']);    
	$idsoal     = int_filter($_GET['idsoal']);  
	$idujian     = int_filter($_GET['idujian']);  
$hasil = $koneksi_db->sql_query( "SELECT * FROM soal WHERE id='$idsoal'" );
while($data = mysql_fetch_array($hasil)){
    $namagambar =  $data['files'];
    $uploaddir = $temp . $namagambar; 
	unlink($uploaddir);
}	
		$hasil = $koneksi_db->sql_query("DELETE FROM `soal` WHERE `id`='$idsoal'");  
	if($hasil){    
		$admin.='<div class="sukses">Soal berhasil dihapus! .</div>';    
		$style_include[] ='<meta http-equiv="refresh" content="1; url=admin.php?pilih=ujian&mod=yes&aksi=addsoal&idujian='.$idujian.'&id='.$id.'" />';    
	}
}

if (in_array($_GET['aksi'],array('listujian'))) {

$id     = int_filter($_GET['id']);
$admin .='<div class="panel-heading"><b>Daftar Kursus</b></div>';
$hasil =  $koneksi_db->sql_query( "SELECT * FROM kursus_setting where id='$id' " );
$data = $koneksi_db->sql_fetchrow($hasil);
$idkursus=$data['id'];
$guru=$data['guru'];
$mapel =$data['mapel'];
$tahun =$data['tahun'];
$namakursus =$data['judul'];
$hasil =  $koneksi_db->sql_query( "SELECT * FROM useraura where user='$guru' " );
$data = $koneksi_db->sql_fetchrow($hasil);
$statusemail=$data['statusemail'];
$statustelp=$data['statustelp'];
$email=$data['email'];
$telp=$data['telp'];
if($statusemail=='tampilkan'){
$email = $email;
}else{
$email =$statusemail;
}
if($statustelp=='tampilkan'){
$telp=$telp;
}else{
$telp=$statustelp;
}
$admin .= '
<table cellspacing="0" cellpadding="0"class="table table-striped table-hover">
	<tr>
		<td>Nama Guru</td>
		<td>:</td>
		<td>'.getnamaguru($guru).'</td>
		<td>Tahun</td>
		<td>:</td>
		<td>'.$tahun.'</td>
	</tr>
	<tr>
		<td>Mata Pelajaran</td>
		<td>:</td>
		<td>'.getmapel($mapel).'</td>
		<td>Nama Kursus</td>
		<td>:</td>
		<td>'.$namakursus.'</td>
	</tr>';
$admin .="<tr><td>Kelas</td>
		<td>:</td>
		<td colspan='4'>";
$getkelasid_ks = getkelasid_ks($idkursus);
$qry_kelas=mysql_query("SELECT * from kelas where id in($getkelasid_ks)");
$no=1;
while($datas=mysql_fetch_array($qry_kelas)){
$idkelas = $datas["idkelas"];
$kelas = $datas["kelas"];
$admin .="<input type='checkbox' name='kelas$no' value='$idkelas' checked disabled /> $kelas </label>&nbsp;";
$no++;
}
$admin .= '</td></tr>';	
$admin .= '</table>';

/************************************/
$hasil = $koneksi_db->sql_query( "SELECT * FROM ujian where guru='$guru' and idkursus='$idkursus' order by tgl desc" );
$admin .='<div class="panel-heading"><b>Daftar Ujian</b></div>';
$admin .= '<table id="example" class="table table-striped table-hover">
<thead><tr>
<th>Tgl</th>
<th>Pertemuan</th>
<th>Judul</th>
<th>Soal/Jml</th>
<th>Tipe</th>
<th>Status</th>
<th width="220px">Aksi</th>
</tr></thead><tbody>';
$no = 1;
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$pertemuan=$data['pertemuan'];
$idujian=$data['id'];
$idkursus=$data['idkursus'];
$tgl=$data['tgl'];
$judul=$data['judul'];
$jumlahsoal=$data['jumlahsoal'];
$tipe=$data['tipe'];
$status=$data['status'];
$idkelas = $data['kelas'];
$kelas = lihatkelas($idkelas);
$kelas = substr_replace($kelas, "", -1, 1);
$admin .='<tr>
<td><b>'.tglsort($tgl).'</b></td>
<td>'.getpertemuan($pertemuan).'</td>
<td>'.$judul.'</td>
<td>'.getjumlahsoal($idujian).' / '.$jumlahsoal.'</td>
<td>'.$tipe.'</td>
<td>'.$status.'</td>';
if(getjumlahsoal($idujian)==$jumlahsoal){
$test = '<a href="?pilih=ujian&amp;mod=yes&amp;aksi=testujian&amp;idujian='.$data['id'].'&amp;id='.$data['idkursus'].'"><span class="btn btn-primary">Test</span></a>';
}else{
$test = '';
}
$admin .='
<td><a href="?pilih=ujian&amp;mod=yes&amp;aksi=del&amp;id='.$data['id'].'&amp;idkursus='.$data['idkursus'].'" onclick="return confirm(\'Soal pada ujian tersebut akan ikut terhapus,Apakah Anda Yakin Ingin Menghapus Data Ini ?\')"><span class="btn btn-danger">Del</span></a>&nbsp;<a href="?pilih=ujian&amp;mod=yes&amp;aksi=edit&amp;id='.$data['id'].'&amp;idkursus='.$data['idkursus'].'" onclick="return confirm(\'Edit Ujian hanya mengedit Tipe Soal Urut/Random dan Status Ujian, Apakah ingin melanjutkan ?\')"><span class="btn btn-warning">Edit</span></a>&nbsp;<a href="?pilih=ujian&amp;mod=yes&amp;aksi=addsoal&amp;idujian='.$data['id'].'&amp;id='.$data['idkursus'].'"><span class="btn btn-success">Soal</span></a>&nbsp;'.$test.'</td>
</tr>';
$no++;
}
$admin .= '</tbody></table>';
$admin.="<table class='table'><tr><td><a href='?pilih=ujian&mod=yes'><span class='btn btn-primary'>BACK</span></a></td></tr></table>";
/************************************/
}

if (in_array($_GET['aksi'],array('addsoal'))) {

$id     = int_filter($_GET['id']);
/************************************/
$hasil = $koneksi_db->sql_query( "SELECT * FROM soal where ujian='$idujian' order by id asc" );
$admin .='<div class="panel-heading"><b>Daftar Soal</b></div>';
$admin .= '<table id="example" class="table table-striped table-hover">
<thead><tr>
<th width="10px">No</th>
<th width="300px">Soal</th>
<th width="100px">Files</th>
<th width="150px">Aksi</th>
</tr></thead><tbody>';
$no = 1;
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$idsoal=$data['id'];
$soal=$data['soal'];
$files=$data['files'];
if($files){
$gambar = '<a href="mod/ujian/download/'.$files.'" target="new"><span class="label label-success">available</span></a>&nbsp;<a href="?pilih=ujian&amp;mod=yes&amp;aksi=hapusfilessoal&amp;idujian='.$idujian.'&amp;id='.$idkursus .'&amp;idsoal='.$idsoal .'"><span class="label label-danger">hapus</span></a>' ;
}else{
$gambar = '<span class="label label-danger">not-available</span>';
}
$kelas = lihatkelas($idkelas);
$kelas = substr_replace($kelas, "", -1, 1);
$admin .='<tr>
<td><b>'.$no.'</b></td>
<td>'.$soal.'</td>
<td>'.$gambar.'</td>
<td><a href="?pilih=ujian&amp;mod=yes&amp;aksi=delsoal&amp;idujian='.$idujian.'&amp;id='.$idkursus .'&amp;idsoal='.$idsoal .'" onclick="return confirm(\'Apakah Anda Yakin Ingin Menghapus Soal Ini ?\')"><span class="btn btn-danger">Del</span></a>&nbsp;<a href="?pilih=ujian&amp;mod=yes&amp;aksi=editsoal&amp;idujian='.$idujian.'&amp;id='.$idkursus .'&amp;idsoal='.$idsoal .'"><span class="btn btn-warning">Edit</span></a>&nbsp;<a href="?pilih=ujian&amp;mod=yes&amp;aksi=addsoal&amp;idujian='.$idujian.'&amp;id='.$idkursus.'"><span class="btn btn-success">Add</span></a></td>
</tr>';
$no++;
}
$admin .= '</tbody></table>';
/************************************/
}

if ($_GET['aksi']== 'testujian') {
$id     = int_filter($_GET['id']);
$idujian     = int_filter($_GET['idujian']);
//$admin .='<div class="panel-heading"><b>Kursus</b></div>';
$hasil =  $koneksi_db->sql_query( "SELECT * FROM kursus_setting where id='$id' " );
$data = $koneksi_db->sql_fetchrow($hasil);
$idkursus=$data['id'];
$guru=$data['guru'];
$mapel =$data['mapel'];
$tahun =$data['tahun'];
/*
$admin .= '
<table cellspacing="0" cellpadding="0"class="table table-striped table-hover">
	<tr>
		<td>Nama Guru</td>
		<td>:</td>
		<td>'.getnamaguru($guru).'</td>
		<td>Tahun</td>
		<td>:</td>
		<td>'.$tahun.'</td>
	</tr>
	<tr>
		<td>Mata Pelajaran</td>
		<td>:</td>
		<td>'.getmapel($mapel).'</td>
		<td></td>
		<td></td>
		<td>';
$admin.="<a href='?pilih=ujian&mod=yes&aksi=listujian&id=$idkursus'><span class='btn btn-primary'>BACK</span></a>";	
$admin.='</td>
	</tr>
</table>';
*/
$idujian     = int_filter($_GET['idujian']);
$admin .='<div class="panel-heading"><b>Latihan Ujian</b></div>';
$hasil2 =  $koneksi_db->sql_query( "SELECT * FROM ujian where id='$idujian' " );
$data2 = $koneksi_db->sql_fetchrow($hasil2);
$judul=$data2['judul'];
$tipe =$data2['tipe'];
$tipeujian =$data2['tipeujian'];
$jumlahsoal =$data2['jumlahsoal'];
$status =$data2['status'];
$guru =$data2['guru'];
$pointbenar =$data2['pointbenar'];
$pointsalah =$data2['pointsalah'];
$pointkosong =$data2['pointkosong'];
$petunjuk =$data2['petunjuk'];
if($petunjuk){
$petunjukumum = "
<tr><td colspan='6'>
<B>Petunjuk Umum :</b>
<br>$petunjuk
</td></tr>
";
}
$admin .= '
<table cellspacing="0" cellpadding="0"class="table table-striped table-hover">
	<tr>
		<td>Judul</td>
		<td>:</td>
		<td>'.$judul.'</td>
		<td>Jumlah Soal</td>
		<td>:</td>
		<td>'.$jumlahsoal.'</td>
	</tr>
	<tr>
		<td>Nama Guru</td>
		<td>:</td>
		<td>'.getnamaguru($guru).'</td>
		<td>Tipe / Status Soal</td>
		<td>:</td>
		<td>'.$tipeujian.' / '.$status.'</td>
	</tr>
		<tr>
		<td>Nilai Sebelumnya</td>
		<td>:</td>
		<td>'.getnilaiujian($idujian,$user).'</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	'.$petunjukumum.'
</table>';
$tipejawaban = getjumlahjawaban($idujian);
$jawaban = explode(",", $tipejawaban);
$jml_jawaban = count($jawaban);
if($tipe=='random'){
$hasil = mysql_query("SELECT * FROM soal where ujian='$idujian' ORDER BY RAND()");
}else{
$hasil = mysql_query("SELECT * FROM soal where ujian='$idujian'order by id asc");
}
/*****************/
$total         = $koneksi_db->sql_numrows($hasil);
$tombolsoal=1;
$admin .='<table class="table">';
$admin .='<tr><td><div id="buttons">  ';
for ($j = 1; $j <= $total; $j++) {
$admin .='
<a  class="btnsoal" target="'.$j.'">Soal '.$j.'</a>&nbsp;';
}

$admin .='</div></td></tr>';
$admin .='</table>';
/******************/
$admin .= '
<form method="post"action="?pilih=ujian&mod=yes&aksi=hasiltest&id='.$idkursus.'">
<table class="table table-striped table-hover">
<thead ><tr class="info">
<th>Soal</th>
</tr></thead><tbody>';
$admin .= '<tr><td>';
$nosoal=1;
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$idsoal=$data['id'];
$soal=$data['soal'];
$kunci=$data['kunci'];
$pilihansoal = explode("#", $data["pilihan"]);
$jml_pil = count($pilihansoal);
$filesgambar=$data['files'];
if($filesgambar){
$gambar = "<img src='mod/ujian/download/$filesgambar'><br>";
}else{
$gambar = '';
}
/***************************************/
$admin .='<div id="div'.$nosoal.'" class="targetDiv"style="display:none">
<b>'.$nosoal.'</b>. 
'.$gambar.''.$soal.'<br>';
for ($i = 0; $i < $jml_jawaban; $i++) {
$admin .="<label class='radio'>
  <input type='radio' name='jawabantest$nosoal' value='$jawaban[$i]'>
$jawaban[$i]. $pilihansoal[$i]</label>";
}
$admin.='</div>';

$nosoal++;
$kuncijawaban.=$kunci."#";
}
$admin .= '</td></tr>';
$admin .= '</tbody></table>';
/*******************************************/
$admin.="<div align='center'>";
$admin .="
<input type='hidden' name='pointbenar' value='$pointbenar' />";
$admin .="
<input type='hidden' name='pointsalah' value='$pointsalah' />";
$admin .="
<input type='hidden' name='pointkosong' value='$pointkosong' />";
$admin .="
<input type='hidden' name='tot' value='$nosoal' />";
$admin .="
<input type='hidden' name='idkursus' value='$idkursus' />";
$admin .="
<input type='hidden' name='kuncijawaban' value='$kuncijawaban' />";
$admin .="
<input type='hidden' name='idujian' value='$idujian' />";
$admin .="
<input type='hidden' name='tipeujian' value='$tipeujian' />";
$admin .="<a href='?pilih=ujian&mod=yes&aksi=listujian&id=$idkursus'><span class='btn btn-primary'>BACK</span></a>&nbsp;";
$admin .='<input type="submit"class="btn btn-success" value="Submit" name="submit" onclick="return confirm(\'Apakah Anda Yakin Ingin Mengakhiri Ujian Ini ?\')">';
$admin.="</div>";
$admin.="<br></form>";

}

if ($_GET['aksi']== 'hasiltest') {
$admin .='<div class="panel-heading"><b>Hasil Test Latihan Ujian</b></div>';
$kj2 = substr_replace($_POST['kuncijawaban'],"", -1, 1);	
$kuncijawaban = explode("#", $kj2);
$idkursus = $_POST['idkursus'];
$idujian = $_POST['idujian'];
$tipeujian = $_POST['tipeujian'];
$pointbenar = $_POST['pointbenar'];
$pointsalah = $_POST['pointsalah'];
$pointkosong = $_POST['pointkosong'];
$tot = $_POST['tot'];
$jawabankosong=0;
$jawabanterisi=0;
$jawabanbenar=0;
$jawabansalah=0;
for ($i = 1; $i < $tot; $i++) {
if($_POST['jawabantest'.$i]==""){
$jawabankosong++;
}
if($_POST['jawabantest'.$i]<>""){
$jawabanterisi++;
}
if($_POST['jawabantest'.$i]==$kuncijawaban[$i-1]){
$jawabanbenar++;
}

$ppil .= $_POST['jawabantest'.$i]."#" ;
$ppil = substr_replace($ppil, "", -1, 1);				
}
$jawabansalah = $jawabanterisi-$jawabanbenar;
$score = ($pointbenar*$jawabanbenar)+($pointsalah*$jawabansalah)+($pointkosong*$jawabankosong);
/*******************/
simpannilai($idujian,$user,$score,$tipeujian,$levelakses);
/********************/
$admin.="<table class='table'>";
$admin.="<tr><td><h2>Total Score : $score </h2></td></tr>";
$admin.="<tr><td>
Level : $levelakses <br>
User  : $user <br>
		Jawaban Terisi : $jawabanterisi <br>";
$admin.="Jawaban Benar : $jawabanbenar <br>";
$admin.="Jawaban Salah : $jawabansalah </td></tr>";
$admin .="<tr><td><a href='?pilih=ujian&mod=yes&aksi=listujian&id=$idkursus'><span class='btn btn-primary'>BACK</span></a>&nbsp;</td></tr>";
$admin.="</table>";

}

if($_GET['aksi']=="hapusfilessoal"){
	global $koneksi_db;    
	$id     = int_filter($_GET['id']);    
	$idsoal     = int_filter($_GET['idsoal']);  
	$idujian     = int_filter($_GET['idujian']);  
$hasil = $koneksi_db->sql_query( "SELECT * FROM soal WHERE id='$idsoal'" );
while($data = mysql_fetch_array($hasil)){
    $namagambar =  $data['files'];
    $uploaddir = $temp . $namagambar; 
	unlink($uploaddir);
}	
		$hasil = $koneksi_db->sql_query("update `soal` set files='' WHERE `id`='$idsoal'");  
	if($hasil){    
		$admin.='<div class="sukses">File pada Soal berhasil dihapus! .</div>';    
		$style_include[] ='<meta http-equiv="refresh" content="1; url=admin.php?pilih=ujian&mod=yes&aksi=addsoal&idujian='.$idujian.'&id='.$id.'" />';    
	}
}

/* NILAI UJIAN */
if($_GET['aksi']=="nilaiujian"){
$admin .='<div class="panel-heading"><b>Nilai Ujian</b></div>';
$admin .= '
<form method="post" action=""class="form-inline">
<table cellspacing="0" cellpadding="0"class="table table-striped table-hover">
	<tr>
		<td>Nama Guru | Judul Ujian</td>
		<td>:</td>
		<td>
<select name="idujian" class="form-control" required>';
$hasil = $koneksi_db->sql_query("SELECT * FROM ujian where guru = '$user'ORDER BY guru asc");
$admin .= '<option value="">== Pilih Judul Ujian ==</option>';
while ($datas =  $koneksi_db->sql_fetchrow ($hasil)){
$admin .= '<option value="'.$datas['id'].'"'.$pilihan.'>'.$datas['guru'].' | '.$datas['judul'].'</option>';
}
$admin .='</select></td>
	</tr>
	<tr>
		<td>Kelas</td>
		<td>:</td>
		<td>
<select name="kelas" class="form-control" required>';
$hasil = $koneksi_db->sql_query("SELECT * FROM kelas  ORDER BY kelas asc");
$admin .= '<option value="">== Pilih Kelas ==</option>';
while ($datas =  $koneksi_db->sql_fetchrow ($hasil)){
$admin .= '<option value="'.$datas['id'].'"'.$pilihan.'>'.$datas['kelas'].'</option>';
}
$admin .='</select></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td>
		<input type="submit" value="Lihat Nilai" name="lihatnilaiujian"class="btn btn-success"></td>
	</tr>
</table>
</form>
';
if(isset($_POST['lihatnilaiujian'])){
$idujian     		= $_POST['idujian'];
$kelasid     		= $_POST['kelas'];
$kelas = getkelas($kelasid);
$namaujian = getnamaujian($idujian);
$namaguru = getnamaguruujian($idujian);
$hasil = $koneksi_db->sql_query( "SELECT * FROM `kelas_isi`where kelas ='$kelasid'" );
$admin.='<div class="panel-heading"><b>Daftar Siswa Kelas '.$kelas.'</b></div>';
$admin .="
<form method='post' action='excellnilaiujian.php'><table class='table table-striped table-hover'>";
  $admin .= "    <tr>
    <td width='30%' valign='top'>Kelas </td>
    <td width='1%' valign='top'>:</td>
    <td width='69%' valign='top'>$kelas</td>
  </tr>"; 
   $admin .= "    <tr>
    <td width='30%' valign='top'>Nama Ujian </td>
    <td width='1%' valign='top'>:</td>
    <td width='69%' valign='top'>$namaujian</td>
  </tr>"; 
    $admin .= "    <tr>
    <td width='30%' valign='top'>Nama Guru </td>
    <td width='1%' valign='top'>:</td>
    <td width='69%' valign='top'>$namaguru</td>
  </tr>";
      $admin .= "    <tr>
    <td width='30%' valign='top'>Export Ke </td>
    <td width='1%' valign='top'>:</td>
    <td width='69%' valign='top'>
	<input type='hidden' name='idujian' value='$idujian'>
	<input type='hidden' name='kelasid' value='$kelasid'>
	<input type='submit' value='Excell' name='nilaiujianexcell'class='btn btn-warning'></td>
  </tr>";
$admin .="</table></form>";
$admin.='
<table id="example" class="table table-striped table-hover">
<thead><tr>
    <td align="left" width="100px"><b>No.Induk</b></td>
    <td align="left"><b>Nama</b></td>
    <td align="left" width="100px"><b>Nilai</b></td>
  </tr></thead><tbody>';
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$namasiswa = getnamasiswa($data['siswa']);
$nilaiujian = getnilaiujian ($idujian,$data['siswa']);
$admin.='
  <tr>
    <td>'.$data['siswa'].'</td>
    <td>'.$namasiswa.'</td>
    <td>'.$nilaiujian.'</td>
   </tr>';
}
$admin.='</table>';
}
}

$admin .='</div>';
}
echo $admin;

?>