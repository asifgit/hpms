<?php
	include('cnct.php');
	$imagesss	=	mysqli_query($con, "SELECT * FROM hmsaaapreb");
	$cntrrr=1;
	while($row	=	mysqli_fetch_assoc($imagesss))
	{
		echo '
			<img
				style="height:200px; width:100px;"
				id="zoom_01"
				src=" ' . $row['PRImg'] . ' "
				data-zoom-image="Images/Prescriptionsq/PRimg0.jpg"
			>
		';
		$cntrrr++;
	}
	
?>