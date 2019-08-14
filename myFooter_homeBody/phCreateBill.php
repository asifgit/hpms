<?php
	include('cnct.php');

	$prIID	=	$_GET['prescriptionID'];
	
	$ptIID	=	$_GET['patientID'];
	$dcFee	=	100;
	$mBill	=	$_GET['currentTotalBill'];
	$pBill	=	$_GET['paidTotalBill'];
	$uBill	=	$mBill	-	$pBill;

	$mdIDsAre	=	$_GET['prptMedicinesAre'];
	//echo $mdIDsAre . "<br>";

	$arrayMDAllInfoWithBill		=	explode(",", $mdIDsAre);

	$myDateToDisplayEnterBill	=	getdate(date("U"));

	date_default_timezone_set("Asia/Karachi");
	$tme24 = date("H:i:s");
	$dtttt = date("Y-m-d");
	$tme12 = date("g:i a", strtotime($tme24));

	$qryToGetName	=	"SELECT UFNaam, ULNaam FROM hmsaaausers WHERE UID=$ptIID AND URID=2";
	$nameRz			=	mysqli_query($con, $qryToGetName);

	$qryEnterBill	=	"INSERT INTO `hmsaaabillsp` (`PRBID`, `PRBPtID`, `PRBDcFee`, `PRBTotal`, `PRBPaid`, `PRBDate`, `PRBTime`) 
							VALUES ('$prIID', '$ptIID', '$dcFee', '$mBill', '$pBill', '$dtttt', '$tme24')";
	$rzEnterBill	=	mysqli_query($con, $qryEnterBill);

	if($rzEnterBill)
	{
		echo "
			<script>
				//document.getElementById('divspan" . $prIID . "').innerHTML='';
			</script>
		";
		echo "
			<br>
			<div class='row-fluid'>
				<div class='span8 offset2' id='rowLoading" . $prIID . "'>
					<div class='span11 progress progress-striped active' id='loadingClass" . $prIID . "'>
						<div class='bar span3' style='width: 2%;' id='loading" . $prIID . "'>Creating Bill</div>
					</div>
					<button class='close span1' onclick='reomoveLoader(" . $prIID . ");'>x</button>
				</div>
			</div>
		";
		//<span class='alert alert-success pull-left' style='font-size:12px;'>Bill created Successfully</span>
		$j	=	1;
		for ($i=0; $i < sizeof($arrayMDAllInfoWithBill); $i++)
		{
			if($i%3==0 && $arrayMDAllInfoWithBill[$i]!="0")
			{	$mdIDdd	=	$arrayMDAllInfoWithBill[$i];	//echo $mdIDdd . " ";	
			}
			if($i%3==1 && $arrayMDAllInfoWithBill[$i-1]!="0")
			{	$mdQTdd	=	$arrayMDAllInfoWithBill[$i];	//echo $mdQTdd . " ";	
			}
			if($i%3==2 && $arrayMDAllInfoWithBill[$i-2]!="0")
			{
				$mdPRdd	=	$arrayMDAllInfoWithBill[$i];	//echo $mdPRdd . "<br>";
				$qryEnterBillMdInfo	=	"INSERT INTO `hmsaaapbmedicines` (`PRBID`, `MDID`, `PRMDAmountPrescribed`, `PRMDAmountPrescribedPrice`) 
										VALUES ('$prIID', '$mdIDdd', '$mdQTdd', '$mdPRdd')";
				mysqli_query($con, $qryEnterBillMdInfo);
				$qrygetMedicineInfo	=	"SELECT MDQuantity, MDSaleLeastUnit FROM hmsaaamedicines WHERE MDID=$mdIDdd";
				//echo $qrygetMedicineInfo . "<br>";
				$getMedicineInfo	=	mysqli_query($con, $qrygetMedicineInfo);
				while($row_medSaleUnit	=	mysqli_fetch_assoc($getMedicineInfo))
				{
					$totalGramsPrevious			=	$row_medSaleUnit['MDQuantity'];
					$totalGramsToBeSubtracted	=	$row_medSaleUnit['MDSaleLeastUnit'] * $mdQTdd;
					$totalGramsToBeUpdated		=	$totalGramsPrevious - $totalGramsToBeSubtracted;
					//echo "<br>In DB: " . $totalGramsPrevious . "&emsp;" . $totalGramsToBeSubtracted . "<br>" . $row_medSaleUnit['MDSaleLeastUnit'] . " * " . $mdQTdd . " =&emsp;" . $totalGramsToBeSubtracted;
					$qryToSubtractPhInventory	=	"UPDATE `hmsaaamedicines` SET `MDQuantity`='$totalGramsToBeUpdated' WHERE `MDID`='$mdIDdd'";
					$rzToSubtractPhInventory	=	mysqli_query($con, $qryToSubtractPhInventory);
				}
			}
			if($i%3==0)
			{
				echo "
					<script>
						document.getElementById('btn" . $prIID . "xlmth_" . $j . "').setAttribute('disabled','true');
						document.getElementById('pt" . $prIID . "mdrw" . $j . "').setAttribute('disabled','true');
						document.getElementById('pt" . $prIID . "qtrw" . $j . "').setAttribute('disabled','true');
					</script>
				";
				$j++;
			}
		}
		echo"
			<table class='billPrint span6 offset3' style='content-align:center; padding-top:2px;' id='billRecept_" . $prIID . "'>
				<thead style='background-color:rgb(63, 195, 175); color:WHITE;'>
					<tr>
						<th colspan='3' style='text-align:center;'>TDK Pharmacists Multan<br>" . $tme12 . " - " . $dtttt . "</th>
					</tr>
				</thead>
		";
		echo"
				<tbody style=''>
					<tr style='text-align:left;'>
						<th colspan='1' >&emsp;Patient Name: </th>
		";
		if($nameRz)
		{
			while($row_NameUser = mysqli_fetch_assoc($nameRz))
			{
				echo"
						<td colspan='2'>&emsp;" . $row_NameUser['UFNaam'] . " " . $row_NameUser['ULNaam'] . "</td>
				";
			}
		}
		else
		{
			echo"
						<td colspan='2'>&emsp;Can't retrieve</td>
			";
		}
		echo"
					</tr>
					<tr style='text-align:left;'>
						<th colspan='1'>&emsp;Doctor's Fee: </th>
						<td colspan='2'>&emsp;" . $dcFee . " Rs</td>
					</tr>
					<tr>
						<td colspan='3'><hr style='padding:0px;margin:0px;'></td>
					</tr>
					<tr style='text-align:left;'>
						<th colspan='1' style='width:180px;' >&emsp;&emsp;Medicine</th>
						<th colspan='2' style='width:150px; text-align:center;' >Quantity x Price</th>
					</tr>
					<tr>
						<td colspan='3'><hr style='padding:0px;margin:0px;'></td>
					</tr>
		";
		$nomedicines	=	1;
		$sizeofMedAr	=	sizeof($arrayMDAllInfoWithBill);
		//echo $sizeofMedAr;
		if($nomedicines	==	$sizeofMedAr)
		{	$nomedicines	=	1;	}
		else
		{	$nomedicines	=	2;	}

		for ($i=0; $i < sizeof($arrayMDAllInfoWithBill); $i++)
		{
			if($i%3==0 && $arrayMDAllInfoWithBill[$i]!="0")
			{	$mdIDdd	=	$arrayMDAllInfoWithBill[$i];	//echo $mdIDdd . " ";
			}
			if($i%3==1 && $arrayMDAllInfoWithBill[$i-1]!="0")
			{	$mdQTdd	=	$arrayMDAllInfoWithBill[$i];	//echo $mdQTdd . " ";
			}
			if($i%3==2 && $arrayMDAllInfoWithBill[$i-2]!="0")
			{
				$mdPRdd				=	$arrayMDAllInfoWithBill[$i];	//echo $mdPRdd . "<br>";
				$qryGetMDName		=	"SELECT MDName FROM hmsaaamedicines WHERE MDID = $mdIDdd";
				$rzqryGetMDName		=	mysqli_query($con, $qryGetMDName);
				while($row_MDName	=	mysqli_fetch_assoc($rzqryGetMDName))
				{
				echo"
					<tr>
						<td colspan='1' style='text-align:left;'>&emsp;" . $row_MDName['MDName'] . "</td>
						<td colspan='2' style='text-align:left;'>&emsp;&emsp;&emsp;" . $mdQTdd . " x " . $mdPRdd . "</td>
					</tr>
				";
				}
			}
		}
		if($nomedicines==1)
		{
			echo "
					<tr style='text-align:center;'>
						<td colspan='1'>---</td>
						<td colspan='2'>--</td>
					</tr>
			";
		}
		echo"
				</tbody>
				<tfoot style='text-align:left; padding-top:5px;'>
					<tr>
						<td colspan='3'><hr style='padding:0px;margin:0px; font-weight:bold'></td>
					</tr>
					<tr>
						<th colspan='1' >&emsp;&emsp;&emsp;Total Bill: </th>
						<td colspan='2'>&emsp;&emsp;&emsp;" . $mBill . "</td>
					</tr>
					<tr>
						<th colspan='1' >&emsp;&emsp;&emsp;Paid: </th>
						<td colspan='2'>&emsp;&emsp;&emsp;" . $pBill . "</td>
					</tr>
		";
		if($uBill!=0)
		{
			echo"
					<tr>
						<th colspan='1' >&emsp;&emsp;&emsp;Unpaid: </th>
						<td colspan='2'>&emsp;&emsp;&emsp;" . $uBill . "</td>
					</tr>
			";
		}
		echo"
				</tfoot>
			</table>
			<a href='#' class='span12' id='" . $prIID . "' onclick='printCreatedBill(id); return false;' style='color:rgb(218, 76, 216);'>Print Bill</a>
		";

		echo "
			<script>
				document.getElementById('cretBill" . $prIID . "_" . $ptIID . "').disabled=true;
				document.getElementById('paidptID" . $prIID . "_" . $ptIID . "').setAttribute('readonly','true');
			</script><br><br><br><br><br><br>
		";
		$qryUpdatePresStatus	=	"UPDATE `hmsaaapreb` SET `PRBReachedPharmacy`='1' WHERE `PRBID`='$prIID'";
		$rzUpdtPresStatus		=	mysqli_query($con, $qryUpdatePresStatus);
	}
	else
	{
		echo "<span class='alert alert-error'>Something went wrong, please try again.</span>";
		echo"
			<div class='progress progress-striped active' id='loadingClass" . $prIID . "' hidden>
				<div class='bar span3' style='width: 2%;' id='loading" . $prIID . "'>Creating Bill</div>
			</div>
		";
	}
?>