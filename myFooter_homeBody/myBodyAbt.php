<?php
	include('cnct.php');
	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to mysql: " . mysqli_connect_error();
		exit();
	}
	
	$result		= mysqli_query($con,"SELECT UFNaam, ULNaam FROM hmsaaausers");
	$dctrarray	= array();
	
	if (mysqli_num_rows($result) == 1)
	{
		;
	}

	while ($row_user = mysqli_fetch_assoc($result))
	{
		$dctrarray[] = $row_user['UFNaam'] . " " . $row_user['ULNaam'];
	}
	
	$count=1;
	$strBld;
	foreach ($dctrarray as $key)
	{
		if($count==1)
		{
			$strBld = "[\"" . $key . "\"";
		}
		else
		{
			$strBld = $strBld . ", \"" . $key . "\"";
		}
		$count++;
	}
	$strBld = $strBld . "]'";
	echo"
		<div class='container-fluid'>
			<div class='row-fluid' id='imgsldshw'>
				<div class='span5'>
					<div id='myCarousel' class='carousel slide'>
						<ol class='carousel-indicators'>
							<li data-target='#myCarousel' data-slide-to='0' class='active'></li>
							<li data-target='#myCarousel' data-slide-to='1' class=''></li>
							<li data-target='#myCarousel' data-slide-to='2' class=''></li>
							<li data-target='#myCarousel' data-slide-to='3' class=''></li>
							<li data-target='#myCarousel' data-slide-to='4' class=''></li>
							<li data-target='#myCarousel' data-slide-to='5' class=''></li>
						</ol>
						<div class='carousel-inner'>
							<div class='active item'>
								<img src='Images/Hospitals/hh1.jpg' alt=''>
								<div class='carousel-caption'>
									<h4>Hospitals Building</h4>
									<p>The building is established to make a <span style='color:YELLOW;'>healthier Pakistan</span>.</p>
								</div>
							</div>
							<div class='item'>
								<img src='Images/Hospitals/hh2.jpg' alt=''>
								<div class='carousel-caption'>
									<h4>Head of Doctors</h4>
									<p><span style='color:YELLOW;'>Dr. Umair Naru</span> is the current head of our Hospital.</p>
								</div>
							</div>
							<div class='item'>
								<img src='Images/Hospitals/hh3.jpg' alt=''>
								<div class='carousel-caption'>
									<h4>Group Photo Africa</h4>
									<p>A past rememberance with <span style='color:YELLOW;'>African Doctors</span>.</p>
								</div>
							</div>
							<div class='item'>
								<img src='Images/Hospitals/hh4.jpg' alt=''>
								<div class='carousel-caption'>
									<h4>Hospitals Starting Ceremony</h4>
									<p>Establisment took place in <span style='color:YELLOW;'>18- 08 -1998</span>.</p>
								</div>
							</div>
							<div class='item'>
								<img src='Images/Hospitals/hh5.jpg' alt=''>
								<div class='carousel-caption'>
									<h4>Dentists Team</h4>
									<p>Our <span style='color:YELLOW;'>4 Specialists</span> in the specified field.</p>
								</div>
							</div>
							<div class='item'>
								<img src='Images/Hospitals/hh6.jpg' alt=''>
								<div class='carousel-caption'>
									<h4>Patients Free Checkup Day</h4>
									<p>After every <span style='color:YELLOW;'>6 months</span> this event takes place.</p>
								</div>
							</div>
						</div>
						<a class='left carousel-control' href='#myCarousel' data-slide='prev'>&lsaquo;</a>
						<a class='right carousel-control' href='#myCarousel' data-slide='next'>&rsaquo;</a>
					</div>
				</div>
				<div class='span7' id='imgIntrCnt'>
					<div class='' id='stlrghtToImgz'>
						<h3 class='hdngInCntr'>Contact Us:</h3>
						<ul>
							<li>0314-5272806</li>
							<li>0314-5272807</li>
							<li>0314-5272808</li>
							<li>0314-5272809</li>
							<li>0314-5272810</li>
						</ul>
					</div>
				</div>
			</div>
			<br>
			<div class='row-fluid'>
				<div class='span4'>
					<p> More stuff here</p>
				</div>
				<div class='span8'>
					<p>More stuff here</p>
				</div>
			</div>
		</div>
		";
?>