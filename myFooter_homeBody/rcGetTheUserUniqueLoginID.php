<?php
	include('cnct.php');
	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to mysql: " . mysqli_connect_error();
		exit();
	}
	$stringMth	=	$stringMth[1] . $stringMth[2] . $stringMth[3];
	$stringYr	=	$stringYr[3] . $stringYr[4];
	$stringToBeComparedWithIs	=	"TDK-" . $stringMth . $stringYr . "-";
	//echo $stringToBeComparedWithIs;
	$qryToGetUniqueID	=	mysqli_query($con, "SELECT COUNT(*) as countID FROM hmsaaausers WHERE UNAAM like '$stringToBeComparedWithIs%'");

	if(!$qryToGetUniqueID)
	{
		//echo "Count Query Error.";
	}
	else
	{
		$cntabc	=	mysqli_fetch_assoc($qryToGetUniqueID);
		
		$countIDIs	=	str_pad($cntabc['countID'] + 1, 3, "0", STR_PAD_LEFT);
		$countIDIs	=	$stringToBeComparedWithIs . $countIDIs;
		//echo "<br>" . $countIDIs;
		//echo "<br>" . $countIDIs;
		echo"
			<script>
				var IDIDID	=	document.getElementById('autoAssignedID').value	=	'" . $countIDIs . "';
				console.log(IDIDID);
			</script>
		";
	}
?>