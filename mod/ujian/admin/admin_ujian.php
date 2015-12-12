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
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons template textcolor paste  textcolor filemanager"
        ],

        toolbar1: "| bold italic underline strikethrough | code",
		

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
    $('#example').dataTable( "pageLength": 50);
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
if ($_GET['aksi']== 'testujian') {
date_default_timezone_set('Asia/Jakarta');
$detik=getwaktu();
$waktuselesai=tambahwaktu($detik);
$waktumulai1=time();
$waktumulai = date("M j, Y H:i:s",$waktumulai1);
$waktuakhir1 = $waktumulai1+$detik;
$waktuakhir = date("M j, Y H:i:s",$waktuakhir1);
if (isset ($_SESSION['waktumulai'])){
$waktumulai = $_SESSION['waktumulai'];
}else{
$_SESSION['waktumulai']= $waktumulai;	
}	
if (isset ($_SESSION['waktuakhir'])){
$waktuakhir = $_SESSION['waktuakhir'];
}else{
$_SESSION['waktuakhir']= $waktuakhir;	
}

$JS_SCRIPT.= <<<js
<script type="text/javascript" src="includes/countdown2/jquery.countdownTimer.js"></script>
<script>
  $(function(){
    $('#future_date').countdowntimer({
       dateAndTime : "<?php $_SESSION[waktuakhir] ?>",
       size : "lg",
       regexpMatchFormat: "([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})",
       regexpReplaceWith: "<div align='center'><div class='btn btn-danger btn-lg'>$2</div>:<div class='btn btn-danger btn-lg'>$3</div>:<div class='btn btn-danger btn-lg'>$4</div></div>"
    });
  });
</script>
js;
$JS_SCRIPT.= <<<js
<script type="text/javascript">
setTimeout(function(){
  alert("Waktu Ujian Telah Habis !");
}, $detik*1000);
</script>
js;
$JS_SCRIPT.= <<<js
<script type="text/javascript">
setTimeout(function(){
 document.getElementById('formujian').submit();
}, $detik*1000);
</script>
js;
}
$script_include[] = $JS_SCRIPT;
$user =  $_SESSION['UserName'];
$levelakses=$_SESSION['LevelAkses'];
$mapel=getmapeluser($_SESSION['UserName']);
$petunjuk=getpetunjuk();

    $temp 	= 'mod/ujian/download/';
	$admin .= '<div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-list-alt"></i> Ujian</h3>
					<ol class="breadcrumb">
					<li><i class="fa fa-home"></i><a href="?pilih=ujian&mod=yes">Home</a></li>
					<li><i class="icon icon_document_alt"></i><a href="admin.php?pilih=ujian&mod=yes&aksi=nilaiujian">Lihat Nilai</a></li>';
if($_SESSION['LevelAkses']=='Administrator'){
$admin .= '<li><i class="icon  icon_cog"></i><a href="admin.php?pilih=ujian&mod=yes&aksi=setting">Setting</a></li>';
}
$admin .= '<li><i class="icon  icon_documents_alt"></i><a href="admin.php?pilih=ujian&mod=yes&aksi=nilaihistoryujian">Lihat Nilai Sendiri</a></li>';
$admin .= '</ol></div></div>';

$admin .='<div class="panel">';

