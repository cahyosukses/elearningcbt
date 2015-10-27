<?php
if (!defined('AURACMS_admin')) {
	Header("Location: ../index.php");
	exit;
}

//$index_hal = 1;
$admin = '';
if (!cek_login ()){   
	
$admin .='<p class="judul">Access Denied !!!!!!</p>';
}else{
	
$admin .='<h4 class="bg">Menu Manager</h4>';

if($_GET['aksi']== 'delma'){    
	global $koneksi_db;    
	$id     = int_filter($_GET['id']);    
	$hasil = $koneksi_db->sql_query("DELETE FROM `admin` WHERE `id`='$id'");    
	if($hasil){    
		$admin.='<div class="sukses">Menu Admin berhasil dihapus! .</div>';    
		$style_include[] ='<meta http-equiv="refresh" content="1; url=admin.php?pilih=menu&mod=yes&aksi=menuadmin" />';    
	}
}

if($_GET['aksi'] == 'editma'){
$id = int_filter ($_GET['id']);
$tengah = '';
if(isset($_POST['submit'])){
	$menu 		= $_POST['menu'];
	$url 		= $_POST['url'];
	$mod		= $_POST['mod'];
	$parent   = $_POST['parent'];
	$error 	= '';
	if (!$menu)  	$error .= "Error: Silahkan Isi Nama Menunya<br />";
	if (!$url)   	$error .= "Error: Silahkan Isi Urlnya<br />";
	if ($error){
		$tengah .= '<div class="error">'.$error.'</div>';
	}else{
		$hasil  = mysql_query( "UPDATE `admin` SET `menu`='$menu' ,`url`='$url' ,`mod`='$mod',`parent`='$parent' WHERE `id`='$id'" );
		if($hasil){
			$tengah .= '<div class="sukses"><b>Menu Berhasil di Update.</b></div>';
			$style_include[] ='<meta http-equiv="refresh" content="1; url=admin.php?pilih=menu&mod=yes&aksi=menuadmin" />';	
		}else{
			$tengah .= '<div class="error"><b>Menu Gagal di Update.</b></div>';
		}
	}

}
$query 		= mysql_query ("SELECT * FROM `admin` WHERE `id`='$id'");
$data 		= mysql_fetch_array($query);
$cekmod		= $data['mod'];
$parent		= $data['parent'];
$tengah .= '
<div class="border">
<form method="post" action="">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="padding-left: 5px; padding-right: 5px; padding-top: 5px; padding-bottom: 0">Nama Menu</td>
		<td style="padding-left: 5px; padding-right: 5px; padding-top: 5px; padding-bottom: 0">:</td>
		<td style="padding-left: 5px; padding-right: 5px; padding-top: 5px; padding-bottom: 0"><input type="text" name="menu" value="'.$data['menu'].'" size="25"></td>
	</tr>
	<tr>
		<td style="padding-left: 5px; padding-right: 5px; padding-top: 5px; padding-bottom: 0">URL</td>
		<td style="padding-left: 5px; padding-right: 5px; padding-top: 5px; padding-bottom: 0">:</td>
		<td style="padding-left: 5px; padding-right: 5px; padding-top: 5px; padding-bottom: 0"><input type="text" name="url" value="'.$data['url'].'" size="25"></td>
	</tr>
	<tr>
		<td style="padding-left: 5px; padding-right: 5px; padding-top: 5px; padding-bottom: 0">Status Modul</td>
		<td style="padding-left: 5px; padding-right: 5px; padding-top: 5px; padding-bottom: 0">:</td>
		<td style="padding-left: 5px; padding-right: 5px; padding-top: 5px; padding-bottom: 0"><select name="mod">';
if($cekmod == 1){
	$tengah .= '<option value="0">Tidak</option><option value="1" selected>Ya</option>';
}else{
	$tengah .= '<option value="0" selected>Tidak</option><option value="1">Ya</option>';
}
$tengah .= '
		</select></td>
	</tr>
<tr>            
		<td style="padding-left: 5px; padding-right: 5px; padding-top: 5px; padding-bottom: 0">Sub Dari</td>
		<td style="padding-left: 5px; padding-right: 5px; padding-top: 5px; padding-bottom: 0">:</td>
		<td style="padding-left: 5px; padding-right: 5px; padding-top: 5px; padding-bottom: 0"><select name="parent">';
			$tengah .='<option value="0" selected> None </option>';
$hasil = $koneksi_db->sql_query( "SELECT * FROM admin where parent='0' ORDER BY ordering" );
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
	$pilihan = ($data[0]==$parent)?"selected":'';
	$tengah .='<option value="'.$data['0'].'" '.$pilihan.'>'.$data[1].'</option>';
}

$tengah .='</select>        
</td>        
</tr> 
	<tr>
		<td style="padding-left: 5px; padding-right: 5px; padding-top: 5px; padding-bottom: 0"></td>
		<td style="padding-left: 5px; padding-right: 5px; padding-top: 5px; padding-bottom: 0"></td>
		<td style="padding-left: 5px; padding-right: 5px; padding-top: 5px; padding-bottom: 0">
		<input type="submit" value="Submit" name="submit"></td>
	</tr>
</table>
</form>
</div>';	
$admin .= $tengah;
}

