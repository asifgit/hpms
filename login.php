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
		<title>HMS:Login Here</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="stylesheet" type="text/css" href="asfCSSheets/bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="asfCSSheets/bootstrap-responsive.css">
		<link rel="stylesheet" type="text/css" href="asfCSSheets/mycss.css"/>
		<link rel="stylesheet" type="text/css" href="asfCSSheets/myIcons.css">

		<script type="text/javascript" src="asfJScript/jquery.min.js"></script>
		<script type="text/javascript" src="asfJScript/bootstrap.js"></script>
		<script type="text/javascript" src="asfJScript/bootstrap-collapse.js"></script>
		<script type="text/javascript" src="asfJScript/bootstrap-typeahead.js">
			$('.typeahead').typeahead();
		</script>

		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
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
							<li><a href="zzAboutUs.php">About Us</a></li>
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
							<div id="signInDecClkd">
								<a href="login.php" style="background-color: #75004f;color: WHITE;" onclick="return false; "id="signInDecClkd">Sign in</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="container-fluid" id="Login">
			<div class="row-fluid" id="InLogin">
				<div class="span8 offset2" id="InLoginHdr">
					<div>
						<h2 id="">Login Here</h2>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span8 offset2" id="divLgUpdt">
						<div class="span4 offset1">
							<img class="img-circle" src="Images/Login_Settings/admin.jpg">
						</div>
						<div class="span7">
							<div id="msgLoginResponse"><span class="label label-important" id="VLDINVLDMSG"></span>.</div>
							<form action="myFooter_homeBody/checkLogin.php" name="signin" method="POST" class="form-horizontal">
								<br>User Name : 
								<input type="text" name="username" id="loginUserName">
								<br><br>Password&nbsp;&nbsp; : 
								<input type="password" name="password">
								<br><br>
								<center>
									<button class=" btn btn-info" type="SUBMIT" value="Login">
										<img id="icon-users" class="img-rounded"> Sign in
									</button>
								</center>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php include('myFooter_homeBody/myFtr.php') ?>

		<?php
			if(empty($_GET))
				echo'
					<script type="text/javascript">
						console.log("Direct user on login page.");
					</script>
				';
			else
			{
				if($_GET['invalid']==1)
					echo'
						<script type="text/javascript">
							document.getElementById("VLDINVLDMSG").className	=	"label label-important";
							document.getElementById("VLDINVLDMSG").innerText	=	"Invalid User name or Password";
							document.getElementById("loginUserName").autofocus	=	true;
						</script>
					';
				if($_GET['loggedOut']==1)
					echo'
						<script type="text/javascript">
							document.getElementById("VLDINVLDMSG").className	=	"label label-success";
							document.getElementById("VLDINVLDMSG").innerText	=	"Logged out successfully";
						</script>
					';
			}
		?>

	</body>
</html>