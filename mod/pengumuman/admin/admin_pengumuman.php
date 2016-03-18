<?php
if (!defined('AURACMS_admin')) {
	Header("Location: ../../../index.php");
	exit;
}
if (!cek_login ()){
   $admin .='<p class="judul">Access Denied !!!!!!</p>';
   exit;
}

$admin = '
<script type="text/javascript" language="javascript">
/*<![CDATA[*/
   function GP_popupConfirmMsg(msg) { //v1.0
  document.MM_returnValue = confirm(msg);
}
function flevPopupLink(){// v1.2
var v1=arguments,v2=window.open(v1[0],v1[1],v1[2]), v3=(v1.length>3)?v1[3]:false;if (v3){v2.focus();}document.MM_returnValue=false;
}
/*]]>*/
</script>';
global $maxadmindata;
if (isset ($_GET['pg'])) $pg = int_filter ($_GET['pg']); else $pg = 0;
if (isset ($_GET['stg'])) $stg = int_filter ($_GET['stg']); else $stg = 0;
if (isset ($_GET['offset'])) $offset = int_filter ($_GET['offset']); else $offset = 0;

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
		toolbar2: "| cut copy paste pastetext | searchreplace | outdent indent blockquote | undo redo | link unlink anchor image code jbimages | forecolor backcolor",
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
js;
$JS_SCRIPT.= <<<js
<script type="text/javascript">
  $(function() {
$( "#tgl" ).datepicker({ dateFormat: "yy-mm-dd" } );
  });
  </script>
js;
$JS_SCRIPT.= <<<js
<script language="JavaScript" type="text/javascript">
$(document).ready(function() {
    $('#example').dataTable({
    "iDisplayLength":50});
} );
</script>
js;

$script_include[] = $JS_SCRIPT;
$total2 =  $koneksi_db->sql_query( "SELECT * FROM pengumuman_sekolah" );
$jumlah2 = $koneksi_db->sql_numrows( $total2 );
$admin .='<section class="content-header">
          <h1>
            Pengumuman
            <small>Mengatur Pengumuman</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="./admin.php?pilih=pengumuman&mod=yes"><i class="fa fa-dashboard"></i>Home</a></li>
			<li>E-Learning</li>
            <li class="active">Pengumuman</li>
          </ol>
        </section>';			
$admin .='
<section class="content-header">
<a class="btn btn-default btn-flat" href="./admin.php?pilih=pengumuman&mod=yes" >
<i class="fa fa-image">&nbsp;</i> Pengumuman <span class="badge bg-green">'.$jumlah2.'</span></a>
<a class="btn btn-default btn-flat" href="./admin.php?pilih=pengumuman&mod=yes&aksi=add" >
<i class="fa fa-plus">&nbsp;</i> Tambah Pengumuman <span class="badge bg-green"></span></a>
</section>';
$admin .='
<section class="content">';			
$admin .= '<div class="box">
                <div class="box-header">
                  <h3 class="box-title">Pengumuman</h3>
                </div><!-- /.box-header -->
                <div class="box-body">';
if($_GET['aksi']=="add"){
if (isset($_POST['submit'])){
$judul     		= addslashes($_POST['judul']);
$konten  = addslashes($_POST['konten']);
$tgl  		= $_POST['tgl'];
$total = $koneksi_db->sql_query( "SELECT * FROM pengumuman_sekolah WHERE judul = '".$_POST['judul']."'");
$jumlah = $koneksi_db->sql_numrows( $total );
$error = '';
if (!$judul)  $error .= "Error: Please enter Title!<br />";
if (!$konten) $error .= "Error: Please enter Content !<br />";

if ($error){
$admin.='<div class="error">'.$error.'</div>';

}else{
	$seftitle    = AuraCMSSEO($judul);
    $user   	 = $_SESSION['UserName'];
	$jumlah='';
$total = $koneksi_db->sql_query( "SELECT * FROM pengumuman_sekolah WHERE seftitle like '%$seftitle%'");
$jumlah = $koneksi_db->sql_numrows( $total );
if ($jumlah){
$seftitle = $seftitle.$jumlah;
}
$hasil = $koneksi_db->sql_query( "INSERT INTO pengumuman_sekolah (tgl,user,judul,konten,seftitle) VALUES ('$tgl','$user','$judul','$konten','$seftitle')" );
if($hasil){
$admin.='<div class="sukses">Berhasil memasukkan Pengumuman dg judul <u>' . stripslashes ($_POST['judul']) . ' </u> - topik '.$topik.'</div>';
unset($judul);
unset($konten);
unset($seftitle);
    }
}
}
$judul 		= !isset($judul) ? '' : $judul;
$seftitle	= !isset($seftitle) ? '' : $seftitle;
$konten	= !isset($konten) ? '' : $konten;
$tglnow = date("Y-m-d");
$tgl 		= !isset($tgl) ? $tglnow : $tgl;
$admin .= "
<form method='post' action='' enctype ='multipart/form-data' id='posts'>
<table cellspacing='5'cellpadding='1' class='table table-striped table-hover'><tr><td>
<label>Judul</label><br /><input type='text' name='judul' class='form-control' value='$judul' size='53' onkeyup=\"genSEF(this,document.forms['posts'].seftitle)\" onchange=\"genSEF(this,document.forms['posts'].seftitle)\">
<input type='hidden' name='seftitle' value='$seftitle' size='53'><br />";
$admin .="
<label>Isi</label><br /><textarea name='konten' id='textarea1'class='form-control'>$konten</textarea><br />";
$admin .='
<label>Tanggal </label><br><input type="text" size="10" name="tgl" id="tgl" value="'.$tgl.'"class="form-control">';
$admin .="
<br /><br />
<input type='submit' value='Simpan' name='submit'  class='btn btn-success'>
</td>";
$admin .= "
</tr></table>
</form>";
}

