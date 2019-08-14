<?php
	include('cnct.php');
	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to mysql: " . mysqli_connect_error();
		exit();
	}
	
	$medicinesResults	= mysqli_query($con, "SELECT * FROM hmsaaamedicines ORDER BY MDName");
	echo'
		<tbody class="searchable">
	';
	
	if (mysqli_num_rows($medicinesResults) == 0)
	{
		echo'
			<tr>
				<td style="text-align:center; font-style:italic;" colspan="5">
					No Medicines in the Pharmacy.
				</td>
			</tr>
		';
	}
	else
	{
		$currentInventoryPriceOfPharmacy	=	0;
		$totalUnits							=	0;
		$countlist=1;
		while ($row_medicines = mysqli_fetch_assoc($medicinesResults))
		{
			$mdPriceOfLeastUnit	=	$row_medicines['MDSaleUnitPrice'];
			$mdLeastUnitOfSale	=	$row_medicines['MDSaleLeastUnit'];
			$mdTotalAmount		=	$row_medicines['MDQuantity'];

			//$currentPrice						=	($mdTotalAmount / $mdLeastUnitOfSale)	*	$mdPriceOfLeastUnit;
			//		OR
			$currentPrice						=	($mdTotalAmount * $mdPriceOfLeastUnit)	/	$mdLeastUnitOfSale;
			$currentInventoryPriceOfPharmacy	=	$currentInventoryPriceOfPharmacy		+	$currentPrice;
			$numberOfUnits						=	$mdTotalAmount / $mdLeastUnitOfSale;
			$totalUnits							=	$totalUnits								+	$numberOfUnits;

			echo'
				<tr id = "' . $row_medicines['MDID'] . '">
					<td style="text-align:center;">
						' . $countlist . '
					</td>
					<td>&emsp;&emsp;&emsp;&emsp;
						' . $row_medicines['MDName'] . '
					</td>
					<td style="text-align:center;">
						' . $numberOfUnits . '
					</td>
					<td>&emsp;&emsp;&emsp;&emsp;
						' . $mdTotalAmount . '&emsp;<i>' . $row_medicines['MDUnit'] . '</i>
					</td>
					<td>&emsp;&emsp;&emsp;&emsp;
						' . $currentPrice . '
					</td>
					<td>
						' . '&emsp;&emsp;&emsp;' . $row_medicines['MDBarcode'] . '
					</td>
				</tr>
			';

			$countlist++;
		}
		echo '
			</tbody>
			<tfoot style="background-color:#055c8b; color:WHITE;">
				<tr>
					<td colspan="4" style="text-align:center;">
						Totol Price =&emsp;' . number_format($currentInventoryPriceOfPharmacy) . ' <span style="font-weight:BOLD; color:rgb(54, 189, 25);"> / </span>Rs
					</td>
					<td colspan="2" style="text-align:center;">
						Totol Units =&emsp;' . $totalUnits . '
					</td>
				</tr>
			</tfoot>
		';
	}
	mysqli_close($con);
?>