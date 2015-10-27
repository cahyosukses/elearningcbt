<?php
if(ereg("menu.php",$_SERVER['PHP_SELF']))
{header("location:index.php");
die; }
global $koneksi_db;
echo '<ul id="menu" class="menu">';
$hasil = $koneksi_db->sql_query( "SELECT * FROM menu where published = 1 ORDER BY ordering" );
while ($data = $koneksi_db->sql_fetchrow($hasil)) {
$parent= $data['id'];
$url = $data['url'];
//$link_menu = '<a class="menulink" href ='.$url.'>'.$data['menu'].'</a>';
$hasil2 = $koneksi_db->sql_query( "SELECT * FROM submenu WHERE parent ='$parent' and published = 1 ORDER BY ordering" );
if($hasil2){
echo '<li ><a class="menulink" href ="'.$url.'">'.$data['menu'].'</a><ul>';
}else{
echo '<li><a class="menulink" href ="'.$url.'">'.$data['menu'].'</a></li>';
}
while ($data2 = $koneksi_db->sql_fetchrow($hasil2)) {
$parent2= $data2['id'];
//$link_menu2 = $data2['menu'];
$url2 = $data2['url'];
//$link_menu2 = '<a class="menulink"  href ='.$url2.'>'.$data2['menu'].'</a>';
$hasil3 = $koneksi_db->sql_query( "SELECT * FROM subsubmenu WHERE parent ='$parent2' and published = 1 ORDER BY ordering" );
if($hasil3){
echo '<li><a class="sub" href ='.$url2.'>'.$data2['menu'].'</a><ul>';
}else{
echo '<li><a class="topline" href ='.$url2.'>'.$data2['menu'].'</a></li>';
}
while ($data3 = $koneksi_db->sql_fetchrow($hasil3)) {
$parent3= $data3['id'];
//$link_menu3 = $data3['menu'];
$url3 = $data3['url'];
//$link_menu3 = '<a class="menulink"  href ='.$url3.'>'.$data3['menu'].'</a>';
$hasil4 = $koneksi_db->sql_query( "SELECT * FROM subsubmenu WHERE parent ='$parent3' and published = 1 ORDER BY ordering" );
if($hasil4){
echo '<li><a href ='.$url3.'>'.$data3['menu'].'</a><ul>';
}else{
echo '<li><a class="topline" href ='.$url3.'>'.$data3['menu'].'</a></li>';
}

## whilehasil4 ul
if($hasil4){
echo '</ul>';
}
## whilehasil3
}
## whilehasil3 ul
if($hasil3){
echo '</ul>';
}
## whilehasil2
}
## whilehasil2 ul
if($hasil2){
echo '</ul>';
}
## whilehasil
}
/*echo '<ul class="menu" id="menu">
	<li><a href="#" class="menulink">Dropdown One</a>
		<ul>

			<li><a href="#">Navigation Item 1</a></li>
			<li>
				<a href="#" class="sub">Navigation Item 2</a>
				<ul>
					<li class="topline"><a href="#">Navigation Item 1</a></li>
					<li><a href="#">Navigation Item 2</a></li>
					<li><a href="#">Navigation Item 3</a></li>

					<li><a href="#">Navigation Item 4</a></li>
					<li><a href="#">Navigation Item 5</a></li>
				</ul>
			</li>
			<li>
				<a href="#" class="sub">Navigation Item 3</a>
				<ul>

					<li class="topline"><a href="#">Navigation Item 1</a></li>
					<li><a href="#">Navigation Item 2</a></li>
					<li>
						<a href="#" class="sub">Navigation Item 3</a>
						<ul>
							<li class="topline"><a href="#">Navigation Item 1</a></li>
							<li><a href="#">Navigation Item 2</a></li>

							<li><a href="#">Navigation Item 3</a></li>
							<li><a href="#">Navigation Item 4</a></li>
							<li><a href="#">Navigation Item 5</a></li>
							<li><a href="#">Navigation Item 6</a></li>
						</ul>
					</li>
					<li><a href="#">Navigation Item 4</a></li>

				</ul>
			</li>
			<li><a href="#">Navigation Item 4</a></li>
			<li><a href="#">Navigation Item 5</a></li>
		</ul>
	</li>
	<li><a href="#" class="menulink">Non-Dropdown</a></li>

	<li>
		<a href="#" class="menulink">Dropdown Two</a>
		<ul>
			<li><a href="#">Navigation Item 1</a></li>
			<li>
				<a href="#" class="sub">Navigation Item 2</a>
				<ul>

					<li class="topline"><a href="#">Navigation Item 1</a></li>
					<li><a href="#">Navigation Item 2</a></li>
					<li><a href="#">Navigation Item 3</a></li>
				</ul>
			</li>
		</ul>
	</li>

	<li>
		<a href="#" class="menulink">Dropdown Three</a>
		<ul>
			<li><a href="#">Navigation Item 1</a></li>
			<li><a href="#">Navigation Item 2</a></li>
			<li><a href="#">Navigation Item 3</a></li>
			<li><a href="#">Navigation Item 4</a></li>

			<li><a href="#">Navigation Item 5</a></li>
			<li>
				<a href="#" class="sub">Navigation Item 6</a>
				<ul>
					<li class="topline"><a href="#">Navigation Item 1</a></li>
					<li><a href="#">Navigation Item 2</a></li>
				</ul>

			</li>
			<li><a href="#">Navigation Item 7</a></li>
			<li><a href="#">Navigation Item 8</a></li>
			<li><a href="#">Navigation Item 9</a></li>
			<li><a href="#">Navigation Item 10</a></li>
		</ul>
	</li>

</ul>';*/

?>
<script type="text/javascript">
	var menu=new menu.dd("menu");
	menu.init("menu","menuhover");
</script>