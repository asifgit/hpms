<?php
	include('cnct.php');
	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to mysql: " . mysqli_connect_error();
		exit();
	}
	
	$resultDc		= mysqli_query($con, "SELECT UID, UFNaam, ULNaam FROM hmsaaausers WHERE URID = '1' ORDER BY UFNaam");
	$dctrarray		= array();
	$dctrarrayID	= array();
	
	if (mysqli_num_rows($resultDc) == 1)
	{
		;
		;
	}

	while ($row_userDc = mysqli_fetch_assoc($resultDc))
	{
		$dctrarray[]	= $row_userDc['UFNaam'] . " " . $row_userDc['ULNaam'];
		$dctrarrayID[]	= $row_userDc['UID'];
	}
	
	$countDc=1;
	$strBld;
	$strBldID;
	//doctorNames into a single string
	foreach ($dctrarray as $key)
	{
		if($countDc == 1)
		{
			$strBld = "[\"Dr. " . $key . "\"";
			$countDc++;
		}
		else
		{
			$strBld = $strBld . ", \"Dr. " . $key . "\"";
		}
	}
	$countDc=1;
	foreach ($dctrarrayID as $keyID)
	{
		if($countDc == 1)
		{
			$strBldID = "[\"" . $keyID . "\"";
			$countDc++;
		}
		else
		{
			$strBldID = $strBldID . ", \"" . $keyID . "\"";
		}
	}
	
	$strBld		= $strBld . "]";
	$strBldID	= $strBldID . "]";
	//echo $strBldID . "<br>" . $strBld;

	mysqli_close($con);
?>