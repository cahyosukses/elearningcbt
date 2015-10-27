<?php

if (!defined('AURACMS_CONTENT')) {
	Header("Location: ../index.php");
	exit;
}

if(ereg(basename (__FILE__), $_SERVER['PHP_SELF']))
{
	header("HTTP/1.1 404 Not Found");
	exit;
}
/////////////////////////////
global $koneksi_db,$style_include,$script_include,$url_situs;
$style_include[] = '<style type="text/css">
@import url("'.$url_situs.'/mod/katalog/highslide/highslide.css");
</style>';
$script_include[] = '
<script type="text/javascript" src="'.$url_situs.'/mod/news/highslide/highslide.js"></script>
<script type="text/javascript">
	hs.graphicsDir = "'.$url_situs.'/mod/news/highslide/graphics/";
	hs.wrapperClassName = "wide-border";
</script>';
/////////////////////////////
global $koneksi_db,$maxdata;
$tengah ='<h4 class="bg">Hasil Pencarian</h4>';
$query = cleartext($_GET['query']);
if($query=='' or !isset($query)){
	$tengah .="<div class=\"error\">Tidak Ada Pencarian</div>";
}else{

	$limit = 10;
	$s1 = '';
	$query = htmlentities($query);
	
	
	$hasil= $koneksi_db->sql_query("SELECT * FROM artikel WHERE ((judul LIKE '%$query%' OR konten LIKE '%$query%' OR user LIKE '%$query%')AND publikasi=1)");
	$jumlah= $koneksi_db->sql_numrows($hasil);

	if ($jumlah<1){
		$s1="tidak ada";
	}

	$a = new paging ($limit);

if (!$s1) {

	$tengah .='<div class="border">';
	$tengah .="Yang dicari <b>\"$query\"</b>";
	$tengah .='</div>';
	
	
	$offset = int_filter(@$_GET['offset']);
	$pg		= int_filter(@$_GET['pg']);
	$stg	= int_filter(@$_GET['stg']);
	
	$hasil2= $koneksi_db->sql_query("SELECT * FROM artikel WHERE ((judul LIKE '%$query%' OR konten LIKE '%$query%' OR user LIKE '%$query%')AND publikasi=1) ORDER By id LIMIT $offset,$limit");

	


	$tengah .='<div class="border">';
	$tengah .= "Ditemukan <b>".$jumlah."</b> artikel mengandung kata: <b>$query</b>";
	$tengah .='</div>';
	
	$tengah .='<div class="border">';
	while($data = $koneksi_db->sql_fetchrow($hasil2)){
$warna = empty ($warna) ? 'bgcolor="#efefef"' : '';
$data['tgl']= datetimes($data['tgl']);
$gambar = ($data[8] == '') ? 
'<img style="margin-right:5px; margin-top:5px; padding:1px; background:#f2f2f2; border:1px solid #cccccc; float:left;max-height:150px;max-width:150px;" src="mod/news/images/normal/news-default.jpg">' : 
'<a href="'.$url_situs.'/mod/news/images/normal/'.$data[8].'" onclick="return hs.expand(this)">
<img style="margin-right:5px; margin-top:5px; padding:1px; background:#f2f2f2; border:1px solid #cccccc; float:left;max-height:150px;max-width:150px;" src="mod/news/images/normal/'.$data[8].'" alt="'.$data['judul'].'"/></a>';

$ikon_readmore = '<a href="article-'.AuraCMSSEO($data['seftitle']).'.html" title="'.$data['judul'].'" class="readmore"><img src=images/readmore.jpg border=0></a>';
$tengah .='<table class="border" width="100%"><tr><td><a href="article-'.AuraCMSSEO($data[1]).'.html" title="'.$data[1].'" class="readmore"><h4>'.$data[1].'</h4></a>'.$gambar.'
<span class="date">'.$data['tgl'].'</span><br>
'.limitTXT(strip_tags($data[2]),300).'<br>'.$ikon_readmore.'</td></tr></table>';
$no++;
}
if($jumlah>$limit){

if (empty($_GET['offset']) and !isset ($_GET['offset'])) {
	$offset = 0;
}
if (empty($_GET['pg']) and !isset ($_GET['pg'])) {
	$pg = 1;
}
if (empty($_GET['stg']) and !isset ($_GET['stg'])) {
	$stg = 1;
}

$tengah .='<div class="border"><center>';
$tengah .= $ada-> getPaging($jumlah, $pg, $stg);
$tengah .='</center></div>';
}
} //akhir if $s1


if ($s1) {
		$tengah.='<div class="error">Pencarian dengan kata kunci : <b>'.$query.'</b> <br />tidak ditemukan</div>';

}

}

echo $tengah;

?>