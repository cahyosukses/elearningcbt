<?php
if (cek_login ()){

if (isset ($_SESSION['UserName']) && !empty ($_SESSION['UserName'])  ){
$username=$_SESSION['UserName'];
$hasil =  $koneksi_db->sql_query( "SELECT * FROM usernafi WHERE user='$username'" );
$data = $koneksi_db->sql_fetchrow($hasil);
	$id=$data[0];
	$user=$data['user'];
	$biodata=$data['biodata'];
	$email=$data['email'];
	$gambarlama=$data['avatar'];
	$start=date("d-m-Y",$data['start']);
	$foto = '<img src="profile/images/'.$gambarlama.'" class="img-circle" alt="User Image" />';
	echo '          <div class="user-panel">
            <div class="pull-left image">
              '.$foto.'
            </div>
            <div class="pull-left info">
              <p>'.$user.'</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>';
			  }
}
?>