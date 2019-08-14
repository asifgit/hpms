<?php
	include('cnct.php');
	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to mysql: " . mysqli_connect_error();
		exit();
	}

	$doctorResults	= mysqli_query($con, "SELECT UID, URID, UFNaam, ULNaam, UAge, USpeciality FROM hmsaaausers WHERE URID='1' ORDER BY UFNaam");
	
	if (mysqli_num_rows($doctorResults) == 0)
	{
		;
		;
	}
	while ($row_user = mysqli_fetch_assoc($doctorResults))
	{

	}

	mysqli_close($con);
?>