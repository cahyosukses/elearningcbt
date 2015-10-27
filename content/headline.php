<?php
if(preg_match('/'.basename(__FILE__).'/',$_SERVER['PHP_SELF']))
{
	header("HTTP/1.1 404 Not Found");
	exit;
}

echo '<div id="featured" ><ul class="ui-tabs-nav">';
// featured 01 ==============================================================================
echo '<li class="ui-tabs-nav-item ui-tabs-selected" id="nav-fragment-1">';
global $koneksi_db,$maxdata, $maxkonten;

$hasil = $koneksi_db->sql_query( "SELECT * FROM `artikel` where publikasi='1'  ORDER BY `id` DESC LIMIT 0,1" );

while ($data = $koneksi_db->sql_fetchrow($hasil)) {

$datatt['tgl']= datetimes($data['tgl']);
$gambar = ($data['gambar'] == '') ? '<img src="mod/news/images/normal/news-default.jpg"width="80"height="50" alt="'.$data[1].'"/>' : '<img src="mod/news/images/normal/'.$data['gambar'].'"width="80"height="50" alt="'.$data[1].'"/>';
echo '<a href="#fragment-1">'.$gambar.'<span>'.limitTXT(strip_tags($data[1]),50).'</span></a></li>';
}

// featured 02 ==============================================================================
echo '<li class="ui-tabs-nav-item" id="nav-fragment-2">';
global $koneksi_db,$maxdata, $maxkonten;

$hasil = $koneksi_db->sql_query( "SELECT * FROM `artikel` where publikasi='1' ORDER BY `id` DESC LIMIT 1,1" );

while ($data = $koneksi_db->sql_fetchrow($hasil)) {

$datatt['tgl']= datetimes($data['tgl']);
$gambar = ($data['gambar'] == '') ? '<img src="mod/news/images/normal/news-default.jpg"width="80"height="50" alt="'.$data[1].'"/>' : '<img src="mod/news/images/normal/'.$data['gambar'].'"width="80"height="50" alt="'.$data[1].'"/>';
echo '<a href="#fragment-2">'.$gambar.'<span>'.limitTXT(strip_tags($data[1]),50).'</span></a></li>';
}

// featured 03 ==============================================================================
echo '<li class="ui-tabs-nav-item" id="nav-fragment-3">';
global $koneksi_db,$maxdata, $maxkonten;

$hasil = $koneksi_db->sql_query( "SELECT * FROM `artikel` where  publikasi='1' ORDER BY `id` DESC LIMIT 2,1" );

while ($data = $koneksi_db->sql_fetchrow($hasil)) {

$datatt['tgl']= datetimes($data['tgl']);
$gambar = ($data['gambar'] == '') ? '<img src="mod/news/images/normal/news-default.jpg"width="80"height="50" alt="'.$data[1].'"/>' : '<img src="mod/news/images/normal/'.$data['gambar'].'"width="80"height="50" alt="'.$data[1].'"/>';
echo '<a href="#fragment-3">'.$gambar.'<span>'.limitTXT(strip_tags($data[1]),50).'</span></a></li>';
}

// featured 04 ==============================================================================
echo '<li class="ui-tabs-nav-item" id="nav-fragment-4">';
global $koneksi_db,$maxdata, $maxkonten;

$hasil = $koneksi_db->sql_query( "SELECT * FROM `artikel` where publikasi='1' ORDER BY `id` DESC LIMIT 3,1" );

while ($data = $koneksi_db->sql_fetchrow($hasil)) {

$datatt['tgl']= datetimes($data['tgl']);
$gambar = ($data['gambar'] == '') ? '<img src="mod/news/images/normal/news-default.jpg"alt="'.$data[1].'"/>' : '<img src="mod/news/images/normal/'.$data['gambar'].'"width="80"height="50" alt="'.$data[1].'"/>';
echo '<a href="#fragment-4">'.$gambar.'<span>'.limitTXT(strip_tags($data[1]),50).'</span></a></li>';
}

echo '</ul>';

// Berita 01 ====================================================================================
echo '<div id="fragment-1" class="ui-tabs-panel">';
global $koneksi_db,$maxdata, $maxkonten;

$hasil = $koneksi_db->sql_query( "SELECT * FROM `artikel`where publikasi='1' ORDER BY `id` DESC LIMIT 0,1" );

