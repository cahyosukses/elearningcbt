<?php


error_reporting(0);

/*---------------------------------------------------------------------------------
 konfigurasi database
---------------------------------------------------------------------------------*/
define('AURACMS_FUNC', true);


$mysql_user = 'root';
$mysql_password = '';
$mysql_database = 'elearningcbt';
$mysql_host = 'localhost';
/*
$mysql_user = 'psbfrate_cbt';
$mysql_password = 'elearningcbt';
$mysql_database = 'psbfrate_cbt';
$mysql_host = 'localhost';
*/
/*---------------------------------------------------------------------------------
 konfigurasi situs dan email
---------------------------------------------------------------------------------*/

//$email_master='';
//$theme='tcms';
//$judul_situs='';
//$url_situs= '';
//$slogan = '';
$adminfile = 'admin'; //silahkan di ganti dan jangan lupa merename file admin.php  sesuai dg yang anda ganti
$editor ='1';  //Jika menggunakan WYSIWYG isi 1 jika tidak 0
$name_blocker = '';
$mail_blocker = '';

//$_META['description'] = '';
//$_META['keywords'] = 'ada';

//$maxkonten=50;
//$maxadmindata = 20;
//$maxdata = 10;
$translateKal = array( 'Mon' => 'Senin',
      'Tue' => 'Selasa',
      'Wed' => 'Rabu',
      'Thu' => 'Kamis',
      'Fri' => 'Jumat',
      'Sat' => 'Sabtu',
      'Sun' => 'Minggu',
      'Jan' => 'Januari',
      'Feb' => 'Februari',
      'Mar' => 'Maret',
      'Apr' => 'April',
      'May' => 'Mei',
      'Jun' => 'Juni',
      'Jul' => 'Juli',
      'Aug' => 'Agustus',
      'Sep' => 'September',
      'Oct' => 'Oktober',
      'Nov' => 'Nopember',
      'Dec' => 'Desember');

if (file_exists('includes/fungsi.php')){
 include 'includes/fungsi.php';
}
if (file_exists('includes/Mobile_Detect.php')){
 include 'includes/Mobile_Detect.php';
}

?>