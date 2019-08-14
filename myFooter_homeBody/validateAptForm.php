<?php
	include('cnct.php');

	//echo "You are in the file that ajax called" . $_GET['tagANDId'] . '<br>';
	$myDateToCheckAptsAvailable=getdate(date("U"));
	$mySpanOfMessage	=	"";
	$mySpanOfMessageT	=	"";
	//echo $myDateToCheckAptsAvailable['mday'] . "<br>";

	if($myDateToCheckAptsAvailable['mon']<10)
	{
		$dateBuilderString = $myDateToCheckAptsAvailable['year'] . "-0" . $myDateToCheckAptsAvailable['mon'] . "-";
		if($myDateToCheckAptsAvailable['mday']<10)
		{
			$dateBuilderString = $dateBuilderString . "0" .  $myDateToCheckAptsAvailable['mday'];
		}
		else
		{
			$dateBuilderString = $dateBuilderString .  $myDateToCheckAptsAvailable['mday'];
		}
	}
	else
	{
		$dateBuilderString = $myDateToCheckAptsAvailable['year'] . "-" . $myDateToCheckAptsAvailable['mon'] . "-";
		if($myDateToCheckAptsAvailable['mday']<10)
		{
			$dateBuilderString = $dateBuilderString . "0" .  $myDateToCheckAptsAvailable['mday'];
		}
		else
		{
			$dateBuilderString = $dateBuilderString .  $myDateToCheckAptsAvailable['mday'];
		}
	}
	//$dateBuilderString	=	$myDateToCheckAptsAvailable['year'] . '-' . $myDateToCheckAptsAvailable['mon'] . '-' . $myDateToCheckAptsAvailable['mday'];
	//echo "Now Date : " . $dateBuilderString . "<br>";
	$yourDate	=	$_GET['dateEnteredNow'];
	$yourDateStr	=	"\"" . $yourDate . "\"";
	$lengthOfDate=strlen($yourDate);
	$yourTime	=	$_GET['timeEnteredNow'];
	$lengthOfTime=strlen($yourTime);
	//echo $yourTime . ' Length of time is: ' . $lengthOfTime . '<br>';
	$btnsID		=	$_GET['sbmtbtnID'];
	$txtDtID	=	$_GET['dateID'];
	$txtTmID	=	$_GET['timeID'];
	$dcID="";
	for ($i=7; $i < strlen($btnsID); $i++)
	{
		$dcID = $dcID . $btnsID[$i];
	}
	//echo $dcID;
	echo "<script>console.log(\"Button ID is: \"+" . $btnsID . ");</script>";
	//console.log("Button ID is: "+$btnsID);
	////echo $lengthOfDate;
	if($lengthOfDate!=10)
	{
		//echo "Your Date: Invalid.";
		//echo "<script>document.getElementById(" . $btnsID . ").disabled=true;</script>";
		$mySpanOfMessage	=	'<span class=' . '"label label-important">Invalid Date</span>';
		$mySpanOfMessageT	=	'<span class=' . '"label label-warning">Enter correct Date first</span>';
		
		echo "
			<script>
				var dateVar =\"" . $txtDtID . "\";	var jsVariable=\"" . $btnsID . "\";
				var timeVar	=\"" . $txtTmID . "\";
				document.getElementById(dateVar).innerHTML='" . $mySpanOfMessage . "';
				document.getElementById(timeVar).innerHTML='" . $mySpanOfMessageT . "';
				document.getElementById(jsVariable).disabled=true;
			</script>
		";
	}
	else
	{
		//echo "Your Date: " . $yourDate . "<br>";
		//echo "2daysDate: " . $dateBuilderString;
		$cmpYrDate	=	$yourDate[0].$yourDate[1].$yourDate[2].$yourDate[3].$yourDate[5].$yourDate[6].$yourDate[8].$yourDate[9];
		$cmp2DDate	=	$dateBuilderString[00].$dateBuilderString[1].$dateBuilderString[2].$dateBuilderString[3].$dateBuilderString[5].$dateBuilderString[6].$dateBuilderString[8].$dateBuilderString[9];
		//echo "Urz".$cmpYrDate."--2Days".$cmp2DDate;
		if($cmpYrDate<$cmp2DDate)
			{ ;/*echo "<br>EXPIRED.";*/ }
		else
			{ ;/*echo "<br>NOT EXPIRED.";*/	}

		if($yourDate<$dateBuilderString)
		{
			//echo "<br>Date has passed, ID of Btn is:" . $btnsID;
			$mySpanOfMessage	=	'<span class=' . '"label label-important">Expired Date</span>';
			$mySpanOfMessageT	=	'<span class=' . '"label label-warning">Enter correct Date first</span>';
			echo "
				<script>
					var dateVar =\"" . $txtDtID . "\";	var jsVariable=\"" . $btnsID . "\";
					var timeVar	=\"" . $txtTmID . "\";
					document.getElementById(dateVar).innerHTML='" . $mySpanOfMessage . "';
					document.getElementById(timeVar).innerHTML='" . $mySpanOfMessageT . "';
					document.getElementById(jsVariable).disabled=true;
				</script>
			";
		}
		else
		{
			$qry	=	"SELECT * FROM hmsaaaappointments WHERE APDate=$yourDateStr AND APDcID=$dcID AND APDealt=0 ORDER BY APDate, APTime";
			$rzAp	=	mysqli_query($con, $qry);
			if(mysqli_num_rows($rzAp)<101)
			{
				if(mysqli_num_rows($rzAp)!=0)
				{
					if($yourTime!="")
					{
						if($yourTime<'09:00:00.000000')
						{
							$mySpanOfMessageT	=	'<span class=' . '"label label-important">Hospital opens at 9 AM</span>';
							echo "
								<script>
									var jsVariable=\"" . $btnsID . "\";
									var timeVar	=\"" . $txtTmID . "\";
									document.getElementById(timeVar).innerHTML='" . $mySpanOfMessageT . "';
									document.getElementById(jsVariable).disabled=true;
								</script>
							";
						}
						else
						{
							if ($yourTime>'16:55:00.000000')
							{
								$mySpanOfMessageT	=	'<span class=' . '"label label-important">Hospital closes at 5 PM</span>';
								echo "
									<script>
										var jsVariable=\"" . $btnsID . "\";
										var timeVar	=\"" . $txtTmID . "\";
										document.getElementById(timeVar).innerHTML='" . $mySpanOfMessageT . "';
										document.getElementById(jsVariable).disabled=true;
									</script>
								";
							}
							else
							{
								$oneone=0;
								while ($rowApps	=	mysqli_fetch_assoc($rzAp))
								{
									//echo '<br>DBsRz: ' . $rowApps['APDate'] . ' - ' . $rowApps['APTime'];
									if($yourTime==$rowApps['APTime'])
									{
										//echo '<br>YesRz: ' . $rowApps['APDate'] . ' - ' . $yourTime;
										$mySpanOfMessageT	=	'<span class=' . '"label label-important">Time is reserved</span>';
										echo "
											<script>
												var jsVariable=\"" . $btnsID . "\";
												var timeVar	=\"" . $txtTmID . "\";
												document.getElementById(timeVar).innerHTML='" . $mySpanOfMessageT . "';
												document.getElementById(jsVariable).disabled=true;
											</script>
										";
										$oneone	=	1;
									}
									else
									{
										if($oneone==0)
										{
											//echo '<br>NottRz: ' . $rowApps['APDate'] . ' - ' . $yourTime;
											$mySpanOfMessageT	=	'<span class=' . '"label label-success"></span>';
											echo "
												<script>
													var jsVariable=\"" . $btnsID . "\";
													var timeVar	=\"" . $txtTmID . "\";
													document.getElementById(timeVar).innerHTML='" . $mySpanOfMessageT . "';
													document.getElementById(jsVariable).disabled=false;
												</script>
											";
										}
									}
								}
							}
						}
					}
					else
					{
						$mySpanOfMessageT	=	'<span class=' . '"label label-important">Enter correct time</span>';
						echo "
								<script>
									var jsVariable=\"" . $btnsID . "\";
									var timeVar	=\"" . $txtTmID . "\";
									document.getElementById(timeVar).innerHTML='" . $mySpanOfMessageT . "';
									document.getElementById(jsVariable).disabled=true;
								</script>
						";
					}
				}
				else
				{
					if($yourTime!="")
					{
						if($yourTime<'09:00:00.000000')
						{
							$mySpanOfMessageT	=	'<span class=' . '"label label-important">Hospital opens at 9 AM</span>';
							echo "
								<script>
									var jsVariable=\"" . $btnsID . "\";
									var timeVar	=\"" . $txtTmID . "\";
									document.getElementById(timeVar).innerHTML='" . $mySpanOfMessageT . "';
									document.getElementById(jsVariable).disabled=true;
								</script>
							";
						}
						else
						{
							if ($yourTime>'16:55:00.000000')
							{
								$mySpanOfMessageT	=	'<span class=' . '"label label-important">Hospital closes at 5 PM</span>';
								echo "
									<script>
										var jsVariable=\"" . $btnsID . "\";
										var timeVar	=\"" . $txtTmID . "\";
										document.getElementById(timeVar).innerHTML='" . $mySpanOfMessageT . "';
										document.getElementById(jsVariable).disabled=true;
									</script>
								";
							}
							else
							{
								$mySpanOfMessageT	=	'<span class=' . '"label label-important"></span>';
								echo "
									<script>
										var jsVariable=\"" . $btnsID . "\";
										var timeVar	=\"" . $txtTmID . "\";
										document.getElementById(timeVar).innerHTML='" . $mySpanOfMessageT . "';
										document.getElementById(jsVariable).disabled=false;
									</script>
								";
							}
						}
						
					}
					else
					{
						$mySpanOfMessageT	=	'<span class=' . '"label label-important">Enter correct time</span>';
						echo "
								<script>
									var jsVariable=\"" . $btnsID . "\";
									var timeVar	=\"" . $txtTmID . "\";
									document.getElementById(timeVar).innerHTML='" . $mySpanOfMessageT . "';
									document.getElementById(jsVariable).disabled=true;
								</script>
						";
					}
				}
				$mySpanOfMessage	=	'<span class=' . '"label label-success">Times are available</span>';
				echo "
					<script>
						var dateVar =\"" . $txtDtID . "\";
						document.getElementById(dateVar).innerHTML='" . $mySpanOfMessage . "';
					</script>
				";
			}
			else
			{
				$mySpanOfMessage	=	'<span class=' . '"label label-important">No Appointments available</span>';
				$mySpanOfMessageT	=	'<span class=' . '"label label-warning">Enter correct Date first</span>';
				echo "
					<script>
						var dateVar =\"" . $txtDtID . "\";	var jsVariable=\"" . $btnsID . "\";
						var timeVar =\"" . $txtTmID ."\";
						document.getElementById(dateVar).innerHTML='" . $mySpanOfMessage . "';
						document.getElementById(timeVar).innerHTML='" . $mySpanOfMessageT . "';
						document.getElementById(jsVariable).disabled=true;
					</script>
				";
			}
			//echo '<br>' . mysqli_num_rows($rzAp) . ' APTs reserved on the ' . $yourDate . '.<br>';
		}
	}

	mysqli_close($con);
?>