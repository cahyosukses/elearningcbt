<?php


if (cek_login ()){

if (isset ($_SESSION['UserName']) && !empty ($_SESSION['UserName'])  ){

$username=$_SESSION['UserName'];
$hasil =  $koneksi_db->sql_query( "SELECT * FROM useraura WHERE user='$username'" );
$data = $koneksi_db->sql_fetchrow($hasil);
	$id=$data[0];
	$user=$data['user'];
	$biodata=$data['biodata'];
	$email=$data['email'];
	$gambarlama=$data['photo'];
		$nama=$data['nama'];
		if(!$gambarlama){
			$gambarlama = 'default-photo.jpg';
			
		}
echo '<span class="profile-ava">
<img alt="" src="mod/user/photo/'.$gambarlama.'"width="30px"height="30px">
</span>
<span class="username">'.$nama.'</span>
<b class="caret"></b>';
}
}
?>