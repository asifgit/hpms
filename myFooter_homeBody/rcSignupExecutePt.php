<?php
//require_once("connection.php");
	include('cnct.php');
	date_default_timezone_set('Asia/Seoul');
	$myDateToBeEnteredInDB=getdate(date("U"));
	$dateBuilderString	=	"";
	if($myDateToBeEnteredInDB['mon']<10)
	{
		$dateBuilderString = $myDateToBeEnteredInDB['year'] . "-0" . $myDateToBeEnteredInDB['mon'] . "-";
		if($myDateToBeEnteredInDB['mday']<10)
		{
			$dateBuilderString = $dateBuilderString . "0" .  $myDateToBeEnteredInDB['mday'];
		}
		else
		{
			$dateBuilderString = $dateBuilderString .  $myDateToBeEnteredInDB['mday'];
		}
	}
	else
	{
		$dateBuilderString = $myDateToBeEnteredInDB['year'] . "-" . $myDateToBeEnteredInDB['mon'] . "-";
		if($myDateToBeEnteredInDB['mday']<10)
		{
			$dateBuilderString = $dateBuilderString . "0" .  $myDateToBeEnteredInDB['mday'];
		}
		else
		{
			$dateBuilderString = $dateBuilderString .  $myDateToBeEnteredInDB['mday'];
		}
	}
	  
	$fname		=	$_POST['fname'];
	$lname		=	$_POST['lname'];
	$username	=	$_POST['uname'];
	$passwrd		=	$_POST['pass'];
	$name		=	$_FILES['pic']['name']; //pic name
	$adress		=	$_POST['adress'];
	$gender		=	$_POST['gender'];
	$age			=	$_POST['age'];
	$idnum1		=	$_POST['idnum1'];
	$idnum2		=	$_POST['idnum2'];
	$idnum3		=	$_POST['idnum3'];
	$idnum		=	$idnum1 . '-' . $idnum2 . '-' . $idnum3;

	$URID = "2";
	$target_path = "pics/";



	$pic=$_FILES['pic']['tmp_name'];
	echo "string";
	   
	$extension = pathinfo($name, PATHINFO_EXTENSION);
	$id=rand(0,10000);
	$nfilename = $id.$name;
	$target_path = "../Images/UserImages/";
	$target_path = $target_path.$nfilename ; 
	if(move_uploaded_file($pic, $target_path)) 


	$code=0;
	$qry = "INSERT INTO `hmsaaausers`(`URID`, `UFNaam`, `ULNaam`, `UNaam`, `UPwd`, `UAdress`, `UGender`, `UAge`, `URegDate`, `UPicture`, `UIDCardNumber`) VALUES ('$URID','$fname','$lname','$username','$passwrd','$adress','$gender','$age','$dateBuilderString','$target_path','$idnum')";
	if($r=mysqli_query($con, $qry))
	{
	$code=1;
	}
	echo $code;
	mysqli_close($con);
	if($code==1)
	{
		header("location:../lgdinRcViews.php?idR=7,created=1");
	}
	else
	{
		header("location:../lgdinRcViews.php?idR=7,created=0");
	}
?>
