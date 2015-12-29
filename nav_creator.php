	<head>                                                       
<script type="text/javascript" src="js/pimg.js"></script>
<script type="text/javascript" >
$(document).ready(function($){
	pimg();
}) 
</script>

<style type="text/css">
#pimg {
	display: none;
	position: absolute;
}
</style>
</head>
<?php
include"koneksi.php";
error_reporting(0);
session_start();
$usernameb=$_SESSION['username'];
$query = "SELECT * FROM user
join agreement_opl on (agreement_opl.user=user.username)
where user.username='$usernameb'";
	$result = mysql_query($query) or die ('error, query failed.'.mysql_error());
	
	while ($row=mysql_fetch_array($result)) {
	$usernamec=$row['username'];
	}
?>
	<div class="row" >
		<div class="span12" >
			<div class="navbar " >
				<div class="navbar-inner" >
					<div class="container-fluid" >
						 <a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="btn btn-navbar"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></a> 
						
						<div class="nav-collapse collapse navbar-responsive-collapse">
						
							<ul class="nav">
								<li>
									<a><img src='img/logokalbe.png' width='95'> <img src='img/LogoTPM.png' width='50'></a>
								</li>
								<li>
									<a href="index.php"><font face='calibri'><b>BERANDA</b></font></a>
								</li><?php
								if ($usernamec == NULL){
									echo"<li>
									<a href='opl_baru_error.php'><font face='calibri'>OPL BARU</font></a>
								</li>";
								} else {
								echo"<li>
									<a href='opl_baru.php'><font face='calibri'><b>OPL BARU</b></font></a>
								</li>";
								}
								?>
								<li>
									<a href="forum_opl.php"><font face='calibri'><b>FORUM</b></font></a>
								</li>
							</ul>
							
							<ul class="nav pull-right">
							<li>
									<a> 
									<b><?php $username=$_SESSION['inisial']; $foto=$_SESSION['foto']; echo"
									<img src='foto/$foto'width='30px'><br/><center><small><font face='calibri'><b>$username</b></font></small></center>"; ?></b></a>
								</li>
								<li>
									<a href="logout.php"> 
									<input type='submit' class="btn btn-danger" value='Keluar'></a>
								</li>
							</ul>
						</div>
						
					</div>
				</div>
				
			</div>
		</div>
	</div>