if($_GET['aksi']=="menuadmin" or $_GET['aksi']==""){
if($_GET['op']== 'mup'){
$ID = int_filter ($_GET['id']);
$select = $koneksi_db->sql_query ("SELECT MAX(ordering) as sc FROM admin where parent ='0'");
$data = $koneksi_db->sql_fetchrow ($select);
$total = $data['sc'] + 1;
$update = $koneksi_db->sql_query ("UPDATE admin SET ordering='$total' WHERE ordering='".($ID-1)."'"); 
$update = $koneksi_db->sql_query ("UPDATE admin SET ordering=ordering-1 WHERE ordering='$ID'");
$update = $koneksi_db->sql_query ("UPDATE admin SET ordering='$ID' WHERE ordering='$total'");   
header ("location:admin.php?pilih=menu&mod=yes&aksi=menuadmin");
}
if($_GET['op']== 'mdown'){
$ID = int_filter ($_GET['id']);
$select = $koneksi_db->sql_query ("SELECT MAX(ordering) as sc FROM admin where parent ='0'");
$data = $koneksi_db->sql_fetchrow ($select);
$total = $data['sc'] + 1;
$update = $koneksi_db->sql_query ("UPDATE admin SET ordering='$total' WHERE ordering='".($ID+1)."'"); 
$update = $koneksi_db->sql_query ("UPDATE admin SET ordering=ordering+1 WHERE ordering='$ID'");
$update = $koneksi_db->sql_query ("UPDATE admin SET ordering='$ID' WHERE ordering='$total'");    
header ("location:admin.php?pilih=menu&mod=yes&aksi=menuadmin");
}
if(isset($_POST['submit'])){
	$menu 		= $_POST['menu'];
	$url 		= $_POST['url'];
	$mod		= $_POST['mod'];
	$parent		= $_POST['parent'];
	if($parent=='0'){
	$ceks 		= mysql_query ("SELECT MAX(ordering) as ordering FROM admin where parent='0'");
	}else{
	$ceks 		= mysql_query ("SELECT MAX(ordering) as ordering FROM admin where parent = $parent");
	}
    $hasil 		= mysql_fetch_array ($ceks);
    $ordering 	= $hasil['ordering'] + 1;
	$error 	= '';
	if (!$menu)  	$error .= "Error: Silahkan Isi Nama Menunya<br />";
	if (!$url)   	$error .= "Error: Silahkan Isi Urlnya<br />";
	if ($error){
		$admin .= '<div class="error">'.$error.'</div>';
	}else{
		$hasil  = mysql_query( "INSERT INTO `admin` (`menu` ,`url` ,`mod` ,`ordering`,`parent`) VALUES ('$menu','$url','$mod','$ordering','$parent')" );
		if($hasil){
			$admin .= '<div class="sukses"><b>Menu Berhasil di Buat.</b></div>';
		}else{
			$admin .= '<div class="error"><b>Menu Gagal di Buat.</b></div>';
		}
		unset($menu);
		unset($url);
		unset($parent);
	}

}
$menu     		= !isset($menu) ? '' : $menu;
$url     		= !isset($url) ? '' : $url;
$parent     		= !isset($parent) ? '' : $parent;
$selparent .= '
<select name="parent" size="1" />';
$hasil = $koneksi_db->sql_query("SELECT * FROM `admin` WHERE `parent`='0' ORDER BY `id` ASC");
$selparent .= '<option value="0">None</option>';
while ($data =  $koneksi_db->sql_fetchrow ($hasil)){
$id = $data['id'];
$selparent .= '<option value="'.$data['id'].'">'.$data['menu'].'</option>';
}
$selparent .= '
		</select>';
$admin .= '
<div class="border">
<form method="post" action="">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="padding-left: 5px; padding-right: 5px; padding-top: 5px; padding-bottom: 0">Nama Menu</td>
		<td style="padding-left: 5px; padding-right: 5px; padding-top: 5px; padding-bottom: 0">:</td>
		<td style="padding-left: 5px; padding-right: 5px; padding-top: 5px; padding-bottom: 0"><input type="text" name="menu" value="'.$menu.'" size="30"></td>
	</tr>
	<tr>
		<td style="padding-left: 5px; padding-right: 5px; padding-top: 5px; padding-bottom: 0">URL</td>
		<td style="padding-left: 5px; padding-right: 5px; padding-top: 5px; padding-bottom: 0">:</td>
		<td style="padding-left: 5px; padding-right: 5px; padding-top: 5px; padding-bottom: 0"><input type="text" name="url" value="'.$url.'" size="50"></td>
	</tr>
	<tr>
		<td style="padding-left: 5px; padding-right: 5px; padding-top: 5px; padding-bottom: 0">Parent</td>
		<td style="padding-left: 5px; padding-right: 5px; padding-top: 5px; padding-bottom: 0">:</td>
		<td style="padding-left: 5px; padding-right: 5px; padding-top: 5px; padding-bottom: 0">'.$selparent.'</td>
	</tr>
	<tr>
		<td style="padding-left: 5px; padding-right: 5px; padding-top: 5px; padding-bottom: 0">Status Modul</td>
		<td style="padding-left: 5px; padding-right: 5px; padding-top: 5px; padding-bottom: 0">:</td>
		<td style="padding-left: 5px; padding-right: 5px; padding-top: 5px; padding-bottom: 0"><select name="mod"><option value="0">Tidak</option><option value="1">Ya</option></select></td>
	</tr>
	<tr>
		<td style="padding-left: 5px; padding-right: 5px; padding-top: 5px; padding-bottom: 0"></td>
		<td style="padding-left: 5px; padding-right: 5px; padding-top: 5px; padding-bottom: 0"></td>
		<td style="padding-left: 5px; padding-right: 5px; padding-top: 5px; padding-bottom: 0">
		<input type="submit" value="Publish" name="submit" class="button"></td>
	</tr>
</table>
</form>
</div>';	
$hasil = $koneksi_db->sql_query( "SELECT * FROM admin WHERE parent='0' ORDER BY ordering" );

$querymax = mysql_query ("SELECT MAX(`ordering`) FROM `admin` WHERE parent='0'");
$alhasil = mysql_fetch_row($querymax);	
$numbers_parent = $alhasil[0];

$admin .='<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #DFDFDF; border-radius:5px;">
<tr style="background:url(images/bg-tabel.png) top center repeat-x; font-family:Georgia; font-size:14px;">
<td style="width:20px; text-align:center;padding:9px 10px 9px 10px; border-bottom:1px solid #DFDFDF;">No</td>
<td style="text-align:left; padding:9px 10px 9px 10px; border-bottom:1px solid #DFDFDF;">Menu Item</td>
<td style="text-align:left; padding:9px 10px 9px 10px; border-bottom:1px solid #DFDFDF;">Url</td>
<td style="text-align:center; padding:9px 10px 9px 10px; border-bottom:1px solid #DFDFDF;">Order</td>
<td colspan="2" style="text-align:center; padding:9px 10px 9px 10px; border-bottom:1px solid #DFDFDF;">Aksi</td>
</tr>';
$no = 1;
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$parentid=$data[0];
$urlmenuadmin=$data[2];
$orderd = '<a class="image" href="admin.php?pilih=menu&amp;mod=yes&amp;aksi=menuadmin&amp;op=mdown&amp;id='.$data['ordering'].'"><img src="images/downarrow-1.png" border="0" alt="down" /></a>';    
$orderu = '<a class="image" href="admin.php?pilih=menu&amp;mod=yes&amp;aksi=menuadmin&amp;op=mup&amp;id='.$data['ordering'].'"><img src="images/uparrow-1.png" border="0" alt="up" /></a>';    

   
$ordering_down = $orderd;    
$ordering_up = $orderu;        

if ($data['ordering'] == 1) $ordering_up = '&nbsp;&nbsp;&nbsp;';
if ($data['ordering'] == $numbers_parent) $ordering_down = '&nbsp;';	

$admin .='<tr bgcolor="#E8F8FF">
<td style="text-align:center; padding:4px 10px 4px 10px; border-bottom:1px solid #DFDFDF;"><b>'.$no.'</b></td>
<td style="padding:4px 10px 4px 10px; border-bottom:1px solid #DFDFDF;"><a href="'.$data['url'].'"><b>'.$data['menu'].'</b></a></td>
<td style="text-align:left; padding:4px 10px 4px 10px; border-bottom:1px solid #DFDFDF;">'.$urlmenuadmin.'</td>
<td style="text-align:center; padding:4px 10px 4px 10px; border-bottom:1px solid #DFDFDF;">'.$ordering_up.'  '.$ordering_down.'</td>
<td style="text-align:center; padding:4px 10px 4px 10px; border-bottom:1px solid #DFDFDF;"><a href="?pilih=menu&amp;mod=yes&amp;aksi=delma&amp;id='.$data['id'].'" onclick="return confirm(\'Apakah Anda Yakin Ingin Menghapus Data Ini ?\')"><img border="0" src="images/delete.gif" alt="del" /></a></td>
<td style="text-align:center; padding:4px 10px 4px 10px; border-bottom:1px solid #DFDFDF;"><a href="?pilih=menu&amp;mod=yes&amp;aksi=editma&amp;id='.$data['id'].'"><img border="0" src="images/edit.gif" alt="edit" /></a></td>
</tr>';

$subhasil = $koneksi_db->sql_query( "SELECT * FROM admin WHERE parent='$parentid' ORDER BY menu ");		
$jmlsub = $koneksi_db->sql_numrows( $subhasil );	
$querymax = mysql_query ("SELECT MAX(`ordering`) FROM `admin` WHERE parent=$parentid");
$alhasil = mysql_fetch_row($querymax);	
$numbers = $alhasil[0];
if ($jmlsub>0) {
$warna = '';		
$i = 1;
while ($subdata = $koneksi_db->sql_fetchrow($subhasil)) {
$urlmenuadmin=$subdata[2];            
$orderd = '<a class="image" href="admin.php?pilih=menu&amp;mod=yes&amp;aksi=menuadmin&amp;op=down&amp;id='.$data['ordering'].'"><img src="images/downarrow.png" border="0" alt="down" /></a>';    
$orderu = '<a class="image" href="admin.php?pilih=menu&amp;mod=yes&amp;aksi=menuadmin&amp;op=up&amp;id='.$data['ordering'].'"><img src="images/uparrow.png" border="0" alt="up" /></a>'; 

$ordering_down = $orderd;    
$ordering_up = $orderu;        

if ($data['ordering'] == 1) $ordering_up = '&nbsp;&nbsp;&nbsp;';
if ($data['ordering'] == $numbers) $ordering_down = '&nbsp;';		

$warna = empty ($warna) ? ' bgcolor="#f5f5f5"' : '';

$admin .='<tr '.$warna.'>
<td style="text-align:center; padding:4px 10px 4px 10px; border-bottom:1px solid #DFDFDF;"></td>
<td style="padding:4px 10px 4px 10px; border-bottom:1px solid #DFDFDF;"><img src="images/1.gif" alt="" border="" /> <a href="'.$subdata['url'].'">'.$subdata['menu'].'</a></td>
<td style="text-align:left; padding:4px 10px 4px 10px; border-bottom:1px solid #DFDFDF;">'.$urlmenuadmin.'</td>
<td style="text-align:center; padding:4px 10px 4px 10px; border-bottom:1px solid #DFDFDF;"></td>
<td style="text-align:center; padding:4px 10px 4px 10px; border-bottom:1px solid #DFDFDF; width:20px;"><a href="?pilih=menu&amp;mod=yes&amp;aksi=delma&amp;id='.$subdata['id'].'" onclick="return confirm(\'Apakah Anda Yakin Ingin Menghapus Data Ini ?\')"><img border="0" src="images/delete.gif" alt="del" /></a></td>
<td style="text-align:center; padding:4px 10px 4px 10px; border-bottom:1px solid #DFDFDF; width:20px;"><a href="?pilih=menu&amp;mod=yes&amp;aksi=editma&amp;id='.$subdata['id'].'"><img border="0" src="images/edit.gif" alt="edit" /></a></td>
</tr>';
$i++;		
}		
}
unset($numbers);
$no++;
}
$admin .= '<tr><td colspan="5" style="text-align:center; padding:4px 10px 4px 10px;">&nbsp;</td></tr></table>';
}

}
echo $admin;

?>