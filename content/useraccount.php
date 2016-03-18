<?php
if (cek_login ()){

if (isset ($_SESSION['UserName']) && !empty ($_SESSION['UserName'])  ){
$username=$_SESSION['UserName'];
$hasil =  $koneksi_db->sql_query( "SELECT * FROM useraura WHERE user='$username'" );
$data = $koneksi_db->sql_fetchrow($hasil);
	$id=$data[0];
	$user=$data['user'];
	$nama=$data['nama'];
	$start=date("d-m-Y",$data['start']);
	$foto = '<img src="images/logo.png" class="img-circle"/>';
	echo '
 <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="images/logo.png" width="60px"height="60px" class="user-image" alt="User Image" />
                  <span class="hidden-xs">'.$username.'</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    '.$foto.'
                    <p>
                      '.$username.' - '.$nama.'
                      <small>Member since '.$start.'</small>
                    </p>
                  </li>';
				  /*
	echo '
                  <!-- Menu Body -->
                  <li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </li>
				  */
	echo '
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-right">
                      <a href="./admin.php?pilih=logout&mod=yes" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>';
			  }
}
?>