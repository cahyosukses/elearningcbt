<script>
  settab();

  var t=<?php
  /* 
  kalo tanda // di bawah dihapus, 
  biarpun di refresh, sisa waktu kagak bakal balik ke asal 20 detik
  */
  if(!isset($_SESSION['timer']))$_SESSION['timer']=date('U');
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