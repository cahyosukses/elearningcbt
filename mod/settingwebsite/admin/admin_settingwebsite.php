<?php
if (!defined('AURACMS_admin')) {
	Header("Location: ../index.php");
	exit;
}
$style_include[] = <<<style
<style type="text/css">
@import url("mod/news/css/news.css");
</style>

style;

$JS_SCRIPT = <<<js
<!-- TinyMCE -->
<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
        selector: "textarea",
        plugins: [
                "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons template textcolor paste  textcolor filemanager"
        ],

        toolbar1: "| bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
		toolbar2: "| cut copy paste pastetext | searchreplace | outdent indent blockquote | undo redo | link unlink anchor image media code jbimages | forecolor backcolor",
		toolbar3: "| table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",
        menubar: false,
        toolbar_items_size: 'small',
		image_advtab: true,
forced_root_block : false,
    force_p_newlines : 'false',
    remove_linebreaks : false,
    force_br_newlines : true,
    remove_trailing_nbsp : false,
    verify_html : false,
        templates: [
                {title: 'Test template 1', content: 'Test 1'},
                {title: 'Test template 2', content: 'Test 2'}
        ]
		
});</script>
<!-- /TinyMCE -->
<script type=text/javascript>

	var allowsef = 1;
		
	// generate SEF urls 	
	function genSEF(from,to) { 
		if (allowsef == 1) {
			var str = from.value.toLowerCase();
			str = str.replace(/[^a-zA-Z 0-9]+/g,'');
			str = str.replace(/\s+/g, "-");		
			to.value = str;
		}
	}
		
</script>

	
js;
$script_include[] = $JS_SCRIPT;
$admin = '';

if (!cek_login ()){
   $admin .='<h4 class="bg">Access Denied !!!!!!</h4>';
}else{

global $koneksi_db,$PHP_SELF,$theme,$error;

$admin .='<div class="bordermenu">Setting E-Learning</div>';
$admin .="<div class='bordermenu2'><a href='admin.php?pilih=settingwebsite&mod=yes'>Home</a> |
<a href='admin.php?pilih=settingwebsite&mod=yes&aksi=favicon'>Favicon</a> |
<a href='admin.php?pilih=settingwebsite&mod=yes&aksi=logo'>Logo Website</a> |
<a href='admin.php?pilih=settingwebsite&mod=yes&aksi=tampilan'>Tampilan Ujian/Kursus</a>";
$admin .='</div>';
$admin .='<div class="panel panel-info">';
if($_GET['aksi']==""){
$admin .='<div class="panel-heading"><b>Setting E-Learning</b></div>';

if (isset($_POST["submit"])) {
$judul_situs = $_POST["judul_situs"];
$url_situs = $_POST["url_situs"];
$slogan = $_POST["slogan"];
$email_master = $_POST["email_master"];
$description = $_POST["description"];
$keywords = cleanText($_POST["keywords"]);
$alamatkantor = $_POST["alamatkantor"];
$error = '';
if (!$judul_situs)  $error .= "Error: Judul Situs tidak boleh kosong!<br />";
if (!$url_situs)  $error .= "Error: URL Situs tidak boleh kosong!<br />";
if (!$slogan)  $error .= "Error: Slogan Situs tidak boleh kosong!<br />";
if (!$email_master)  $error .= "Error: Email Master Situs tidak boleh kosong!<br />";
if ($error) {

$admin .='<div class="error">'.$error.'</div>';

} else {

$hasil = $koneksi_db->sql_query( "UPDATE situs SET judul_situs='$judul_situs', url_situs='$url_situs', slogan='$slogan', email_master='$email_master', description='$description', keywords='$keywords',alamatkantor='$alamatkantor' WHERE id='1'" );

$admin.='<div class="border"><table width="100%" class="bodyline"><tr><td align="left"><img src="images/info.gif" border="0"></td><td align="center"><font class="option"><b>Informasi Situs telah di updated</b><br /></font></td><td align="right"><img src="images/info.gif" border="0"></td></tr></table></div>';
}
}
$user =  $_SESSION['UserName'];
$hasil =  $koneksi_db->sql_query( "SELECT * FROM situs WHERE id='1'" );
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
	$id=$data[0];
	$judul_situs=$data['judul_situs'];
	$url_situs=$data['url_situs'];
	$slogan=$data['slogan'];
	$email_master=$data['email_master'];
	$description=$data['description'];
	$keywords=$data['keywords'];
	$alamatkantor=$data['alamatkantor'];
}

$admin .='<div class="border">';
$admin .='
<form method="post" action="">
    <table class="table">
        <tr>
            <td>Nama Sekolah&nbsp;:</td>
            <td><input type="text" size="40" name="judul_situs" value="'.$judul_situs.'" required class="form-control"/></td>
        </tr>
        <tr>
            <td>Url Situs&nbsp;:</td>
            <td><input type="text" size="40" name="url_situs" value="'.$url_situs.'" required class="form-control"/></td>
        </tr>
        <tr>
            <td>Slogan&nbsp;:</td>
            <td><input type="text" size="40" name="slogan" value="'.$slogan.'" required class="form-control"/></td>
        </tr>
        <tr>
            <td>Email Master&nbsp;:</td>
            <td><input type="text" size="40" name="email_master" value="'.$email_master.'" required class="form-control"/></td>
        </tr>
        <tr>
            <td>Deskripsi [META]&nbsp;:</td>
            <td><input type="text" size="40" name="description" value="'.$description.'" class="form-control"/></td>
        </tr>
		 <tr>
            <td valign="top">Keywords - Tags [META]&nbsp;:</td>
            <td><textarea class="form-control" name="keywords" cols="40">'.$keywords.'</textarea></td>
        </tr>
		 <tr>
            <td valign="top">Alamat Sekolah&nbsp;:</td>
            <td><textarea class="form-control"name="alamatkantor" cols="40">'.$alamatkantor.'</textarea></td>
        </tr>		
		<tr>
            <td></td><td colspan="2">
            <input type="hidden" name="id" value="'.$id.'" />
            <input type="submit" name="submit" value="Simpan" class="btn btn-success" />
            </td>
        </tr>
    </table>
</form> ';
$admin .='</div>';
}

