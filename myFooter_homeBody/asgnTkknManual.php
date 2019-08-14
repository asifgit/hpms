<?php
	include('cnct.php');

	date_default_timezone_set('Asia/Seoul');
	$myDateToBeEnteredInDB=getdate(date("U"));
	if($myDateToBeEnteredInDB['mon']<10)
	{
		$dateBuilderString = $myDateToBeEnteredInDB['year'] . "-0" . $myDateToBeEnteredInDB['mon'] . "-";
		if($myDateToBeEnteredInDB['mday']<10)
		{
			$dateBuilderString = $dateBuilderString . "0" .  $myDateToBeEnteredInDB['mday'];
		}
		else
		{
			$dateBuilderString = $dateBuilderString .  $myDateToBeEnteredInDB['mday'];
		}
	}
	else
	{
		$dateBuilderString = $myDateToBeEnteredInDB['year'] . "-" . $myDateToBeEnteredInDB['mon'] . "-";
		if($myDateToBeEnteredInDB['mday']<10)
		{
			$dateBuilderString = $dateBuilderString . "0" .  $myDateToBeEnteredInDB['mday'];
		}
		else
		{
			$dateBuilderString = $dateBuilderString .  $myDateToBeEnteredInDB['mday'];
		}
	}

	$IDofTxtResponse	=	$_GET['txtOfResponse'];
	$IDofPatient		=	$_GET['pttID'];
	$IDofDoctor			=	$_GET['dccID'];
	//echo $IDofTxtResponse . ' ' .$IDofPatient . ' ' . $IDofDoctor;

	$qry4Token		=	"SELECT COUNT(*) as count FROM hmsaaaappointmentsrl WHERE DATE(`APDate`) = CURDATE()";
	$rzCount		=	mysqli_query($con, $qry4Token);
	$countInsert	=	0;
	if(!$rzCount)
	{	;	}
	else
	{
		$cntttt	=	mysqli_fetch_assoc($rzCount);
		$countInsert	=	$cntttt['count'] + 1;
		//echo $countInsert . "<br>";
	}
	date_default_timezone_set("Asia/Seoul");
	$datetime = date("H:i:s", time());
	$qryAsgnTknRcPt		=	"INSERT INTO `hmsaaaappointmentsrl` (`APPtID`, `APDcID`, `APDate`, `APTime`, `APTkn`) 
							VALUES ('$IDofPatient', '$IDofDoctor', '$dateBuilderString', '$datetime', '$countInsert')";
	$rzINSRTApptManual	=	mysqli_query($con, $qryAsgnTknRcPt);

	if(!$rzINSRTApptManual)
	{
		echo"<div style='text-align:center;'><a style='margin-top:7px; margin-bottom:7px; background-color:WHITE; color:rgb(220, 226, 0);'>Refresh the page and try again</a></div>";
	}
	else
	{
		echo"<div style='text-align:center;'><a style='margin-top:7px; margin-bottom:7px; background-color:rgb(94, 186, 94); color:WHITE'>Assigned token # " . $countInsert . "</a></div>";
	}

	mysqli_close($con);
?>