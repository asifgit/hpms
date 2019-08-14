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
	
	$appntOnlinePtResults	= mysqli_query($con, "SELECT * FROM hmsaaaappointmentsrl WHERE APDate='$dateBuilderString' ORDER BY APTkn");
	
	if (mysqli_num_rows($appntOnlinePtResults) == 0)
	{
		echo'
			<tr>
				<td style="text-align:center; font-style:italic;" colspan="8">
					No Tokens assigned, today.
				</td>
			</tr>
		';
	}
	else
	{
		$countlist=1;
		while ($row_user = mysqli_fetch_assoc($appntOnlinePtResults))
		{
			$ptIDToBeChecked		=	$row_user['APPtID'];
			$dcIDWhosChecked		=	$row_user['APDcID'];
			$usrNames				=	mysqli_query($con, "SELECT UFNaam, ULNaam, UNaam, UAge FROM hmsaaausers WHERE UID = $ptIDToBeChecked");
			$dcName					=   mysqli_query($con, "SELECT UFNaam, ULNaam, USpeciality FROM hmsaaausers WHERE UID = $dcIDWhosChecked");
			while($row_userPtUser 	=	mysqli_fetch_assoc($usrNames))
			{
				$ageOfUserIs	=	0;
				$bd	=	$row_userPtUser['UAge'];
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
				$timetobedisplayed	=	date("g:i a", strtotime($row_user['APTime']));//[0] . $row_user['APTime'][1] . " : "  . $row_user['APTime'][3] . $row_user['APTime'][4] . $row_user['APTime'][5] . $row_user['APTime'][6] . $row_user['APTime'][7];
				while($row_userDcUser 	=	mysqli_fetch_assoc($dcName))
				{
				echo'
					<tr id = "' . $row_user['APID'] . '">
						<td style="text-align:center;">
							<span class="badge" style="margin:0px; background-color:#B6B6B2;">' . $row_user['APTkn'] . '</span>
						</td>
						<td style="text-align:center;">
							' . $row_userPtUser['UNaam'] . '
						</td>
						<td style="text-align:left">
							<p id="' . $row_user['APID'] . '" data-toggle="modal" style="text-decoration:none; margin:0px; color:BLACK;">
								&emsp;&emsp;&emsp;&emsp;' . $row_userPtUser['UFNaam'] . ' ' . $row_userPtUser['ULNaam'] . '
							</p>
						</td>
						<td style="text-align:center; border-left:none;">
							---
						</td>
				';
				//		<td style="text-align:center;">
				//			' . $ageOfUserIs . '
				//		</td>
				echo'
						<td style="text-align:left; border-left:none;">
							&emsp;' . $row_userDcUser['UFNaam'] . ' ' . $row_userDcUser['ULNaam'] . '
						</td>
						<td style="text-align:right;">
							&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
							' . $timetobedisplayed . '
						</td>
						<td style="border-left:none; text-align:center;">
							-
						</td>
						<td style="border-left:none;">
							' . $row_userDcUser['USpeciality'] . '
						</td>
					</tr>
				';
				echo'
					<div id="myModal' . $countlist . '" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-header" id="mdlhdr">
							<button class="close" data-dismiss="modal" aria-hidden="true">X</button>
							<h3 id="myModalLabel">
							' . $countlist . '
							Creating 
							<span id="mdlhdrnm">' . $row_userPtUser['UFNaam'] . ' ' . $row_userPtUser['ULNaam'] .'\'s' . '</span>
							Bill
							</h3>
						</div>
						<div class="modal-body" id="mdlbdy">						
							<div class="span6">
								<img class="mdlbdyImgPrescription"/>
							</div>
							<div class="span6">
								<h4 id="blmdhdr">Scan the Medicines (Pending Work)</h4>
								<form class="form-horizontal" name="sendheshemail" action="createUsersBill.php" method="POST" onsubmit="">
								    <div class="control-group" align="left">
				';
		    	echo'
		    							<div style="text-align:center;">
									    	<label class="control-label" for="sentTo">
									    		<span style="background-color:#c9c9c9">
									    			<span style="color:Red;padding-top:10px;">*</span> Dr. ' . $row_userDcUser['UFNaam'] . ' ' . $row_userDcUser['ULNaam'] . '\'s fee:
									    		</span>
									    	</label>
									    	<div class="controls">
									            <input type="text" id="sentTo" name="sentTo" placeholder="Amount in /Rs">
									        </div>
									    </div>
								        <hr>
				';
				}
				echo'
									    <label class="control-label">
								        	<span style="background-color:#c9c9c9">Medicine\'s Entry:</span> 
								        </label>
								        <div class="controls" style="text-align:center;">
								            <input type="text" id="mdcName" name="mdcName" placeholder="Medicine Name"/>
								            <input type="text" id="mdcAmount" name="mdcAmount" placeholder="Amount"/>
								        </div>

									</div>
								    <hr>
								    <div class="control-group">
								        <button onclick="" type="submit" id="crtBill" class="btn">Create Bill</button>
								    </div>
								</form>
							</div>
						</div>
						<div class="modal-footer" id="mdlftr">
							<button class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">Close</button>
						</div>
			        </div>
				';
				$countlist++;
			}
		}
	}
	mysqli_close($con);
?>