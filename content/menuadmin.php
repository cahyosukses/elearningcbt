<?php

if(preg_match('/'.basename(__FILE__).'/',$_SERVER['PHP_SELF']))
{
	header("HTTP/1.1 404 Not Found");
	exit;
}

if (cek_login ()){

if (isset ($_SESSION['UserName']) && !empty ($_SESSION['UserName'])  ){
/**********************************/
$username=$_SESSION['UserName'];
$query 		= mysql_query ("SELECT * FROM `useraura` WHERE `user`='$username'");
$data 		= mysql_fetch_array($query);
$photo = $data['photo'];
if($photo){
$photo = '<img src="mod/user/photo/'.$photo.'">';
}else{
$photo = '<img src="mod/user/photo/default-photo.jpg">';
}
/**********************************/
if (isset( $_SESSION['LevelAkses'] ) &&  $_SESSION['LevelAkses']=="Administrator"){
global $koneksi_db;

$hasil = $koneksi_db->sql_query( "SELECT * FROM admin where parent =0 ORDER BY ordering ASC" );
$menuadmin = "<ul>";
while ($data = $koneksi_db->sql_fetchrow($hasil)) {

		$target = "?aksi=logout";
		if ($data[2]==$target) {
			$adminmenu = "$target";
			$data[1] = "<b>$data[1]</b>";
		} else {
			$mod = $data['mod'] == 1 ? '&amp;mod=yes' : '';
			$adminmenu = $data['mod'] == 1 ? $adminfile.".php?pilih=".$data['url'].$mod : $adminfile.'.php?pilih='.basename($data['url'],'.php');
			
		}
$parentid=$data[0];
$menuadmin.= '<h4  class="bg2"><img src="themes/administrator/images/'.$data[6].'" align="top" style="margin-right:8px;">'.$data[1].'</h4>';
$hasil2 = $koneksi_db->sql_query( "SELECT * FROM admin where parent =$parentid ORDER BY menu ASC" );
$menuadmin .= "";
while ($data2 = $koneksi_db->sql_fetchrow($hasil2)) {
$mod = $data2['mod'] == 1 ? '&amp;mod=yes' : '';
$adminmenu2 = $data2['mod'] == 1 ? $adminfile.".php?pilih=".$data2['url'].$mod : $adminfile.'.php?pilih='.basename($data2['url'],'.php');
$menuadmin.= '<li><a href="'.$adminmenu2.'">'.$data2[1].'</a></li>';
}
}
$menuadmin.= "</ul>";


kotakjudul('<span class="link"><a href="./">Menu Admin</a></span>', $menuadmin);

}elseif (isset( $_SESSION['LevelAkses'] ) &&  $_SESSION['LevelAkses']=="Guru"){
$username=$_SESSION['UserName'];
$hasil = $koneksi_db->sql_query( "SELECT * FROM menu_guru where parent =0 ORDER BY ordering ASC" );
$menuadmin = "<ul>";
$menuadmin.= '<li><div align="center">'.$photo.'</li>';
while ($data = $koneksi_db->sql_fetchrow($hasil)) {

		$target = "?aksi=logout";
		if ($data[2]==$target) {
			$adminmenu = "$target";
			$data[1] = "<b>$data[1]</b>";
		} else {
			$adminmenu = $data[2];
			
		}
$parentid=$data[0];
$menuadmin.= '<h4 class="bg2"><img src="themes/administrator/images/'.$data[5].'" align="top" style="margin-right:8px;">'.$data[1].'</h4>';
$hasil2 = $koneksi_db->sql_query( "SELECT * FROM menu_guru where parent =$parentid ORDER BY menu ASC" );
while ($data2 = $koneksi_db->sql_fetchrow($hasil2)) {
$adminmenu2 =$data2['url'];
$menuadmin.= '<li><a href="'.$adminmenu2.'">'.$data2[1].'</a></li>';
}
}
$menuadmin.= "</ul>";


kotakjudul('<span class="link"><a href="./">Menu Guru</a></span>', $menuadmin);
}else{
$username=$_SESSION['UserName'];
$hasil = $koneksi_db->sql_query( "SELECT * FROM menu_siswa where parent =0 ORDER BY ordering ASC" );
$menuadmin .= "<ul>";
while ($data = $koneksi_db->sql_fetchrow($hasil)) {

		$target = "?aksi=logout";
		if ($data[2]==$target) {
			$adminmenu = "$target";
			$data[1] = "<b>$data[1]</b>";
		} else {
			$adminmenu = $data[2];
			
		}
$parentid=$data[0];
$menuadmin.= '<h4 class="bg2"><img src="themes/administrator/images/'.$data[5].'" align="top" style="margin-right:8px;">'.$data[1].'</h4>';
$hasil2 = $koneksi_db->sql_query( "SELECT * FROM menu_siswa where parent =$parentid ORDER BY menu ASC" );
$menuadmin .= "<ul>";
while ($data2 = $koneksi_db->sql_fetchrow($hasil2)) {
$adminmenu2 =$data2['url'];
$menuadmin.= '<li><a href="'.$adminmenu2.'">'.$data2[1].'</a></li>';
}
}
$menuadmin.= "</ul>";


kotakjudul('<span class="link"><a href="./">Menu Siswa</a></span>', $menuadmin);
}
}
}

?>