<?php
	include('cnct.php');
	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to mysql: " . mysqli_connect_error();
		exit();
	}
	
	$patientResults	= mysqli_query($con, "SELECT UID, URID, UFNaam, ULNaam, UNaam, UAge, UAdress FROM hmsaaausers WHERE URID='2' ORDER BY UFNaam");
	
	if (mysqli_num_rows($patientResults) == 0)
	{
		echo '
			<tr>
				<td style="text-align:center; font-style:italic;" colspan="5">
					No patients registered Yet
				</td>
			</tr>
		';
	}
	else
	{
		$cntListPts=1;
		while ($row_user = mysqli_fetch_assoc($patientResults))
		{
			echo '
					<tr
					 id='. $row_user['UID'] . "_" . $row_user['URID'] . '
					>
						<td style="text-align:center;">
							' . $cntListPts . '
						</td>
						<td>
							<a href="" onclick="return false;">' . $row_user['UFNaam'] . '-' . $row_user['ULNaam'] . '</a>
						</td>
						<td style="text-align:center;">
							' . $row_user['UNaam'] . '
						</td>
						<td style="text-align:center;">
							' . $row_user['UAge'] . '
						</td>
						<td>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. $row_user['UAdress'] . '
						</td>
					</tr>
			';
			$cntListPts++;
		}
	}
	mysqli_close($con);
?>