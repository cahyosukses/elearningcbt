<?php
//include"admin/admin_situs.php";
if (!defined('AURACMS_CONTENT')) {
	Header("Location: ../index.php");
	exit;
}
global $koneksi_db;
$tengah .='<h4 class="bg">Dashboard</h4>';
if (isset( $_SESSION['LevelAkses'] )){
$username = $_SESSION['UserName'];
$query =  $koneksi_db->sql_query( "SELECT * FROM useraura where user = '$username'" );
$data = $koneksi_db->sql_fetchrow( $query );
$last_ping = datetimes($data['last_ping'],false);
if ($_SESSION['LevelAkses']=="Administrator"){
$tengah .='<div class="border"><font style="color:#21759B;"><b>Last Login :</b> '.$last_ping.'</font></div>';

}
if ($_SESSION['LevelAkses']=="User"){
$tengah .='<div class="border">';
$tengah .='-&nbsp;Last Login : '.$last_ping.'';
}



}
echo $tengah;
?>