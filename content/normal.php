<?php
if(ereg(basename (__FILE__), $_SERVER['PHP_SELF']))
{
	header("HTTP/1.1 404 Not Found");
	exit;
}
global $koneksi_db,$maxdata,$maxkonten,$maxgalleri,$maxadmindata;
//Slider
$tengah .= '<div class="border"><div align="left"><div id="slider1" class="sliderwrapper">
<div style="display: none; z-index: 13; opacity: 1.1; visibility: visible;" class="contentdiv">
<a href="#"><img src="header/slide01.jpg" width="580" border="0" height="150"></a></div>
<div style="display: none; z-index: 14; opacity: 1.1; visibility: visible;" class="contentdiv">
  <a href="#"><img src="header/slide02.jpg" width="580" border="0" height="150"></a></div>
<div style="display: none; z-index: 15; opacity: 1.1; visibility: visible;" class="contentdiv">
  <a href="#"><img src="header/slide03.jpg" width="580" border="0" height="150"></a></div>
<div style="display: block; z-index: 16; opacity: 1.1; visibility: visible;" class="contentdiv">
  <a href="#"><img src="header/slide04.jpg" width="580" border="0" height="150"></a></div>
</div>
</div>
<div align="left">
<div id="paginate-slider1" class="pagination"><a href="#prev" class="prev">Previous</a> <a rel="1" href="#1" class="toc">1</a> <a rel="2" href="#2" class="toc">2</a> <a rel="3" href="#3" class="toc">3</a> <a rel="4" href="#4" class="toc selected">4</a> <a href="#next" class="next">Next</a></div>
</div></div>
';
//////////////////////////////////////////////////////////////////////////////
$tengah .= '<img src="images/tw.jpg" width="595">';
global $koneksi_db,$maxdata, $maxkonten;
$tengah .= '<table width = "100%"><tr>';
$hasil = $koneksi_db->sql_query( "SELECT * FROM `artikel` WHERE topik= $frontnews1 ORDER BY `id` DESC LIMIT 1" );
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$judulhal = $data['judul'];
$isihal = $data['konten'];
$isihal2 = limitTXT(strip_tags($isihal),120);
$user = $data['user'];
$tgl=  datetimes($data[5]);
$gambar = $data['gambar'];
if(!$gambar){
$gambar="news-default.jpg";
}
/*
$gambarthumb ='<img src="mod/news/images/normal/'.$gambar.'" alt="" style="margin-right: 10px; margin-top: 5px; padding: 3px; border: 1px solid rgb(204, 204, 204); background: none repeat scroll 0% 0% rgb(255, 255, 255); float: left;" border="0"  height="80">';
*/
$gambarthumb ='<img src="timthumb.php?src=mod/news/images/normal/'.$gambar .'&h=90&w=140&zc=1;&q=50" alt="xxxxxxxx"'>;
$topik = $data['topik'];
$hasilt1 = $koneksi_db->sql_query( "SELECT * FROM `topik` WHERE id= $topik" );
$datat1 = $koneksi_db->sql_fetchrow($hasilt1);
$tengah .= '
<td valign="top" width=50%><h1 class="bg3">'.$datat1[1].'</h1><div class="bordernews">
<h4><a href="article-'.$data[0].'-'.AuraCMSSEO($data[1]).'.html" title="'.$data[1].'">'.$judulhal.'</a></h4>
<div class="date"> '.$data[5].'- by - 720 views</div>
'.$gambarthumb.''.$isihal2.' ...</div>';
//-- box bawah
$tengah .= '
<div class="box">';
$hasil2 = $koneksi_db->sql_query( "SELECT * FROM `artikel` WHERE topik= $frontnews1 ORDER BY `id` DESC LIMIT 1,3" );
while ($data2 = $koneksi_db->sql_fetchrow($hasil2)) {
$judulhal2 = $data2['judul'];
$tengah .='<ul><li><a href="article-'.$data2[0].'-'.AuraCMSSEO($data2[1]).'.html" title="'.$data2[1].'">'.$judulhal2.'</a></a></li></ul>';
}
$tengah.='</div></td>
<td valign="top" width="1%">&nbsp;</td>
';
}
$hasil = $koneksi_db->sql_query( "SELECT * FROM `artikel` WHERE topik= $frontnews2 ORDER BY `id` DESC LIMIT 1" );
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$judulhal = $data['judul'];
$isihal = $data['konten'];
$isihal2 = limitTXT(strip_tags($isihal),120);
$user = $data['user'];
$tgl=  datetimes($data[5]);
$gambar = $data['gambar'];
if(!$gambar){
$gambar="news-default.jpg";
}
$topik = $data['topik'];
$hasilt1 = $koneksi_db->sql_query( "SELECT * FROM `topik` WHERE id= $topik" );
$datat1 = $koneksi_db->sql_fetchrow($hasilt1);
$tengah .= '
<td valign="top" width=50%><h1 class="bg3">'.$datat1[1].'</h1><div class="bordernews">
<h4><a href="article-'.$data[0].'-'.AuraCMSSEO($data[1]).'.html" title="'.$data[1].'">'.$judulhal.'</a></h4>
<div class="date"> '.$data[5].'- by - 720 views</div>
<img src="mod/news/images/normal/'.$gambar.'" alt="" style="margin-right: 10px; margin-top: 5px; padding: 3px; border: 1px solid rgb(204, 204, 204); background: none repeat scroll 0% 0% rgb(255, 255, 255); float: left;" border="0"  height="80">'.$isihal2.' ...</div>';
//-- box bawah
$tengah .= '
<div class="box">';
$hasil2 = $koneksi_db->sql_query( "SELECT * FROM `artikel` WHERE topik= $frontnews2 ORDER BY `id` DESC LIMIT 1,3" );
while ($data2 = $koneksi_db->sql_fetchrow($hasil2)) {
$judulhal2 = $data2['judul'];
$tengah .='<ul><li><a href="article-'.$data2[0].'-'.AuraCMSSEO($data2[1]).'.html" title="'.$data2[1].'">'.$judulhal2.'</a></a></li></ul>';
}
$tengah.='</div></td>
<td valign="top" width="1%">&nbsp;</td>
';
}
$tengah .= '</tr></table>';
//-------------------
$hasil = $koneksi_db->sql_query( "SELECT * FROM `artikel` WHERE topik = $frontnews3 ORDER BY `id` DESC LIMIT 2" );
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$judulhal = $data['judul'];
$isihal = $data['konten'];
$isihal2 = limitTXT(strip_tags($isihal),300);
$user = $data['user'];
$tgl=  datetimes($data[5]);
$gambar = $data['gambar'];
if(!$gambar){
$gambar="news-default.jpg";
}
$topik = $data['topik'];
$hasilt1 = $koneksi_db->sql_query( "SELECT * FROM `topik` WHERE id= $topik" );
$datat1 = $koneksi_db->sql_fetchrow($hasilt1);
$tengah .= '<table><tr><td><h1 class="bg3">'.$datat1[1].'</h1></td></tr>';
$tengah .= '<tr>
<td valign="top" width="100%"><div class="bordernews">
<h4><a href="article-'.$data[0].'-'.AuraCMSSEO($data[1]).'.html" title="'.$data[1].'">'.$judulhal.'</a></h4>
<div class="date"> '.$data[5].'- by - 720 views</div>
<img src="mod/news/images/normal/'.$gambar.'" alt="" style="margin-right: 10px; margin-top: 5px; padding: 3px; border: 1px solid rgb(204, 204, 204); background: none repeat scroll 0% 0% rgb(255, 255, 255); float: left;" border="0"  height="80">'.$isihal2.' ...</div>';
$tengah .= '</tr>';
}
$tengah .= '</tr></table>';
$tengah .= '<img src="images/tw.jpg" width="595">';
//////////////////////////////////////////////////////////////////////////////
// Photo Gallery 
$tengah .= '<h1 class="bg3">Photo Gallery</h1>';
$tengah .='<div class="border-photodepan">';
$tengah .= '<table  width="100%" class="border"><tr>';
$no =0;
$s = mysql_query ("SELECT * FROM `mod_gallery` ORDER BY RAND() DESC LIMIT 0,8");	
while($data = mysql_fetch_array($s)){
$gambar = $data['name'];
$urutan = $no + 1;
$tengah .= '<td valign="top" style="text-align:center;">
<img src="mod/gallery/storedata/normal/'.$gambar.'" alt="" style="margin-right: 10px; margin-top: 5px; padding: 3px; border: 1px solid rgb(204, 204, 204); background: none repeat scroll 0% 0% rgb(255, 255, 255); float: left;" border="0"  height="100">
</td>';
if ($urutan  % $maxgalleri == 0) {
$tengah .= '</tr></tr>';
}
$no++;
}
$tengah .= '</table></div>';
echo $tengah;


?>
