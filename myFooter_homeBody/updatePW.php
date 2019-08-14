<?php
	include('cnct.php');
	session_start();
	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to mysql: " . mysqli_connect_error();
		exit();
	}
	$oldPWD	=	$_POST["oldP"];		$oldPWD	=	mysqli_real_escape_string($con, $oldPWD);
	$UzrId	=	$_SESSION["FlID"];
	$RID	=	$_SESSION["RlID"];
	$newPW1	=	$_POST['newP1'];		$newPW1	=	mysqli_real_escape_string($con, $newPW1);
	$newPW2	=	$_POST['newP2'];		$newPW2	=	mysqli_real_escape_string($con, $newPW2);
	$updatePW;
	echo $UzrId . '<br>' . $oldPWD . '<br>' . $newPW1 . '<br>' . $newPW2 . '<br>';
	if($newPW1==$newPW2)
	{
		$updatePW	=	"UPDATE `hmsaaausers` SET `UPwd`='$newPW2' WHERE `UID`='$UzrId'";

	}
	else
	{
		echo "Something went wrong, you tried to hack the system.";
	}

//"INSERT INTO  `bol_final`.`message` (`mid` ,`messagetype`,`fromuser`,`touser`,`textorpath`,`from_uname`,`pic`)
//		VALUES (NULL ,'$data','$usid','$client_id','$txt','$usnm','$pic')");


							//	INSERT INTO MyGuests (firstname, lastname, email)
							//	VALUES ('John', 'Doe', 'john@example.com')
	$UPDTQRY	=	mysqli_query($con, $updatePW);

	if($UPDTQRY)
	{
		echo "Inserted successfully";
		switch ($RID)
		{
			case 2:	header('Location: ../lgdinPt.php');		break;
			case 3:	header('Location: ../lgdinRcHome.php');	break;
			case 4:	header('Location: ../lgdinPhHome.php');		break;
		}
	}
	else
	{
		echo"Not Inserted";
	}
	
	mysqli_close($con);
	//header('Location: ../lgdinPt.php');
?>