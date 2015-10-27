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
$admin .= '
<script language="javascript" type="text/javascript" src="mod/calendar/js/browserSniffer.js"></script>
<script language="javascript" type="text/javascript" src="mod/calendar/js/dynCalendar.js"></script>';
$tanggal = <<<eof
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
        document.forms['posts'].tgl.value = year + '-' + month + '-' + date;
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
		toolbar2: "| cut copy paste pastetext | searchreplace | outdent indent blockquote | undo redo | link unlink anchor image media code jbimages | forecolor backcolor",
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
$admin .='<div class="bordermenu">Administrasi Ujian</div>';
$admin .='<div class="panel panel-info">';
$user =  $_SESSION['UserName'];
$kelasaktif =  getkelasid($user);
$levelakses=$_SESSION['LevelAkses'];
if($_GET['aksi']==""){
$hasil = $koneksi_db->sql_query( "SELECT * FROM kursus_setting WHERE LOCATE(CONCAT(',', $kelasaktif ,','),CONCAT(',',kelas,',')) order by guru asc" );
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
$admin .='<tr>
<td><b>'.$no.'</b></td>
<td>'.getnamaguru($data['guru']).'</td>
<td>'.getmapel($data['mapel']).'</td>
<td>'.$data['tahun'].'</td>
<td>'.$data['judul'].'</td>
<td>&nbsp;';
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

if (in_array($_GET['aksi'],array('listujian'))) {

$id     = int_filter($_GET['id']);
$admin .='<div class="panel-heading"><b>Daftar Kursus</b></div>';
$hasil =  $koneksi_db->sql_query( "SELECT * FROM kursus_setting where id='$id' " );
$data = $koneksi_db->sql_fetchrow($hasil);
$idkursus=$data['id'];
$guru=$data['guru'];
$mapel =$data['mapel'];
$tahun =$data['tahun'];
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
		<td>Kelas</td>
		<td>:</td>
		<td>'.getkelas($kelasaktif).'</td>
	</tr>
	<tr>
		<td>Email</td>
		<td>:</td>
		<td>'.$email.'</td>
		<td>Telepon</td>
		<td>:</td>
		<td>'.$telp.'</td>
	</tr>
</table>';

/************************************/
$hasil = $koneksi_db->sql_query( "SELECT * FROM ujian  where idkursus='$idkursus'  order by id desc" );
$admin .='<div class="panel-heading"><b>Daftar Ujian</b></div>';
$admin .= '<table id="example" class="table table-striped table-hover">
<thead><tr>
<th>Tgl</th>
<th>Judul</th>
<th>Soal/Jml</th>
<th>Tipe</th>
<th>Ujian</th>
<th width="100px">Aksi</th>
</tr></thead><tbody>';
$no = 1;
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$idujian=$data['id'];
$idkursus=$data['idkursus'];
$tgl=$data['tgl'];
$judul=$data['judul'];
$jumlahsoal=$data['jumlahsoal'];
$tipe=$data['tipe'];
$status=$data['status'];
$tipeujian=$data['tipeujian'];
$idkelas = $data['kelas'];
$kelas = lihatkelas($idkelas);
$kelas = substr_replace($kelas, "", -1, 1);
$admin .='<tr>
<td><b>'.tglsort($tgl).'</b></td>
<td>'.$judul.'</td>
<td>'.getjumlahsoal($idujian).' / '.$jumlahsoal.'</td>
<td>'.$tipe.'</td>
<td>'.$tipeujian.'</td>
';
if(getjumlahsoal($idujian)==$jumlahsoal){
$test = '<a href="?pilih=ujian&amp;mod=yes&amp;aksi=testujian&amp;idujian='.$data['id'].'&amp;id='.$data['idkursus'].'"><span class="btn btn-primary">Test Ujian</span></a>';
}else{
$test = '';
}
$admin .='
<td>&nbsp;'.$test.'</td>
</tr>';
$no++;
}
$admin .= '</tbody></table>';
$admin.="<table class='table'><tr><td><a href='?pilih=ujian&mod=yes'><span class='btn btn-primary'>BACK</span></a></td></tr></table>";
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
$admin.="<tr><td><a href='?pilih=ujian&mod=yes&aksi=listujian&id=$idkursus'>
<span class='btn btn-primary'>BACK</span></a></td></tr></table>";
}

$admin .='</div>';
}
echo $admin;
?>