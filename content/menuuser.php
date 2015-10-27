<?php

if(ereg(basename (__FILE__), $_SERVER['PHP_SELF']))
{
	header("HTTP/1.1 404 Not Found");
	exit;
}

if (cek_login ()){

if (session_is_registered ('UserName') && isset ($_SESSION['UserName']) && !empty ($_SESSION['UserName'])  ){
if (session_is_registered ('LevelAkses') &&  $_SESSION['LevelAkses']=="Editor"){
$secure = 'Welcome   : <b>' . $_SESSION['UserName'] .'</b> <br />Your Level : <b>' . $_SESSION['LevelAkses'] .'</b> <br /> <br />';
$secure .= '<ul><li><a href="'.$url_situs.'/index.php?aksi=logout">LogOut</a>';
$secure .= '<li><a href="'.$url_situs.'/index.php?pilih=user&amp;aksi=change">Change Password</a>';
$secure .= '<li><a href="'.$url_situs.'/'.$adminfile.'.php?pilih=news&amp;mod=yes">Send Article</a>';


kotakjudul("Your Account", $secure);	
}else{
$hasil = $koneksi_db->sql_query( "SELECT * FROM `menu_users` ORDER BY ordering ASC" );
$menuuser.= "<ul>";
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
			$adminmenu = $data['url'];
		$menuuser.= '<li><a href="'.$adminmenu.'">'.$data['menu'].'</a></li>';

}
$menuuser.= "</ul>";
$secure .= $menuuser;
kotakjudul("Your Account", $secure);
}
}
}

?>