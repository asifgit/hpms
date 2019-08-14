<?php
	$bd	=	"1991-02-26";
	$td	=	"2015-03-27";
	
	$bddy	=	$bd[8] . $bd[9];
	$tddy	=	$td[8] . $td[9];

	$bdmn	=	$bd[5] . $bd[6];
	$tdmn	=	$td[5] . $td[6];

	$bdyr	=	$bd[0] . $bd[1] . $bd[2] . $bd[3];
	$tdyr	=	$td[0] . $td[1] . $td[2] . $td[3];

	///////////////////////////////////////////////
	$yrDf	=	-($bdyr-$tdyr);
	$mnDf	=	-($bdmn-$tdmn);
	$dyDf	=	-($bddy-$tddy);
	echo $bd . "<br>" . $td . "<br>" . $yrDf . ".." . $mnDf . ".." . $dyDf . "<br>";
	//////////////////////////////////////////////
	if($yrDf>0)
	{
		if($mnDf>=0)
		{
			if($mnDf>0)
			{
				echo $yrDf;
			}
			else
			{
				if($dyDf>=0)
				{
					if($dyDf>0)
					{
						echo $yrDf;
					}
					else
					{
						echo "<span style='color:YELLOW'>" . $yrDf . "</span>";
					}
				}
				else
				{
					echo ($yrDf-1);
				}
			}
		}
		else
		{
			echo ($yrDf-1);
		}
	}
	else
	{
		echo"Undefined";
	}
?>