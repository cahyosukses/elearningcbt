<?php
if (!defined('AURACMS_admin')) {
	Header("Location: ../../../index.php");
	exit;
}

if (!cek_login ()){
   $admin .='<p class="judul">Access Denied !!!!!!</p>';
   exit;
}


if (isset ($_GET['pg'])) $pg = int_filter ($_GET['pg']); else $pg = 0;
if (isset ($_GET['stg'])) $stg = int_filter ($_GET['stg']); else $stg = 0;
if (isset ($_GET['offset'])) $offset = int_filter ($_GET['offset']); else $offset = 0;
$username = $_SESSION["UserName"];
$admin .='<section class="content-header">
          <h1>
            Ubah Password
            <small>Mengubah Password Anda</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="./admin.php?pilih=ubahpassword&mod=yes"><i class="fa fa-dashboard"></i>Home</a></li>
			<li>Ubah Password</li>
          </ol>
        </section>';		
		$admin .='
<section class="content">';	
$admin .= '<div class="box">
                <div class="box-header">
                  <h3 class="box-title"><i class="fa fa-unlock-alt"></i>&nbsp;&nbsp;Ubah Password</h3>
                </div><!-- /.box-header -->
                <div class="box-body">';
if($_GET['aksi']==""){
if (isset($_POST["submit"])) {
$user		   = $_SESSION["UserName"];
//$email	      = text_filter($_POST['email']);
$password0 = md5($_POST["password0"]);
$password1 = $_POST["password1"];
$password2 = $_POST["password2"];

$hasil = $koneksi_db->sql_query( "SELECT password FROM useraura WHERE user='$user'" );
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
	$password=$data['password'];
	}
	
$error = '';
if (!$password0)  $error .= "Error: Please enter your Old Password!<br />";
if (!$password1)  $error .= "Error: Please enter new password!<br />";
if (!$password2)  $error .= "Error: Please retype your your new password!<br />";
//checkemail($email);
if ($password0 != $password)  $error .= "Invalid old pasword, silahkan ulangi lagi.";
if ($password1 != $password2)   $error .= "New password dan retype berbeda, silahkan ulangi.<br />";
//if ($koneksi_db->sql_numrows($koneksi_db->sql_query("SELECT email FROM useraura WHERE email='$email' and user!='$user'")) > 0) $error .= "Error: Email ".$email." sudah terdaftar , silahkan ulangi.<br />";

if ($error) {

$admin .='<div class="panel-body"><div class="alert alert-danger fade in">'.$error.'</div></div>';

} else {

$password3=md5($password1);
$hasil = $koneksi_db->sql_query( "UPDATE useraura SET user='$user', password='$password3' WHERE user='$user'" );

$admin.='<div class="panel-body"><div class="alert alert-success fade in">Password telah di updated</div></div>';
}

}

$user =  $_SESSION['UserName'];
$hasil =  $koneksi_db->sql_query( "SELECT * FROM useraura WHERE user='$user'" );
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
	$id=$data[0];
	$user=$data[1];
	$email=$data[3];
		$nama=$data['nama'];
}
$admin .='
<div class="panel-body">
<form method="post" action=""class="form-validate form-horizontal" id="feedback_form" >
<div class="form-group">
<label class="col-sm-2 control-label">Username</label>
<div class="col-sm-10"><p class="form-control-static">'.$user.'</p>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">Nama</label>
<div class="col-sm-10"><p class="form-control-static">'.$nama.'</p>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">Old Password</label>
<div class="col-sm-10">
<input type="text" class="form-control"name="password0">
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">New Password</label>
<div class="col-sm-10">
<input type="text" class="form-control"name="password1">
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">Retype New Password</label>
<div class="col-sm-10">
<input type="text" class="form-control"name="password2">
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label"></label>
<div class="col-sm-10">
<p class="form-control-static"><input type="submit" name="submit" value="Update" class="btn btn-success"/></p>
</div>
</div>
</div>
</form> ';
$admin .='</div>';
}

$admin .= '</div><!-- /.box-body -->
</div><!-- /.box -->';				  
$admin .='</section>';
echo $admin;

?>						  
						  