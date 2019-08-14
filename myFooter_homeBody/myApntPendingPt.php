<?php
	include('cnct.php');
	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to mysql: " . mysqli_connect_error();
		exit();
	}

	$myDateToGetOnwardAppointments=getdate(date("U"));
	if($myDateToGetOnwardAppointments['mon']<10)
	{
		$dateBuilderString = $myDateToGetOnwardAppointments['year'] . "-0" . $myDateToGetOnwardAppointments['mon'] . "-";
		if($myDateToGetOnwardAppointments['mday']<10)
		{
			$dateBuilderString = $dateBuilderString . "0" .  $myDateToGetOnwardAppointments['mday'];
		}
		else
		{
			$dateBuilderString = $dateBuilderString .  $myDateToGetOnwardAppointments['mday'];
		}
	}
	else
	{
		$dateBuilderString = $myDateToGetOnwardAppointments['year'] . "-" . $myDateToGetOnwardAppointments['mon'] . "-";
		if($myDateToGetOnwardAppointments['mday']<10)
		{
			$dateBuilderString = $dateBuilderString . "0" .  $myDateToGetOnwardAppointments['mday'];
		}
		else
		{
			$dateBuilderString = $dateBuilderString .  $myDateToGetOnwardAppointments['mday'];
		}
	}

	$dateBuilderStringpp		= new DateTime();
	$dateBuilderString		= $dateBuilderStringpp->format("Y-m-d");
	//echo $dateBuilderStringpp;
	$abc	=	gettimeofday();//(time("U"));
	/*echo "
		<script type='text/javascript'>
			console.log( " . $abc . " );
		</script>
	";*/
	$ptIDToBeChecked		=	$_SESSION['FlID'];
	
	$ApntsPtResultsPending	= mysqli_query($con, "SELECT * FROM hmsaaaappointments WHERE APDate>=DATE_SUB( NOW( ) , INTERVAL 1
DAY ) AND APDealt='0' AND APPtID=" . $ptIDToBeChecked . " ORDER BY APDate, APTime");

	echo '
			<b class="txtInTabs">Pending Appointments:</b>
	';
	if (mysqli_num_rows($ApntsPtResultsPending) == 0)
	{
		echo '
			<p style="padding-left:120px;">You have no Appointment pending.</p>
			<br>
			<strong style="padding-left:95px;">Or else: </strong><br>
			<a class="txtInTabs" style="padding-left:120px;" href="#" onclick="showViewsPt(7);">Get Appointed</a>
		';
	}
	else
	{
		echo'
			<div class="row-fluid">
				<div class="span10 offset1">
		';
		echo "
					<br>
					<table class='table table-striped table-hover table-condensed table-bordered'>
						<thead>
							<tr style='color:WHITE; background-color:#055c8b;'>
								<th style='text-align:center;width:20px;'>S.No</th>
								<th style='text-align:center; width:200px;' colspan='3'>Date & Time</th>
								<th style='text-align:center;'>Action</th>
								<th style='text-align:left; padding-left:70px;'>Doctor</th>
							</tr>
						</thead>
						<tbody>
		";
		$cntr	=	1;
		while ($row_userAPPts = mysqli_fetch_assoc($ApntsPtResultsPending))
		{			
			//$row_userAPPts['APPtID'];
			$dcIDWhosChecked		=	$row_userAPPts['APDcID'];
			$usrNamesPts			=	mysqli_query($con, "SELECT UFNaam, ULNaam, UAdress, UAge FROM hmsaaausers WHERE UID = $ptIDToBeChecked");
			$dcNames				=   mysqli_query($con, "SELECT UFNaam, ULNaam FROM hmsaaausers WHERE UID = $dcIDWhosChecked");
			while($row_userAPPtsPtUserAPpendings 	=	mysqli_fetch_assoc($usrNamesPts))
			{
					$timetobedisplayed	=	date("g:i a", strtotime($row_userAPPts['APTime']));
					$datetobedisplayed	=	$row_userAPPts['APDate'];
					$datetobedisplayed	=	$datetobedisplayed[8] . $datetobedisplayed[9] .'-' . $datetobedisplayed[5] . $datetobedisplayed[6] .'-' . $datetobedisplayed[0] . $datetobedisplayed[1] . $datetobedisplayed[2] . $datetobedisplayed[3];
					
					echo '
							<tr id="' . $row_userAPPts['APID'] . '">
								<td style="text-align:center;"><span class="badge badge-info" margin:0px;>' . $cntr . '</span></td>
								<td style="text-align:right; width:120px;">
									' . $datetobedisplayed . '
								</td>
								<td style="text-align:center; width:55px; border-left:none;">
									at
								</td>
								<td style="text-align:right; width:120px; border-left:none;">
									' . $timetobedisplayed . '&emsp;&emsp;&emsp;&emsp;
								</td>
								<td style="text-align:center; width:180px;" id = "haha' . $row_userAPPts['APID'] . '">
									<a style="color:rgb(242, 26, 43);" href="#" onclick="cancelTkn(' . $row_userAPPts['APID'] . ');">Cancel</a>
								</td>
					';
					while($row_userAPPtsDcUserAPpendings 	=	mysqli_fetch_assoc($dcNames))
				    {
						echo'
								<td style="text-align:left; padding-left:70px;">
									' . $row_userAPPtsDcUserAPpendings['UFNaam'] . ' ' . $row_userAPPtsDcUserAPpendings['ULNaam'] . '
								</td>
						';
					}
					echo '
							</tr>
					';
			}
			$cntr++;
		}
		echo '
						</tbody>
					</table>
					<br>
					<strong >Or else: </strong><br>
					<a class="txtInTabs" href="#" onclick="showViewsPt(7);">Get Appointed</a>
				</div>
			</div>
		';

	}

	mysqli_close($con);
?>	