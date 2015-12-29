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
								</li>
							</ul>
							
							<ul class="nav pull-right">
							<li>
									<a href="#"> 
									<b><?php $username=$_SESSION['fullname']; echo"<font face='calibri'>$username</font>"; ?></b></a>
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