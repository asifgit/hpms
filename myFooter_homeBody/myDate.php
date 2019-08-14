<?php
	date_default_timezone_set('Asia/Seoul');
	$mydate=getdate(date("U"));
	echo '
		<div class="row-fluid" style="background-color:#ebf2f6; padding-top:7px">
			<div class="span4" style="text-align:center;">
				<p>
					Date: 
					' . $mydate['month'] . ' ' . '
					<b style="font-size:16px;">
					' . $mydate['mday'] . ', ' . '
					</b>
					' . $mydate['year'] . '
				</p>
			</div>
			<div class="span6" style="text-align:center;">
				<span>Welcome to <b>TDK-Multan</b>, Hospital</span>
			</div>
		</div>
	';
	$stringMth	=	"-";
	$stringMth1	=	$mydate['month'][0] . $mydate['month'][1] . $mydate['month'][2];
	//$stringMth1	=	$stringMth1;
	//$stringMth1	=	$stringMth1.toString();
	$stringMth	=	$stringMth	. $stringMth1;
	$stringYr	=	"-" . $mydate['year'];

?>