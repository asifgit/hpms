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


	$ApIDToBeInserted	=	$_GET['ApptID'];
	$getOnlineApptQry	=	"SELECT APID, APPtID, APDcID FROM hmsaaaappointments WHERE APID='$ApIDToBeInserted'";
	$rzToGetAppt		=	mysqli_query($con, $getOnlineApptQry);
	$aAPID		=	"";
	$aAPPtID	=	"";	$aAPDcID	=	"";
	//$aAPDate	=	""; $aAPTime	=	"";
	while($rowAppt	=	mysqli_fetch_assoc($rzToGetAppt))
	{
		/*echo "APID: " . $rowAppt['APID'] . "<br>";
		echo "PtID: " . $rowAppt['APPtID'] . "<br>";
		echo "DcID: " . $rowAppt['APDcID'] . "<br>";
		echo "APDt: " . $rowAppt['APDate'] . "<br>";
		echo "APTm: " . $rowAppt['APTime'];*/
		$aAPID		=	$rowAppt['APID'];
		$aAPPtID 	=	$rowAppt['APPtID'];
		$aAPDcID 	=	$rowAppt['APDcID'];
		//$aAPDate 	=	$rowAppt['APDate'];
		//$aAPTime 	=	$rowAppt['APTime'];
		//$aAPTime	=	getTime();
	}

	$qry4Token		=	"SELECT COUNT(*) as count FROM hmsaaaappointmentsrl WHERE DATE(`APDate`) = CURDATE()";
	$rzCount		=	mysqli_query($con, $qry4Token);
	$countInsert	=	0;
	if(!$rzCount)
	{
		//echo "Count Query Error.";
	}
	else
	{
		$cntttt	=	mysqli_fetch_assoc($rzCount);
		//echo $cntttt['count'] . "Rows<br>";
		$countInsert	=	$cntttt['count'] + 1;
	}
	
	$datetime = date('H:i:s', time());

	$qryAssignToken	=	"INSERT INTO `hmsaaaappointmentsrl` (`APPtID`, `APDcID`, `APDate`, `APTime`, `APTkn`) 
							VALUES ('$aAPPtID', '$aAPDcID', '$dateBuilderString', '$datetime', '$countInsert')";
//	INSERT INTO `hmsaaaappointmentsrl`(`APID`, `APPtID`, `APDcID`, `APDateTime`, `APTkn`) 
//	VALUES ([value-1],[value-2],[value-3],[value-4],[value-5])
	$INSRTQryRzlt	=	mysqli_query($con, $qryAssignToken);
	if($INSRTQryRzlt)
	{
		$updtDealt	=	"UPDATE `hmsaaaappointments` SET `APDealt`='1' WHERE APID=$aAPID";
		$rzUpt		=	mysqli_query($con, $updtDealt);
		echo "<div style='background-color:rgb(94, 186, 94); text-align:center; color:WHITE;'>Assigned token # " . $countInsert . "</div>";
		echo "
			<script type='text/javascript'>
				document.getElementById('" . $ApIDToBeInserted . "').style='background-color:GREEN';
				var cnt = 1;
				if(cnt==1)
				{
					setInterval(
						function ()
						{
							for (var i = 0; i < 100000; i++) 
							{
								for (var j = 0; j < 1000; j++) 
								{
									j++;
								};
								i++;

							};
							document.getElementById('" . $ApIDToBeInserted . "').innerHTML='';
						}, 3000);
					cnt++;
				}
			</script>
		";
	}
	else
	{
		echo "Refresh the page and try again." 
			. $qryAssignToken;
	}
	mysqli_close($con);
?>