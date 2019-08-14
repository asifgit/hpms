<?php
	include('cnct.php');
	$myID		=	'\'' . $_SESSION['FlID'] . '\'';
	$pwOLDMine	=	mysqli_query($con, "SELECT UPwd FROM hmsaaausers WHERE UID=$myID");
	while($myPW		=	mysqli_fetch_assoc($pwOLDMine))
	{
		echo"<script>var myPW22='" . $myPW['UPwd'] . "';</script>";
	}
	
?>