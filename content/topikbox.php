<?php
if(ereg(basename (__FILE__), $_SERVER['PHP_SELF']))
{
	header("HTTP/1.1 404 Not Found");
	exit;
}

global $koneksi_db;

$title = "Rubrik";

$perintah = "SELECT * FROM topik where parentid=0 ORDER BY id";
$hasil = $koneksi_db->sql_query( $perintah );

$topikbox = "<ul>";
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$judul = AuraCMSSEO($data['topik']);
//$seftitle = $data['seftitle'];
$id      = $data['id'];
$total =  $koneksi_db->sql_query( "SELECT * FROM artikel where publikasi=1 and topik ='$id'" );
$jumlah = $koneksi_db->sql_numrows( $total );

//$topikbox.= '<li><a href="index.php?pilih=news&mod=yes&aksi=arsip&judul='.$judul.'">'.$data['topik'].'</a></li>';
		$topikbox.= '<li><a href="category-'.$judul.'.html" title="'.$data['topik'].'">'.$data['topik'].'('.$jumlah.')</a></li>';

	}
$topikbox.= "</ul>";

kotakjudul ($title, $topikbox);

?>