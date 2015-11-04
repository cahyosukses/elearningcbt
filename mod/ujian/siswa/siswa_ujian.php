<?php
if (!defined('AURACMS_admin')) {
	Header("Location: ../index.php");
	exit;
}

//$index_hal = 1;
if (!cek_login ()){   
	
$admin .='<p class="judul">Access Denied !!!!!!</p>';
}else{

$style_include[] = '<link rel="stylesheet" media="screen" href="mod/calendar/css/dynCalendar.css" />';

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
    $('#example').dataTable();
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
}

$script_include[] = $JS_SCRIPT;

    $temp 	= 'mod/ujian/download/';
	$admin .= '<div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-list-alt"></i> Ujian</h3>
					<ol class="breadcrumb">
					<li><i class="fa fa-home"></i><a href="?pilih=ujian&mod=yes">Home</a></li>
					<li><i class="fa fa-home"></i><a href="admin.php?pilih=ujian&mod=yes&aksi=nilaiujian">Lihat Nilai</a></li>
					</ol>
				</div>
			</div>';
			
$admin .='<div class="panel panel-info">';
$user =  $_SESSION['UserName'];
$levelakses=$_SESSION['LevelAkses'];
$petunjuk=getpetunjuk();
$waktu=getwaktu();
if($_GET['aksi']==""){
$hasil = $koneksi_db->sql_query( "SELECT * FROM mapel  order by mapel asc" );
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

$admin .='<tr>
<td><b>'.$no.'</b></td>
<td>'.$data['mapel'].'</td>
<td>';
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

if (in_array($_GET['aksi'],array('listujian'))) {

$id     = int_filter($_GET['id']);
$admin .='<div class="panel-heading"><b>Mata Pelajaran</b></div>';
$hasil =  $koneksi_db->sql_query( "SELECT * FROM mapel where id='$id' " );
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
	</tr>';


/************************************/
$hasil = $koneksi_db->sql_query( "SELECT * FROM ujian where  idmapel='$idmapel' ORDER BY RAND()" );
$data = $koneksi_db->sql_fetchrow($hasil);
$idujian=$data['id'];
$tgl=$data['tgl'];
$judul=$data['judul'];
$jumlahsoal=$data['jumlahsoal'];
$tipe=$data['tipe'];
$status=$data['status'];
$tipeujian=$data['tipeujian'];
$test = '<a href="?pilih=ujian&amp;mod=yes&amp;aksi=testujian&amp;idujian='.$idujian.'&amp;id='.$idmapel.'"><span class="btn btn-success">Mulai</span></a>';
$kembali ="<a href='?pilih=ujian&mod=yes'><span class='btn btn-primary'>KEMBALI</span></a>";
$admin .= '<tr>
		<td></td>
		<td></td>
		<td>'.$test.'</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>';
$admin.='</table>';
/*
$hasil = $koneksi_db->sql_query( "SELECT * FROM ujian where  idmapel='$idmapel' order by tgl desc" );
$admin .='<div class="panel-heading"><b>Daftar Ujian</b></div>';
$admin .= '<table id="example" class="table table-striped table-hover">
<thead><tr>
<th>Tgl</th>
<th width="300px">Judul</th>
<th>Soal/Jml</th>
<th>Tipe/Status</th>
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
$admin .='<tr>
<td><b>'.tglsort($tgl).'</b></td>
<td>'.$judul.'</td>
<td>'.getjumlahsoal($idujian).' / '.$jumlahsoal.'</td>
<td>'.$tipe.'/'.$status.'</td>
';
if(getjumlahsoal($idujian)==$jumlahsoal){
$test = '<a href="?pilih=ujian&amp;mod=yes&amp;aksi=testujian&amp;idujian='.$data['id'].'&amp;id='.$idmapel.'"><span class="btn btn-primary">Test</span></a>';
//$test = '<a href="?pilih=ujiantest&amp;mod=yes&amp;idujian='.$data['id'].'&amp;id='.$idkursus.'"><span class="btn btn-primary">Test</span></a>';
}else{
$test = '';
}
$admin .='
<td>'.$test.'</td>
</tr>';
$no++;
}
$admin .= '</tbody></table>';
$admin.="<table class='table'><tr><td><a href='?pilih=ujian&mod=yes'><span class='btn btn-primary'>BACK</span></a></td></tr></table>";
/************************************/
}


if ($_GET['aksi']== 'testujian') {
$idmapel     = int_filter($_GET['id']);
$idujian     = int_filter($_GET['idujian']);

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
		<td>'.getnilaiujian($idmapel,$user).'</td>
		<td>Waktu</td>
		<td>:</td>
		<td>'.konversi_detik($waktu).'</td>';
//$admin .= '<a href="./downloaddoc.php?idujian='.$idujian.'&amp;id='.$idmapel.'"><span class="btn btn-primary">Download DOC</span></a>';
$admin .= '	'.$petunjukumum.''.$timercountdown.'
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
<form method="post"action="?pilih=ujian&mod=yes&aksi=hasiltest&id='.$idmapel.'">
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
<input type='hidden' name='idmapel' value='$idmapel' />";
$admin .="
<input type='hidden' name='kuncijawaban' value='$kuncijawaban' />";
$admin .="
<input type='hidden' name='idujian' value='$idujian' />";
$admin .="
<input type='hidden' name='tipeujian' value='$tipeujian' />";
//$admin .="<a href='?pilih=ujian&mod=yes&aksi=listujian&id=$idmapel'><span class='btn btn-primary'>BACK</span></a>&nbsp;";
$admin .='<input type="submit"class="btn btn-success" value="Selesai" name="submit" onclick="return confirm(\'Apakah Anda Yakin Ingin Mengakhiri Ujian Ini ?\')">';
$admin.="</div>";
$admin.="<br></form>";

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

/* NILAI UJIAN */
if($_GET['aksi']=="nilaiujian"){
$admin .='<div class="panel-heading"><b>Nilai Ujian</b></div>';
$admin .= '
<form method="post" action=""class="form-inline">
<table cellspacing="0" cellpadding="0"class="table table-striped table-hover">
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
		<td></td>
		<td></td>
		<td><input type="submit" value="Lihat History Nilai" name="lihathistorynilai"class="btn btn-primary"></td>
	</tr>
</table>
</form>
';
if(isset($_POST['lihathistorynilai'])){
$idmapel     		= $_POST['idmapel'];
$namamapel = getmapel($idmapel);
$admin .="<table class='table table-striped table-hover'>";
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
<th>Nama</th>
<th>Nilai</th>
</tr></thead><tbody>';
$no = 1;
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$tgl     = $data['tgl'];  
$nilai     = $data['nilai'];  
$nama     = getnamaguru($data['user']);  
$admin .='<tr>
<td><b>'.$no.'</b></td>
<td>'.datetimes($data['tgl']).'</td>
<td>'.$nama.'</td>
<td>'.$data['nilai'].'</td>';
$admin .='
</tr>';
$no++;
}
$admin .= '</tbody></table>';
}


}

$admin .='</div>';
}
echo $admin;

?>