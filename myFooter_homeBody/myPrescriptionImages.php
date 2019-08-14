<?php
	include('cnct.php');
	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to mysql: " . mysqli_connect_error();
		exit();
	}

	$myID	=	$_SESSION['FlID'];
	
	$resultPRImages		= mysqli_query($con, "SELECT PRBID, PRImg, PRBDate FROM hmsaaapreb WHERE PRBPtID='$myID'");

	echo '
			<b class="txtInTabs">My Prescriptions:</b>
	';

	if (mysqli_num_rows($resultPRImages) == 0)
	{
		echo '
			<p style="padding-left:120px;">You have not been prescribed yet.</p>
		';
	}
	else
	{
		echo '
			<ul class="enlarge">
		';
		$cntListImgs=1;
		while ($row_userPRImages = mysqli_fetch_assoc($resultPRImages))
		{
			echo'
				<li>
					<h4>
						' . $row_userPRImages['PRBDate'] . '
					</h4>
					<a href="#myModalImg' . $cntListImgs . '" id="' . $row_userPRImages['PRBID'] . '" data-toggle="modal">
						<img src="'. $row_userPRImages['PRImg'] .' " class="imgPrs" alt="Deckchairs"
							id = "' . $row_userPRImages['PRBID'] . '"
						/>
					</a>
				</li>			
			';
			
			echo'
				<div id="myModalImg' . $cntListImgs . '" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
				style="margin-left:200px; width:700px; height:95%; top:2%">
					<div class="modal-header" id="mdlhdr" style="padding-right:2px;">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
						<h3 id="myModalLabel">
							<span id="mdlhdrnm">
								' . $row_userPRImages['PRBDate'] . '
							</span>
						</h3>
					</div>
					<div class="modal-body" id="mdlbdy" style="position: relative; height: 585px; padding-right: 2px;">
						<div class="row-fluid">
							<img src=" ' . $row_userPRImages['PRImg'] .' "
								style="width:100%; height:585px;"
							/>
						</div>
					</div>
				</div>
			';
			$cntListImgs++;
			
		}

		echo '
			</ul>
		';
	}

	mysqli_close($con);
?>