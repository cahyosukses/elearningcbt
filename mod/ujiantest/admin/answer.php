<?php
  session_start();

  if(!isset($_SESSION['answer'])) $_SESSION['answer']=array();
  if(isset($_GET['no'],$_GET['choice'])) {
    $no=(int)trim($_GET['no']);
    $choice=$_GET['choice'];
    $_SESSION['answer'][$no]=$choice;
    $pre=print_r($_SESSION['answer'],true);
    echo count($_SESSION['answer']).'#'.$pre;
  }
  if(isset($_POST['selesai'])&&$_POST['selesai']=='Selesai') {
    print_r($_POST);
	$_SESSION['answer']=array();
  }
?>