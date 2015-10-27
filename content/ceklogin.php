<?php
if (!defined('AURACMS_CONTENT')) {
	Header("Location: ../index.php");
	exit;
}
global $koneksi_db;
$login ="";
if (isset ($_POST['submit_login']) && @$_POST['loguser'] == 1){
$login .= aura_login ();
}
if (cek_login ()){
//echo '<div class="lainnya">';
$user = $_SESSION['UserName'];
$levelakses =$_SESSION['LevelAkses'];
if ($levelakses=="Administrator"){
$hasil = $koneksi_db->sql_query( "SELECT * FROM useraura WHERE user='$user'" );
$data = mysql_fetch_assoc($hasil);
$user = $data['user'];
$nama = $data['nama'];
//echo '<div align="right">Selamat datang,&nbsp;&nbsp;<b>'.$user.'</b>, '.$nama.'&nbsp;&nbsp;|&nbsp;&nbsp;<a href="?aksi=logout">Sign Out</a></div>';
echo '
<nav>
<ul>
<li><a href="#">'.$user.'</a>
 <ul>
 <li><a href="?aksi=logout">Logout</a></li>
</ul>
</li>
</ul>
</nav> 
';

}else{
$hasil = $koneksi_db->sql_query( "SELECT * FROM useraura WHERE user='$user'" );
$data = mysql_fetch_assoc($hasil);
$user = $data['user'];
$nama = $data['nama'];
echo '
<nav>
<ul>
<li><a href="#">'.$user.'</a>
 <ul>
 <li><a href="index.php?aksi=logout">Logout</a></li>
</ul>
</li>
</ul>
</nav> 
';

}
}else{
//$login .= '<b><a href="tc-admin" target="_blank">Sign In</a></b>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="forgotpassword.html">Lupa Password ?</a>';
echo $login;
}
?>