<?php
if (!defined('AURACMS_admin')) {
	Header("Location: ../index.php");
	exit;
}
	
function format_size($file){
	$get_file_size = filesize("./files/$file");
	$get_file_size = number_format($get_file_size / 1024,1);
	return "$get_file_size KB";
}

if (!cek_login ()){
$admin .='<p class="judul">Access Denied !!!!!!</p>';

}else{
$JS_SCRIPT= <<<js
<script language="JavaScript" type="text/javascript">
$(document).ready(function() {
    $('#example').dataTable();
} );
</script>
js;
$script_include[] = $JS_SCRIPT;
	$admin .= '<div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-list-alt"></i> File Manager</h3>
					<ol class="breadcrumb">
					<li><i class="fa fa-home"></i><a href="?pilih=filemanager&mod=yes">Home</a></li>
					<li><i class="fa fa-home"></i><a href="admin.php?pilih=filemanager&mod=yes&aksi=add">Upload File</a></li>
					</ol>
				</div>
			</div>';
$admin .='<blockquote>
<b>Catatan:</b><br />
Gunakan url seperti dibawah ini untuk menyisipkan image di artikel atau halaman web : <br /><b>"files/nama_file.extension"</b><br /><b>contoh :</b> <br />&lt;img src="files/teamworks.jpg" alt="" border="0" /&gt;
</blockquote>';


if($_GET['aksi'] == ''){
$admin .= '<table class="table table-striped table-bordered" id="example">
<thead>
<tr>
<td>Nama File</td>
<td >Ukuran</td>
<td >Preview</td>
<td >Aksi</td>
</tr>
</thead><tbody>';
$rep=opendir('./files/');
$warna = '';
$no = 1;
while ($file = readdir($rep)) {
if($file != '..' && $file !='.' && $file !=''&& $file !='Thumbs.db'){
if (is_dir($file)){
continue;
}else {
$deleted = '<a href="?pilih=filemanager&amp;mod=yes&amp;aksi=hapus&amp;nama='.$file.'" onclick="return confirm(\'Apakah Anda Ingin Menghapus Data Ini ?\')" class="btn btn-warning"> Delete </a>';
if ($file !='index.php'){
$warna = empty($warna) ? 'bgcolor="#f2f2f2"' : '';
$admin .= '<tr id="'.$warna.'">
<td >'.$file.'</td>
<td >'.format_size($file).'</td>
<td ><a href="files/'.$file.'" rel="lightbox[roadtrip]"><img src="files/'.$file.'" width="100px"></a></td>
<td>'.$deleted.'</td>
</tr>';
$warna = empty($warna) ? 'bgcolor="#efefef"' : '';
}
}
}
$no++;
}
closedir($rep);
clearstatcache();
$admin .= '</tbody></table>';
	
	
}

if ($_GET['aksi']=='add'){

global $max_size,$allowed_exts,$allowed_mime;

if (isset($_POST['submit'])) {
    $image_name1=$_FILES['image1']['name'];
    $image_size1=$_FILES['image1']['size'];
    $image_name2=$_FILES['image2']['name'];
    $image_size2=$_FILES['image2']['size'];
    $image_name3=$_FILES['image3']['name'];
    $image_size3=$_FILES['image3']['size'];
    $image_name4=$_FILES['image4']['name'];
    $image_size4=$_FILES['image4']['size'];
    $image_name5=$_FILES['image5']['name'];
    $image_size5=$_FILES['image5']['size'];
	$error = '';
    if ($image_name1){
		@copy($_FILES['image1']['tmp_name'], "./files/".$image_name1);
        //unlink($image);
        $admin.='<div class="sukses">Upload file '.$image_name1.' berhasil!</div>';  
	}
	if ($image_name2){
		@copy($_FILES['image2']['tmp_name'], "./files/".$image_name2);
        //unlink($image);
        $admin.='<div class="sukses">Upload file '.$image_name2.' berhasil!</div>';  
	}
	if ($image_name3){
		@copy($_FILES['image3']['tmp_name'], "./files/".$image_name3);
        //unlink($image);
        $admin.='<div class="sukses">Upload file '.$image_name3.' berhasil!</div>';  
	}
	if ($image_name4){
		@copy($_FILES['image4']['tmp_name'], "./files/".$image_name4);
        //unlink($image);
        $admin.='<div class="sukses">Upload file '.$image_name4.' berhasil!</div>';  
	}
	if ($image_name5){
		@copy($_FILES['image5']['tmp_name'], "./files/".$image_name5);
        //unlink($image);
        $admin.='<div class="sukses">Upload file '.$image_name5.' berhasil!</div>';  
	}
	 $style_include[] ='<meta http-equiv="refresh" content="3; url=?pilih=admin_files" />';

}
$admin .='<div class="border">
<form method="post" enctype="multipart/form-data" action="">
<b>File Uploader</b><br /><input type="hidden" name="MAX_FILE_SIZE" value="500000" />
<input type="file" name="image1" size="70" /><br />
<input type="file" name="image2" size="70" /><br />
<input type="file" name="image3" size="70" /><br />
<input type="file" name="image4" size="70" /><br />
<input type="file" name="image5" size="70" /><br />
<br />
<input type="submit" name="submit" value="Upload" class="button" />
</form></div>';
}

if ($_GET['aksi']=='hapus'){
    $nama = $_GET['nama'];
	if ($nama){
	unlink ("files/".$nama);
    }
    $admin.='<div class="sukses">File <b>'.$nama.'</b> telah di delete!</div>';
    $style_include[] ='<meta http-equiv="refresh" content="3; url=?pilih=filemanager&mod=yes" />';
}


echo $admin;

}
?>