if($_GET['aksi']=="edit"){
$id     = $_GET['id'];
if (isset($_POST['submit'])){

$judul   = addslashes($_POST['judul']);
$konten  = addslashes($_POST['konten']);
$tgl  		= $_POST['tgl'];
$seftitle    = AuraCMSSEO($judul);
$total 			= $koneksi_db->sql_query( "SELECT * FROM pengumuman_sekolah WHERE judul = '".$_POST['judul']."' and id != '".$id."'");
$jumlah = $koneksi_db->sql_numrows( $total );
$error = '';
if (!$judul)  $error .= "Error: Please enter Title !<br />";

if ($error){
$admin.='<div class="error">'.$error.'</div>';
}else{

    $hasil = $koneksi_db->sql_query( "UPDATE pengumuman_sekolah SET judul='$judul', konten='$konten', seftitle='$seftitle',tgl='$tgl' WHERE id='$id'" );
    if($hasil){
    $admin.='<div class="sukses">Berhasil memasukkan berita dg judul <u>' . stripslashes ($_POST['judul']) . ' </u></div>';
header("location:?pilih=pengumuman&mod=yes");
exit;
    }
}
}
$hasil = $koneksi_db->sql_query( "SELECT * FROM pengumuman_sekolah WHERE id=$id" );
$data = $koneksi_db->sql_fetchrow($hasil);

	$judul     	= $data['judul'];
	$konten  	= $data['konten'];
	$tags     	= $data['tags'];
	$seftitle   = $data['seftitle'];
	$tgl   = $data['tgl'];
$admin .="
<form method='post' action='' enctype ='multipart/form-data' id='posts'>
<table cellspacing='5'cellpadding='1' class='table'><tr><td>
<label>Judul</label><br /><input type='text' name='judul' value='".$judul."' size='100px' class='form-control'><br /><label>Seftitle</label><br />$seftitle";

$admin .="<br />
<label>Isi</label><br /><textarea name='konten' id='textarea1'>".$konten."</textarea><br />";
$admin .='
<label>Tanggal </label><br><input type="text" size="10" name="tgl" id="tgl" value="'.$tgl.'"class="form-control"><br>';
$admin .="
<br /><br />
<input type='submit' value='Simpan' name='submit'  class='btn btn-success'>
</td>";
$admin .="</tr></table>";
}

if($_GET['aksi']=="del"){

global $koneksi_db;
$id     = int_filter($_GET['id']);

$koneksi_db->sql_query("DELETE FROM pengumuman_sekolah WHERE id='$id'");
$admin.='<div class="sukses">Berhasil menghapus Pengumuman Sekolah</div>';
header("location:?pilih=pengumuman&mod=yes");
exit;
}

if($_GET['aksi']==""){
/************************************/
$hasil = $koneksi_db->sql_query( "SELECT * FROM pengumuman_sekolah order by tgl desc" );
$admin .= '<table id="example1" class="table table-striped table-hover">
<thead><tr>
<th width="50px">Tgl</th>
<th width="150px">Judul</th>
<th>Pengumuman</th>
<th width="150px">Aksi</th>
</tr></thead><tbody>';
$no = 1;
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$tgl=tglsort($data['tgl']);
$judul = limitTXT(strip_tags($data['judul']),20);
//$konten=$data['konten'];
$konten = limitTXT(strip_tags($data['konten']),70);
$admin .='<tr>
<td><b>'.$tgl.'</b></td>
<td>'.$judul.'</td>
<td>'.$konten.'</td>
<td><a href="?pilih=pengumuman&amp;mod=yes&amp;aksi=del&amp;id='.$data['id'].'" onclick="return confirm(\'Apakah Anda Yakin Ingin Menghapus Data Ini ?\')" class="btn btn-danger">Hapus</a> <a href="?pilih=pengumuman&amp;mod=yes&amp;aksi=edit&amp;id='.$data['id'].'" class="btn btn-warning">Edit</a></td>
</tr>';
$no++;
}
$admin .= '</tbody></table>';
/************************************/
}
$admin .= '</div><!-- /.box-body -->
</div><!-- /.box -->';
$admin .='</section>';

echo $admin;

?>