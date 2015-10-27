<?php
global $koneksi_db;
//Slider
$no=1;
$hasil = $koneksi_db->sql_query( "SELECT * FROM `header` ORDER BY `id` ASC" );
$tengah .= '<div class="border"><div align="left">
<div id="slider1" class="sliderwrapper">';
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$header=$data['header'];
$tengah .= '
<div style="display: none; z-index: 13; opacity: 1.1; visibility: visible;" class="contentdiv">
<a href="#"><img src="mod/header/images/'.$header.'" width="580" border="0" height="150"></a></div>';
}
$tengah .= '
</div>
</div>
<div align="left">
<div id="paginate-slider1" class="pagination">
<a href="#prev" class="prev">Previous</a>';
$hasil = $koneksi_db->sql_query( "SELECT * FROM `header` ORDER BY `id` ASC" );
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$tengah .= '
<a rel="'.$no.'" href="#'.$no.'" class="toc">'.$no.'</a>';
$no++;
}
$tengah .= ' 
<a href="#next" class="next">Next</a></div>
</div></div>';
?>
