<?php
	include('cnct.php');
	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to mysql: " . mysqli_connect_error();
		exit();
	}
	
	$myID	=	$_SESSION['FlID'];

	$billPResults	= mysqli_query($con, "SELECT * FROM hmsaaabillsp WHERE PRBPtID='$myID'");
	echo'
			<b class="txtInTabs">Bills History:</b>
	';
	if (mysqli_num_rows($billPResults) == 0)
	{
		echo '
			<p style="padding-left:120px;">You have no bills.</p>
		';
	}
	else
	{
		echo'
	        <ul class="enlarge">
		';

		while($row_billsP = mysqli_fetch_assoc($billPResults))
		{
			$Unpaid	=	$row_billsP['PRBTotal']-$row_billsP['PRBPaid'];
			echo'
	    		<li class="folded-lefttop">
					<p class="hdrInBill">
						<b>
							' . $row_billsP['PRBDate'] . '
						</b>
					</p>
					<div class="pre-scrollable">
						<table class="table table-condensed">
							<thead class="BlTblHdrs">
								<tr>
									<th>Medicines</th>
									<th>Prices (Rs)</th>
								</tr>
							</thead>
							<tfoot class="BlTblFtrs">
								<tr>
									<td colspan="2" style="color:BLACK ;"><br>Doctor Fee: &nbsp;&nbsp;&nbsp;&nbsp;
										' . $row_billsP['PRBDcFee'] . '
									</td>
								</tr>
								<tr>
									<td colspan="2" style="color:BLACK;">Total Bill: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										' . $row_billsP['PRBTotal'] . '
									</td>
								</tr>
								<tr style="color:GREEN;">
									<td colspan="2">Paid: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										' . $row_billsP['PRBPaid'] . '
									</td>
								</tr>
								<tr>
									<td colspan="2" style="color:rgb(189, 0, 0);">Unpaid: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										' . $Unpaid . '
									</td>
								</tr>
							</tfoot>
							<tbody>
			';
							$noMDInBill		=	false;
							$pbMedResults	= mysqli_query($con, "SELECT * FROM hmsaaapbmedicines");
							if(mysqli_num_rows($pbMedResults) == 0)
							{
								$noMDInBill		=	true;
							}
							if($noMDInBill)
							{
								echo '
												<tr>
													<td colspan="2" style="text-align:center;">No Medicines<hr style="padding-top:0px; margin-top:0px;"></td>
												</tr>

								';
							}
							while($row_medicines = mysqli_fetch_array($pbMedResults))
							{
								if($row_billsP['PRBID'] == $row_medicines['PRBID'])
								{
									$MedResults		= mysqli_query($con, "SELECT * FROM hmsaaamedicines");
									while($row_medicinedetails = mysqli_fetch_array($MedResults))
									{
										if($row_medicines['MDID'] == $row_medicinedetails['MDID'])
										{
											$priceOfOneRow	=	$row_medicines['PRMDAmountPrescribed'] * $row_medicines['PRMDAmountPrescribedPrice'];
											echo '
												<tr>
													<td class="pull-left">
														' . $row_medicinedetails['MDName'] . '
													</td>
													<td>										
														' . $row_medicines['PRMDAmountPrescribed'] . ' x ' . $row_medicines['PRMDAmountPrescribedPrice'] . '<i class="pull-right">= ' . $priceOfOneRow . '</i>
													</td>
												</tr>
											';
										}
									}
								}
							}
			echo'
							</tbody>
						</table>
					</div>
				</li>
	        ';
		}
	    echo'
			</ul>
		';
	}

	mysqli_close($con);
?>