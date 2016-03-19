<?php

if(ereg(basename (__FILE__), $_SERVER['PHP_SELF']))
{
	header("HTTP/1.1 404 Not Found");
	exit;
}

if (cek_login ()){
global $koneksi_db;
if (isset( $_SESSION['LevelAkses'] ) &&  $_SESSION['LevelAkses']=="Administrator"){
$hasil = $koneksi_db->sql_query( "SELECT * FROM admin where parent =0 ORDER BY ordering ASC" );

while ($data = $koneksi_db->sql_fetchrow($hasil)) {
echo'<li class="treeview">';
$idmaster = $data['id'];
$mod = $data['mod'] == 1 ? '&amp;mod=yes' : '';
$adminmenu = $data['mod'] == 1 ? $adminfile.".php?pilih=".$data['url'].$mod : $adminfile.'.php?pilih='.basename($data['url'],'.php');
echo'<a href="#">
                <i class="'.$data['icon'].'"></i>
                <span>'.$data['menu'].'</span><i class="fa fa-angle-left pull-right"></i></a>';
echo'<ul class="treeview-menu">';
$hasil2 = $koneksi_db->sql_query( "SELECT * FROM admin where parent = $idmaster ORDER BY ordering ASC" );
while ($data2 = $koneksi_db->sql_fetchrow($hasil2)) {
$mod = $data2['mod'] == 1 ? '&amp;mod=yes' : '';
$adminmenu2 = $data2['mod'] == 1 ? $adminfile.".php?pilih=".$data2['url'].$mod : $adminfile.'.php?pilih='.basename($data2['url'],'.php');
echo'<li><a href="'.$adminmenu2.'"><i class="fa fa-circle-o"></i> '.$data2['menu'].'</a></li>';    
}	
echo'</ul>';
echo'</li>';
}
}else if (isset( $_SESSION['LevelAkses'] ) &&  $_SESSION['LevelAkses']=="Siswa"){
$hasil = $koneksi_db->sql_query( "SELECT * FROM menu_siswa where parent =0 ORDER BY ordering ASC" );

while ($data = $koneksi_db->sql_fetchrow($hasil)) {
echo'<li class="treeview">';
$idmaster = $data['id'];
$mod = $data['mod'] == 1 ? '&amp;mod=yes' : '';
$adminmenu = $data['mod'] == 1 ? $adminfile.".php?pilih=".$data['url'].$mod : $adminfile.'.php?pilih='.basename($data['url'],'.php');
echo'<a href="#">
                <i class="'.$data['icon'].'"></i>
                <span>'.$data['menu'].'</span><i class="fa fa-angle-left pull-right"></i></a>';
echo'<ul class="treeview-menu">';
$hasil2 = $koneksi_db->sql_query( "SELECT * FROM menu_siswa where parent = $idmaster ORDER BY ordering ASC" );
while ($data2 = $koneksi_db->sql_fetchrow($hasil2)) {
$mod = $data2['mod'] == 1 ? '&amp;mod=yes' : '';
$adminmenu2 = $data2['mod'] == 1 ? $adminfile.".php?pilih=".$data2['url'].$mod : $adminfile.'.php?pilih='.basename($data2['url'],'.php');
echo'<li><a href="'.$adminmenu2.'"><i class="fa fa-circle-o"></i> '.$data2['menu'].'</a></li>';    
}	
echo'</ul>';
echo'</li>';
}
}else if (isset( $_SESSION['LevelAkses'] ) &&  $_SESSION['LevelAkses']=="Guru"){
$hasil = $koneksi_db->sql_query( "SELECT * FROM menu_guru where parent =0 ORDER BY ordering ASC" );

while ($data = $koneksi_db->sql_fetchrow($hasil)) {
echo'<li class="treeview">';
$idmaster = $data['id'];
$mod = $data['mod'] == 1 ? '&amp;mod=yes' : '';
$adminmenu = $data['mod'] == 1 ? $adminfile.".php?pilih=".$data['url'].$mod : $adminfile.'.php?pilih='.basename($data['url'],'.php');
echo'<a href="#">
                <i class="'.$data['icon'].'"></i>
                <span>'.$data['menu'].'</span><i class="fa fa-angle-left pull-right"></i></a>';
echo'<ul class="treeview-menu">';
$hasil2 = $koneksi_db->sql_query( "SELECT * FROM menu_guru where parent = $idmaster ORDER BY ordering ASC" );
while ($data2 = $koneksi_db->sql_fetchrow($hasil2)) {
$mod = $data2['mod'] == 1 ? '&amp;mod=yes' : '';
$adminmenu2 = $data2['mod'] == 1 ? $adminfile.".php?pilih=".$data2['url'].$mod : $adminfile.'.php?pilih='.basename($data2['url'],'.php');
echo'<li><a href="'.$adminmenu2.'"><i class="fa fa-circle-o"></i> '.$data2['menu'].'</a></li>';    
}	
echo'</ul>';
echo'</li>';
}
}
/*
            <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Post</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="./admin.php?pilih=hal&mod=yes"><i class="fa fa-circle-o"></i> Halaman</a></li>
                <li><a href="./admin.php?pilih=news&mod=yes"><i class="fa fa-circle-o"></i> Blogs</a></li>
              </ul>
            </li>
*/
}
//echo $menuadmin;
?>