<?php
	include('cnct.php');
	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to mysql: " . mysqli_connect_error();
		exit();
	}
	
	$resultPt		= mysqli_query($con, "SELECT UFNaam, ULNaam FROM hmsaaausers WHERE URID = '2' ORDER BY UFNaam");
	$ptarray	= array();
	
	if (mysqli_num_rows($resultPt) == 1)
	{
		;
		;
	}

	while ($row_userDc = mysqli_fetch_assoc($resultPt))
	{
		$ptarray[] = $row_userDc['UFNaam'] . " " . $row_userDc['ULNaam'];
	}
	
	$countPt=1;
	$strBldPt;
	foreach ($ptarray as $key)
	{
		if($countPt == 1)
		{
			$strBldPt = "[\"" . $key . "\"";
			$countPt++;
		}
		else
		{
			$strBldPt = $strBldPt . ", \"" . $key . "\"";
		}
	}
	$strBldPt = $strBldPt . "]'";
	mysqli_close($con);
?>