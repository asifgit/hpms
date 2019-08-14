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
		<title>HMS:Patient Update settings</title>
		<link rel="stylesheet" type="text/css" href="asfCSSheets/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="asfCSSheets/bootstrap-responsive.css">
		<link rel="stylesheet" type="text/css" href="asfCSSheets/mycss.css">

		<script type="text/javascript" src="asfJScript/jquery.min.js"></script>
		<script type="text/javascript" src="asfJScript/bootstrap.js"></script>
		<script type="text/javascript" src="asfJScript/bootstrap-collapse.js"></script>
		<script type="text/javascript" src="asfJScript/changePWJS.js"></script>
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
							<li><a href="lgdinPtAbout.php">About Us</a></li>
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
							<li><a href="lgdinPtUpdtst.php" onclick="return false;" id="clkdMnu">Update settings</a></li>
						</ul>
						<div class="navbar-search pull-left" action="" id="srchInNav">
							<?php
								echo "<input type='text' placeholder='Search Doctors Here' class='search-query' data-items='11' data-provide='typeahead' data-source='$strBld'>";
							?>
	                    </div>
						<div class="nav pull-right" id="ulInNav">
							<a href="#" onclick="return false" id="signInDec">Welcome <?php echo $_SESSION['UzrNm']; ?></a>
							<br>
							<a href="myFooter_homeBody/dstrySsn.php" id="signInDec">Sign Out</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="container-fluid" id="Update">
			<div class="row-fluid" id="InUpdate">
				<div class="span10 offset1" id="InUpdateHdr">
					<div>
						<h2 id="">Change Password</h2>
					</div>
					<?php include('myFooter_homeBody/myGetOldPw.php');?>
				</div>
				<div class="row-fluid">
					<div class="span10 offset1" id="divLgUpdt">
						<div class="span3 offset1">
							<img class="img-rounded" src="Images/Login_Settings/admin.jpg">
						</div>
						<div class="span8">
							<!--<form action="myFooter_homeBody/myUpdtSettings.php" name="ChangPW" method="POST" class="form-horizontal">-->
							<form name="ChangPW" method="POST" action="myFooter_homeBody/updatePW.php" class="form-horizontal">
								<div class="row-fluid">
									<div class="span7">
										Old Password &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :
										<input type="password" name="oldP" id="OldPW" oninput="inzero();" onfocus="inzero();" autofocus>
										<input type="hidden" name="diRuser" value="1">
									</div>
									<div style="text-align:left;" class="span4" id="txtInFrntOfPW"></div>
								</div>
								<br><br>
								<div class="row-fluid">
									<div class="span7">
										New Password &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :<input type="password" name="newP1" id="NewPW1" oninput="inone_and_two();" onfocus="inone_and_two();">
									</div>
									<div style="text-align:left;" class="span4" id="txtInFrntOfPW1"></div>
								</div>
								<br><br> 
								<div class="row-fluid">
									<div class="span7">
										Confirm Password :<input type="password" name="newP2" id="NewPW2" oninput="inone_and_two();" onfocus="inone_and_two();">
									</div>
									<div style="text-align:left;" class="span3" id="txtInFrntOfPW2"></div>
								</div>
								<br><br>
								<center>
									<button type="submit" id="chngpwbtn" class=" btn btn-info" value="Login">Change now</button>
								</center>
								
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php include('myFooter_homeBody/myFtr.php') ?>

		

	</body>
</html>