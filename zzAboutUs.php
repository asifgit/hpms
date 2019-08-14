<?php
	session_start();
	{
		if(empty($_SESSION))
		{
			;//echo "jjnjnjnj";
		}
		else
		{
			switch ($_SESSION['RlID'])
			{
				case '2':
						header("location:lgdinPt.php");
						break;
				case '3':
						header("location:lgdinRcHome.php");
						break;
				case '4':
						header("location:lgdinPhHome.php");
						break;
				case '5':
						header("location:admin_new/lgdinAdminHome.php");
						break;
				case '1':
						session_destroy();
						header("location:login.php");
						break;
			};
		}
	}
?>
<!doctype html>
<html>
	<head>
		<title>HMS:About Us</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="stylesheet" type="text/css" href="asfCSSheets/bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="asfCSSheets/bootstrap-responsive.css">
		<link rel="stylesheet" type="text/css" href="asfCSSheets/mycss.css"/>
		<link rel="stylesheet" type="text/css" href="asfCSSheets/myIcons.css">

		<script type="text/javascript" src="asfJScript/jquery.min.js"></script>
		<script type="text/javascript" src="asfJScript/bootstrap.js"></script>
		<script type="text/javascript" src="asfJScript/bootstrap-carousel.js">
			$('.carousel').carousel()
		</script>
		<script type="text/javascript" src="asfJScript/bootstrap-collapse.js"></script>
		<script type="text/javascript" src="asfJScript/bootstrap-typeahead.js">
			$('.typeahead').typeahead();
		</script>

		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
		<style>
			#slideShowImages
			{
			background-color: gray;
			}   

			#slideShowImages img
			{
			border: 0.8em black solid;
			padding: 3px;
			}   
		</style>
	</head>	
	<body>

		<?php include('myFooter_homeBody/mySrchListDocs.php') ?>
		<?php  include('myFooter_homeBody/myDate.php') ?>

		<div class="navbar navbar-inverse navbar-static-top">
			<div class="navbar-inner">
				<div class="container">
					<a class="btn btn-navbar" id="ulInNav" data-toggle="collapse" data-target=".navbar-inverse-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<?php include('myFooter_homeBody/myBrandLogo.php') ?>
					<div class="nav-collapse navbar-inverse-collapse collapse">
						<ul class="nav" id="ulInNav">
							<li><a href="default.php">Home</a></li>
							<li><a href="zzAboutUs.php" onclick="return false;" id="clkdMnu">About Us</a></li>
							<li><a href="" onclick="return false">Missions</a></li>
							<li><a href="" onclick="return false">Pharmacy</a></li>
							<li><a href="" onclick="return false">Diseases</a></li>
						</ul>
						<form class="navbar-search pull-left" action="" id="srchInNav">
							<?php
								echo "<input type='text' placeholder='Search Doctors Here' class='search-query' data-items='11' data-provide='typeahead' data-source='$strBld'>";
							?>
	                    </form>
						<div class="nav pull-right" id="ulInNav">
							<a href="login.php" id="signInDec"><img id="icon-users" class="img-circle"> Sign in</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php include('myFooter_homeBody/myBodyAbt.php') ?>

		<?php include('myFooter_homeBody/myFtr.php') ?>

	</body>
</html>