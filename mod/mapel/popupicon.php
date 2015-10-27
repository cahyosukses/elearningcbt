<!-------------------------------->
<link rel="stylesheet" media="screen" href="../../includes/media/css/jquery.dataTables.css" />
<script language="javascript" type="text/javascript" src="../../includes/media/js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="../../includes/media/js/jquery.dataTables.js"></script>
<link rel="stylesheet" href="../../includes/bootstrap/css/bootstrap.css" type="text/css">
<!-------------------------------->
<script language="JavaScript" type="text/javascript">
$(document).ready(function() {
    $('#example').dataTable({
    "iDisplayLength":50});
} );
</script>
<script>
  function simpan($icon) {
    window.opener.document.getElementById('id1').value=$icon;
    this.window.close();
  }
  function tutup() {
    this.window.close();
  }
</script>

<?php
include '../../includes/config.php';
include '../../includes/fungsi.php';
include '../../includes/mysql.php';

//$sql = "SELECT * FROM perpus_buku";
//$runsql = mysql_query($sql);
echo '<table class="table table-striped table-hover">
<thead><tr>
<th>No</th>
<th>Icon</th>
<th width="180px">Aksi</th>
</tr></thead><tbody>';
$no=1;
$hasil = $koneksi_db->sql_query( "SELECT * FROM mapel_icon order by id asc" );
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
//while($data=mysql_fetch_array($runsql)){ // while digunakan untuk melakukan perulangan. 
$id=$data['id'];
$icon=$data['icon'];
echo'<tr>
<td><b>'.$no.'</b></td>
<td><img src="'.$icon.'" height="100px"></td>
<td>
<input class="btn btn-success" type="button" value="PILIH" onclick="simpan('.$id.')"></td>
</tr>';
$no++;
}
echo '</tbody></table>';
echo '<div align="center"><input type="button" value="BATAL" onclick="tutup()"class="btn btn-warning"></div>';
?>