<?php
//include"admin/admin_situs.php";
if (!defined('AURACMS_CONTENT')) {
	Header("Location: ../index.php");
	exit;
}
global $koneksi_db;

$admin .='<section class="content-header">
          <h1>
            Dashboard
            <small>Admin Site</small>
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i>Home</a></li>
			<li>Dashboard</li>
            <li class="active">Admin Site</li>
          </ol>
        </section>';
$admin .='
<section class="content">';	
$admin .= '<div class="box">
                <div class="box-header">
                  <h3 class="box-title">Dashboard</h3>
                </div><!-- /.box-header -->
                <div class="box-body">';
if (isset( $_SESSION['LevelAkses'] )){
$username = $_SESSION['UserName'];
$query =  $koneksi_db->sql_query( "SELECT * FROM useraura where user = '$username'" );
$data = $koneksi_db->sql_fetchrow( $query );
$last_ping = datetimes($data['last_ping'],false);
if ($_SESSION['LevelAkses']=="Administrator"){
$admin .='-&nbsp;<b>Last Login :</b> '.$last_ping.'';

}
if ($_SESSION['LevelAkses']=="Siswa"){
$admin .='-&nbsp;Last Login : '.$last_ping.'';
}



}
$admin .= '</div><!-- /.box-body -->
</div><!-- /.box -->';
$admin .='</section>';
echo $admin;
?>