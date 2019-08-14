<?php
	include('cnct.php');
	session_start();
	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to mysql: " . mysqli_connect_error();
		exit();
	}
	$ptName	=	$_POST["PNM"];		$ptName	=	mysqli_real_escape_string($con, $ptName);
	$ptId	=	$_SESSION['FlID'];
	$dcName	=	$_POST['DNM'];		$dcName	=	mysqli_real_escape_string($con, $dcName);
	$apDlt	=	0;
	$apDate	=	$_POST['APDT'];		$apDate	=	mysqli_real_escape_string($con, $apDate);
	$apTime	=	$_POST['APTM'];		$apTime	=	mysqli_real_escape_string($con, $apTime);
	$dId	=	$_POST['DID'];		$dId	=	mysqli_real_escape_string($con, $dId);

	echo $ptId . ' ' . $ptName . '<br>' . $dId . ' ' . $dcName . '<br>' . $apDate . '<br>' . $apTime . '<br>';
	$insertAppntment	=	"INSERT INTO `hmsaaaappointments` (`APPtID`, `APDcID`, `APDate`, `APTime`, `APDealt`) 
							VALUES ('$ptId', '$dId', '$apDate', '$apTime', '$apDlt')";

//"INSERT INTO  `bol_final`.`message` (`mid` ,`messagetype`,`fromuser`,`touser`,`textorpath`,`from_uname`,`pic`)
//		VALUES (NULL ,'$data','$usid','$client_id','$txt','$usnm','$pic')");


							//	INSERT INTO MyGuests (firstname, lastname, email)
							//	VALUES ('John', 'Doe', 'john@example.com')
	$INSQRY	=	mysqli_query($con, $insertAppntment);

	if($INSQRY)
	{
		echo "Inserted successfully";
	}
	else
	{
		echo"Not Inserted";
	}
	
	mysqli_close($con);
	header('Location: ../lgdinPtViewAp.php?id=1');
?>