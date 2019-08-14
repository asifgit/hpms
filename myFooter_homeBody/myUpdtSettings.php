<?php
	include('cnct.php');

	$updtpwd = "UPDATE `hmsaaa`.`hmsaaausers` SET `UPwd` = '526' WHERE `hmsaaausers`.`UID` = 2";

	mysqli_query($con, $updtpwd);

	echo"You have updated well :-)";

/*	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to mysql: " . mysqli_connect_error();
		exit();
	}
	
	$resultPRImages		= mysqli_query($con, "SELECT PRBID, PRImg, PRBDate FROM hmsaaapreb");
	
	if (mysqli_num_rows($resultPRImages) == 1)
	{
		;
		;
	}

		echo '
			<b class="txtInTabs">My Prescriptions:</b>
			<ul class="enlarge">
		';

	while ($row_userPRImages = mysqli_fetch_assoc($resultPRImages))
	{
		echo'
				<li>
					<h4>
						' . $row_userPRImages['PRBDate'] . '
					</h4>
					<img src="data:image/jpeg;base64,
						'.base64_encode( $row_userPRImages['PRImg'] ).' " class="imgPrs" alt="Deckchairs"
						id = "' . $row_userPRImages['PRBID'] . '"
					/>
					<span>
						<img src="data:image/jpeg;base64,
							'.base64_encode( $row_userPRImages['PRImg'] ).' "
							style="width:100%; height:90%"
						/>
						<br />
						<h4>
							' . $row_userPRImages['PRBDate'] . '
						</h4>
					</span>				
		';
	}

	echo '
			</ul>
	';*/

	mysqli_close($con);
?>