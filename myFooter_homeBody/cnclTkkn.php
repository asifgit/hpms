<?php
	include('cnct.php');
	//echo "assigned file ajax: ";
	//echo " " . $_GET['ApptID'];
	$ApIDToCancelled	=	$_GET['ApptID'];
	
	$updtDealt	=	"UPDATE `hmsaaaappointments` SET `APDealt`='2' WHERE APID=$ApIDToCancelled";
	$rzUpt		=	mysqli_query($con, $updtDealt);
	
	if($rzUpt)
	{
		echo "<div style='background-color:rgb(231, 231, 89); text-align:center; color:WHITE;'>Cancelled</div>";
		echo "
			<script type='text/javascript'>
				document.getElementById('" . $ApIDToCancelled . "').style='background-color:YELLOW';
				var cnt = 1;
				if(cnt==1)
				{
					setInterval(
						function ()
						{
							for (var i = 0; i < 100000; i++) 
							{
								for (var j = 0; j < 1000; j++) 
								{
									j++;
								};
								i++;

							};
							document.getElementById('" . $ApIDToCancelled . "').innerHTML='';
						}, 3000);
					cnt++;
				}
			</script>
		";
	}
	else
	{
		echo "Refresh the page and try again.";
	}
	mysqli_close($con);
?>