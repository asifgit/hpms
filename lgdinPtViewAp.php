<?php
	session_start();
	{
		if($_SESSION['RlID']=="" || $_SESSION['RlID']==1)
		{
			header("location:login.php");
		}
		else
		{
			switch ($_SESSION['RlID'])
			{
				case '3':
						header("location:lgdinRcHome.php");
						break;
				case '4':
						header("location:lgdinPhHome.php");
						break;
				case '5':
						header("location:admin_new/lgdinAdminHome.php");
						break;
				case '1':
						session_destroy();
						header("location:login.php");
						break;
			};
		}
	}
?>
<!doctype html>
<html>
	<head>
		<title>HMS:Patient View Details</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="stylesheet" type="text/css" href="asfCSSheets/bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="asfCSSheets/bootstrap-responsive.css">
		<link rel="stylesheet" type="text/css" href="asfCSSheets/mycss.css"/>
		<link rel="stylesheet" type="text/css" href="asfCSSheets/foldedCorner.css">
		<link rel="stylesheet" type="text/css" href="asfCSSheets/jjjPresBills.css">
		<link rel="stylesheet" type="text/css" href="asfCSSheets/tabstyle.css">
		
		<script type="text/javascript" src="asfJScript/jquery.min.js"></script>
		<script type="text/javascript" src="asfJScript/bootstrap-modal.js"></script>
		<script type="text/javascript" src="asfJScript/bootstrap-dropdown.js">
			$('.dropdown-toggle').dropdown()
		</script>
		<script type="text/javascript" src="asfJScript/bootstrap-collapse.js"></script>
		<script type="text/javascript" src="asfJScript/bootstrap-typeahead.js">
			
		</script>
		<script type="text/javascript" src="asfJScript/bootstrap-tooltip.js"></script>
		<script type="text/javascript" src="asfJScript/tabstyle.js"></script>
		<script type="text/javascript">
			$(document).ready(function ()
			{
			    (function ($) 
			    {

			        $('#filter').keyup(function ()
			        {
			            var rex = new RegExp($(this).val(), 'i');
			            $('.searchable tr').hide();
			            $('.searchable tr').filter(function ()
			            {
							return rex.test($(this).text());
						}).show();

					})

			    }(jQuery));

			});
		</script>
		<script type="text/javascript" src="asfJScript/showViewsFunction.js"></script>
		<script type="text/javascript">
			function loadXMLDoc()
			{
				var xmlhttp;
				if (window.XMLHttpRequest)
				  {// code for IE7+, Firefox, Chrome, Opera, Safari
				  xmlhttp=new XMLHttpRequest();
				  console.log("latest versions.");
				  console.log("Request status: " + xmlhttp.status);
				  console.log("Response Text : " + xmlhttp.responseText);
				  }
				else
				  {// code for IE6, IE5
				  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				  console.log("older versions.");
				  console.log(xmlhttp);
				  }
				xmlhttp.onreadystatechange=function()
				{
					if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
						document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
					}
				}
				xmlhttp.open("GET","cnct.php",true);
				xmlhttp.send();
				document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
			}
		</script>
		<!--after uplod-->
		<script type="text/javascript">
			function parseScript(strcode)
			{
				var scripts = new Array();         // Array which will store the script's code

				// Strip out tags
				while(strcode.indexOf("<script") > -1 || strcode.indexOf("</script") > -1)
				{
				var s = strcode.indexOf("<script");
				var s_e = strcode.indexOf(">", s);
				var e = strcode.indexOf("</script", s);
				var e_e = strcode.indexOf(">", e);

				// Add to scripts array
				scripts.push(strcode.substring(s_e+1, e));
				// Strip from strcode
				strcode = strcode.substring(0, s) + strcode.substring(e_e+1);
				}

				// Loop through every script collected and eval it
				for(var i=0; i<scripts.length; i++)
				{
				try {
				  eval(scripts[i]);
				}
				catch(ex) {
				  // do what you want here when a script fails
				}
				}
			}
			function checkdateValidOrNot($iid)
			{
				document.getElementById("sbmtBtn"+$iid).disabled	=	true;
				var xmlhttp;
				$cntCaptured=""+$iid;
				if (window.XMLHttpRequest)
				{// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp=new XMLHttpRequest();
					//console.log("latest versions.");
					//console.log("Request status: " + xmlhttp.status);
					//console.log("Response Text : " + xmlhttp.responseText);
				}
				else
				{// code for IE6, IE5
					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
					//console.log("older versions.");
					//console.log(xmlhttp);
				}
				$tagPlusId	=	"tagapDateTime"+$cntCaptured;
				$tagPlusIdDt=	"apDateTime"+$cntCaptured;
				$tagPlusIdTm=	"apTime"+$cntCaptured;
				console.log("Tag Id: "+$tagPlusId+", DateId: "+$tagPlusIdDt+", TimeID"+$tagPlusIdTm);
				console.log($iid);
				xmlhttp.onreadystatechange=function()
				{
					if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
						var resp = document.getElementById($tagPlusId).innerHTML=xmlhttp.responseText;
						parseScript(resp);


						console.log(xmlhttp);
					}
				}
				$sbmtId	 =	"sbmtBtn" + $cntCaptured;
				$txtDate =	"txtFrntDate" + $cntCaptured;
				$txtTime =	"txtFrntTime" + $cntCaptured;

				$dtNow	 =	document.getElementById($tagPlusIdDt).value;
				console.log("Time Val now is: "+$dtNow);
				if(document.getElementById($tagPlusIdTm).value!="")
					$tmNow	 =	document.getElementById($tagPlusIdTm).value + ":00.000000";
					//$tmNow	 =	document.getElementById($tagPlusIdTm).value + ":00"; for Online server
				else
					$tmNow	 =	"";
				console.log("Time Val now is: "+$tmNow);

				console.log($sbmtId);
				//width=" + width + "&height=" + height
				xmlhttp.open("GET","myFooter_homeBody/validateAptForm.php?tagANDId="+$tagPlusId+"&dateEnteredNow="+$dtNow+"&timeEnteredNow="+$tmNow+"&sbmtbtnID="+$sbmtId+"&dateID="+$txtDate+"&timeID="+$txtTime,true);
				xmlhttp.send();
			}/**/
		</script>

		<script type="text/javascript">
			function cancelTkn(AppID)
			{
				var xmlhttp2;
				if (window.XMLHttpRequest)
				{// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp2=new XMLHttpRequest();
					//console.log("latest versions.");
					//console.log("Request status: " + xmlhttp.status);
					//console.log("Response Text : " + xmlhttp.responseText);
				}
				else
				{// code for IE6, IE5
					xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");
					//console.log("older versions.");
					//console.log(xmlhttp);
				}
				$AppFullID	=	"" + AppID;
				$AppTxtID	=	"haha" + $AppFullID;
				xmlhttp2.onreadystatechange=function()
				{
					if (xmlhttp2.readyState==4 && xmlhttp2.status==200)
					{
						var respOfTkn = document.getElementById($AppTxtID).innerHTML=xmlhttp2.responseText;
						parseScript(respOfTkn);


						console.log(xmlhttp2);
					}
				}

				xmlhttp2.open("GET","myFooter_homeBody/cnclTkkn.php?ApptID="+$AppFullID,true);
				//xmlhttp.open("GET","myFooter_homeBody/asgnTkkn.php?ApptID="+$AppFullID+"&dateEnteredNow="+$dtNow+"&timeEnteredNow="+$tmNow+"&sbmtbtnID="+$sbmtId+"&dateID="+$txtDate+"&timeID="+$txtTime,true);
				xmlhttp2.send();
			}/**/
		</script>

		<script type="text/javascript">
			function disabless(jsVariable)
			{
				console.log("heheheeheh");
				document.getElementById(jsVariable).disabled=true;	
			}
		</script>		
		
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	</head>
	<body>

		<?php include('myFooter_homeBody/mySrchListDocs.php') ?>
		<?php  include('myFooter_homeBody/myDate.php') ?>

		<div class="navbar navbar-inverse navbar-static-top">
			<div class="navbar-inner">
				<div class="container">
					<a class="btn btn-navbar" id="ulInNav" data-toggle="collapse" data-target=".navbar-inverse-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<?php include('myFooter_homeBody/myBrandLogo.php') ?>
					<div class="nav-collapse navbar-inverse-collapse collapse">
						<ul class="nav" id="ulInNav">
							<li><a href="lgdinPt.php">Home</a></li>
							<li><a href="lgdinPtAbout.php">About Us</a></li>
							<li class="dropdown">
								<a href="lgdinPtViewAp.php" class="dropdown-toggle" data-toggle="dropdown" id="clkdMnu">View
									<b class="caret"></b>
								</a>
								<ul class="dropdown-menu">
									<li>
										<a href="lgdinPtViewAp.php" onclick="showViewsPt(1); return false;">Appointments</a>
									</li>
									<li>
										<a href="lgdinPtViewAp.php" onclick="showViewsPt(3); return false;">Prescriptions</a>
									</li>
									<li>
										<a href="lgdinPtViewAp.php" onclick="showViewsPt(5); return false;">Bills</a>
									</li>
									<li>
										<a href="lgdinPtViewAp.php" onclick="showViewsPt(7); return false;">Doctors</a>
									</li>
								</ul>
							</li>
							<li><a href="lgdinPtUpdtst.php">Update settings</a></li>
						</ul>
						<form class="navbar-search pull-left" action="" id="srchInNav">
							<?php
								echo "<input type='text' placeholder='Search Doctors Here' class='search-query' data-items='11' data-provide='typeahead' data-source='$strBld'>";
							?>
	                    </form>
						<div class="nav pull-right" id="ulInNav">
							<a href="#" onclick="return false" id="signInDec">Welcome <?php echo $_SESSION['UzrNm']; ?></a>
							<br>
							<a href="myFooter_homeBody/dstrySsn.php" id="signInDec">Sign Out</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="container-fluid" id="ptViewsBdy">
			<div class="row-fluid">
			 	<ul class="tabs" data-persist="true" id="ptTabsHdr">
		            <li>
		            	<a href="#view1" onclick="showViewsPt(1); return false;">
		            		<span class="tabsheading">Appointments</span>
		            	</a>
		            </li>
		            <li>
		            	<a href="#view2" onclick="showViewsPt(3); return false;">
		            		<span class="tabsheading">Prescriptions</span>
		            	</a>
		            </li>
		            <li>
		            	<a href="#view3" onclick="showViewsPt(5); return false;">
		            		<span class="tabsheading">Bills</span>
		            	</a>
		            </li>
		            <li>
		            	<a href="#view4" onclick="showViewsPt(7); return false;">
		            		<span class="tabsheading">Doctors</span>
		            	</a>
		            </li>
		        </ul>
		        <div class="row-fluid">
			        <div class="tabcontents" id="tabcontents">
			            <div id="view1">
							<?php include('myFooter_homeBody/myApntPendingPt.php'); ?>
						</div>
			            <div id="view2">
			            	<?php include('myFooter_homeBody/myPrescriptionImages.php') ?>
							<br>
							<br>
			            </div>
			            <div id="view3">
			            	<?php include('myFooter_homeBody/myListBills.php') ?>
			            </div>
			            <div id="view4">
			            	<br>
			            	<div class="row-fluid">
			            		<!---->
								<div class="span10 offset1" id="VwDocsHdr">
									<div class="input-group"> 
										<span class="input-group-addon" id="fntWghtSize">Filter Doctors:</span>
										<input id="filter" type="text" class="form-control search-query" placeholder="By any attribute" >
									</div>
								</div>
							</div>
			            	<div class="row-fluid">
			            		<div align="center" class="span10 offset1">
									<table  id="hdrTblDctr" class="table table-striped table-hover table-condensed table-bordered">
										<thead>
											<tr>
												<th style="width:5px;">S.No</th>
												<th style="width:200px;">&emsp;&emsp;&emsp;Name</th>
												<!--<th style="width:60px; text-align:center;">Age</th>-->
												<th>&emsp;Speciality</th>
											</tr>
										</thead>
										<tbody class="searchable">
											<?php include('myFooter_homeBody/myListDocsTableForPt.php') ?>
										</tbody>
									</table>
								</div>
							</div>
			            </div>
			        </div>
			    </div>
		    </div>
			<br>
		</div>

		<?php include('myFooter_homeBody/myFtr.php') ?>

		<script type="text/javascript">
		// For Form ENtry to get Appointed by AUtoFill
		//
			function chkbxclickd($idSent)
			{
				var idSent= $idSent;
					$bldStr="";
					$outLoop=0;
					$aftrB="";
					for(i=8; i<idSent.length;i++)
					{
						if (idSent[i]=='b')
							{ $outLoop=1;};
						if($outLoop==0)
							{ $bldStr	=	$bldStr + idSent[i]; }
						else
							{ $aftrB=$aftrB+idSent[i]; }
					}
				for(i=0; i<500; i++)
				{
					console.log(idSent);
					if(document.getElementById("asfchkbx"+$bldStr+"b" + i)!=null)
					{
						$asfbx= "asfchkbx"+$bldStr+"b"+i;
						document.getElementById($asfbx).checked = false;
						console.log("Unchecked id: " + $asfbx);
					}
				}
				//
				document.getElementById(idSent).checked=true;
				if(document.getElementById(idSent).checked)
				{
					console.log("Checked id: " + idSent);

					
					console.log($bldStr);

					$dateToBePlacedInInputTag	=	document.getElementById("asftxtVal"+ $bldStr + $aftrB).innerText;
					$yearIsThis	=	$dateToBePlacedInInputTag[6] + $dateToBePlacedInInputTag[7] + $dateToBePlacedInInputTag[8] + $dateToBePlacedInInputTag[9];
					$monthIsThis	=	$dateToBePlacedInInputTag[0] + $dateToBePlacedInInputTag[1];
					$dayIsThis	=	$dateToBePlacedInInputTag[3] + $dateToBePlacedInInputTag[4];
					//console.log($monthIsThis + 1 + "-" + $dayIsThis + "-" + $yearIsThis);
					
					$dateOriginal	=	$yearIsThis + "-" + $monthIsThis + "-" + $dayIsThis;
					document.getElementById("apDateTime" + $bldStr).value=$dateOriginal;
				}
			}
			//
		</script>

		<?php
			if(empty($_GET))
				echo'
					<script type="text/javascript">
						showViewsPt(1);
					</script>
				';
			else
				echo'
					<script type="text/javascript">
						showViewsPt(' . $_GET["id"] . ');
					</script>
				';
		?>

	</body>
</html>