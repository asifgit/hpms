<?php
	include('cnct.php');
	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to mysql: " . mysqli_connect_error();
		exit();
	}
	
	$doctorResults	= mysqli_query($con, "SELECT UID, URID, UFNaam, ULNaam, UAge, USpeciality FROM hmsaaausers WHERE URID='1' ORDER BY UFNaam");
	
	if (mysqli_num_rows($doctorResults) == 1)
	{
		;
		;
	}
	$cntListDcs=1;
	while ($row_user = mysqli_fetch_assoc($doctorResults))
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
				 id='. $row_user['UID'] . "_" . $row_user['URID'] . '
				>
					<td style="text-align:center;">
						<span class="badge" style="margin:0px; background-color:#B6B6B2;">' . $cntListDcs . '
					</td>
					<td>
						&emsp;&emsp;&emsp;'. $row_user['UFNaam'] . '-' . $row_user['ULNaam'] .'
					</td>
		';

		//			<td style="text-align:center;">
		//			'. $ageOfUserIs .'
		//			</td>
		echo'
					<td>
							&emsp;&emsp;&emsp;&emsp;'. $row_user['USpeciality'] .'
					</td>
				</tr>
		';
		$cntListDcs++;
	}

	mysqli_close($con);
?>