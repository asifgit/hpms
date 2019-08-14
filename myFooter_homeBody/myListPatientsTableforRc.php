<?php
	include('cnct.php');
	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to mysql: " . mysqli_connect_error();
		exit();
	}

	$myDateToGetTodaysPrescriptions=getdate(date("U"));
	//echo $myDateToGetTodaysPrescriptions;
	if($myDateToGetTodaysPrescriptions['mon']<10)
	{
		$dateBuilderString = $myDateToGetTodaysPrescriptions['year'] . "-" . 0 . $myDateToGetTodaysPrescriptions['mon'] . "-";
		if($myDateToGetTodaysPrescriptions['mday']<10)
		{
			$dateBuilderString	=	$dateBuilderString . '0' . $myDateToGetTodaysPrescriptions['mday'];
		}
		else
		{
			$dateBuilderString	=	$dateBuilderString . $myDateToGetTodaysPrescriptions['mday'];
		}
	}
	else
	{
		$dateBuilderString = $myDateToGetTodaysPrescriptions['year'] . "-" . $myDateToGetTodaysPrescriptions['mon'] . "-";
		if($myDateToGetTodaysPrescriptions['mday']<10)
		{
			$dateBuilderString	=	$dateBuilderString . '0' . $myDateToGetTodaysPrescriptions['mday'];
		}
		else
		{
			$dateBuilderString	=	$dateBuilderString . $myDateToGetTodaysPrescriptions['mday'];
		}
	}
	
	$patientResults	= mysqli_query($con, "SELECT UID, URID, UFNaam, ULNaam, UNaam, UAge, UAdress FROM hmsaaausers WHERE URID='2' ORDER BY UNaam");
	
	if (mysqli_num_rows($patientResults) == 0)
	{
		echo '
			<tr>
				<td style="text-align:center; font-style:italic;" colspan="5">
					No patients registered Yet
				</td>
			</tr>
		';
	}
	else
	{
		$cntListPts=1;
		while ($row_user = mysqli_fetch_assoc($patientResults))
		{
			$ageOfUserIs	=	0;
			$bd	=	$row_user['UAge'];
			$td	=	$dateBuilderString;
			//echo $bd . "....." . $td;
			
			$bddy	=	$bd[8] . $bd[9];
			$tddy	=	$td[8] . $td[9];

			$bdmn	=	$bd[5] . $bd[6];
			$tdmn	=	$td[5] . $td[6];

			$bdyr	=	$bd[0] . $bd[1] . $bd[2] . $bd[3];
			$tdyr	=	$td[0] . $td[1] . $td[2] . $td[3];

			///////////////////////////////////////////////
			$yrDf	=	-($bdyr-$tdyr);
			$mnDf	=	-($bdmn-$tdmn);
			$dyDf	=	-($bddy-$tddy);
			//echo $bd . "<br>" . $td . "<br>" . $yrDf . ".." . $mnDf . ".." . $dyDf . "<br>";
			//////////////////////////////////////////////
			if($yrDf>0)
			{
				if($mnDf>=0)
				{
					if($mnDf>0)
					{
						$ageOfUserIs	=	$yrDf;
					}
					else
					{
						if($dyDf>=0)
						{
							if($dyDf>0)
							{
								$ageOfUserIs	=	$yrDf;
							}
							else
							{
								$ageOfUserIs	=	$yrDf;
							}
						}
						else
						{
							$ageOfUserIs	=	($yrDf-1);
						}
					}
				}
				else
				{
					$ageOfUserIs	=	($yrDf-1);
				}
			}
			else
			{
				$ageOfUserIs	=	"Undefined";
			}
			echo '
					<tr
					 id=tr'. $row_user['UID'] . '
					>
						<td style="text-align:center;">
							<span class="badge" style="margin:0px; background-color:#B6B6B2;">' . $cntListPts . '</span>
						</td>
						<td>
							&emsp;&emsp;&emsp;
							<a href="" id="td' . $row_user['UID'] . '" onclick="rcClkdPtToAppendNewRow(id); return false;">' . $row_user['UFNaam'] . '-' . $row_user['ULNaam'] . '</a>
						</td>
						<td style="text-align:center;">
							' . $row_user['UNaam'] . '
						</td>
						<td style="text-align:center;">
							' . $ageOfUserIs . '
						</td>
						<td>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. $row_user['UAdress'] . '
						</td>
					</tr>
			';
			$cntListPts++;
		}
	}
	mysqli_close($con);
?>