if($_GET['aksi']=="datasetting"){
$admin .='<div class="panel-heading"><b>Setting E-Learning</b></div>';
if (isset($_POST["submit"])) {
$maxkonten = $_POST["maxkonten"];
$maxadmindata = $_POST["maxadmindata"];
$maxdata = $_POST["maxdata"];
$maxgalleri = $_POST["maxgalleri"];
$maxgalleridata = $_POST["maxgalleridata"];
$error = '';
if (!$maxkonten)  $error .= "Error: Max Konten tidak boleh kosong!<br />";
if (!$maxadmindata)  $error .= "Error: Max Admin Data tidak boleh kosong!<br />";
if (!$maxdata)  $error .= "Error: Max Data tidak boleh kosong!<br />";
if (!$maxgalleri)  $error .= "Error: Max Galleri tidak boleh kosong!<br />";
if ($error) {
$admin .='<div class="error">'.$error.'</div>';
} else {
$hasil = $koneksi_db->sql_query( "UPDATE situs SET maxkonten='$maxkonten', maxadmindata='$maxadmindata', maxdata='$maxdata', maxgalleri='$maxgalleri' , maxgalleridata='$maxgalleridata' WHERE id='1'" );

$admin.='<div class="border"><table width="100%" class="bodyline"><tr><td align="left"><img src="images/info.gif" border="0"></td><td align="center"><font class="option"><b>Data Setting telah di updated</b><br /></font></td><td align="right"><img src="images/info.gif" border="0"></td></tr></table></div>';
}
}
$user =  $_SESSION['UserName'];
$hasil =  $koneksi_db->sql_query( "SELECT * FROM situs WHERE id='1'" );
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
	$id=$data[0];
	$maxkonten=$data['maxkonten'];
	$maxadmindata=$data['maxadmindata'];
	$maxdata=$data['maxdata'];
	$maxgalleri=$data['maxgalleri'];
	$maxgalleridata=$data['maxgalleridata'];
}
$admin .='<div class="border">';
$admin .='
<form method="post" action="">
    <table>
        <tr>
            <td>Max Konten&nbsp;:</td>
            <td><input type="text" size="40" name="maxkonten" value="'.$maxkonten.'" /></td>
        </tr>
        <tr>
            <td>Jumlah Limit Data Admin&nbsp;:</td>
            <td><input type="text" size="40" name="maxadmindata" value="'.$maxadmindata.'" /></td>
        </tr>
        <tr>
            <td>Jumlah Limit Data Blog&nbsp;:</td>
            <td><input type="text" size="40" name="maxdata" value="'.$maxdata.'" /></td>
        </tr>
		        <tr>
            <td>Max Galleri&nbsp;:</td>
            <td><input type="text" size="40" name="maxgalleri" value="'.$maxgalleri.'" /></td>
        </tr>
			<tr>
            <td>Jumlah Limit Data Galleri&nbsp;:</td>
            <td><input type="text" size="40" name="maxgalleridata" value="'.$maxgalleridata.'" /></td>
        </tr>
        <tr>
            <td></td><td colspan="2">
            <input type="hidden" name="id" value="'.$id.'" />
            <input type="submit" name="submit" value="Update" />
            </td>
        </tr>
    </table>
</form> ';
$admin .='</div>';
}

