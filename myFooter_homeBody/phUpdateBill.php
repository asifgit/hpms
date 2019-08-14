<?php
	include('cnct.php');

	$billIDToBeUpdated	=	$_GET['billIDPassedIs'];
	$billPaidToBeAdded	=	$_GET['billAmountToBeAdded'];
	//echo $billIDToBeUpdated . " Bill-ID " . $billPaidToBeAdded;
	$previousAmountIs		=	0;
	$qryToGetPreviousPaid	=	"SELECT `PRBPaid` FROM `hmsaaabillsp` WHERE `PRBID`='$billIDToBeUpdated'";
	$rzGetPreviousPaid		=	mysqli_query($con, $qryToGetPreviousPaid);
	if($rzGetPreviousPaid)
	{
		while ($row_BillAmountPrev	=	mysqli_fetch_assoc($rzGetPreviousPaid)	)
		{
			$previousAmountIs	=	$row_BillAmountPrev['PRBPaid'];
		}
		//echo "\n" . $previousAmountIs;
		$AmountToBeUpdated	=	$previousAmountIs	+	$billPaidToBeAdded;
		//echo "\n" . $AmountToBeUpdated;
		$qryToUpdateBillAmount	=	"UPDATE `hmsaaabillsp` SET `PRBPaid`='$AmountToBeUpdated' WHERE `PRBID`='$billIDToBeUpdated'";
		//echo "\n" . $qryToUpdateBillAmount;
		$rzQryToUpdateBillAmount	=	mysqli_query($con, $qryToUpdateBillAmount);
		if($rzQryToUpdateBillAmount)
		{
			echo "
				<script>
					document.getElementById('txtFrntUpdt" . $billIDToBeUpdated . "').className 	=	'label label-success';
					document.getElementById('upTxtBx" . $billIDToBeUpdated . "').setAttribute('disabled','true');
				</script>
			";
			echo "Bill updated successfully";
		}
		else
		{
			echo "
				<script>
					document.getElementById('txtFrntUpdt" . $billIDToBeUpdated . "').className 	=	'label label-warning';
				</script>
			";
			echo "Something went wrong, try again";
		}
	}
	mysqli_close($con);
?>