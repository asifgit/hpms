<?php
	include('cnct.php');
	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to mysql: " . mysqli_connect_error();
		exit();
	}
	$mdArray	=	array();	$mdArrayID	=	array();	$mdArrayPR	=	array();
	$myMedicinesList	=	mysqli_query($con, "SELECT MDID, MDName, MDSaleUnitPrice FROM hmsaaamedicines ORDER BY MDName");
	while($rw_med	=	mysqli_fetch_assoc($myMedicinesList))
	{
		$mdArrayID[]	=	$rw_med['MDID'];
		$mdArray[]		=	$rw_med['MDName'];
		$mdArrayPR[]	=	$rw_med['MDSaleUnitPrice'];
	}

	$countMD=1;
	$strBldMd;
	$stringMedicines	=	"";
	foreach ($mdArray as $key)
	{
		if($countMD == 1)
		{
			$strBldMd = "[\"" . $key . "\"";
			$countMD++;
			$stringMedicines	=	$stringMedicines	.	$key;
		}
		else
		{
			$strBldMd = $strBldMd . ", \"" . $key . "\"";
			$stringMedicines	=	$stringMedicines	.	","	.	$key;
		}
	}
	$countMDID=1;
	$strBldMdID;
	$stringMedicinesID	=	"";
	foreach ($mdArrayID as $key1)
	{
		if($countMDID == 1)
		{
			$strBldMdID = "[\"" . $key1 . "\"";
			$countMDID++;
			$stringMedicinesID	=	$stringMedicinesID	.	$key1;
		}
		else
		{
			$strBldMdID = $strBldMdID . ", \"" . $key1 . "\"";
			$stringMedicinesID	=	$stringMedicinesID	.	","	.	$key1;
		}
	}
	$countMDPR=1;
	$strBldMdPR;
	$stringMedicinesPR	=	"";
	foreach ($mdArrayPR as $key)
	{
		if($countMDPR == 1)
		{
			$strBldMdPR = "[\"" . $key . "\"";
			$countMDPR++;
			$stringMedicinesPR	=	$stringMedicinesPR	.	$key;
		}
		else
		{
			$strBldMdPR = $strBldMdPR . ", \"" . $key . "\"";
			$stringMedicinesPR	=	$stringMedicinesPR	.	","	.	$key;
		}
	}

	$strBldMd		=	$strBldMd . "]";
	$strBldMdPHP	=	explode(",", $stringMedicines);
	$strBldMdID		=	$strBldMdID . "]";
	$strBldMdIDPHP	=	explode(",", $stringMedicinesID);
	$strBldMdPR		=	$strBldMdPR . "]";

	$myDateToGetTodaysPrescriptions=getdate(date("U"));
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

	$prescribedPtResults	= mysqli_query($con, "SELECT * FROM hmsaaapreb WHERE PRBDate='$dateBuilderString' AND PRBReachedPharmacy=false ORDER BY PRBTime");
	/*	filters prescribed patients of 			"TODAYS DATE"
		, also the specific patient				"LOGGED-IN"
		AND who has not visited the
		pharmacy after getting prescribed		"CHECK FIRST TIME VISITED"
	*/
	if (mysqli_num_rows($prescribedPtResults) == 0)
	{
		echo'
			<tr>
				<td style="text-align:center; font-style:italic;" colspan="8">
					No prescribed patients are pending
				</td>
			</tr>
		';
	}
	else
	{
		$countlist=1;
		while ($row_user = mysqli_fetch_assoc($prescribedPtResults))
		{
			$ptIDToBeChecked		=	$row_user['PRBPtID'];
			$dcIDWhosChecked		=	$row_user['PRBDcID'];
			$usrNames				=	mysqli_query($con, "SELECT UID, UFNaam, ULNaam, UNaam, UAge FROM hmsaaausers WHERE UID = $ptIDToBeChecked");
			$dcName					=   mysqli_query($con, "SELECT UFNaam, ULNaam, USpeciality, UDcFee FROM hmsaaausers WHERE UID = $dcIDWhosChecked");
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
				$timetobedisplayed	=	date("g:i a", strtotime($row_user['PRBTime']));//$row_user['PRBTime'][0] . $row_user['PRBTime'][1] . " : "  . $row_user['PRBTime'][3] . $row_user['PRBTime'][4] . $row_user['PRBTime'][5] . $row_user['PRBTime'][6] . $row_user['PRBTime'][7];
				echo'
					<tr id = "' . $row_user['PRBID'] . '">
						<td style="text-align:center;">
							' . $countlist . '
						</td>
						<td style="text-align:center;">
							' . $row_userPtUser['UNaam'] . ' , ' . $ageOfUserIs . '
						</td>
						<td>
							&emsp;&emsp;
							<a href="#myModal' . $countlist . '" id="' . $row_user['PRBID'] . '_' . $row_userPtUser['UID'] . '" onclick="jeje(id)" data-toggle="modal">
								' . $row_userPtUser['UFNaam'] . ' ' . $row_userPtUser['ULNaam'] . '
							</a>
						</td>
						<td style="text-align:center; border-left:none;">
							---
						</td>
				';
				$currentDcFeeIs	=	0;
				while ($row_userDcUser	=	mysqli_fetch_assoc($dcName))
				{
					$currentDcFeeIs	=	$row_userDcUser['UDcFee'];
					echo '
						<td style="border-left:none;">
							' . $row_userDcUser['UFNaam'] . ' ' . $row_userDcUser['ULNaam'] . '
						</td>
					';
					/*echo'
						<td style="text-align:center;">
							' . $ageOfUserIs . '
						</td>
					';*/
					echo'
						<td style="text-align:right;">
							' . $timetobedisplayed . '
						</td>
						<td style="text-align:center; border-left:none;">
							-
						</td>
						<td style=" border-left:none;">
							' . $row_userDcUser['USpeciality'] . '
						</td>
					</tr>
					<script>
						var mdidANDqt' . $row_user['PRBID'] . ' = new Array();
						var mdqtANDid' . $row_user['PRBID'] . ' = new Array();
						var mdprANDid' . $row_user['PRBID'] . ' = new Array();
					</script>
					<script></script>
					';
				}
				echo'
					<div id="myModal' . $countlist . '" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-header" id="mdlhdr">
							<button class="close" data-dismiss="modal" aria-hidden="true">X</button>
							<h3 id="myModalLabel">
								Creating ' . $row_userPtUser['UFNaam'] . ' ' . $row_userPtUser['ULNaam'] .'\'s' . ' Bill
							</h3>
						</div>
						<div class="modal-body" id="mdlbdy">						
							<div class="span5">
								<img class="mdlbdyImgPrescription"
									id="zoom_01"
									src=" ' . $row_user['PRImg'] . ' "
									data-zoom-image=" ' . $row_user['PRImg'] . ' "
								/>
							</div>
				';
				//id = "' . $row_user['PRBID'] . '"
				echo'
							<div class="span7" id="divspan' . $row_user['PRBID'] . '" style="background-color:WHITE;">
								<div style="border:1px solid BLACK; border-radius:5px;">
									<div class="row-fluid" style="padding-top:5px; text-align:center; background-color:#70BCE5; color:WHITE;">
										<div class="span12">
										    <span class="span4" style="text-align:right;">Medicine Names</span>
										    <span class="span3">&emsp;&emsp;&emsp;Quantity</span>
										    <span class="span1"></span>
										    <span class="span2" style="text-align:left">Prices</span>
									    </div>
									</div>
								    <div style="text-align:left; padding-right:5px;">
								    	<div class="pre-scrollable" style="min-height:321px;">
									    	<div class="row-fluid" id="oneoneonetag' . $row_user['PRBID'] . '" style="text-align:center"></div>
											<div class="span11" style="padding-top:10px;" id="mdcOfPtID' . $row_user['PRBID'] . '_1">
												<p class="span1" style="padding-top:5px;"><span class="badge badge-info">1</span></p>
												<select class="span5 pull-left" id="pt' . $row_user['PRBID'] . 'mdrw1"  oninput="changeBorderColor(id);" style="border:1px solid YELLOW" autofocus>
													<option value="0">None</option>
				';
				foreach($strBldMdIDPHP as $key => $content)
				{
					$contentb = $strBldMdPHP[$key];
					echo'
													<option value="' . $content . '">' . $contentb . '</option>
					';
				}
				
				echo'
												</select>
												<select class="span2 pull-left" id="pt' . $row_user['PRBID'] . 'qtrw1"  oninput="changeBorderColorQt(id);">
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
												</select>
												<button class="btn btn-info btn-mini pull-right" id="btn' . $row_user['PRBID'] . 'xlmth_1"  onclick="addNewInputTags(id);">+</button>
												<p class="span2 pull-right" style="padding-top:7px;"  id="pt' . $row_user['PRBID'] . 'prrw1" name="mdcPrice_1">1 x 0</p>
											</div>
										</div>
									</div>
									<div class="row-fluid" style="padding-top:5px; text-align:left; background-color:#70BCE5; color:WHITE;">
										<div class="span12" style="margin-bottom:5px;">
										    <span class="span4" style="text-align:center; padding-top:12px;">Current Bill: Rs&emsp;<span style="color:BLACK; font-size:16px; font-weight:bold;" id="ttlBill' . $row_user['PRBID'] . '">' . $currentDcFeeIs . '</span></span>
										    <span class="span5" style="padding-top:5px;">Paid: <input type="text" id="paidptID' . $row_user['PRBID'] . '_' . $row_userPtUser['UID'] . '" oninput="validatePaidIntegerNot(id)"/></span>
										    <span class="span3" style="padding-top:5px;"><button class="btn" type="submit" id="cretBill' . $row_user['PRBID'] . '_' . $row_userPtUser['UID'] . '" onclick="ScheduleCheckBillBefore(id)" style="background-color:WHITE;">Create Bill</button></span>
									    </div>
									</div>
								</div>
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