if($_GET['aksi']=="favicon"){
$admin .='<div class="panel-heading"><b>Setting Favicon</b></div>';
if (isset($_POST['submit'])){
$namafile_name 	= $_FILES['gambar']['name'];
$extension = end(explode('.', $_FILES['gambar']['name']));
	$error 	= '';
if ($extension!='ico')  	$error .= "Error: Format ekstensi ico<br />";
if ($error){
	$admin .= '<div class="error">'.$error.'</div>';
	}else{	
if (!empty ($namafile_name)){
    $files = $_FILES['gambar']['name'];
    $tmp_files = $_FILES['gambar']['tmp_name'];
    $tempnews 	= './';
    $namagambar = 'favicon.ico';
    $uploaddir = $tempnews . $namagambar; 
    $uploads = move_uploaded_file($tmp_files, $uploaddir);
	if (file_exists($uploaddir)){
		@chmod($uploaddir,0644);
	}
	$gnews 		= '';
	$nsmall = $gnews . $namagambar;
			$admin .= '<div class="sukses"><b>Berhasil di Upload.</b></div>';	
	
		}
		}
	}
$admin .= "
<form method='post' action='' enctype ='multipart/form-data' id='posts'>
<table class='table'><tr><td><img src='images/favicon.png' width=30></td><td valign=top class='border'>Contoh bentuk icon, Harap ber ekstensi ico</td></tr>
<tr><td>Favicon</td><td><input type='file' class='form-control' name='gambar' size='53' required></td><tr>
<tr><td></td><td>
<input type='submit' value='Upload' name='submit' class='btn btn-success'></td></tr>
</table>
</form>";

}

if($_GET['aksi']=="logo"){
$admin .='<div class="panel-heading"><b>Setting Logo</b></div>';
if (isset($_POST['submit'])){
define("GIS_GIF", 1);
define("GIS_JPG", 2);
define("GIS_PNG", 3);
define("GIS_SWF", 4);

include "includes/hft_image.php";
$namafile_name 	= $_FILES['gambar']['name'];
$extension = end(explode('.', $_FILES['gambar']['name']));
	$error 	= '';
if ($extension!='png')  	$error .= "Error: Format ekstensi png<br />";
if ($error){
	$admin .= '<div class="error">'.$error.'</div>';
	}else{	
if (!empty ($namafile_name)){
    $files = $_FILES['gambar']['name'];
    $tmp_files = $_FILES['gambar']['tmp_name'];
    $tempnews 	= 'images/';
    $namagambar = 'logo.png';
    $uploaddir = $tempnews . $namagambar; 
    $uploads = move_uploaded_file($tmp_files, $uploaddir);
	if (file_exists($uploaddir)){
		@chmod($uploaddir,0644);
	}
	$admin .= '<div class="sukses"><b>Berhasil di Upload.</b></div>';	
		}
		}
	}
$admin .= "
<form method='post' action='' enctype ='multipart/form-data' id='posts'>
<table class='table'><tr><td></td><td valign=top class='border'><img src='images/logo.png'></td></tr>
<tr><td></td><td>Ukuran logo sebaiknya  panjang : 100px ber ekstensi png<br><input type='file' class='form-control' name='gambar' size='53' required></td><tr>
<tr><td></td><td>
<input type='submit' value='Upload' name='submit' class='btn btn-success'></td></tr>
</table>
</form>";

}

if($_GET['aksi']=="tampilan"){
if (isset($_POST['submit'])){
$tampilan = $_POST["tampilan"];
$hasil = $koneksi_db->sql_query( "UPDATE situs SET tampilan='$tampilan' WHERE id='1'" );
}

$hasil =  $koneksi_db->sql_query( "SELECT * FROM situs WHERE id='1'" );
$data = $koneksi_db->sql_fetchrow($hasil);
$id=$data[0];
$tampilan=$data['tampilan'];
$sel2 = '<select name="tampilan"class="form-control">';
$arr2 = array ('table','icon');
foreach ($arr2 as $kk=>$vv){
if($tampilan==$vv){
	$sel2 .= '<option value="'.$vv.'" selected="selected">'.$vv.'</option>';
	}else{
	$sel2 .= '<option value="'.$vv.'">'.$vv.'</option>';
}	
}
$sel2 .= '</select>';

$admin .='<div class="panel-heading"><b>Setting Tampilan</b></div>';
$admin .= "
<form method='post' action='' enctype ='multipart/form-data' id='posts'>
<table class='table'><tr><td>Tampilan</td><td valign=top class='border'>$sel2<br>
*Tampilan hanya dapat dilihat oleh siswa</td></tr>
<tr><td></td><td>
<input type='submit' value='Pilih' name='submit' class='btn btn-success'></td></tr>
</table>
</form>";
}

}
$admin .='</div>';
echo $admin;
?>