<?php
	include('cnct.php');
	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to mysql: " . mysqli_connect_error();
		exit();
	}

	$myDateToGetTodaysDcApnts=getdate(date("U"));
	if($myDateToGetTodaysDcApnts['mon']<10)
	{
		$dateBuilderString = $myDateToGetTodaysDcApnts['year'] . "-" . 0 . $myDateToGetTodaysDcApnts['mon'] . "-";
		if($myDateToGetTodaysDcApnts['mday']<10)
		{
			$dateBuilderString	=	$dateBuilderString . '0' . $myDateToGetTodaysDcApnts['mday'];
		}
		else
		{
			$dateBuilderString	=	$dateBuilderString . $myDateToGetTodaysDcApnts['mday'];
		}
	}
	else
	{
		$dateBuilderString = $myDateToGetTodaysDcApnts['year'] . "-" . $myDateToGetTodaysDcApnts['mon'] . "-";
		if($myDateToGetTodaysDcApnts['mday']<10)
		{
			$dateBuilderString	=	$dateBuilderString . '0' . $myDateToGetTodaysDcApnts['mday'];
		}
		else
		{
			$dateBuilderString	=	$dateBuilderString . $myDateToGetTodaysDcApnts['mday'];
		}
	}
	
	$doctorResults	= mysqli_query($con, "SELECT UID, URID, UFNaam, ULNaam, UAge, USpeciality FROM hmsaaausers WHERE URID='1' ORDER BY UFNaam");
	
	if (mysqli_num_rows($doctorResults) == 0)
	{
		;
		;
	}
	$cntListDcs =1;
	$cntTimer=1;
	$frstVal=1;
	$cntListDcsChanged=0;
	$dtFrstTime="a";
	echo'
		<script>
			var dcNmzArray="";
		</script>
	';
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
		$frst=1;
		echo '
			<tr
			 id="abc' . $row_user['UID'] . '"
			>
				<td style="text-align:center;"><span class="badge badge-info" style="margin:0px;">' . $cntListDcs . '</span></td>
				<td>
					&emsp;&emsp;&emsp;
					<a href="#myModal' . $row_user['UID'] . '" id="' . $row_user['UID'] . '" data-toggle="modal">
						' . $row_user['UFNaam'] . ' ' . $row_user['ULNaam'] . '
					</a>
				</td>
		';
		//		<td style="text-align:center;">
		//			'. $ageOfUserIs .'
		//		</td>
		echo '
				<td>
					&emsp;&emsp;'. $row_user['USpeciality'] .'
				</td>
			</tr>
			<script>
				var dcNmzArray	= dcNmzArray + ",' . $row_user['UFNaam'] . ' ' . $row_user['ULNaam'] . '";
			</script>
		';

		echo'
			<div id="myModal' . $row_user['UID'] . '" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-header" id="mdlhdr">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
					<h3 id="myModalLabel"> 
						Get Appointment from ' . $row_user['UFNaam'] . ' ' . $row_user['ULNaam'] . '
					</h3>
				</div>
				<div class="modal-body" id="mdlbdy">
					<div class="row-fluid">
						<div class="span3 offset1" style="min-height:350px; padding:0 10px 0 10px;">
		';
							$dcSpecificAppointments = $row_user['UID'];
							$dcAppointmentsListForPt	=	mysqli_query($con, "SELECT * FROM hmsaaaappointments WHERE APDate>=DATE_SUB( NOW( ) , INTERVAL 1 DAY ) AND APDcID=$dcSpecificAppointments AND APDealt='0' ORDER BY APDate DESC, APTime ASC");
					
							if (mysqli_num_rows($dcAppointmentsListForPt) == 0)
							{
								echo '
									<br><br><br><br><br><br>
									<h4>No Reserved times:</h4>
									<p>There are no Appointment pending.</p>
									<p>Select time to get Appointed.</p>
								';
							}
							else
							{
								echo'
									<br><h4>Reserved times are:</h4>
									<div class="accordion pre-scrollable" style="min-height:350px;" id="accordion' . $row_user['UID'] . '">
								';
								$ApntsDatewiseChanged=0;
								
								echo'
										<div class="accordion-group">
								';

								while($row_Apnts = mysqli_fetch_assoc($dcAppointmentsListForPt))
								{
									$newDate	=	$row_Apnts['APDate'];
									$newYear	=	$newDate[0] . $newDate[1] . $newDate[2] . $newDate[3];
									$newMonth	=	$newDate[5] . $newDate[6];
									$newDay		=	$newDate[8] . $newDate[9];						
									
									///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
									// Date header here, down.
									///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
											$idToBePassed	= "asfchkbx" . $row_user['UID'] . 'b' . $cntTimer;
											$asfText		= "asftxtVal" . $row_user['UID'] . 'b' . $cntTimer;
											$dtDefault		= 	$newDate[0] . $newDate[1] . $newDate[2] . $newDate[3] . '-' .
																$newDate[5] . $newDate[6] . '-' . $newDate[8] . $newDate[9];
											if($frstVal == 1 || $cntListDcsChanged == 1)
											{
												$dtFrstTime	=	$dtDefault;
												$frstVal++;
												$cntListDcsChanged = 0;

											}
											$dtShwAcrdn	=	$newDate[5] . $newDate[6] . '/' . $newDate[8] . $newDate[9] . '/' .
																$newDate[0] . $newDate[1] . $newDate[2] . $newDate[3];
											/*background-color:rgb(221,221,213);*/
											echo '
												<div class="accordion-heading" style="border:1px solid BLACK; border-radius:5px;">
													<div class="row-fluid" id="' . $asfText . '">
														<a class="accordion-toggle span11" data-toggle="collapse" data-parent="#accordion' . $row_user['UID'] . '" href="#collapse' . $cntTimer . '">
															<b style=" color: BLACK;">'
																. $dtShwAcrdn .
															'</b>
														</a>
														<input class="span1" type="radio" id="' . $idToBePassed . '" 
																onclick="chkbxclickd(' 
																	. "'" . $idToBePassed . "'" .
																');">
													</div>
												</div>
											';
										$cntTimer++;
									
									$prevDate	=	$row_Apnts['APDate'];

									$prevYear	=	$prevDate[0] . $prevDate[1] . $prevDate[2] . $prevDate[3];
									$prevMonth	=	$prevDate[5] . $prevDate[6];
									$prevDay	=	$prevDate[8] . $prevDate[9];

									///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
									// Inside text here, down.
									///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
									$abc=$cntTimer-1;
									if($frst==1)
									{
										echo'
												<div id="collapse' . $abc . '" class="accordion-body collapse in">
													<div class="accordion-inner">
														' . date("g:i a", strtotime($row_Apnts['APTime'])) . '
													</div>
												</div>
										';
										$frst++;
									}
									else
									{
										echo'
												<div id="collapse' . $abc . '" class="accordion-body collapse">
													<div class="accordion-inner">
														' . date("g:i a", strtotime($row_Apnts['APTime'])) . '
													</div>
												</div>
										';
									}

								}
								echo'
										</div>
									</div>
								';
							}

		echo'
						</div>
						<div class="span7" style=" border-radius:10px; border-left:none; min-height:410px;">
						';
						// UID should be the session ID provided (on nextline)
						$ptID	=	$_SESSION['FlID'];
						//$ptNameForAppointment	=	mysqli_query($con, "SELECT * FROM hmsaaausers WHERE UID='$ptID' AND URID='2' ");
						//while($rowPt_user=mysqli_fetch_assoc($ptNameForAppointment))
						{
							echo'
								<form class="form-horizontal" action="myFooter_homeBody/insertAppointment.php" method="POST">
									<h4 style="padding-top:15px;">Appointment Form:</h4>
									<div class="control-group span11" style="padding-top:15px;">
										<label class="control-label span3" for="inputEmail">Doctor Name: </label>
										<div class="controls span5">
											<input class="" name="DNM" type="text" id="dcName' . $row_user['UID'] . '" value="' . $row_user['UFNaam'] . ' ' . $row_user['ULNaam'] . '" required readonly>
										</div>
									</div>
									<div class="control-group span11">
										<label class="control-label span3" for="inputPassword">My Name: </label>
										<div class="controls span5">
											<input class="" name="PNM" type="text" id="ptName" required readonly value="' . $_SESSION['UzrNm'] . '">
										</div>
									</div>
							';
							$dcAppointmentsListForPt	=	mysqli_query($con, "SELECT * FROM hmsaaaappointments WHERE APDcID=$dcSpecificAppointments ORDER BY APDate DESC, APTime ASC");
							// if NO appointments are reserved
							if (mysqli_num_rows($dcAppointmentsListForPt) == 0)
							{	//after uplod
								echo'
									<div class="control-group span11">
										<div class="row-fluid">
											<label class="control-label span3" for="inputPassword">Date: </label>
											<div class="controls span5">
												<input type="text" name="DID" value="' . $row_user['UID'] . '" style="display:none">
												<input class="" name="APDT" type="Date" id="apDateTime' . $row_user['UID'] . '" 
														oninput="checkdateValidOrNot(' . $row_user['UID'] . ');" required
												>
												<div id="tagapDateTime' . $row_user['UID'] . '"></div>
											</div>
											<div class="span4" id="txtFrntDate' . $row_user['UID'] . '" style="text-align:left; margin-top:10px;"><span class="label label-important">Please Enter Date</span></div>
										</div>
									</div>
								';
							}
							// if appointments are reserved
							else
							{	//after uplod
								echo'
									<div class="control-group span11">
										<div class="row-fluid">
											<label class="control-label span3" for="inputPassword">Date: </label>
											<div class="controls span5">
												<input type="text" name="DID" value="' . $row_user['UID'] . '" style="display:none">
												<input	class="" name="APDT" type="Date" value="' . $dtFrstTime . '" id="apDateTime' . $row_user['UID'] . '" 
														oninput="checkdateValidOrNot(' . $row_user['UID'] . ');" required
												>
												<div id="tagapDateTime' . $row_user['UID'] . '"></div>
											</div>
											<div class="span4" id="txtFrntDate' . $row_user['UID'] . '" style="text-align:left"></div>
										</div>
									</div>
								';
							}

							echo'
									<div class="control-group span11">
										<div class="row-fluid">
											<label class="control-label span3" for="inputPassword">Time: </label>
											<div class="controls span5">
												<input class="" name="APTM" type="time" id="apTime' . $row_user['UID'] . '"
														oninput="checkdateValidOrNot(' . $row_user['UID'] . ');" 
														onfocus="checkdateValidOrNot(' . $row_user['UID'] . ');" required autofocus>
											</div>
											<div class="span4" id="txtFrntTime' . $row_user['UID'] . '" style="text-align:left"><span class="label label-important">Invalid Time</span></div>
										</div>
									</div>
							';

							echo'
									<div class="control-group span8 offset1" style="padding-top:5px;">
										<div class="controls" style="padding-top:15px;">
											<button type="submit" id="sbmtBtn' . $row_user['UID'] . '" class="btn btn-info btn-mini" style="">Confirm Appointment</button>
										</div>
									</div>
								</form>
							';
						}
		echo'
						</div>
					</div>
				</div>
				<div class="modal-footer" id="mdlftr">
				</div>
	        </div>
		';

		$cntListDcs++;
		$cntListDcsChanged = 1;
	}
	echo'
		<script>
			var temp = dcNmzArray.split(",");
			for ($i=0; $i<temp.length; $i++) { 
				console.log(temp[$i]);
			}
		</script>
	';

	mysqli_close($con);
?>