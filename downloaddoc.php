<?php
define('AURACMS_MODULE', true);
define('AURACMS_CONTENT', true);
include "includes/config.php";
include "includes/mysql.php";
include "includes/configsitus.php";
?>
<?php
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
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=$judul.doc");

$admin .= '
<table>
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
		<td>';
$admin .= '</td>
	</tr>
	'.$petunjukumum.'
</table><hr>';
$tipejawaban = getjumlahjawaban($idujian);
$jawaban = explode(",", $tipejawaban);
$jml_jawaban = count($jawaban);
$hasil = mysql_query("SELECT * FROM soal where ujian='$idujian'order by id asc");
$admin .= '
<table>
<thead ><tr class="info">
<th width="10px">No</th>
<th>Soal</th>
</tr></thead><tbody>';
$nosoal=1;
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$idsoal=$data['id'];
$soal=$data['soal'];
$kunci=$data['kunci'];
$pilihansoal = explode("#", $data["pilihan"]);
$jml_pil = count($pilihansoal);
$filesgambar=$data['files'];
if($filesgambar){
$gambar = "<img src='$url_situs/mod/ujian/download/$filesgambar'><br>";
}else{
$gambar = '';
}
$admin .='<tr>
<td valign="top"><b>'.$nosoal.'</b></td>
<td>'.$gambar.''.$soal.'<br>';
for ($i = 0; $i < $jml_jawaban; $i++) {
$admin .="
$jawaban[$i]. $pilihansoal[$i]<br>";
}
$admin.='
</tr>';
$nosoal++;

}
$admin .= '</tbody></table>';
echo $admin;

?>