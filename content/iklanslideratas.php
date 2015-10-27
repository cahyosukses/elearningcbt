<?php
global $koneksi_db;
//Slider
$no=1;
$hasil = $koneksi_db->sql_query( "SELECT * FROM `akrindo_iklanslideratas` ORDER BY `id` ASC" );

while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$gambar=$data['gambar'];
$url=$data['url'];
if(!$url){
echo '
<div class="gallerycontent">
<a href="pages-menjadi-sponsor.html"><img src="mod/iklanslideratas/images/normal/'.$gambar.'"></a>
</div>
';
}else{
echo '
<div class="gallerycontent">
<a href="http://'.$url.'"target="new"><img src="mod/iklanslideratas/images/normal/'.$gambar.'"></a>
</div>
';
}
}

?>