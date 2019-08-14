<?php
	include('cnct.php');

	$uzrNm	=	$_POST['username'];
	$uzrPs	=	$_POST['password'];

	//echo $uzrNm . ' - ' . $uzrPs;

	$qry="SELECT UID, URID, ULNaam, UFNaam FROM hmsaaausers WHERE UNaam = '$uzrNm' AND UPwd = '$uzrPs'";
	$rzLogin	=	mysqli_query($con, $qry);
	if(!$rzLogin)
	{
		echo "Failed to load.";
	}
	else
	{
		if(mysqli_num_rows($rzLogin)==0)
		{
			header("location:../login.php?invalid=1");
		}
		else
		{
			$_SESSION['UzrNm']	=	"";
			$_SESSION['FlID']	=	"";
			$_SESSION['RlID']	=	"";
			while($rowOfLoggedInUser=mysqli_fetch_assoc($rzLogin))
			{
				session_start();
				$_SESSION['UzrNm']	=	$rowOfLoggedInUser['UFNaam'];
				$_SESSION['FlID']	=	$rowOfLoggedInUser['UID'];
				$_SESSION['RlID']	=	$rowOfLoggedInUser['URID'];
			}
			if($_SESSION['RlID']==1)
			{
				echo "Doctors are not allowed to login here.";
			}
			else
			{
				echo $_SESSION['UzrNm'] . '<br>UID: ' . $_SESSION['FlID'] . '<br>Role ID: ' . $_SESSION['RlID'];
				switch($_SESSION['RlID'])
				{
					case '2':
							header("location:../lgdinPt.php");
							break;
					case '3':
							header("location:../lgdinRcHome.php");
							break;
					case '4':
							header("location:../lgdinPhHome.php");
							break;
					case '5':
							header("location:../admin_new/lgdinAdminHome.php");
							break;
					default:
							header("location:../login.php?invalid=1");
				}
			}


		}

	}
?>