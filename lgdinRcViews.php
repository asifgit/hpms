<?php
	session_start();
	{
		if($_SESSION['RlID']=="")
		{
			header("location:login.php");
		}
		else
		{
			switch ($_SESSION['RlID'])
			{
				case '2':
						header("location:lgdinPt.php");
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
		<title>HMS:Receptionist Views</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="stylesheet" type="text/css" href="asfCSSheets/bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="asfCSSheets/bootstrap-responsive.css">
		<link rel="stylesheet" type="text/css" href="asfCSSheets/mycss.css"/>
		<link rel="stylesheet" type="text/css" href="asfCSSheets/foldedCorner.css">
		<link rel="stylesheet" type="text/css" href="asfCSSheets/jjjPresBills.css">
		<link rel="stylesheet" type="text/css" href="asfCSSheets/tabstyle.css">

		<script type="text/javascript" src="asfJScript/jquery.min.js"></script>
		<script type="text/javascript" src="asfJScript/bootstrap-dropdown.js">
			$('.dropdown-toggle').dropdown()
		</script>
		<script type="text/javascript" src="asfJScript/bootstrap-collapse.js"></script>
		<script type="text/javascript" src="asfJScript/bootstrap-modal.js"></script>
		<script type="text/javascript" src="asfJScript/bootstrap-typeahead.js">
			$('.typeahead').typeahead();
		</script>
		<script type="text/javascript" src="asfJScript/tabstyle.js"></script>
		<script type="text/javascript">
			function insrtApntRcPt(idppt)
			{
				console.log("You have to work hard to send ajax-request for this code.");
				var dcccc	=	document.getElementById("slkt'"+idppt+"'");
				var idddc	=	dcccc.options[dcccc.selectedIndex].value;
				console.log("Patient ID:" + idppt);
				console.log("Doctors ID:" + idddc);
				var xmlhttp3;
				if (window.XMLHttpRequest)
				{// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp3=new XMLHttpRequest();
					//console.log("latest versions.");
					//console.log("Request status: " + xmlhttp.status);
					//console.log("Response Text : " + xmlhttp.responseText);
				}
				else
				{// code for IE6, IE5
					xmlhttp3=new ActiveXObject("Microsoft.XMLHTTP");
					//console.log("older versions.");
					//console.log(xmlhttp);
				}
				$tknTxtID	=	"nnw" + idppt;
				console.log($tknTxtID);
				//$AppTxtID	=	"haha" + $AppFullID;
				xmlhttp3.onreadystatechange=function()
				{
					if (xmlhttp3.readyState==4 && xmlhttp3.status==200)
					{
						var respOfTkn3 = document.getElementById($tknTxtID).innerHTML=xmlhttp3.responseText;
						parseScript(respOfTkn3);


						console.log(xmlhttp3);
					}
				}

				xmlhttp3.open("GET","myFooter_homeBody/asgnTkknManual.php?txtOfResponse="+$tknTxtID+"&pttID="+idppt+"&dccID="+idddc,true);
				xmlhttp3.send();
				
			}
			function insertAfter(newElement,targetElement)
			{
				//target is what you want it to go after. Look for this elements parent.
				var parent = targetElement.parentNode;

				//if the parents lastchild is the targetElement...
				if(parent.lastchild == targetElement)
				{
					//add the newElement after the target element.
					parent.appendChild(newElement);
				}
				else
				{
					// else the target has siblings, insert the new element between the target and it's next sibling.
					parent.insertBefore(newElement, targetElement.nextSibling);
				}
			}
			function rcClkdPtToAppendNewRow(idpsd)
			{
				console.log("You clicked: " + idpsd);
				var extractedID	=	"";
				for(i=2; i<idpsd.length; i++)
				{
					extractedID	=	extractedID + idpsd[i];
				}
				for(i=0; i<5000; i++)
				{
					if(document.getElementById("nwtr"+i)!=null)
					{
						$nop	=	document.getElementById("nwtr"+i).innerHTML="";
					}
					else
					{	;	}
				}
				var tblElement	=	document.getElementById("hhhhwe").childNodes;
				console.log(tblElement.length);
				for(ii=0;ii<26000;ii++)
				{
					if(tblElement[ii]!=null)
						{
							if(tblElement[ii].id!=null)
							{
								var idOnlytrs	=	tblElement[ii].id;
								if(tblElement[ii].id!="")
								{
									if(idOnlytrs[0]!="n")
									{
										//console.log(tblElement[ii].id);
										tblElement[ii].style.backgroundColor="WHITE";
									}
								}
							}
						}
				}
				$newRow				=	document.createElement("tr");
				$newRow.style.backgroundColor	=	"#f5f5f5";
				$newRow.id			=	"nwtr"	+ extractedID;
				$rwclkdID			=	"tr"	+ extractedID;
				$idpsdElement		=	document.getElementById("tr"+extractedID);
				document.getElementById($rwclkdID).style.backgroundColor	=	"#f5f5f5";
				$idtd				=	"td"+extractedID;
				/*if($strBld!=null)
				{
					console.log($strBld);
				}*/
				console.log($rwclkdID + " - " + $idtd);
				var slkt	=	"<select id=slkt'"+ extractedID +"' required>";
				var numOfDocs	=	strBldr.length;
				//console.log("Doctors are: "+numOfDocs);
				for(k=0;k<numOfDocs;k++)
				{

					slkt	=	slkt	+	"<option value='" + strBldrID[k] + "'>"	+	strBldr[k]	+	"</option>";
				}
				slkt	=	slkt	+	"</select>";
				//var slkt	=	"<select><option value='volvo'>Volvo</option><option value='saab'>Saab</option></select>";
				$strr='<form class="form-inline pull-left span6 offset1" action="none" style="margin-top:7px; margin-bottom:7px"><input type="text" class="span4" value="'+ extractedID +'" name="ptIIID" style="display:none">' + slkt + '<button type="submit" class="btn btn-info btn-mini offset1" onclick="insrtApntRcPt('+ extractedID +'); return false;">Confirm Appointment</button></form>';
				$newRow.innerHTML	=	"<td id='nnw"+ extractedID +"' colspan='5' style='border:1px solid BLACK; border-top:none; text-align:left;'>"+ $strr +"</td>";

				console.log("New Elements ID is: " + $newRow.id);
				console.log($newRow.innerHTML);
				insertAfter($newRow, $idpsdElement);
				document.getElementById("slkt'"+extractedID+"'").focus();
				document.getElementById("slkt'"+extractedID+"'").click=true;
			}
		</script>
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
			function assignTkn(AppID)
			{
				var xmlhttp;
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
				$AppFullID	=	"" + AppID;
				$AppTxtID	=	"haha" + $AppFullID;
				xmlhttp.onreadystatechange=function()
				{
					if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
						var respOfTkn = document.getElementById($AppTxtID).innerHTML=xmlhttp.responseText;
						parseScript(respOfTkn);


						console.log(xmlhttp);
					}
				}

				xmlhttp.open("GET","myFooter_homeBody/asgnTkkn.php?ApptID="+$AppFullID,true);
				//xmlhttp.open("GET","myFooter_homeBody/asgnTkkn.php?ApptID="+$AppFullID+"&dateEnteredNow="+$dtNow+"&timeEnteredNow="+$tmNow+"&sbmtbtnID="+$sbmtId+"&dateID="+$txtDate+"&timeID="+$txtTime,true);
				xmlhttp.send();
			}/**/
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
		</script>
		<!--Validate Registeration-->
		<script type="text/javascript">
			function IDCARDValidate()
			{
				console.clear();
				var val1	=	document.getElementById("IDCARDVal1").value;
				var v1ln	=	val1.length;
				var val2	=	document.getElementById("IDCARDVal2").value;
				var v2ln	=	val2.length;
				var val3	=	document.getElementById("IDCARDVal3").value;
				var v3ln	=	val3.length;
				
				console.log(v1ln + " " + val1);
				console.log(v2ln + " " + val2);
				console.log(v3ln + " " + val3);
				if((v1ln	==	5) && (v2ln	==	7) && (v3ln	==	1))
				{
					document.getElementById("rgsrtBtn").disabled				=	false;
					document.getElementById("IDCARDtxt").innerText	=	"";
				}
				else
				{
					document.getElementById("IDCARDtxt").innerText	=	"Complete the CNIC Number";
					document.getElementById("rgsrtBtn").disabled				=	true;
				}
			}
			function NAMEValidate()
			{
				var name1	=	document.getElementById("FNAMEVal").value;
				var n1ln	=	name1.length;
				var name2	=	document.getElementById("LNAMEVal").value;
				var n2ln	=	name2.length;
				if( (n1ln	==	0)	||	(n2ln	==	0) )
				{
					document.getElementById("NAMEtxt").innerText	=	"Name can not be left Empty";
				}
				else
				{
					document.getElementById("NAMEtxt").innerText	=	"";
				}
			}
			function PASSValidate()
			{
				var pass1	=	document.getElementById("PassVal1").value;
				var pass2	=	document.getElementById("PassVal2").value;
				var jjj	=	document.getElementById("PASStxt");
				if( (pass1	!=	pass2) )
				{
					jjj.className	=	"label label-important";
					document.getElementById("rgsrtBtn").disabled				=	true;
					jjj.innerText	=	"Do not match";
				}
				else
				{
					jjj.className	=	"label label-success";
					document.getElementById("rgsrtBtn").disabled				=	false;
					jjj.innerText	=	"Matched";
				}
			}
			function  IDCARDREMOVEtxt()
			{
				if(document.getElementById("IDCARDtxt").innerText!="")
				{
					var IDCARD1	=	document.getElementById("IDCARDVal1").value;
					var ID1ln	=	IDCARD1.length;
					var IDCARD2	=	document.getElementById("IDCARDVal2").value;
					var ID2ln	=	IDCARD2.length;
					var IDCARD3	=	document.getElementById("IDCARDVal3").value;
					var ID3ln	=	IDCARD3.length;
					
					if( (ID1ln	==	5)	&&	(ID2ln	==	6)	&&	(ID3ln	==	1) )
					{
						document.getElementById("rgsrtBtn").disabled				=	false;
						document.getElementById("IDCARDtxt").innerText="";
					}
					else
					{
						document.getElementById("rgsrtBtn").disabled				=	true;
						document.getElementById("IDCARDtxt").innerText				=	"Complete the CNIC Number";
					}
				}
			}
			function NAMEREMOVEtxt()
			{
				if(document.getElementById("NAMEtxt").innerText!="")
				{
					var name1	=	document.getElementById("FNAMEVal").value;
					var n1ln	=	name1.length;
					var name2	=	document.getElementById("LNAMEVal").value;
					var n2ln	=	name2.length;
					if( (n1ln	!=	0)	&&	(n2ln	!=	0) )
					{
						document.getElementById("NAMEtxt").innerText="";
					}
				}
			}
			function PASSREMOVEtxt()
			{
				if(document.getElementById("PASStxt").innerText	!=	"");
				{
					var pass1	=	document.getElementById("PassVal1").value;
					var pass2	=	document.getElementById("PassVal2").value;
					if(pass1.length	!=	"" && pass2.length	!=	"")
					{
						if(pass1	!=	pass2)
						{
							document.getElementById("rgsrtBtn").disabled				=	true;
							document.getElementById("PASStxt").innerText	=	"";
						}
						else
						{
							document.getElementById("rgsrtBtn").disabled				=	false;
							document.getElementById("PASStxt").className	=	"label label-success";
							document.getElementById("PASStxt").innerText	=	"Matched";
						}
					}
				}
			}
			function displayFileName()
			{
				var fullPath	=	document.getElementById("uploadBtn").value;
				if (fullPath) {
					var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
					var filename = fullPath.substring(startIndex);
					if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
						filename = filename.substring(1);
					}
					console.log(filename);
					var fileExtensionIs	=	"";
					var dotCame		=	false;
					for(var i=(filename.length-1); i>=0; i--)
					{
						if(filename[i]==".")
							dotCame	=	true;
						if(!dotCame)
						{
							fileExtensionIs	=	fileExtensionIs	+	filename[i];
						}
					}
					console.log(fileExtensionIs);
					fileExtensionRealIs	=	"";
					for (var i = fileExtensionIs.length - 1; i >= 0; i--) {
						fileExtensionRealIs	=	fileExtensionRealIs	+	fileExtensionIs[i];
					};
					
					fileExtensionRealIs = fileExtensionRealIs.toLowerCase();
					console.log(fileExtensionRealIs);
					if(fileExtensionRealIs	==	"jpg" || fileExtensionRealIs	==	"jpeg")
					{
						document.getElementById("uploadFileIs").style.border	=	"1px solid #eeeeee";
						document.getElementById("uploadFileIs").value			=	filename;
					}
					else
					{
						document.getElementById("uploadFileIs").style.border	=	"1px solid RED";
						document.getElementById("uploadFileIs").value	=	"";
					}
				}
			}
		</script>

		<script type="text/javascript" src="asfJScript/showViewsFunctionRc.js"></script>

		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	</head>
	<body>

		<?php
			include('myFooter_homeBody/mySrchListPatients.php');
			include('myFooter_homeBody/mySrchListDocs.php');
			echo'
				<script type="text/javascript">
					var strBldr		=	' . $strBld . ';
					var strBldrID	=	' . $strBldID . ';
					//console.log(strBldr);
					//console.log(strBldrID);
				</script>
			';
		?>
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
							<li><a href="lgdinRcHome.php">Home</a></li>
							<li><a href="lgdinRcAbout.php">About Us</a></li>
							<li class="dropdown">
								<a href="lgdinRcView.php" class="dropdown-toggle" data-toggle="dropdown" id="clkdMnu">View
									<b class="caret"></b>
								</a>
								<ul class="dropdown-menu">
									<li>
										<a href="lgdinRcViews.php" onclick="showViewsRc(1); return false;">Appointments</a>
									</li>
									<li>
										<a href="lgdinRcViews.php" onclick="showViewsRc(3); return false;">Patients</a>
									</li>
									<li>
										<a href="lgdinRcViews.php" onclick="showViewsRc(5); return false;">Doctors</a>
									</li>
									<li>
										<a href="lgdinRcViews.php" onclick="showViewsRc(7); return false;">Token's List</a>
									</li>
								</ul>
							</li>
							<li>
								<a href="lgdinRcUpdtst.php">Update settings</a>
							</li>
						</ul>
	                    </form>
						<div class="nav pull-right" id="ulInNav">
							<a href="#" onclick="return false" id="signInDec">Welcome <?php echo $_SESSION['UzrNm'];?></a>
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
		            	<a href="#view1" onclick="showViewsRc(1); return false;">
		            		<span class="tabsheading">Appointments</span>
		            	</a>
		            </li>
		            <li>
		            	<a href="#view2" onclick="showViewsRc(3); return false;">
		            		<span class="tabsheading">Patients</span>
		            	</a>
		            </li>
		            <li>
		            	<a href="#view3" onclick="showViewsRc(5); return false;">
		            		<span class="tabsheading">Doctors</span>
		            	</a>
		            </li>
		            <li>
		            	<a href="#view4" onclick="showViewsRc(7); return false;">
		            		<span class="tabsheading">Token's List</span>
		            	</a>
		            </li>
		            <li>
						<a class="input-group" style="background-color:#055c8b; color:WHITE;"> 
							<span class="input-group-addon">Filter Table:</span>
							<input id="filter" type="text" class="form-control search-query" placeholder="For Patients and Doctors Only" >
						</a>
		            </li>
		            <li class="pull-right">
		            	<a href="#view5" style="border:none; color:#75004f; font-size:2px;" onclick="showViewsRc(9); return false;">
		            		<span class="tabsheading">Click to register a patient</span>
		            	</a>
		            </li>
		        </ul>
			
		        <div class="row-fluid">
			        <div class="tabcontents" id="tabcontents">
			            <div id="view1">
			            	<br>
			            	<div class="row-fluid">
								<div class="span10 offset1" id="VwDocsHdrwthoutForm">
									<?php
										$mydate=getdate(date("U"));
										echo '
											Online Appointments To be Scheduled: &nbsp;&nbsp;
											<span style="color:#E0ACCF; font-size:20px;">
												' . '" ' . $mydate['month'][0] . $mydate['month'][1] . $mydate['month'][2] . ' ' . '
												' . $mydate['mday'] . ' ", ' . '
											</span>
											' . $mydate['year'] . '
										';
									?>
								</div>
							</div>
							<div class="row-fluid">
								<div align="center" class="span10 offset1">
									<table  id="hdrTblApnt" class="table table-striped table-hover table-condensed table-bordered">
										<thead>
											<tr>
												<th style="width:5px;">S.No.</th>
												<th style="text-align:center;">Login ID</th>
												<th style="text-align:left; width:145px;">&emsp;&emsp;Patient</th>
												<th style="text-align:center; border-left:none;">--</th>
												<th style="text-align:left; border-left:none; width:125px;">Doctor</th>
												<th colspan="2" style="text-align:center; width:230px;">Confirm Appointment</th>
												<th>&emsp;Department</th>
											</tr>
										</thead>
										<tbody  id="load_UpdatedNotifications">
											<?php include('myFooter_homeBody/myOnlineApntPatients.php'); ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
			            <div id="view2">
			            	<br>
			            	<div class="row-fluid">
			            		<div align="center" class="span10 offset1">
					            	<table  id="hdrTblPt" class="table table-hover table-condensed table-bordered">
										<thead style="background-color:#055c8b; color:WHITE;">
											<tr>
												<th style="width:5px;">S.No</th>
												<th>&emsp;&emsp;Name</th>
												<th style="text-align:center;">Login ID</th>
												<th style="text-align:center;">Age</th>
												<th>Adresses</th>
											</tr>
										</thead>
										<tbody class="searchable" id="hhhhwe" style="background-color:WHITE;">
											<?php include('myFooter_homeBody/myListPatientsTableforRc.php') ?>
										</tbody>
									</table>
								</div>
							</div>
			            </div>
			            <div id="view3">
			            	<br>
			            	<div class="row-fluid">
			            		<div align="center" class="span10 offset1">
									<table  id="hdrTblDctr" class="table table-striped table-hover table-condensed table-bordered">
										<thead style="background-color:#055c8b; color:WHITE;">
											<tr>
												<th style="width:5px;">S.No</th>
												<th style="width:300px;">&emsp;&emsp;Name</th>
												<!--<th style="width:60px; text-align:center;">Age</th>-->
												<th>&emsp;&emsp;Speciality</th>
											</tr>
										</thead>
										<tbody class="searchable">
											<?php include('myFooter_homeBody/myListDocsTableforRc.php') ?>
										</tbody>
									</table>
								</div>
							</div>
			            </div>
			            <div id="view4">
			            	<br>
			            	<div class="row-fluid">
								<div class="span10 offset1" id="VwDocsHdrwthoutForm">
									<?php
										$mydate=getdate(date("U"));
										echo '
											Running Tokens: &nbsp;&nbsp;
											<span style="color:#E0ACCF; font-size:20px;">
												' . '" ' . $mydate['month'][0] . $mydate['month'][1] . $mydate['month'][2] . ' ' . '
												' . $mydate['mday'] . ' ", ' . '
											</span>
											</b>
											' . $mydate['year'] . '
										';
									?>
								</div>
							</div>
														<div class="row-fluid">
								<div align="center" class="span10 offset1">
									<table  id="hdrTblApnt" class="table table-striped table-hover table-condensed table-bordered">
										<thead>
											<tr>
												<th style="width:5px;">Token</th>
												<th style="text-align:center;">Login ID</th>
												<th style="text-align:left; width:180px;">&emsp;&emsp;&emsp;&emsp;Patient</th>
												<th style="border-left:none; text-align:center;">--</th>
												<th style=" width:200px; border-left:none;">&emsp;Doctor</th>
												<th style="text-align:right; width:150px;">Time&emsp;</th>
												<th style="border-left:none; text-align:center;">at</th>
												<th style="border-left:none;">Department</th>
											</tr>
										</thead>
										<tbody  id="load_UpdatedNotifications">
											<?php include('myFooter_homeBody/rcApntTknPatients.php'); ?>
										</tbody>
									</table>
								</div>
							</div>
			            </div>
			            <div id="view5">
		            		<div style="text-align:center; margin:0px; padding:0px;" class="row-fluid">
		            			<h4>Registeration form</h4>
		            		</div>
		            		<form class="bs-docs-example form-horizontal" action="myFooter_homeBody/rcSignupExecutePt.php" method="post" enctype="multipart/form-data">
								<div class="span6" style="height:320px; border:2px solid #055c8b; border-radius:3px; border-right:none;">
									<div style="text-align:center; border-bottom:1px solid BLACK; color:WHITE; background-color:#055c8b;">
										<h5 style="padding-top:8px;">Personal information</h5>
									</div>
									<div class="control-group" style="margin-top:10px;">
										<label class="control-label">User ID:</label>
										<div class="controls span5">
											<input id="autoAssignedID" name="uname" type="text" value="" readonly/>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">CNIC No:</label>
										<div class="controls span5" style="margin-right:0px;">
											<input type="text" id="IDCARDVal1" name="idnum1" onblur="IDCARDValidate();" oninput="IDCARDREMOVEtxt();" style="margin:0px; width:61px" maxlength="5" onkeypress="return event.charCode >= 48 && event.charCode <= 57"/> -
				            				<input type="text" id="IDCARDVal2" name="idnum2" onblur="IDCARDValidate();" oninput="IDCARDREMOVEtxt();" style="margin:0px; width:75px" maxlength="7" onkeypress="return event.charCode >= 48 && event.charCode <= 57"/> -
				            				<input type="text" id="IDCARDVal3" name="idnum3" onblur="IDCARDValidate();" oninput="IDCARDREMOVEtxt();" style="margin:0px; width:15px" maxlength="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57"/>
										</div>
										<div>
											<span id="IDCARDtxt" class="label label-important" style="margin-top:7px;"></span>
										</div>
									</div>
									<div class="control-group" style="padding-left: 92px;">
										<div class="controls span8" style="margin-right:0px;">
											<input type="text" id="FNAMEVal" name="fname" onblur="NAMEValidate();" oninput="NAMEREMOVEtxt();" style="margin:0px; width:138px;" maxlength="18" onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122))" placeholder="First Name" required>
											<input type="text" id="LNAMEVal" name="lname" onblur="NAMEValidate();" oninput="NAMEREMOVEtxt();" style="margin:0px; width:138px;" maxlength="18" onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122))" placeholder="Last Name" required>
										</div>
										<div>
											<span id="NAMEtxt" class="label label-important" style="margin-top:7px;"></span>
										</div>
									</div>
									<div class="control-group" style="padding-left: 92px;">
										<div class="controls span8" style="margin-right:0px; display:inline block;">
											<input type="password" id="PassVal1" name="pass" onblur="PASSValidate();" oninput="PASSREMOVEtxt();" style="margin:0px; width:138px;" maxlength="18" onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 48 && event.charCode <= 57))" placeholder="Password" required>
											<input type="password" id="PassVal2" name="pass1" onblur="PASSValidate();" oninput="PASSREMOVEtxt();" style="margin:0px; width:138px;" maxlength="18" onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 48 && event.charCode <= 57))" placeholder="Confirm password" required>
										</div>
										<div>
											<span id="PASStxt" class="label label-important" style="margin-top:7px;"></span>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Gender:</label>
										<div class="controls span5" style="padding-left:20px;">
											<input type="radio" name="gender" id="optionsRadios1" value="Male" checked>
											Male
											<input type="radio" name="gender" id="optionsRadios2" value="Female">
											Female
											<div>
												<span id="GENDERtxt" name="gender" class="label label-important" style="margin-top:7px;"></span>
											</div>
										</div>
									</div>
								</div>
								<div class="span6" style="height:320px; border:2px solid #055c8b; border-radius:1px; border-left:none; border-bottom:3px solid #055c8b; margin-top:0px;">
									<div style="text-align:center; border-bottom:1px solid BLACK; color:WHITE; background-color:#055c8b;">
										<h5 style="padding-top:8px;">Other information</h5>
									</div>
									<div class="row-fluid" style="margin-top:10px; display:inline block;">
										<label class="control-label span3">Date of Birth:</label>
										<input type="Date" name="age" /required>
									</div>
									<div style="padding-left:50px;">
										<input id="uploadFileIs" placeholder="Profile-Image" disabled="disabled" />
										<div class="fileUpload btn btn-info btn-mini">
											<span>Upload</span>
											<input id="uploadBtn" type="file" name="pic" class="upload" onchange="displayFileName();" required/>
										</div>
									</div>
									<div class="row-fluid" style="text-align:left; margin-top:10px; display:inline block;">
										<label class="control-label span3">Adress:</label>
										<input style="height:50px;" type="text" name="adress" required />
									</div>
									<div style="text-align:center; padding-top:30px;">
										<button id="rgsrtBtn" type="submit" class="btn btn-primary" disabled>Register</button>
									</div>
								</div>
							</form>
			            </div>
			        </div>
			    </div>
		    </div>
			<br>
		</div>

		<?php include('myFooter_homeBody/myFtr.php') ?>

		<?php
			if(empty($_GET))
				echo'
					<script type="text/javascript">
						showViewsRc(1);
					</script>
				';
			else
				echo'
					<script type="text/javascript">
						showViewsRc(' . $_GET["idR"] . ');
					</script>
				';
			// Assigning the 1st && 2nd part of User Login Name
			$stringMth	=	strtoupper($stringMth);
			echo'
				<script>
					$Mth				=	"' . $stringMth . '";
					var ID2ndPartIs		=	"' . $stringYr . '";
					var ID2ndPartIs		=	ID2ndPartIs[3]	+ ID2ndPartIs[4] + "-";
					var UserIDFrntEndIs	=	"TDK" + $Mth + ID2ndPartIs;
					console.log(UserIDFrntEndIs);
					document.getElementById("autoAssignedID").value	=	UserIDFrntEndIs;
				</script>
			';
			// Assigning the 3rd part of User Login Name
			include('myFooter_homeBody/rcGetTheUserUniqueLoginID.php');
			/*if($_GET["created"]==0)
			{
				echo "
					<script>
						document.getElementById('createdMessage').className	=	'alert alert-error';
						document.getElementById('createdMessage').innerText	=	'Something went wrong, try again;
					</script>
				";
			}
			if($_GET["created"]==1)
			{
				echo "
					<script>
						document.getElementById('createdMessage').className	=	'alert alert-success';
						document.getElementById('createdMessage').innerText	=	'Account " . $username . " created successfully';
					</script>
				";
			}*/
		?>

	</body>
</html>	