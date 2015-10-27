<link rel="stylesheet" media="screen" href="includes/media/css/jquery.dataTables.css" />
<script language="javascript" type="text/javascript" src="includes/media/js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="includes/media/js/jquery.dataTables.js"></script>
<script language="JavaScript" type="text/javascript">
$(document).ready(function() {
    $('#example').dataTable( {
    "iDisplayLength":50
});
} );
</script>
<?php
error_reporting(0);
include "includes/excel_reader2.php";
$admin='';
 if( mysql_connect("localhost","$mysql_user","$mysql_password") ){
   mysql_select_db( "$mysql_database" );
}else{
   $admin .= "database gagal";
}
if (!cek_login ()){   
	
$admin .='<p class="judul">Access Denied !!!!!!</p>';
}else{
$admin .='<div class="bordermenu">Data Siswa</div>';
$admin .= '<div class="bordermenu2"><a href="admin.php?pilih=importsiswa&amp;mod=yes">Import Siswa</a> | <a href="admin.php?pilih=importsiswa&amp;mod=yes&amp;aksi=delkelas">Hapus Siswa Per Kelas</a> | <a href="admin.php?pilih=importsiswa&amp;mod=yes&amp;aksi=inputsiswa">Input Siswa Satuan</a> | <a href="admin.php?pilih=importsiswa&amp;mod=yes&amp;aksi=daftarsiswa">Siswa tanpa Kelas</a>';
$admin .= '</div>';
$admin .='<div class="panel panel-info">';

if($_GET['aksi']==""){
if(isset($_POST['submit'])){
	$kelas 		= $_POST['kelas'];
  
//nilai awal counter jumlah data yang sukses dan yang gagal diimport
 $sukses = 0;
 $gagal = 0;
 
 $cell   = new Spreadsheet_Excel_Reader($_FILES['upfile']['tmp_name']);
$jumlah = $cell->rowcount($sheet_index=0);
 
$i = 2; // dimulai dari ke dua karena baris pertama berisi title
while( $i<=$jumlah ){
 
   //$cell->val( baris,kolom )
 
   $nama  = $cell->val( $i,2 );
   $username = $cell->val( $i,1 );
   $password = $cell->val( $i,1 );
$password = md5("$password");
$nama=addslashes($nama);
if($username<>'' and $password<>''){
$sql ="INSERT INTO `useraura` (`user`,`password`,`nama`) VALUES ('$username','$password','$nama')";
$hasil = mysql_query( $sql );
$sql2 ="INSERT INTO `kelas_isi` (`kelas`,`siswa`) VALUES ('$kelas','$username')";
$hasil2 = mysql_query( $sql2 );
if($hasil and $hasil2){
$sukses++;
}else{
$gagal++;
}
}else{
$gagal++;	
}
   $i++;
}
 //tampilkan report hasil import
 $admin .= "<h3> Proses Import Data Siswa, Kelas <b>".getkelas($kelas)."</b> Selesai</h3>";
 $admin .= "<p>Jumlah data sukses diimport : ".$sukses."<br>";
 $admin .= "Jumlah data gagal diimport : ".$gagal."<p>";


}
$admin .='<div class="panel-heading"><b>Import Siswa</b></div>';
$admin .='
 <form method="post" enctype="multipart/form-data" action="">
 <table class="table table-striped table-hover">
 <tr>
		<td>Kelas</td>
		<td>:</td>
		<td>
<select name="kelas" class="form-control">';
$hasil = $koneksi_db->sql_query("SELECT * FROM kelas ORDER BY kelas");
$admin .= '<option value="">== Pilih Kelas ==</option>';
while ($datas =  $koneksi_db->sql_fetchrow ($hasil)){
$admin .= '<option value="'.$datas['id'].'" '.$pilihan.'>'.$datas['kelas'].'</option>';
}
$admin .='</select></td>
	</tr>
 <tr>
	<td>Silakan Pilih File Excel </td>
	<td>:</td>
	<td><input name="upfile" type="file"></td>
 </tr>
 <tr>
	<td>Contoh File Excel </td>
	<td>:</td>
	<td><a href="mod/importsiswa/admin/importsiswa.xls">importsiswa.xls</a></td>
 </tr>
 <tr>
	<td></td>
	<td></td>
	<td><input name="submit" type="submit" value="import" class="btn btn-success"></td>
 </tr>
 </table>
 </form>';
}

if($_GET['aksi'] == 'edit'){
$user = $_GET['user'];
if(isset($_POST['submit'])){
	
	$nama 		= addslashes($_POST['nama']);
	$password 		= $_POST['password'];
	$error 	= '';
	if (!$nama)  	$error .= "Error: Silahkan Isi Nama<br />";
	if ($error){
		$tengah .= '<div class="error">'.$error.'</div>';
	}else{
	$hasil  = mysql_query( "UPDATE `useraura` SET `nama`='$nama' WHERE `user`='$user'" );
	if ($password){
		$hasil  = mysql_query( "UPDATE `useraura` SET `password`=md5('$password') WHERE `user`='$user'" );
	}
		if($hasil){
			$admin .= '<div class="sukses"><b>Berhasil di Update.</b></div>';
			$style_include[] ='<meta http-equiv="refresh" content="1; url=admin.php?pilih=importsiswa&amp;mod=yes" />';	
		}else{
			$admin .= '<div class="error"><b>Gagal di Update.</b></div>';
		}
	}

}

if(isset($_POST['submitlogin'])){
	$user 		= $_POST['user'];	
	$nama 		= addslashes($_POST['nama']);
	$password 		= $_POST['password'];
	$error 	= '';
	if (!$nama)  	$error .= "Error: Silahkan Isi Nama<br />";
if ($koneksi_db->sql_numrows($koneksi_db->sql_query("SELECT * from user aura where user ='$user'")) > 0) $error .= "Error: Siswa dengan NIS $user sudah terdaftar , silahkan ulangi.<br />";
	if ($error){
		$tengah .= '<div class="error">'.$error.'</div>';
	}else{
		$hasil  = mysql_query("INSERT INTO `useraura` (`user`,`password`,`nama`) VALUES ('$user',md5('$password'),'$nama')");
		if($hasil){
			$admin .= '<div class="sukses"><b>Berhasil di Update.</b></div>';
			$style_include[] ='<meta http-equiv="refresh" content="1; url=admin.php?pilih=importsiswa&amp;mod=yes" />';	
		}else{
			$admin .= '<div class="error"><b>Gagal di Update.</b></div>';
		}
	}

}


$query 		= mysql_query ("SELECT ki.siswa,ua.nama,ki.kelas FROM `useraura` as ua right join kelas_isi as ki on ua.user=ki.siswa where ua.user='$user'");
$data 		= mysql_fetch_array($query);
$nama 		= $data['nama'];
$siswa 		= $data['siswa'];
$kelas 		= $data['kelas'];
if($siswa<>''){
$admin .='<div class="panel-heading"><b>Edit Siswa</b></div>';
$admin .= '
<form method="post" action=""class="form-inline">
<table border="0" cellspacing="0" cellpadding="0"class="table table-striped table-hover">
	<tr>
		<td>Kelas</td>
		<td>:</td>
		<td>'.getkelas($kelas).'</td>
	</tr>
	<tr>
		<td>No. Induk</td>
		<td>:</td>
		<td>'.$siswa.'</td>
	</tr>
	<tr>
		<td>Nama</td>
		<td>:</td>
		<td><input type="text" name="nama" value="'.$nama.'" size="25"class="form-control"></td>
	</tr>
	<tr>
		<td>Password</td>
		<td>:</td>
		<td><input type="text" name="password" value="'.$password.'" size="25"class="form-control"></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td>
		<input type="hidden" name="user" value="'.$user.'">
		<input type="submit" value="Simpan" name="submit"class="btn btn-success"></td>
	</tr>
</table>
</form>';
}else{
$query 		= mysql_query ("SELECT ki.siswa,ki.kelas FROM kelas_isi as ki where ki.siswa='$user'");
$data 		= mysql_fetch_array($query);
$siswa 		= $data['siswa'];
$kelas 		= $data['kelas'];	
$admin .='<div class="panel-heading"><b>Edit Siswa</b></div>';
$admin .= '
<form method="post" action=""class="form-inline">
<table border="0" cellspacing="0" cellpadding="0"class="table table-striped table-hover">
	<tr>
		<td>Kelas</td>
		<td>:</td>
		<td>'.getkelas($kelas).'</td>
	</tr>
	<tr>
		<td>No. Induk</td>
		<td>:</td>
		<td>'.$siswa.'</td>
	</tr>
	<tr>
		<td>Nama</td>
		<td>:</td>
		<td><input type="text" name="nama" size="25"class="form-control"></td>
	</tr>
	<tr>
		<td>Password</td>
		<td>:</td>
		<td><input type="text" name="password" value="'.$password.'" size="25"class="form-control"></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td>
		<input type="hidden" name="user" value="'.$user.'">
		<input type="submit" value="Simpan" name="submitlogin"class="btn btn-success"></td>
	</tr>
</table>
</form>';	
}
}

if($_GET['aksi']== 'del'){    
	global $koneksi_db;    
	$user     = $_GET['user'];    
	$hasil = $koneksi_db->sql_query("DELETE FROM `useraura` WHERE `user`='$user'");   
	$hasil2 = $koneksi_db->sql_query("DELETE FROM `kelas_isi` WHERE `siswa`='$user'");  	
	$style_include[] ='<meta http-equiv="refresh" content="1; url=admin.php?pilih=importsiswa&mod=yes" />'; 
}

if($_GET['aksi']=="delkelas"){
if(isset($_POST['submit'])){
	$kelas 		= $_POST['kelas'];
	$hasil = $koneksi_db->sql_query("DELETE useraura , kelas_isi  FROM useraura  INNER JOIN kelas_isi  
WHERE useraura.user= kelas_isi.siswa and kelas_isi.kelas = '$kelas'");
	$style_include[] ='<meta http-equiv="refresh" content="1; url=admin.php?pilih=importsiswa&mod=yes&aksi=delkelas" />';    	

}
$admin .='<div class="panel-heading"><b>Import Siswa</b></div>';
$admin .='
 <form method="post" enctype="multipart/form-data" action="">
 <table class="table table-striped table-hover">
 <tr>
		<td>Kelas</td>
		<td>:</td>
		<td>
<select name="kelas" class="form-control">';
$hasil = $koneksi_db->sql_query("SELECT * FROM kelas ORDER BY kelas");
$admin .= '<option value="">== Pilih Kelas ==</option>';
while ($datas =  $koneksi_db->sql_fetchrow ($hasil)){
$admin .= '<option value="'.$datas['id'].'" '.$pilihan.'>'.$datas['kelas'].'</option>';
}
$admin .='</select></td>
	</tr>
  <tr>
	<td></td>
	<td></td>
	<td><input name="submit" type="submit" value="Hapus" class="btn btn-danger"></td>
 </tr>
 </table>
 </form>';
}

if($_GET['aksi']=="inputsiswa"){
if(isset($_POST['submit'])){
	$kelas 		= $_POST['kelas'];
	$username 		= $_POST['username'];
	$password 		= $_POST['password'];
	$nama 		= $_POST['nama'];	
$password = md5("$password");
	$error 	= '';
	if (!$username)  	$error .= "Error: Silahkan Isi Username<br />";
if ($koneksi_db->sql_numrows($koneksi_db->sql_query("SELECT username FROM kelas_isi WHERE username='$username'")) > 0) $error .= "Error: username ".$username." sudah terdaftar , silahkan ulangi.<br />";
	if ($error){
		$admin .= '<div class="error">'.$error.'</div>';
	}else{

$sql ="INSERT INTO `useraura` (`user`,`password`,`nama`) VALUES ('$username','$password','$nama')";
$hasil = mysql_query( $sql );
$sql2 ="INSERT INTO `kelas_isi` (`kelas`,`siswa`) VALUES ('$kelas','$username')";
$hasil2 = mysql_query( $sql2 );
		if($hasil2){
			$admin .= '<div class="sukses"><b>Berhasil di Tambah.</b></div>';
				$style_include[] ='<meta http-equiv="refresh" content="1; url=admin.php?pilih=importsiswa&mod=yes" />'; 
		}else{
			$admin .= '<div class="error"><b> Gagal di Buat.</b></div>';
				$style_include[] ='<meta http-equiv="refresh" content="1; url=admin.php?pilih=importsiswa&mod=yes&aksi=inputsiswa" />'; 
		}
	}

}
$kelas     		= !isset($kelas) ? '' : $kelas;
$username     		= !isset($username) ? '' : $username;
$password     		= !isset($password) ? '' : $password;
$nama     		= !isset($nama) ? '' : $nama;
$admin .='<div class="panel-heading"><b>Tambah Kelas</b></div>';
$admin .= '
<form method="post" action="" class="form-inline">
<table class="table table-striped table-hover">
	<tr>
		<td>Kelas</td>
		<td>:</td>
		<td>
<select name="kelas" class="form-control" required>';
$hasil = $koneksi_db->sql_query("SELECT * FROM kelas ORDER BY kelas");
$admin .= '<option value="" >== Pilih Kelas ==</option>';
while ($datas =  $koneksi_db->sql_fetchrow ($hasil)){
$admin .= '<option value="'.$datas['id'].'" '.$pilihan.' >'.$datas['kelas'].'</option>';
}
$admin .='</select></td>
	</tr>
	<tr>
		<td>Username</td>
		<td>:</td>
		<td><input type="text" name="username" value="'.$username.'" size="30" class="form-control"required></td>
	</tr>
	<tr>
		<td>Password</td>
		<td>:</td>
		<td><input type="text" name="password" value="'.$password.'" size="30" class="form-control"required></td>
	</tr>
	<tr>
		<td>Nama</td>
		<td>:</td>
		<td><input type="text" name="nama" value="'.$nama.'" size="30" class="form-control"required></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td>
		<input type="submit" value="Tambah" name="submit"class="btn btn-success" ></td>
	</tr>
</table>
</form>';	
}

if($_GET['aksi']== 'resetpassword'){    
global $koneksi_db;    
$user     = $_GET['user'];    
$hasil = $koneksi_db->sql_query("update  `useraura` set password = md5('$user') WHERE `user`='$user'");   
$admin .= '<div class="sukses"> Reset password sukses</div>';
$style_include[] ='<meta http-equiv="refresh" content="1; url=admin.php?pilih=importsiswa&mod=yes" />';
 
}

if($_GET['aksi']=="inputkelas"){
	$user = $_GET['user'];
if(isset($_POST['submit'])){
	$kelas 		= $_POST['kelas'];
	$username 		= $_POST['username'];
	$password 		= $_POST['password'];
	$nama 		= $_POST['nama'];	
$password = md5("$password");
	$error 	= '';
	if (!$username)  	$error .= "Error: Silahkan Isi Username<br />";
if ($koneksi_db->sql_numrows($koneksi_db->sql_query("SELECT username FROM kelas_isi WHERE username='$username'")) > 0) $error .= "Error: username ".$username." sudah terdaftar , silahkan ulangi.<br />";
	if ($error){
		$admin .= '<div class="error">'.$error.'</div>';
	}else{
$sql2 ="INSERT INTO `kelas_isi` (`kelas`,`siswa`) VALUES ('$kelas','$username')";
$hasil2 = mysql_query( $sql2 );
		if($hasil2){
			$admin .= '<div class="sukses"><b>Berhasil di Tambah.</b></div>';
				$style_include[] ='<meta http-equiv="refresh" content="1; url=admin.php?pilih=importsiswa&mod=yes" />'; 
		}else{
			$admin .= '<div class="error"><b> Gagal di Buat.</b></div>';
				$style_include[] ='<meta http-equiv="refresh" content="1; url=admin.php?pilih=importsiswa&mod=yes&aksi=inputsiswa" />'; 
		}
	}

}
$query 		= mysql_query ("SELECT * FROM `useraura` where user='$user'");
$data 		= mysql_fetch_array($query);
$nama 		= $data['nama'];
$username 		= $data['user'];
$kelas     		= !isset($kelas) ? '' : $kelas;
$username     		= !isset($username) ? '' : $username;
$password     		= !isset($password) ? '' : $password;
$nama     		= !isset($nama) ? '' : $nama;
$admin .='<div class="panel-heading"><b>Tambah Kelas</b></div>';
$admin .= '
<form method="post" action="" class="form-inline">
<table class="table table-striped table-hover">
	<tr>
		<td>Kelas</td>
		<td>:</td>
		<td>
<select name="kelas" class="form-control" required>';
$hasil = $koneksi_db->sql_query("SELECT * FROM kelas ORDER BY kelas");
$admin .= '<option value="" >== Pilih Kelas ==</option>';
while ($datas =  $koneksi_db->sql_fetchrow ($hasil)){
$admin .= '<option value="'.$datas['id'].'" '.$pilihan.' >'.$datas['kelas'].'</option>';
}
$admin .='</select></td>
	</tr>
	<tr>
		<td>Username</td>
		<td>:</td>
		<td><input type="text" name="username" value="'.$username.'" size="30" class="form-control"required></td>
	</tr>
	<tr>
		<td>Nama</td>
		<td>:</td>
		<td><input type="text" name="nama" value="'.$nama.'" size="30" class="form-control"required></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td>
		<input type="submit" value="Tambah" name="submit"class="btn btn-success" ></td>
	</tr>
</table>
</form>';	
}

if (in_array($_GET['aksi'],array('','edit','del','delkelas','inputsiswa','resetpassword'))){
$admin .='<div class="panel-heading"><b>Daftar Siswa Per Kelas</b></div>';
$admin.='
<table id="example" class="table table-striped table-bordered" cellspacing="0">
<thead>
<tr>
<th>Kelas</th>
<th>Username</th>
<th>Nama</th>
<th width="220px">Aksi</th>
</tr>
</thead>';
$admin.='<tbody>';
$sql = "SELECT * FROM `kelas_isi` order by kelas asc";
$query = mysql_query( $sql );
while ($data = mysql_fetch_array($query)) { 
$id = $data['id'];
$kelas=$data['kelas'];
$siswa=$data['siswa'];
$admin.='<tr>
<td>'.getkelas($kelas).'</td>
<td>'.$siswa.'</td>
<td>'.getnamasiswa($siswa).'</td>';
$admin.='<td><a href="?pilih=importsiswa&amp;mod=yes&amp;aksi=del&amp;user='.$siswa.'" onclick="return confirm(\'Apakah Anda Yakin Ingin Menghapus Siswa Ini ?\')"><span class="btn btn-danger">Hapus</span></a> <a href="?pilih=importsiswa&amp;mod=yes&amp;aksi=resetpassword&amp;user='.$siswa.'"onclick="return confirm(\'Apakah Anda Yakin Ingin Mereset Siswa Ini ?\')"><span class="btn btn-primary">Reset Pass</span></a> <a href="?pilih=importsiswa&amp;mod=yes&amp;aksi=edit&amp;user='.$siswa.'"><span class="btn btn-warning">Edit</span></a></td>';
$admin.='
</tr>';
}
$admin .= '</tbody></table>';
$admin .='</div>';
}else{
$admin .='<div class="panel-heading"><b>Daftar Siswa Per User</b></div>';
$admin.='
<table id="example" class="table table-striped table-bordered" cellspacing="0">
<thead>
<tr>
<th>Kelas</th>
<th>Username</th>
<th>Nama</th>
<th width="220px">Aksi</th>
</tr>
</thead>';
$admin.='<tbody>';
$sql = "SELECT * FROM `useraura` where level ='Siswa' order by user asc";
$query = mysql_query( $sql );
while ($data = mysql_fetch_array($query)) { 
$id = $data['UserId'];
$siswa=$data['user'];
$kelas = getkelasisi($siswa);
if(!$kelas){
$admin.='<tr>
<td>'.$kelas.'</td>
<td>'.$siswa.'</td>
<td>'.getnamasiswa($siswa).'</td>';
$admin.='<td><a href="?pilih=importsiswa&amp;mod=yes&amp;aksi=del&amp;user='.$siswa.'" onclick="return confirm(\'Apakah Anda Yakin Ingin Menghapus Siswa Ini ?\')"><span class="btn btn-danger">Hapus</span></a>&nbsp;<a href="?pilih=importsiswa&amp;mod=yes&amp;aksi=inputkelas&amp;user='.$siswa.'"><span class="btn btn-warning">Input Kelas</span></a></td>';
$admin.='
</tr>';
}
}
$admin .= '</tbody></table>';
$admin .='</div>';	
	
}


}






echo $admin;

?>