<?php
  session_start();
  $_SESSION['answer']=array();
?>
<style>
  body {font:12px arial;}
  #timeout {position:absolute;font:30px arial;color:#fff;background-color:#f00;border:3px solid #000;text-align:center;height:80px;line-height:80px;width:300px;top:50%;left:50%;margin:-80px 0 0 -150px;z-index:10;display:none;}
  .tabbutton {border:1px solid #000;padding:2px 5px;border-bottom:1px solid #fff;cursor:pointer;height:15px;}
  .tab {border:1px solid #000;padding:10px 5px 2px 10px;}
</style>
<script>
  var url="";
  var x=0;
  var request=[];
  var onrequest=false;
  if(window.XMLHttpRequest) {xmlhttp=new XMLHttpRequest();}
  else {xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
  xmlhttp.onreadystatechange=function(){
    if(xmlhttp.readyState==4 && xmlhttp.status==200) {
      var res=xmlhttp.responseText.split("#");
      document.getElementById("answered").innerHTML=res[0];
      document.getElementById("session").innerHTML=res[1];
      onrequest=false;
      if(request.length>0) {
        send(request.shift());
      }
    }
  }

  function send(t) {
    if(!onrequest) {
      onrequest=true;
      x=t.getAttribute("name").replace("radio","");
      url="mod/ujiantest/admin/answer.php?no="+x+"&choice="+t.value;
      xmlhttp.open("GET",url,true);
      xmlhttp.send();
    }
    else {
      request.push(t);
    }
  }

  function settab(r) {
    var v=0;
    var t=document.getElementsByClassName("tab");
    var b=document.getElementsByClassName("tabbutton");
    if(r==undefined) {v=1;}
    else {v=r.getAttribute("rel");}
    for(i in b) {
      if(!isNaN(i)) {
        if(b[i].getAttribute("rel")==v) {b[i].style.backgroundColor="#fff";b[i].style.borderBottom="1px solid #fff";}
        else {b[i].style.backgroundColor="#ccc";b[i].style.borderBottom="1px solid #000";}
      }
    }
    for(i in t) {
      if(!isNaN(i)) {
        if(t[i].getAttribute("rel")==v) {t[i].style.display="";}
        else {t[i].style.display="none";}
      }
    }
  }
</script>
<?php
$id     = int_filter($_GET['id']);
$idujian     = int_filter($_GET['idujian']);

?>
<form id="form" method="post" action="mod/ujiantest/admin/answer.php">
  <div style="margin:0 0 2px 5px;">
    <span class="tabbutton" onclick="settab(this);" rel="1">Page 1</span>
    <span class="tabbutton" onclick="settab(this);" rel="2">Page 2</span>
    Sisa waktu : <span id="timer"></span>
  </div>
  <div class="tab" rel="1">
    1. 1 + 1 = ...<br>
    <input type="radio" name="radio1" value="a" onclick="send(this)"> 4<br>
    <input type="radio" name="radio1" value="b" onclick="send(this)"> 7<br>
    <input type="radio" name="radio1" value="c" onclick="send(this)"> 2<br>
    <input type="radio" name="radio1" value="d" onclick="send(this)"> 1<br>
    <input type="radio" name="radio1" value="e" onclick="send(this)"> 9<br><br>
    2. 7 x 1 = ...<br>
    <input type="radio" name="radio2" value="a" onclick="send(this)"> 1<br>
    <input type="radio" name="radio2" value="b" onclick="send(this)"> 17<br>
    <input type="radio" name="radio2" value="c" onclick="send(this)"> 8<br>
    <input type="radio" name="radio2" value="d" onclick="send(this)"> 6<br>
    <input type="radio" name="radio2" value="e" onclick="send(this)"> 7<br><br>
  </div>
  <div class="tab" rel="2">
    3. 3 x 3 = ...<br>
    <input type="radio" name="radio3" value="a" onclick="send(this)"> 20<br>
    <input type="radio" name="radio3" value="b" onclick="send(this)"> 9<br>
    <input type="radio" name="radio3" value="c" onclick="send(this)"> 6<br>
    <input type="radio" name="radio3" value="d" onclick="send(this)"> 8<br>
    <input type="radio" name="radio3" value="e" onclick="send(this)"> 1<br><br>
    4. 4 : 2 = ...<br>
    <input type="radio" name="radio4" value="a" onclick="send(this)"> 5<br>
    <input type="radio" name="radio4" value="b" onclick="send(this)"> 2<br>
    <input type="radio" name="radio4" value="c" onclick="send(this)"> 9<br>
    <input type="radio" name="radio4" value="d" onclick="send(this)"> 1<br>
    <input type="radio" name="radio4" value="e" onclick="send(this)"> 10<br><br>
  </div>
  <br>Soal dijawab : <span id="answered"><?php echo count($_SESSION['answer']); ?></span>
  <br><br>Data tersimpan di session : <span id="session"><?php print_r($_SESSION['answer']); ?></span>
  <br><br><input id="submit" type="submit" name="selesai" value="Selesai" style="border:1px solid #000;background-color:#f00;color:#fff;padding:1px 3px;">
</form>
<div id="timeout">Time Out !!!</div>
<script>
  settab();

  var t=<?php
  /* 
  kalo tanda // di bawah dihapus, 
  biarpun di refresh, sisa waktu kagak bakal balik ke asal 20 detik
  */
  //if(!isset($_SESSION['timer'])) {
  $_SESSION['timer']=date('U');
  // }
  /* waktu cuma di set 20 detik */
  echo 20-(date('U')-$_SESSION['timer']); ?>;
  var t1=0;
  var t2=0;
  var d=document.getElementById("timer");

  function timer() {
    if(t<=0) {
      clearInterval(vtimer);
      document.getElementById("timeout").style.display="block";
      document.getElementById("submit").click();
    }
    t1=t;
    t2=t1%60;
    t1=(t1-t2)/60;
    t1=(t1<10?"0":"")+t1;
    t2=(t2<10?"0":"")+t2;
    d.innerHTML=t1+":"+t2;
    t-=1;
  }
  timer();

  var vtimer=setInterval(function(){timer()},1000);
</script>