if($_GET['aksi']==""){
if($_SESSION['LevelAkses']=='Guru'){
$hasil = $koneksi_db->sql_query( "SELECT * FROM mapel where id='$mapel'  order by mapel asc" );
}else{
$hasil = $koneksi_db->sql_query( "SELECT * FROM mapel   order by mapel asc" );	
}
$admin .='<div class="panel-heading"><b>Daftar Mapel</b></div>';
$admin .= '<table id="example" class="table table-striped table-hover">
<thead><tr>
<th>No</th>
<th>Mata Pelajaran</th>
<th>Aksi</th>
</tr></thead><tbody>';
$no = 1;
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$idmapel     = $data['id'];  
$mapel     = $data['mapel'];  
$cekjmlujian  = cekjmlujian2($idmapel); 
$tambahujian = '<a href="?pilih=ujian&amp;mod=yes&amp;aksi=addujian&amp;id='.$data['id'].'"><span class="btn btn-warning">Tambah Ujian</span></a>&nbsp;';
$admin .='<tr>
<td><b>'.$no.'</b></td>
<td>'.$data['mapel'].'</td>
<td>'.$tambahujian.'';
if($cekjmlujian>0){
$admin .='<a href="?pilih=ujian&amp;mod=yes&amp;aksi=listujian&amp;id='.$data['id'].'"><span class="btn btn-primary">Ujian('.$cekjmlujian.')</span></a>';
}else{
$admin .='<a href="#"><span class="btn btn-danger">Kosong</span></a>';
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
	$idmapel     = int_filter($_GET['idmapel']);   	
	$hasil = $koneksi_db->sql_query( "SELECT * FROM soal WHERE ujian='$idkursus'" );
	while($data = mysql_fetch_array($hasil)){
    $namagambar =  $data['files'];
    $uploaddir = $temp . $namagambar; 
	unlink($uploaddir);
}
	$hasil = $koneksi_db->sql_query( "SELECT * FROM ujian WHERE id='$id'" );
	$data = mysql_fetch_array($hasil);
    $listening =  $data['listening'];		
    $uploaddir2 = $temp . $listening; 
	unlink($uploaddir2);	
	
	$hasil = $koneksi_db->sql_query("DELETE FROM `ujian` WHERE `id`='$id'");    
		$hasil = $koneksi_db->sql_query("DELETE FROM `soal` WHERE `ujian`='$id'");  
	if($hasil){    
		$admin.='<div class="sukses">Ujian berhasil dihapus! .</div>';    
		$style_include[] ='<meta http-equiv="refresh" content="1; url=admin.php?pilih=ujian&mod=yes&aksi=listujian&id='.$idmapel.'" />';    
	}
}

if($_GET['aksi'] == 'edit'){
$id = int_filter ($_GET['id']);
$idmapel = int_filter ($_GET['idmapel']);
$admin .='<div class="panel-heading"><b>Mata Pelajaran</b></div>';
$hasil =  $koneksi_db->sql_query( "SELECT * FROM mapel where id='$idmapel' " );
$data = $koneksi_db->sql_fetchrow($hasil);
$idmapel=$data['id'];
$mapel =$data['mapel'];
$admin .= '
<table cellspacing="0" cellpadding="0"class="table table-striped table-hover">
<tr>
		<td>Mata Pelajaran</td>
		<td>:</td>
		<td>'.$mapel.'</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
</table>';

if(isset($_POST['submit'])){
$judul     		= addslashes($_POST['judul']);
$tgl     		= $_POST['tgl'];
$tipe     		= $_POST['tipe'];		
$status     	= $_POST['status'];	
$idkursus     	= $_POST['idkursus'];	
$jumlahsoal   	= $_POST['jumlahsoal'];	
$pointbenar		=$_POST['pointbenar'];
$pointsalah		=$_POST['pointsalah'];
$pointkosong	=$_POST['pointkosong'];
$petunjuk	=$_POST['petunjuk'];
$cekjumlahsoal = cekjumlahsoal($id);
$tipeujian	=$_POST['tipeujian'];
$namafile_name 	= $_FILES['listening']['name'];	
$error 	= '';
if($cekjumlahsoal>$jumlahsoal){
$error = "Soal yang terbentuk lebih besar dari jumlah Soal yang akan di Edit.<br>Harap menghapus beberapa Soal $cekjumlahsoal / $jumlahsoal";
}
if ($error){
$admin .= '<div class="error">'.$error.'</div>';
}else{
if ($namafile_name){
	$hasil = $koneksi_db->sql_query( "SELECT * FROM ujian WHERE id='$id'" );
	$data = mysql_fetch_array($hasil);
    $listening =  $data['listening'];		
    $uploaddir2 = $temp . $listening; 
	unlink($uploaddir2);	
@copy($_FILES['listening']['tmp_name'], $temp.$namafile_name);
$hasil  = mysql_query( "update `ujian` set tgl = '$tgl',judul = '$judul',tipe = '$tipe',status='$status',jumlahsoal='$jumlahsoal',pointbenar='$pointbenar',pointsalah='$pointsalah',pointkosong='$pointkosong',petunjuk='$petunjuk',tipeujian='$tipeujian',listening='$namafile_name' where id='$id'" );
	}else{
$hasil  = mysql_query( "update `ujian` set tgl = '$tgl',judul = '$judul',tipe = '$tipe',status='$status',jumlahsoal='$jumlahsoal',pointbenar='$pointbenar',pointsalah='$pointsalah',pointkosong='$pointkosong',petunjuk='$petunjuk',tipeujian='$tipeujian' where id='$id'" );
	}

	
if($hasil){
$admin .= "<div class='sukses'><b>Berhasil di Update.</b></div>";
header("location:?pilih=ujian&mod=yes&aksi=listujian&id=$idmapel");

}else{
$admin .= '<div class="error"><b> Gagal di Update.</b></div>';
header("location:?pilih=ujian&mod=yes&aksi=listujian&id=$idmapel");
}
unset($tipe);
unset($status);
unset($jumlahsoal);
unset($petunjuk);
unset($tipeujian);
}

}
/*************************************************/
$hasil =  $koneksi_db->sql_query( "SELECT * FROM ujian where id='$id'" );
$data = $koneksi_db->sql_fetchrow($hasil);
$judul=$data['judul'];
$tipe=$data['tipe'];
$status=$data['status'];
$jumlahsoal=$data['jumlahsoal'];
$pointbenar=$data['pointbenar'];
$pointsalah=$data['pointsalah'];
$pointkosong=$data['pointkosong'];
$petunjuk=$data['petunjuk'];
$tgl=$data['tgl'];
$tglnow = date("Y-m-d");
$tipeujian=$data['tipeujian'];
$listening=$data['listening'];
if($listening<>''){
$filelistening = $temp.$listening;
}
$tgl 		= !isset($tgl) ? $tglnow : $tgl;
$sel = '<select name="tipe" class="form-control" required>';
$arr = array ('random','urut');
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
$admin.='
		<tr>
		<td>Guru</td>
		<td>:</td>
		<td>'.getnamaguru($user).'</td>
	</tr>
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
		<td>Jumlah Soal</td>
		<td>:</td>
		<td><input type="text" name="jumlahsoal" value="'.$jumlahsoal.'" size="30" class="form-control" required></td>
	</tr>
	
	';
if($levelakses=='Administrator'){
$admin.='
		<tr>
		<td>Tipe Ujian</td>
		<td>:</td>
		<td>'.$sel.'</td>
	</tr>
		<tr>
		<td>Status</td>
		<td>:</td>
		<td>'.$sel2.'</td>
	</tr>';
		
}
if($listening<>''){
$admin .='<tr>
<td>File Listening ( Lama )</td>
<td></td>
<td>
<audio src="'.$filelistening.'" controls="true" loop="true" autoplay="true"></audio><br>
'.$filelistening.'
</td>
</tr>';
}
$admin .="<tr>
<td>File Listening </td>
<td></td>
<td><input type='file' name='listening'> *bila tipe ujian listening harus ada, file harus berformat mp3</td>
</tr>";
$admin.='	<tr>
		<td></td>
		<td></td>
		<td>';
if($levelakses=='Administrator'){
$admin .= "
<input type='hidden' name='idmapel' value='$idmapel'>
<input type='hidden' name='pointsalah' value='0'>
<input type='hidden' name='pointkosong' value='0'>
<input type='hidden' name='tipe' value='random'>
<input type='hidden' name='petunjuk' value='$petunjuk'>
";		
}else{
$admin .= "
<input type='hidden' name='idmapel' value='$idmapel'>
<input type='hidden' name='pointsalah' value='0'>
<input type='hidden' name='pointkosong' value='0'>
<input type='hidden' name='tipe' value='random'>
<input type='hidden' name='tipeujian' value='latihan'>
<input type='hidden' name='petunjuk' value='$petunjuk'>
<input type='hidden' name='status' value='$status'>
";
}

$admin .= '
		<input type="submit" value="Simpan" name="submit"class="btn btn-success" >&nbsp;';
$admin.="<a href='?pilih=ujian&mod=yes&aksi=listujian&id=$idmapel'><span class='btn btn-primary'>BACK</span></a>";		
		$admin.='</td>
	</tr>
</table>
</form>';	
}

if($_GET['aksi']=="addujian"){
$idmapel     = int_filter($_GET['id']);
$admin .= '
<table cellspacing="0" cellpadding="0"class="table table-striped table-hover">
	<tr>
		<td>Mata Pelajaran</td>
		<td>:</td>
		<td>'.getmapel($idmapel).'</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
</table>';

if(isset($_POST['submit'])){
$tgl     		= $_POST['tgl'];	
$judul     		= addslashes($_POST['judul']);	
$pointbenar     		= $_POST['pointbenar'];	
$pointsalah     		= $_POST['pointsalah'];	
$pointkosong     		= $_POST['pointkosong'];	
$tipe     		= $_POST['tipe'];	
$jumlahsoal     		= $_POST['jumlahsoal'];	
$tipejawaban     		= $_POST['tipejawaban'];	
$status     		= $_POST['status'];	
$idmapel     		= $_POST['idmapel'];	
$petunjuk     		= addslashes($_POST['petunjuk']);	
$tipeujian     		= $_POST['tipeujian'];	
$namafile_name 	= $_FILES['listening']['name'];	


if (!$judul)  	$error .= "Error: Silahkan Isi Judul<br />";
if ($koneksi_db->sql_numrows($koneksi_db->sql_query("SELECT * FROM ujian WHERE  judul='$judul'")) > 0) $error .= "Error: Ujian dengan Judul $judul sudah terdaftar , silahkan ulangi.<br />";
if ($error){
$admin .= '<div class="error">'.$error.'</div>';
}else{
$hasil  = mysql_query( "INSERT INTO `ujian` VALUES ('','$tgl','$judul','$pointbenar','$pointsalah','$pointkosong','$tipe','$jumlahsoal','$tipejawaban','$status','$idmapel','$petunjuk','$tipeujian','$namafile_name','$user')" );
    if ($namafile_name){
		@copy($_FILES['listening']['tmp_name'], $temp.$namafile_name);
	}
if($hasil){
$admin .= '<div class="sukses"><b>Berhasil di Buat.</b></div>';
		$style_include[] ='<meta http-equiv="refresh" content="1; url=admin.php?pilih=ujian&aksi=&aksi=listujian&mod=yes&id='.$idmapel.'" />'; 
}else{
$admin .= '<div class="error"><b> Gagal di Buat.</b></div>';
}
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
$arr = array ('random','urut');
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
<form method="post" action="" class="form-inline" id="posts" enctype ="multipart/form-data">
<table class="table table-striped table-hover">';
$admin.='
		<tr>
		<td>Guru</td>
		<td>:</td>
		<td>'.getnamaguru($user).'</td>
	</tr>
<tr>
		<td>Tanggal</td>
		<td>:</td>
		<td><input type="text" name="tgl" id="tgl" value="'.$tgl.'" size="30" class="form-control" required></td>
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
$admin .= '<option value="a,b,c"> A - C </option>';
$admin .='</select></td>
	</tr>';
	$admin .="<tr><td>File Listening </td>
		<td></td>
<td><input type='file' name='listening'> *bila tipe ujian listening harus ada, file harus berformat mp3</td></tr>";
$admin .= "	<tr>
		<td></td>
		<td></td>
		<td>
<input type='hidden' name='idmapel' value='$idmapel'>
<input type='hidden' name='pointsalah' value='0'>
<input type='hidden' name='pointkosong' value='0'>
<input type='hidden' name='tipe' value='random'>
<input type='hidden' name='tipeujian' value='latihan'>
<input type='hidden' name='petunjuk' value=''>
<input type='hidden' name='status' value='disabled'>
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
$idujian     = int_filter($_GET['idujian']);
$admin .='<div class="panel-heading"><b>Daftar Ujian</b></div>';
$hasil2 =  $koneksi_db->sql_query( "SELECT * FROM ujian where id='$idujian' " );
$data2 = $koneksi_db->sql_fetchrow($hasil2);
$judul=$data2['judul'];
$tipe =$data2['tipe'];
$jumlahsoal =$data2['jumlahsoal'];
$status =$data2['status'];
$idmapel =$data2['idmapel'];
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
		<td>Mata Pelajaran</td>
		<td>:</td>
		<td>'.getmapel($idmapel).'</td>
		<td>Tipe / Status Soal</td>
		<td>:</td>
		<td>'.$tipe.'/'.$status.'</td>
	</tr>
</table>';
/******************************/
if(isset($_POST['submit'])){
$namafile_name 	= $_FILES['gambar']['name'];
	$konten 		= (addslashes($_POST['konten']));
	$idujian 		= $_POST['idujian'];	
	$kunci 		= $_POST['kunci'];	
	$error 	= '';
	$tot=$_POST['tot'];
	$ppil ='';
			for($i=1;$i<=$tot;$i++)
			{
				$pilihan = removep($_POST['pilihan'.$i]) ;
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
			unset($konten);
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
		<td><textarea name='konten' id='textarea1'>$konten</textarea></td>
	</tr>";
$admin.="
	<tr>
		<td>Pilihan</td>
		<td></td>
		<td>";
		$no=1;
for ($i = 0; $i < $jml_jawaban; $i++) {
/*
$admin .="
    <div class='input-group'>
      <div class='input-group-addon'>$jawaban[$i].</div><input type='text' name='pilihan$no' class='form-control'required /></div>";
	  */
$admin .="
    <div class='input-group'>
      <div class='input-group-addon'>$jawaban[$i].</div>	  
	  <textarea name='pilihan$no' id='textareas$no'></textarea></div>";
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
$admin.="<a href='?pilih=ujian&mod=yes&aksi=listujian&id=$idmapel'><span class='btn btn-primary'>BACK</span></a>";	
$admin.="
</td>";
$admin.="</tr></table>
</form>";
	
}

if($_GET['aksi']=="editsoal"){

$idmapel     = int_filter($_GET['id']);
$idujian     = int_filter($_GET['idujian']);
$admin .='<div class="panel-heading"><b>Daftar Ujian</b></div>';
$hasil2 =  $koneksi_db->sql_query( "SELECT * FROM ujian where id='$idujian' " );
$data2 = $koneksi_db->sql_fetchrow($hasil2);
$judul=$data2['judul'];
$tipe =$data2['tipe'];
$jumlahsoal =$data2['jumlahsoal'];
$status =$data2['status'];
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
		<td>Mata Pelajaran</td>
		<td>:</td>
		<td>'.getmapel($idmapel).'</td>
		<td>Tipe / Status Soal</td>
		<td>:</td>
		<td>'.$tipe.'/'.$status.'</td>
	</tr>
</table>';
/******************************/
/******************************/
if(isset($_POST['submit'])){
	$konten 		= (addslashes($_POST['konten']));
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
				$pilihan = removep($_POST['pilihan'.$i]) ;
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
	
	/*
$admin .="
    <div class='input-group'>
      <div class='input-group-addon'>$jawaban[$i].</div><input type='text' name='pilihan$no' class='form-control'required value='$pilihansoal[$i]' /></div>";
	  */
	  $admin .="
    <div class='input-group'>
      <div class='input-group-addon'>$jawaban[$i].</div>	  
	  <textarea name='pilihan$no' id='textareas$no'>$pilihansoal[$i]</textarea></div>";
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
$admin.="<a href='?pilih=ujian&mod=yes&aksi=addsoal&idujian=$idujian&id=$idmapel'><span class='btn btn-primary'>BACK</span></a>";
	
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
unset($_SESSION['waktumulai']);
unset($_SESSION['waktuakhir']);
$id     = int_filter($_GET['id']);
$admin .='<div class="panel-heading"><b>Mata Pelajaran</b></div>';
$hasil =  $koneksi_db->sql_query( "SELECT * FROM mapel where id='$id' " );
$data = $koneksi_db->sql_fetchrow($hasil);
$idmapel=$data['id'];
$mapel =$data['mapel'];
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
		<td>Mata Pelajaran</td>
		<td>:</td>
		<td>'.$mapel.'</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>';
$admin .="$petunjukumum";
$admin.='</table>';

/************************************/
$hasil = $koneksi_db->sql_query( "SELECT * FROM ujian where  idmapel='$idmapel' order by tgl desc" );
$admin .='<div class="panel-heading"><b>Daftar Ujian</b></div>';
$admin .= '<table id="example" class="table table-striped table-hover">
<thead><tr>
<th>Tgl</th>
<th width="300px">Judul</th>
<th>Soal/Jml</th>
<th>Tipe/Status</th>
<th>User</th>
<th width="320px">Aksi</th>
</tr></thead><tbody>';
$no = 1;
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$pertemuan=$data['pertemuan'];
$idujian=$data['id'];
$tgl=$data['tgl'];
$judul=$data['judul'];
$jumlahsoal=$data['jumlahsoal'];
$tipe=$data['tipe'];
$status=$data['status'];
$tipeujian=$data['tipeujian'];
$listening=$data['listening'];
$userujian=$data['user'];
$soaldibuat=getjumlahsoal($idujian);
$persensoal= ($soaldibuat/$jumlahsoal)*100;
if($listening<>''){
$listening ='<i class="icon icon_music"></i>';	
}
$persen='                                  <div class="progress progress-striped active">
                                        <div class="progress-bar"  role="progressbar" aria-valuenow="50" aria-valuenow="'.$persensoal.'" aria-valuemax="100" style="width: '.$persensoal.'%"> <div>'.$persensoal.'% Complete</div>
                                        </div>
                                    </div>';
$admin .='<tr>
<td><b>'.tglsort($tgl).'</b></td>
<td>'.$judul.' '.$listening.'</td>';
//$admin .='<td>'.getjumlahsoal($idujian).' / '.$jumlahsoal.'</td>';
$admin .='<td>'.$persen.'</td>';
$admin .='<td>'.$tipe.'/'.$status.'</td>
<td>'.getnamaguru($userujian).'</td>
';

if(($_SESSION['UserName']==$userujian)){
$editujian ='<a href="?pilih=ujian&amp;mod=yes&amp;aksi=del&amp;id='.$data['id'].'&amp;idmapel='.$idmapel.'" onclick="return confirm(\'Soal pada ujian tersebut akan ikut terhapus,Apakah Anda Yakin Ingin Menghapus Data Ini ?\')"><span class="btn btn-danger">Del</span></a>&nbsp;<a href="?pilih=ujian&amp;mod=yes&amp;aksi=edit&amp;id='.$data['id'].'&amp;idmapel='.$idmapel.'" onclick="return confirm(\'Edit Ujian hanya mengedit Tipe Soal Urut/Random dan Status Ujian, Apakah ingin melanjutkan ?\')"><span class="btn btn-warning">Edit</span></a>&nbsp;<a href="?pilih=ujian&amp;mod=yes&amp;aksi=addsoal&amp;idujian='.$data['id'].'&amp;id='.$idmapel.'"><span class="btn btn-success">Soal</span></a>';	
}elseif($_SESSION['LevelAkses']=='Administrator'){
$editujian ='<a href="?pilih=ujian&amp;mod=yes&amp;aksi=del&amp;id='.$data['id'].'&amp;idmapel='.$idmapel.'" onclick="return confirm(\'Soal pada ujian tersebut akan ikut terhapus,Apakah Anda Yakin Ingin Menghapus Data Ini ?\')"><span class="btn btn-danger">Del</span></a>&nbsp;<a href="?pilih=ujian&amp;mod=yes&amp;aksi=edit&amp;id='.$data['id'].'&amp;idmapel='.$idmapel.'" onclick="return confirm(\'Edit Ujian hanya mengedit Tipe Soal Urut/Random dan Status Ujian, Apakah ingin melanjutkan ?\')"><span class="btn btn-warning">Edit</span></a>&nbsp;<a href="?pilih=ujian&amp;mod=yes&amp;aksi=addsoal&amp;idujian='.$data['id'].'&amp;id='.$idmapel.'"><span class="btn btn-success">Soal</span>&nbsp;';
	


}

if(getjumlahsoal($idujian)==$jumlahsoal){
$test = '<a href="?pilih=ujian&amp;mod=yes&amp;aksi=testujian&amp;idujian='.$data['id'].'&amp;id='.$idmapel.'"><span class="btn btn-primary">Mulai</span></a>';

}else{
$test = '';
}
$admin .='
<td>'.$editujian.'&nbsp;'.$test.'</td>
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
$gambar = '<a href="mod/ujian/download/'.$files.'" target="new" class="label label-success" rel="lightbox[roadtrip]">available</a>&nbsp;<a href="?pilih=ujian&amp;mod=yes&amp;aksi=hapusfilessoal&amp;idujian='.$idujian.'&amp;id='.$idmapel .'&amp;idsoal='.$idsoal .'"class="label label-danger">hapus</a>' ;
}else{
$gambar = '<span class="label label-danger">not-available</span>';
}
$kelas = lihatkelas($idkelas);
$kelas = substr_replace($kelas, "", -1, 1);
$admin .='<tr>
<td><b>'.$no.'</b></td>
<td>'.$soal.'</td>
<td>'.$gambar.'</td>
<td><a href="?pilih=ujian&amp;mod=yes&amp;aksi=delsoal&amp;idujian='.$idujian.'&amp;id='.$idmapel .'&amp;idsoal='.$idsoal .'" onclick="return confirm(\'Apakah Anda Yakin Ingin Menghapus Soal Ini ?\')"><span class="btn btn-danger">Del</span></a>&nbsp;<a href="?pilih=ujian&amp;mod=yes&amp;aksi=editsoal&amp;idujian='.$idujian.'&amp;id='.$idmapel .'&amp;idsoal='.$idsoal .'"><span class="btn btn-warning">Edit</span></a>&nbsp;<a href="?pilih=ujian&amp;mod=yes&amp;aksi=addsoal&amp;idujian='.$idujian.'&amp;id='.$idmapel.'"><span class="btn btn-success">Add</span></a></td>
</tr>';
$no++;
}
$admin .= '</tbody></table>';
/************************************/
}

if ($_GET['aksi']== 'testujian') {


$idmapel     = int_filter($_GET['id']);
$idujian     = int_filter($_GET['idujian']);
$admin .='<div class="panel-heading"><b>Latihan Ujian</b></div>';
$hasil2 =  $koneksi_db->sql_query( "SELECT * FROM ujian where id='$idujian' " );
$data2 = $koneksi_db->sql_fetchrow($hasil2);
$judul=$data2['judul'];
$tipe =$data2['tipe'];
$tipeujian =$data2['tipeujian'];
$jumlahsoal =$data2['jumlahsoal'];
$status =$data2['status'];
$pointbenar =$data2['pointbenar'];
$pointsalah =$data2['pointsalah'];
$pointkosong =$data2['pointkosong'];
if($petunjuk){
$petunjukumum = "
<tr><td colspan='6'>
<B>Petunjuk Umum :</b>
<br>$petunjuk
</td></tr>
";
}

$timercountdown = '<tr><td colspan="6"><div id="future_date"></div></td></tr>';
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
		<td>Mata Pelajaran</td>
		<td>:</td>
		<td>'.getmapel($idmapel).'</td>
		<td>Tipe / Status Soal</td>
		<td>:</td>
		<td>'.$tipeujian.' / '.$status.'</td>
	</tr>
	<tr>
		<td>Nilai Sebelumnya</td>
		<td>:</td>
		<td>'.getnilaiujian($idujian,$user).'</td>
		<td>Waktu</td>
		<td>:</td>
		<td>'.konversi_detik($detik).'</td>
	</tr>';
$admin .= '
	'.$petunjukumum.''.$timercountdown.'
</table>';
$tipejawaban = getjumlahjawaban($idujian);
$jawaban = explode(",", $tipejawaban);
$jml_jawaban = count($jawaban);
if($tipe=='random'){
$hasil = mysql_query("SELECT * FROM soal where ujian='$idujian' ORDER BY RAND()");
}else{
$hasil = mysql_query("SELECT * FROM soal where ujian='$idujian'order by id asc");
}

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

$admin .= '
<form  id="formujian" name="formujian" method="post"action="?pilih=ujian&mod=yes&aksi=hasiltest&id='.$idmapel.'">
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
<input type='hidden' name='idmapel' value='$idmapel' />";
$admin .="
<input type='hidden' name='kuncijawaban' value='$kuncijawaban' />";
$admin .="
<input type='hidden' name='idujian' value='$idujian' />";
$admin .="
<input type='hidden' name='tipeujian' value='$tipeujian' />";
//$admin .="<a href='?pilih=ujian&mod=yes&aksi=listujian&id=$idmapel'><span class='btn btn-primary'>BACK</span></a>&nbsp;";
$admin .='<input type="submit"class="btn btn-success" value="Selesai" onclick="return confirm(\'Apakah Anda Yakin Ingin Mengakhiri Ujian Ini ?\')">';
$admin.="</div>";
$admin.="<br></form>";
/*******************************/

}

if ($_GET['aksi']== 'hasiltest') {
$admin .='<div class="panel-heading"><b>Hasil Test Latihan Ujian</b></div>';
$kj2 = substr_replace($_POST['kuncijawaban'],"", -1, 1);	
$kuncijawaban = explode("#", $kj2);
$idmapel = $_POST['idmapel'];
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
simpannilai($idmapel,$user,$score,$tipeujian,$levelakses);
/********************/
$admin.="<table class='table'>";
$admin.="<tr><td><h2>Total Score : $score </h2></td></tr>";
$admin.="<tr><td>
Level : $levelakses <br>
User  : $user <br>
		Jawaban Terisi : $jawabanterisi <br>";
$admin.="Jawaban Benar : $jawabanbenar <br>";
$admin.="Jawaban Salah : $jawabansalah </td></tr>";
$admin .="<tr><td><a href='?pilih=ujian&mod=yes&aksi=listujian&id=$idmapel'><span class='btn btn-primary'>BACK</span></a>&nbsp;</td></tr>";
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
<table cellspacing="0" cellpadding="0"class="table">
	<tr>
		<td>Mata Pelajaran</td>
		<td>:</td>
		<td>
<select name="idmapel" class="form-control" required>';
$hasil = $koneksi_db->sql_query("SELECT * FROM mapel  ORDER BY mapel asc");
$admin .= '<option value="">== Pilih Mata Pelajaran ==</option>';
while ($datas =  $koneksi_db->sql_fetchrow ($hasil)){
$admin .= '<option value="'.$datas['id'].'"'.$pilihan.'>'.$datas['mapel'].'</option>';
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
		<input type="submit" value="Lihat Nilai" name="lihatnilaiujian"class="btn btn-success">&nbsp;</td>
	</tr>
</table>
</form>
';
if(isset($_POST['lihatnilaiujian'])){
$idmapel     		= $_POST['idmapel'];
$kelasid     		= $_POST['kelas'];
$kelas = getkelas($kelasid);
$namamapel = getmapel($idmapel);
$hasil2 = $koneksi_db->sql_query( "SELECT * FROM `kelas_isi`where kelas ='$kelasid'" );
$admin.='<div class="panel-heading"><b>Daftar Siswa Kelas '.$kelas.'</b></div>';
$admin .="
<form method='post' action='excellnilaiujian.php'><table class='table table-striped table-hover'>";
  $admin .= "    <tr>
    <td width='30%' valign='top'>Kelas </td>
    <td width='1%' valign='top'>:</td>
    <td width='69%' valign='top'>$kelas</td>
  </tr>"; 
   $admin .= "    <tr>
    <td width='30%' valign='top'>Mata Pelajaran </td>
    <td width='1%' valign='top'>:</td>
    <td width='69%' valign='top'>$namamapel</td>
  </tr>"; 
      $admin .= "    <tr>
    <td width='30%' valign='top'>Export Ke </td>
    <td width='1%' valign='top'>:</td>
    <td width='69%' valign='top'>
	<input type='hidden' name='idmapel' value='$idmapel'>
	<input type='hidden' name='kelasid' value='$kelasid'>
	<input type='submit' value='Excell' name='nilaiujianexcell'class='btn btn-warning'></td>
  </tr>";
$admin .="</table></form>";
$admin.='
<table id="example" class="table table-striped table-hover">
<thead><tr>
    <td align="left"><b>No</b></td>
    <td align="left"><b>No.Induk</b></td>
    <td align="left"><b>Nama</b></td>
    <td align="left"><b>Tanggal</b></td>
    <td align="left"><b>Jam</b></td>
    <td align="left"><b>Nilai</b></td>
    <td align="left"><b>Aksi</b></td>	
  </tr></thead><tbody>';
  $no=1;
while ($data2 = $koneksi_db->sql_fetchrow($hasil2)) {
$user = $data2['siswa'];
$namasiswa = getnamasiswa($data2['siswa']);
$nilaiujian = getnilaiujian ($idmapel,$dat2['siswa']);
$tanggalujian = gettanggalujian ($idmapel,$data2['siswa']);
$jamujian = getjamujian ($idmapel,$data2['siswa']);

if ($koneksi_db->sql_numrows($koneksi_db->sql_query("SELECT * FROM ujiannilai WHERE mapel = '$idmapel' and user = '$user'")) > 0)
{
$lihathistory = "<a href='admin.php?pilih=ujian&mod=yes&aksi=nilaihistorysiswa&idmapel=$idmapel&user=$user' class='btn btn-success'>Lihat History</a>";}
$admin.='
  <tr>
      <td>'.$no.'</td>
    <td>'.$data2['siswa'].'</td>
    <td>'.$namasiswa.'</td>
    <td>'.$tanggalujian.'</td>
    <td>'.$jamujian.'</td>
    <td>'.$nilaiujian.'</td>
    <td>'.$lihathistory.'</td>
   </tr>';
   $no++;
}
$admin.='</table>';
}

}

if($_GET['aksi']=="nilaihistoryujian"){
$admin .='<div class="panel-heading"><b>Nilai History Ujian</b></div>';
$admin .= '
<form method="post" action=""class="form-inline">
<table cellspacing="0" cellpadding="0"class="table">
	<tr>
		<td>Mata Pelajaran</td>
		<td>:</td>
		<td>
<select name="idmapel" class="form-control" required>';
$hasil = $koneksi_db->sql_query("SELECT * FROM mapel  ORDER BY mapel asc");
$admin .= '<option value="">== Pilih Mata Pelajaran ==</option>';
while ($datas =  $koneksi_db->sql_fetchrow ($hasil)){
$jumlah = getjumlahnilaihistory($datas['id'],$user);
$admin .= '<option value="'.$datas['id'].'"'.$pilihan.'>'.$datas['mapel'].' ('.$jumlah.')</option>';
}
$admin .='</select></td>
	</tr>
		<tr>
		<td></td>
		<td></td>
		<td>
		<input type="submit" value="Lihat History Nilai" name="lihathistorynilai"class="btn btn-primary"></td>
	</tr>
</table>
</form>
';

if(isset($_POST['lihathistorynilai'])){
$idmapel     		= $_POST['idmapel'];
$namamapel = getmapel($idmapel);
$admin .='<div class="panel-heading"><b>Nilai History Ujian</b></div>';
$admin .="<table class='table'>";
   $admin .= "<tr>
    <td width='30%' valign='top'>Mata Pelajaran </td>
    <td width='1%' valign='top'>:</td>
    <td width='69%' valign='top'>$namamapel</td>
  </tr>"; 
$admin .="</table>";
$hasil = $koneksi_db->sql_query( "SELECT * FROM ujiannilai where mapel = '$idmapel' and user='$user'  order by id desc" );
$admin .= '<table id="example" class="table table-striped table-hover">
<thead><tr>
<th>No</th>
<th>Tanggal</th>
<th>Jam</th>
<th>Nama</th>
<th>Nilai</th>
<th>Aksi</th>
</tr></thead><tbody>';
$no = 1;
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$user = $data['user'];
$tgl     = $data['tgl'];  
$jam     = $data['jam'];  
$nilai     = $data['nilai'];  
$nama     = getnamaguru($data['user']);  
$admin .='<tr>
<td><b>'.$no.'</b></td>
<td>'.datetimes($data['tgl']).'</td>
<td>'.$data['jam'].'</td>
<td>'.$nama.'</td>
<td>'.$data['nilai'].'</td>
<td>
<a href="?pilih=ujian&amp;mod=yes&amp;aksi=delnilai&amp;id='.$data['id'].'&amp;idmapel='.$idmapel.'" onclick="return confirm(\'Nilai pada ujian tersebut akan ikut terhapus,Apakah Anda Yakin Ingin Menghapus Data Ini ?\')"><span class="btn btn-danger">Hapus</span></a>';
$admin .='
</tr>';
$no++;
}
$admin .= '</tbody></table>';
$admin .="<table class='table'>";
$admin .= '<tr>
    <td>Hapus Semua History Nilai : <a href="?pilih=ujian&amp;mod=yes&amp;aksi=delhistorynilai&amp;id='.$data['id'].'&amp;user='.$user.'" onclick="return confirm(\'Nilai History pada ujian tersebut akan ikut terhapus,Apakah Anda Yakin Ingin Menghapus Data Ini ?\')"><span class="btn btn-danger">Hapus</span></a></td>
  </tr>'; 
$admin .="</table>";
}

}

if($_GET['aksi']=="nilaihistorysiswa"){
$user     		= $_GET['user'];
$idmapel     		= $_GET['idmapel'];
$namamapel = getmapel($idmapel);
$namasiswa = getnamasiswa($user);
$admin .='<div class="panel-heading"><b>Data Ujian</b></div>';
$admin .="<table class='table'>";
   $admin .= "<tr>
    <td width='30%' valign='top'>Mata Pelajaran </td>
    <td width='1%' valign='top'>:</td>
    <td width='69%' valign='top'>$namamapel</td>
  </tr>"; 
    $admin .= "<tr>
    <td width='30%' valign='top'>Nama Siswa </td>
    <td width='1%' valign='top'>:</td>
    <td width='69%' valign='top'>$namasiswa</td>
  </tr>"; 
$admin .="</table>";
$admin .='<div class="panel-heading"><b>History Nilai</b></div>';
$hasil = $koneksi_db->sql_query( "SELECT * FROM ujiannilai where mapel = '$idmapel' and user='$user'  order by id desc" );
$admin .= '<table id="example" class="table">
<thead><tr>
<th>No</th>
<th>Tanggal</th>
<th>Jam</th>
<th>Nama</th>
<th>Nilai</th>';
if($_SESSION['LevelAkses']=='Administrator'){
$admin .= '<th>Aksi</th>';
}
$admin .= '</tr></thead><tbody>';
$no = 1;
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$tgl     = $data['tgl'];  
$jam     = $data['jam'];  
$nilai     = $data['nilai'];  
$nama     = getnamaguru($data['user']);  
$admin .='<tr>
<td><b>'.$no.'</b></td>
<td>'.datetimes($data['tgl']).'</td>
<td>'.$data['jam'].'</td>
<td>'.$nama.'</td>
<td>'.$data['nilai'].'</td>';
if($_SESSION['LevelAkses']=='Administrator'){
$admin .='
<td>
<a href="?pilih=ujian&amp;mod=yes&amp;aksi=delnilaisiswa&amp;id='.$data['id'].'&amp;idmapel='.$idmapel.'" onclick="return confirm(\'Nilai pada ujian tersebut akan ikut terhapus,Apakah Anda Yakin Ingin Menghapus Data Ini ?\')"><span class="btn btn-danger">Hapus</span></a></td>';
}
$admin .='
</tr>';
$no++;
}
$admin .= '</tbody></table>';
if($_SESSION['LevelAkses']=='Administrator'){
$admin .="<table class='table'>";
$admin .= '<tr>
    <td>Hapus Semua History Nilai : <a href="?pilih=ujian&amp;mod=yes&amp;aksi=delhistorynilaisiswa&amp;user='.$user.'&amp;idmapel='.$idmapel.'" onclick="return confirm(\'Nilai History pada ujian tersebut akan ikut terhapus,Apakah Anda Yakin Ingin Menghapus Data Ini ?\')"><span class="btn btn-danger">Hapus</span></a></td>
  </tr>'; 
$admin .="</table>";
}
}

if($_GET['aksi']== 'delnilai'){    
	global $koneksi_db;    
	$id     = int_filter($_GET['id']);  
	$hasil = $koneksi_db->sql_query("DELETE FROM `ujiannilai` WHERE `id`='$id'");    
	if($hasil){    
		$admin.='<div class="sukses">Nilai History berhasil dihapus! .</div>';    
		$style_include[] ='<meta http-equiv="refresh" content="1; url=admin.php?pilih=ujian&mod=yes&aksi=nilaihistoryujian" />';    
	}else{
		$admin.='<div class="error">Nilai History gagal dihapus! .</div>';		
	}
}

if($_GET['aksi']== 'delnilaisiswa'){    
	global $koneksi_db;    
	$id     = int_filter($_GET['id']);  
	$hasil = $koneksi_db->sql_query("DELETE FROM `ujiannilai` WHERE `id`='$id'");    
	if($hasil){    
		$admin.='<div class="sukses">Nilai History berhasil dihapus! .</div>';    
		$style_include[] ='<meta http-equiv="refresh" content="1; url=admin.php?pilih=ujian&mod=yes&aksi=nilaiujian" />';    
	}else{
		$admin.='<div class="error">Nilai History gagal dihapus! .</div>';		
	}
}

if($_GET['aksi']== 'delhistorynilai'){    
	global $koneksi_db;    
	$user     = $_GET['user'];  
	$idmapel     = int_filter($_GET['idmapel']);  
	$hasil = $koneksi_db->sql_query("DELETE FROM `ujiannilai` WHERE `mapel`='$idmapel' and `user` ='$user'");    
	if($hasil){    
		$admin.='<div class="sukses">Semua Nilai History berhasil dihapus! .</div>';    
		$style_include[] ='<meta http-equiv="refresh" content="1; url=admin.php?pilih=ujian&mod=yes&aksi=nilaihistoryujian" />';    
	}else{
		$admin.='<div class="error">Nilai History gagal dihapus! .</div>';		
	}
}

if($_GET['aksi']== 'delhistorynilaisiswa'){    
	global $koneksi_db;    
	$user     = $_GET['user'];  
	$idmapel     = int_filter($_GET['idmapel']);  
	$hasil = $koneksi_db->sql_query("DELETE FROM `ujiannilai` WHERE `mapel`='$idmapel' and `user` ='$user'");    
	if($hasil){    
		$admin.='<div class="sukses">Semua Nilai History berhasil dihapus! .</div>';    
		$style_include[] ='<meta http-equiv="refresh" content="1; url=admin.php?pilih=ujian&mod=yes&aksi=nilaiujian" />';    
	}else{
		$admin.='<div class="error">Nilai History gagal dihapus! .</div>';		
	}
}

/************************/
if($_GET['aksi'] == 'setting'){
$admin .='<div class="panel-heading"><b>Setting Ujian</b></div>';

if(isset($_POST['submit'])){
$petunjuk     		= addslashes($_POST['petunjuk']);
$waktu     		= $_POST['waktu'];
$error 	= '';
if ($error){
$admin .= '<div class="error">'.$error.'</div>';
}else{
$hasil  = mysql_query( "update `ujiansetting` set petunjuk = '$petunjuk',waktu = '$waktu'" );
if($hasil){
$admin .= "<div class='sukses'><b>Berhasil di Update.</b></div>";
header("location:?pilih=ujian&mod=yes&aksi=setting");

}else{
$admin .= '<div class="error"><b> Gagal di Update.</b></div>';
header("location:?pilih=ujian&mod=yes&aksi=setting");
}
}

}
/*************************************************/
$hasil =  $koneksi_db->sql_query( "SELECT * FROM ujiansetting limit 1" );
$data = $koneksi_db->sql_fetchrow($hasil);
$petunjuk=$data['petunjuk'];
$waktu=$data['waktu'];

$admin .= '
<form method="post" action="" class="form-inline" id="posts">
<table class="table table-striped table-hover">';
$admin.="
	<tr>
		<td>Petunjuk</td>
		<td></td>
		<td><textarea name='petunjuk' id='textareal1'>$petunjuk</textarea></td>
	</tr>";
$admin.='<tr>
		<td>Waktu (dalam detik)</td>
		<td>:</td>
		<td><input type="text" name="waktu" value="'.$waktu.'" size="30" class="form-control"></td></tr>';
$admin.='<tr>
		<td></td>
		<td></td>
		<td><input type="submit" value="Simpan" name="submit"class="btn btn-success" ></td></tr>';

		$admin.='
</table>
</form>';	
}


$admin .='</div>';
}
echo $admin;

?>