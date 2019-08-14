<?php
	include('cnct.php');
	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to mysql: " . mysqli_connect_error();
		exit();
	}

	$qryToGetPtNames	=	"SELECT UID, UFNaam, ULNaam, UNaam FROM hmsaaausers WHERE URID=2";
	$rzqryToGetPtNames	=	mysqli_query($con, $qryToGetPtNames);

	if($rzqryToGetPtNames)
	{
		echo'
			<tbody>
		';

		$UnpaidResults		=	mysqli_query($con, "SELECT * FROM hmsaaabillsp WHERE PRBTotal!=PRBPaid ORDER BY PRBPtID");

		if (mysqli_num_rows($UnpaidResults) == 0)
		{
			echo'
						<tr>
							<td style="text-align:center; font-style:italic;" colspan="5">
								No Unpaid Bills.
							</td>
						</tr>
			';
		}
		else
		{
			$countlist	=	1;
			$uzrIDs		=	"";
			$uzrNames	=	"";
			$uzrLgIDs	=	"";
			while($row_user	=	mysqli_fetch_assoc($rzqryToGetPtNames))
			{
				$uzrIDs		=	$uzrIDs . $row_user['UID'] . "," ;
				$uzrNames	=	$uzrNames . $row_user['UFNaam'] . " " . $row_user['ULNaam'] . ",";
				$uzrLgIDs	=	$uzrLgIDs . $row_user['UNaam'] . ",";
				$countlist++;
			}
			$uzrIDs		=	substr($uzrIDs,0,-1);
			$uzrNames	=	substr($uzrNames,0,-1);
			$uzrLgIDs	=	substr($uzrLgIDs,0,-1);
			$countlist--;
			$uzrIDs		=	explode(",", $uzrIDs);
			$uzrNames	=	explode(",", $uzrNames);
			$uzrLgIDs	=	explode(",", $uzrLgIDs);
			$newCount	=	1;
			$cntrBillID	=	1;
			while ($row_unpaid = mysqli_fetch_assoc($UnpaidResults))
			{
				echo "
					<script>
						window['allBillIDs'+" . $cntrBillID . "]	=	" . $row_unpaid['PRBID'] . ";
					</script>
					<script></script>
				";
				$cntrBillID++;
				for($ji=0;$ji<$countlist;$ji++)
				{
					if($uzrIDs[$ji]	==	$row_unpaid['PRBPtID'])
					{
						$unPaidCalculatedIs	=	$row_unpaid['PRBTotal']	-	$row_unpaid['PRBPaid'];
						if($newCount==1)
						{
						echo "
							<tr>
								<td style='text-align:center; background-color:WHITE; border-top:2px solid #055c8b;' id='t1d" . $row_unpaid['PRBID'] . "'>" . $newCount . "</td>
								<td style='border-top:2px solid #055c8b;'>&emsp;&emsp;" . $uzrNames[$ji] . "</td>
								<td style='border-top:2px solid #055c8b;'>&emsp;&emsp;" . $uzrLgIDs[$ji] . "</td>
								<td style='text-align:right; border-top:2px solid #055c8b;'>&emsp;&emsp;&emsp;&emsp;" . $unPaidCalculatedIs . "</td>
								<td style='width:5px; border:none; border-top:2px solid #055c8b;'>-</td>
								<td style='text-align:left; border:none; border-top:2px solid #055c8b;'>
									<input id='upTxtBx" . $row_unpaid['PRBID'] . "' type='text' style='margin:0px; padding:0px;'
										oninput='blockValueOrNot(value, id, " . $row_unpaid['PRBID'] . ");' 
										onkeypress='return ((event.charCode >= 48 && event.charCode <= 57))' 
										onkeyup='displayunicode(event, value, " . $row_unpaid['PRBID'] . ", " . $unPaidCalculatedIs . "); this.select()'
										onfocus='highlightTheRow(" . $row_unpaid['PRBID'] . ");' 
										onblur='deHighlightTheRow(" . $row_unpaid['PRBID'] . ");' placeholder=' Less / Equal to &emsp;" . $unPaidCalculatedIs . "'
									>
								</td>
								<td style='width:250px; border-top:2px solid #055c8b; border-left:none;'><span class='label label-success' style='margin:0px;' id='txtFrntUpdt" . $row_unpaid['PRBID'] . "'></span></td>
							</tr>
						";
						}
						else
						{
						echo "
							<tr>
								<td style='text-align:center; background-color:WHITE;' id='t1d" . $row_unpaid['PRBID'] . "'>" . $newCount . "</td>
								<td>&emsp;&emsp;" . $uzrNames[$ji] . "</td>
								<td>&emsp;&emsp;" . $uzrLgIDs[$ji] . "</td>
								<td style='text-align:right;'>&emsp;&emsp;&emsp;&emsp;" . $unPaidCalculatedIs . "</td>
								<td style='width:5px; border:none; border-top:1px solid #dddddd;'>-</td>
								<td style='text-align:left; border:none; border-top:1px solid #dddddd;'>
									<input id='upTxtBx" . $row_unpaid['PRBID'] . "' type='text' style='margin:0px; padding:0px;' 
										oninput='blockValueOrNot(value, id, " . $row_unpaid['PRBID'] . ");' 
										onkeypress='return ((event.charCode >= 48 && event.charCode <= 57) || event.keyCode == 13)' 
										onkeyup='displayunicode(event, value, " . $row_unpaid['PRBID'] . ", " . $unPaidCalculatedIs . "); this.select()' 
										onfocus='highlightTheRow(" . $row_unpaid['PRBID'] . ");' 
										onblur='deHighlightTheRow(" . $row_unpaid['PRBID'] . ");' placeholder=' Less / Equal to &emsp;" . $unPaidCalculatedIs . "' 
									>
								</td>
								<td style='width:250px; border-left:none;'><span class='label label-success' style='margin:0px;' id='txtFrntUpdt" . $row_unpaid['PRBID'] . "'></span></td>
							</tr>
						";
						}
						$newCount++;
					}
				}
			}
			echo "
				<script>
					var BillIDsUpTo	=	" . $cntrBillID . ";
				</script>
			";

			$currentInventoryPriceOfPharmacy	=	0;
			$totalUnits							=	0;
			echo '
				</tbody>
				<tfoot style="background-color:#055c8b; color:WHITE;">
					<tr>
						<td colspan="7" style="height:15px;"></td>
					</tr>
				</tfoot>
			';
			/*			<td colspan="5" style="text-align:center;">
							Totol Price =&emsp;' . number_format($currentInventoryPriceOfPharmacy) . ' <span style="font-weight:BOLD; color:rgb(54, 189, 25);"> / </span>Rs
						</td>
						<td colspan="2" style="text-align:center;">
							Totol Units =&emsp;' . $totalUnits . '
						</td>		*/
		}
	}
	mysqli_close($con);
?>