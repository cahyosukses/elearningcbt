<?php
include "includes/config.php";
include "includes/mysql.php";
$idujian     		= $_POST['idujian'];
$kelasid     		= $_POST['kelasid'];
$kelas = getkelas($kelasid);
$namaujian = getnamaujian($idujian);
$namaguru = getnamaguruujian($idujian);
header("Content-Type: application/force-download"); 
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 2010 05:00:00 GMT"); 
header("content-disposition: attachment;filename=elearning_nilaiujian_".$kelas.".xls");
echo "<table>
<tr><td colspan='2'></td>
<td><b>LAPORAN NILAI SISWA</b></td>
</tr>";
echo "    <tr>
    <td colspan='2'></td>
    <td></td>
  </tr>"; 
echo "    <tr>
    <td colspan='2'>Kelas </td>
    <td>$kelas</td>
  </tr>"; 
echo "    <tr>
    <td colspan='2'>Nama Ujian </td>
    <td>$namaujian</td>
  </tr>"; 
echo "    <tr>
    <td colspan='2'>Nama Guru </td>
    <td>$namaguru</td>
  </tr>";
echo "    <tr>
    <td colspan='2'></td>
    <td></td>
  </tr></table>"; 
echo "<table border='1'>
<tr bgcolor='#ECECEC'>
    <th>No.</th>
    <th>No.Induk</th>
    <th>Nama</th>
    <th>Nilai</th>
  </tr>"; 
/************************************/
$no='1';
$hasil = $koneksi_db->sql_query( "SELECT * FROM `kelas_isi`where kelas ='$kelasid'" );
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$namasiswa = getnamasiswa($data['siswa']);
$nilaiujian = getnilaiujian ($idujian,$data['siswa']);
echo '
  <tr>
     <td>'.$no.'</td>
    <td>'.$data['siswa'].'</td>
    <td>'.$namasiswa.'</td>
    <td>'.$nilaiujian.'</td>
   </tr>';
   $no++;
}
echo "</table>";
?>