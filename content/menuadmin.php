<?php

if (cek_login ()){
global $koneksi_db;
if (isset ($_SESSION['UserName']) && !empty ($_SESSION['UserName'])  ){

if (isset( $_SESSION['LevelAkses'] ) &&  $_SESSION['LevelAkses']=="Administrator"){
$hasil = $koneksi_db->sql_query( "SELECT * FROM admin where parent =0 ORDER BY ordering ASC" );
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$idmaster = $data['id'];
$mod = $data['mod'] == 1 ? '&amp;mod=yes' : '';
$adminmenu = $data['mod'] == 1 ? $adminfile.".php?pilih=".$data['url'].$mod : $adminfile.'.php?pilih='.basename($data['url'],'.php');
$menuadmin.='<li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="'.$data['icon'].'"></i>
                          <span>'.$data['menu'].'</span>
							<span class="menu-arrow arrow_carrot-right"></span>
                      </a>';
$hasil2 = $koneksi_db->sql_query( "SELECT * FROM admin where parent = $idmaster ORDER BY ordering ASC" );
$menuadmin.='<ul class="sub">';
while ($data2 = $koneksi_db->sql_fetchrow($hasil2)) {
$mod = $data2['mod'] == 1 ? '&amp;mod=yes' : '';
$adminmenu2 = $data2['mod'] == 1 ? $adminfile.".php?pilih=".$data2['url'].$mod : $adminfile.'.php?pilih='.basename($data2['url'],'.php');
$menuadmin.='<li><a href="'.$adminmenu2.'">'.$data2['menu'].'</a></li>';              
}	
$menuadmin.='</ul>';
$menuadmin.='</li>';
}
}elseif (isset( $_SESSION['LevelAkses'] ) &&  $_SESSION['LevelAkses']=="Guru"){
/*******************************************/
$hasil = $koneksi_db->sql_query( "SELECT * FROM `menu_guru` where parent = 0 ORDER BY ordering ASC" );
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$idmaster = $data['id'];
$menuadmin.='<li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="'.$data['icon'].'"></i>
                          <span>'.$data['menu'].'</span>
							<span class="menu-arrow arrow_carrot-right"></span>
                      </a>';
$hasil2 = $koneksi_db->sql_query( "SELECT * FROM menu_guru where parent = '$idmaster' ORDER BY ordering ASC" );
$menuadmin.='<ul class="sub">';
while ($data2 = $koneksi_db->sql_fetchrow($hasil2)) {
$mod = $data2['mod'] == 1 ? '&amp;mod=yes' : '';
$adminmenu2 = $data2['mod'] == 1 ? $adminfile.".php?pilih=".$data2['url'].$mod : $adminfile.'.php?pilih='.basename($data2['url'],'.php');
$menuadmin.='<li><a href="'.$data2['url'].'">'.$data2['menu'].'</a></li>';              
}	
$menuadmin.='</ul>';
$menuadmin.='</li>';
}
}else{
/*******************************************/
$hasil = $koneksi_db->sql_query( "SELECT * FROM `menu_siswa` where parent = 0 ORDER BY ordering ASC" );
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$idmaster = $data['id'];
$menuadmin.='<li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="'.$data['icon'].'"></i>
                          <span>'.$data['menu'].'</span>
							<span class="menu-arrow arrow_carrot-right"></span>
                      </a>';
$hasil2 = $koneksi_db->sql_query( "SELECT * FROM menu_siswa where parent = '$idmaster' ORDER BY ordering ASC" );
$menuadmin.='<ul class="sub">';
while ($data2 = $koneksi_db->sql_fetchrow($hasil2)) {
$adminmenu2 = $data2['mod'] == 1 ? $adminfile.".php?pilih=".$data2['url'].$mod : $adminfile.'.php?pilih='.basename($data2['url'],'.php');
$menuadmin.='<li><a href="'.$data2['url'].'">'.$data2['menu'].'</a></li>';              
}	
$menuadmin.='</ul>';
$menuadmin.='</li>';
}
}
}
echo $menuadmin;
}
?>