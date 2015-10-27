<?php
//include"admin/admin_situs.php";
if (!defined('AURACMS_CONTENT')) {
	Header("Location: ../index.php");
	exit;
}
$script_include[] = '
<script type="text/javascript">
$(document).ready(function(){
$(".bxslider").bxSlider({
  auto: true,
  autoControls: false
});
});
</script>';
global $koneksi_db;
$hasil =  $koneksi_db->sql_query( "SELECT * FROM pengumuman_sekolah order by tgl desc limit 1 " );
$data = $koneksi_db->sql_fetchrow($hasil);
$judul=$data['judul'];
$konten =$data['konten'];
$tgl =datetimes($data['tgl']);
$admin .='<div class="bordermenu">Dashboard</div>';
if (isset( $_SESSION['LevelAkses'] )){
$username = $_SESSION['UserName'];
$query =  $koneksi_db->sql_query( "SELECT * FROM useraura where user = '$username'" );
$data = $koneksi_db->sql_fetchrow( $query );
$last_ping = datetimes($data['last_ping'],false);
if ($_SESSION['LevelAkses']=="Administrator"){
$admin .='<div class="border">';
$admin .='-&nbsp;Last Login : '.$last_ping.'';
$admin .='</div>';
}

if ($_SESSION['LevelAkses']=="Siswa"){
$user =  $_SESSION['UserName'];
$kelasaktif =  getkelasid($user);
$namakelas = getkelas($kelasaktif);
$admin .='<div class="panel panel-info">';
$admin .='<div class="panel-heading"><b>Pengumuman Sekolah</b></div>';
$admin .='
  <ul class="bxslider">
    ';
	$hasil2 =  $koneksi_db->sql_query( "SELECT * FROM pengumuman_sekolah order by tgl desc limit 5 " );
while ($data2 = $koneksi_db->sql_fetchrow($hasil2)) {
$judul2=$data2['judul'];
$konten2 =$data2['konten'];
$tgl =datetimes($data2['tgl']);
$admin .="<li><div class='slideshow'><h3>$judul2</h3>
	<table><tr><td align='right'><span class='label label-warning'>$tgl</span></td></tr>
	<tr><td>
        <p>$konten2</p>
	</td></tr></table>
      </div>
    </li>";
}	
$admin .='</ul>';
$admin .='<div class="panel-heading"><b>Data profil</b></div>';
$getnamasiswa = getnamasiswa($user);
$admin .="<table class='table'>";
$admin .="<tr><td>Nama</td><td>:</td><td>$getnamasiswa</td></tr>";
$admin .="<tr><td>Kelas</td><td>:</td><td>$namakelas</td></tr>";
$admin .="</table>";
$admin .='</div>';
}

if ($_SESSION['LevelAkses']=="Guru"){
$admin .='<div class="panel panel-info">';
$admin .='<div class="panel-heading"><b>Pengumuman Sekolah</b></div>';
$admin .='
  <ul class="bxslider">
    ';
	$hasil2 =  $koneksi_db->sql_query( "SELECT * FROM pengumuman_sekolah order by tgl desc limit 5 " );
while ($data2 = $koneksi_db->sql_fetchrow($hasil2)) {
$judul2=$data2['judul'];
$konten2 =$data2['konten'];
$tgl =datetimes($data2['tgl']);
$admin .="<li><div class='slideshow'><h3>$judul2</h3>
	<table><tr><td align='right'><span class='label label-warning'>$tgl</span></td></tr>
	<tr><td>
        <p>$konten2</p>
	</td></tr></table>
      </div>
    </li>";
}	
$admin .='</ul>';
$admin .='</div>';
}

}
echo $admin;
?>