while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$hasil_topik = $koneksi_db->sql_query( "SELECT * FROM `topik` WHERE id='$data[topik]'");
$data_topik = $koneksi_db->sql_fetchrow($hasil_topik);

$datatt['tgl']= datetimes($data['tgl']);
$gambar = ($data['gambar'] == '') ? '<img src="mod/news/images/normal/news-default.jpg" alt="'.$data[1].'"/>' : '<img src="mod/news/images/normal/'.$data['gambar'].'" alt="'.$data[1].'"/>';

echo ''.$gambar.'
<div class="info" >
<div class="headjud"><a href="article-'.AuraCMSSEO($data[1]).'.html">'.$data['1'].'</a></div>

<p class="headket">'.limitTXT(strip_tags($data[2]),110).'</p>
</div>
</div>';
}
// End Berita 01 ====================================================================================

// Berita 02 ====================================================================================
echo '<div id="fragment-2" class="ui-tabs-panel ui-tabs-hide">';
global $koneksi_db,$maxdata, $maxkonten;

$hasil = $koneksi_db->sql_query( "SELECT * FROM `artikel` where publikasi='1' ORDER BY `id` DESC LIMIT 1,1" );

while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$hasil_topik = $koneksi_db->sql_query( "SELECT * FROM `topik` WHERE id='$data[topik]'");
$data_topik = $koneksi_db->sql_fetchrow($hasil_topik);

$datatt['tgl']= datetimes($data['tgl']);
$gambar = ($data['gambar'] == '') ? '<img src="mod/news/images/normal/news-default.jpg" alt="'.$data[1].'"/>' : '<img src="mod/news/images/normal/'.$data['gambar'].'" alt="'.$data[1].'"/>';

echo ''.$gambar.'
<div class="info" >
<div class="headjud"><a href="article-'.AuraCMSSEO($data[1]).'.html">'.$data['1'].'</a></div>
<p class="headket">'.limitTXT(strip_tags($data[2]),110).'</p>
</div>
</div>';
}
// End Berita 02 ====================================================================================

// Berita 03 ====================================================================================
echo '<div id="fragment-3" class="ui-tabs-panel ui-tabs-hide">';
global $koneksi_db,$maxdata, $maxkonten;

$hasil = $koneksi_db->sql_query( "SELECT * FROM `artikel` where publikasi='1' ORDER BY `id` DESC LIMIT 2,1" );

while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$hasil_topik = $koneksi_db->sql_query( "SELECT * FROM `topik` WHERE id='$data[topik]'");
$data_topik = $koneksi_db->sql_fetchrow($hasil_topik);

$datatt['tgl']= datetimes($data['tgl']);
$gambar = ($data['gambar'] == '') ? '<img src="mod/news/images/normal/news-default.jpg" alt="'.$data[1].'"/>' : '<img src="mod/news/images/normal/'.$data['gambar'].'" alt="'.$data[1].'"/>';

echo ''.$gambar.'
<div class="info" >
<div class="headjud"><a href="article-'.AuraCMSSEO($data[1]).'.html">'.$data['1'].'</a></div>

<p class="headket">'.limitTXT(strip_tags($data[2]),110).'</p>
</div>
</div>';
}
// End Berita 03 ====================================================================================

// Berita 04 ====================================================================================

echo '<div id="fragment-4" class="ui-tabs-panel ui-tabs-hide">';
global $koneksi_db,$maxdata, $maxkonten;

$hasil = $koneksi_db->sql_query( "SELECT * FROM `artikel` where publikasi='1' ORDER BY `id` DESC LIMIT 3,1" );

while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$hasil_topik = $koneksi_db->sql_query( "SELECT * FROM `topik` WHERE id='$data[topik]'");
$data_topik = $koneksi_db->sql_fetchrow($hasil_topik);

$datatt['tgl']= datetimes($data['tgl']);
$gambar = ($data['gambar'] == '') ? '<img src="mod/news/images/normal/news-default.jpg" alt="'.$data[1].'"/>' : '<img src="mod/news/images/normal/'.$data['gambar'].'" alt="'.$data[1].'"/>';

echo ''.$gambar.'
<div class="info" >
<div class="headjud"><a href="article-'.AuraCMSSEO($data[1]).'.html">'.$data['1'].'</a></div>

<p class="headket">'.limitTXT(strip_tags($data[2]),110).'
</div>
</div>';
}

echo '</div>';
// End Berita 04 ====================================================================================

?>