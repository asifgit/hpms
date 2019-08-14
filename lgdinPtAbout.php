<?php
	session_start();
	{
		if($_SESSION['RlID']=="")
		{
			header("location:login.php");
		}
		else
		{
			switch ($_SESSION['RlID'])
			{
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
		<title>HMS:Patient About Us</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<link rel="stylesheet" type="text/css" href="asfCSSheets/bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="asfCSSheets/bootstrap-responsive.css">
		<link rel="stylesheet" type="text/css" href="asfCSSheets/mycss.css"/>
		
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
							<li><a href="lgdinPt.php">Home</a></li>
							<li><a href="lgdinPtAbout.php" onclick="return false;" id="clkdMnu">About Us</a></li>
							<li class="dropdown">
								<a href="lgdinPtViewAp.php" class="dropdown-toggle" data-toggle="dropdown">View
									<b class="caret"></b>
								</a>
								<ul class="dropdown-menu">
									<li>
										<a href="lgdinPtViewAp.php?id=1">Appointments</a>
									</li>
									<li>
										<a href="lgdinPtViewAp.php?id=3">Prescriptions</a>
									</li>
									<li>
										<a href="lgdinPtViewAp.php?id=5">Bills</a>
									</li>
									<li>
										<a href="lgdinPtViewAp.php?id=7">Doctors</a>
									</li>
								</ul>
							</li>
							<li><a href="lgdinPtUpdtst.php">Update settings</a></li>
						</ul>
						<form class="navbar-search pull-left" action="" id="srchInNav">
							<?php
								echo "<input type='text' placeholder='Search Doctors Here' class='search-query' data-items='11' data-provide='typeahead' data-source='$strBld'>";
							?>
	                    </form>
						<div class="nav pull-right" id="ulInNav">
							<a href="#" onclick="return false" id="signInDec">Welcome <?php echo $_SESSION['UzrNm']; ?></a>
							<br>
							<a href="myFooter_homeBody/dstrySsn.php" id="signInDec">Sign Out</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php include('myFooter_homeBody/myBodyAbt.php') ?>

		<?php include('myFooter_homeBody/myFtr.php') ?>

	</body>
</html>