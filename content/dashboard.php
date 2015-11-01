<?php
//include"admin/admin_situs.php";
if (!defined('AURACMS_CONTENT')) {
	Header("Location: ../index.php");
	exit;
}
global $koneksi_db;

$admin .= ' <div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="icon_group"></i> Dashboard</h3>
				</div>
			</div>';	
$admin.='<section class="panel">
                          <header class="panel-heading">
                              Info
                          </header>';
if (isset( $_SESSION['LevelAkses'] )){
$username = $_SESSION['UserName'];
$query =  $koneksi_db->sql_query( "SELECT * FROM useraura where user = '$username'" );
$data = $koneksi_db->sql_fetchrow( $query );
$last_ping = datetimes($data['last_ping'],false);
if ($_SESSION['LevelAkses']=="Administrator"){
$admin .='-&nbsp;<b>Last Login :</b> '.$last_ping.'';

}
if ($_SESSION['LevelAkses']=="User"){
$admin .='-&nbsp;Last Login : '.$last_ping.'';
}



}
$admin.='</section>';
echo $admin;
?>