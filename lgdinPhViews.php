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
				case '3':
						header("location:lgdinRcHome.php");
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
		<title>HMS:Pharmacist Views</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="stylesheet" type="text/css" href="asfCSSheets/bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="asfCSSheets/bootstrap-responsive.css">
		<link rel="stylesheet" type="text/css" href="asfCSSheets/mycss.css"/>
		<link rel="stylesheet" type="text/css" href="asfCSSheets/foldedCorner.css">
		<link rel="stylesheet" type="text/css" href="asfCSSheets/jjjPresBills.css">
		<link rel="stylesheet" type="text/css" href="asfCSSheets/tabstyle.css">

		<script type="text/javascript" src="asfJScript/jquery.min.js">
			var userIsInPRID=0; var userIsInPTID=0; var currentBill=0;
		</script>
		<script type="text/javascript" src="asfJScript/bootstrap-dropdown.js">
			$('.dropdown-toggle').dropdown()
		</script>
		<script type="text/javascript" src="asfJScript/bootstrap-collapse.js"></script>
		<script type="text/javascript" src="asfJScript/bootstrap-modal.js"></script>
		<script type="text/javascript" src="asfJScript/bootstrap-typeahead.js">
			$('.typeahead').typeahead();
		</script>
		<script type="text/javascript" src="asfJScript/tabstyle.js"></script>
		<script type="text/javascript" src="asfJScript/myPrecribedNotificationsUpdate.js"></script>
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
			var mdidANDqt	=	["0"];
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
			function addNewInputTags(idpsd)
			{
				var extractedPtID	=	"";
				var extractedRowID	=	"";		var UnderScoreCame	=	false;	var firstTime	=	0;
				//console.log(strBldrMD);
				//console.log(strBldrIDMD);
				var x_Came=false;
				for(i=3; i<idpsd.length; i++)
				{
					if(idpsd[i]=='x')
						{	x_Came=true;	}
					if(x_Came==false)
						{	extractedPtID	=	extractedPtID	+	idpsd[i];	}
					else
					{
						if(idpsd[i]=='_')
						{
							UnderScoreCame	=	true;
						}
						if(UnderScoreCame)
						{
							firstTime++;
							if(firstTime!=1)
								extractedRowID	=	extractedRowID	+	idpsd[i];
						}
					}
				}
				var addDivAfterID	=	"mdcOfPtID" + extractedPtID + "_" + extractedRowID;
				//console.log("You clicked : " + idpsd);
				//console.log("Extracted PtID is: " + extractedPtID);
				//console.log("Extracted RwID is: " + extractedRowID);
				//console.log("Add Rw after: " + addDivAfterID);
				var idOfMedTag			=	"pt" + extractedPtID + "mdrw" + extractedRowID;
				var ElementOfMedicine	=	document.getElementById(idOfMedTag);
				if(ElementOfMedicine.options[ElementOfMedicine.selectedIndex].value!=0)
				{
					$curMdRow			=	document.getElementById(addDivAfterID);
					$newMdRow			=	document.createElement("div");
					
					var strMdOptions = "";
					for(i=0; i<strBldrMD.length; i++)
					{
						strMdOptions	=	strMdOptions	+	"<option value='" + strBldrIDMD[i] + "'>"	+	strBldrMD[i]	+	"</option>";
						//console.log(strBldrMD[i]);
					}
					var idMdc			=	parseInt(extractedRowID)+1;
					$newMdRow.id		=	"mdcOfPtID" + extractedPtID + "_" + idMdc;
					$newMdRow.className		=	"span11";
					$newMdRow.innerHTML	=	'<p class="span1" style="padding-top:5px;"><span class="badge badge-info">' + idMdc + '</span></p><select class="span5 pull-left" id="pt' + extractedPtID + 'mdrw' + idMdc + '"  oninput="changeBorderColor(id);" style="border:1px solid YELLOW"><option value="0">None</option>' + strMdOptions + '</select><select class="span2" id="pt' + extractedPtID + 'qtrw' + idMdc + '"  oninput="changeBorderColorQt(id);"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select><button class="btn btn-info btn-mini pull-right" id="btn' + extractedPtID + 'xlmth_' + idMdc + '"  onclick="addNewInputTags(id);">+</button><p class="span2 pull-right" style="padding-top:7px;"  id="pt' + extractedPtID + 'prrw' + idMdc + '">1 x 0</p>';
					insertAfter($newMdRow, $curMdRow);
					$newMdRow.childNodes[1].focus();

					var btttttn	=	document.getElementById(idpsd);
					btttttn.innerText="";
					btttttn.backgroundImage="none";
					btttttn.style.paddingTop="0px";btttttn.style.paddingRight="0px";btttttn.style.paddingBottom="0px";btttttn.style.paddingLeft="0px";
					btttttn.style.border="none";
					btttttn.className="btn span1 pull-right";
					btttttn.style.backgroundColor='#FFFFFF';
					btttttn.disabled=true;
					//btttttn.style.color='rgba(73, 175, 205, 0)';
				}
				else
				{
					ElementOfMedicine.style.border="1px solid YELLOW";
					//console.log("Enter Medicine First");
					ElementOfMedicine.focus();
				}
			}
			function changeBorderColor(idOfMedicineTagClicked)
			{
				console.clear();
				console.log(idOfMedicineTagClicked);
				var Elemt			=	document.getElementById(idOfMedicineTagClicked);
				var ElemtValueIs	=	Elemt.options[Elemt.selectedIndex].value;
				var priceOfMdIs		=	0;
				var crntMedicinesPrice	=	0;
				for(i=0;i<strBldrIDMD.length;i++)
				{
					if(strBldrIDMD[i]==ElemtValueIs)
					{	
						priceOfMdIs	= strBldrPRMD[i];
						crntMedicinesPrice	=	priceOfMdIs;
					}
				}
				//console.log(idOfMedicineTagClicked+" - "+ElemtValueIs);
				var mOfmdCame		=	false;
				var wOfmdCame		=	false;
				var extractedPtIDFromMedicine	=	"";
				var extractedRwIDFromMedicine	=	"";
				var extractedRwIDFromMddicine	=	"";
				for(i=2;i<idOfMedicineTagClicked.length;i++)
				{
					if(idOfMedicineTagClicked[i]=="m")
					{	mOfmdCame=true;	}
					if(!mOfmdCame)
					{	extractedPtIDFromMedicine	=	extractedPtIDFromMedicine + idOfMedicineTagClicked[i];	}
					if(idOfMedicineTagClicked[i]=="w")
					{	wOfmdCame=true;	}
					if(wOfmdCame)
					{	extractedRwIDFromMddicine	=	extractedRwIDFromMddicine + idOfMedicineTagClicked[i];	}
				}
				for(j=1;j<extractedRwIDFromMddicine.length;j++)
				{	extractedRwIDFromMedicine	=	extractedRwIDFromMedicine + extractedRwIDFromMddicine[j];	}
				//console.log("extractedPtIDFromMedicine is : "+extractedPtIDFromMedicine);
				//console.log("extractedRwIDFromMedicine is : "+extractedRwIDFromMedicine);
				if(Elemt.options[Elemt.selectedIndex].value==0)
				{
					Elemt.style.border="1px solid YELLOW";
					//console.log("Null selected");
				}
				else
				{
					Elemt.style.border="1px solid #CCCCCC";
					//console.log("Not null selected");
				}

				var priceID			=	"pt" + extractedPtIDFromMedicine + "prrw" + extractedRwIDFromMedicine;
				var qtty			=	"pt" + extractedPtIDFromMedicine + "qtrw" + extractedRwIDFromMedicine;
				var ElemtQtty		=	document.getElementById(qtty);
				var ElemtQuantityIs	=	ElemtQtty.options[ElemtQtty.selectedIndex].value;
				document.getElementById(priceID).innerText	=	ElemtQuantityIs + " x " + priceOfMdIs;
				var currentBill		=	0;
				for(k=1;k<100;k++)
				{
					var IDOfMDTAG	=	"pt" + extractedPtIDFromMedicine + "mdrw" + k;
					var IDOfQTTAG	=	"pt" + extractedPtIDFromMedicine + "qtrw" + k;
					if(document.getElementById(IDOfMDTAG)!=null)
					{
						var Eltm	=	document.getElementById(IDOfMDTAG);
						var EltmVal	=	Eltm.options[Eltm.selectedIndex].value;
						var Eltq	=	document.getElementById(IDOfQTTAG);
						var EltqVal	=	Eltq.options[Eltq.selectedIndex].value;
						//console.log(EltmVal);
						for(l=0;l<strBldrIDMD.length;l++)
						{
							if(strBldrIDMD[l]==EltmVal)
							{
								currentBill			=	currentBill	+	(	parseInt(strBldrPRMD[l]) * parseInt(EltqVal)	);
							}
						}
					}
				}
				//121
				//console.log(extractedPtIDFromMedicine);
				var currentDcFee		=	0;
				for(cvcv=0;cvcv<dcArrayPreIDs.length;cvcv++)
				{
					if(dcArrayPreIDs[cvcv]==userIsInPRID)
					{
						currentDcFee	=	dcArrayFeeAre[cvcv];
					}
				}
				var ttlBillmdPlusDcFee	=	currentBill + currentDcFee;
				document.getElementById("ttlBill"+userIsInPRID).innerText=ttlBillmdPlusDcFee;

				var BtnElemtmd	=	document.getElementById("cretBill"+userIsInPRID+"_"+userIsInPTID);
				var paidValemd	=	parseInt(document.getElementById("paidptID"+userIsInPRID+"_"+userIsInPTID).value);
				//console.log(userIsInPRID+" "+userIsInPTID);
				//console.log(paidValemd + " - " + currentBill);
				if(paidValemd>ttlBillmdPlusDcFee)
				{
					BtnElemtmd.disabled=true;
					document.getElementById("paidptID"+userIsInPRID+"_"+userIsInPTID).style.border="1px solid red";
				}
				else
				{
					BtnElemtmd.disabled=false;
					document.getElementById("paidptID"+userIsInPRID+"_"+userIsInPTID).style.border="none";
				}

				var mmmddd	=	"mdidANDqt"+extractedPtIDFromMedicine;
				var mmmddq	=	"mdqtANDid"+extractedPtIDFromMedicine;
				var mmmddp	=	"mdprANDid"+extractedPtIDFromMedicine;
				window[mmmddd][extractedRwIDFromMedicine-1]	=	ElemtValueIs;
				window[mmmddq][extractedRwIDFromMedicine-1]	=	ElemtQuantityIs;
				window[mmmddp][extractedRwIDFromMedicine-1]	=	crntMedicinesPrice;
				console.log("Info mediciines of Prescription ID("+ extractedPtIDFromMedicine + "): " + window[mmmddd] + " - " + window[mmmddq] + " - " + window[mmmddp]);
			}

			function jeje(iiiddd)
			{
				var userIsinPRPTID	=	iiiddd;
				userIsInPRID 	=	"";
				userIsInPTID	=	"";
				var unScoreCame		=	false;	var cntt	=	1;
				for(ii=0; ii<iiiddd.length; ii++)
				{
					if(userIsinPRPTID[ii]=="_")
					{	unScoreCame	=	true;	}
					if(!unScoreCame)
					{	userIsInPRID	=	userIsInPRID	+	userIsinPRPTID[ii];	}
					else
					{
						if(cntt>1)
						{	userIsInPTID	=	userIsInPTID	+ 	userIsinPRPTID[ii];	}
						cntt++;
					}
				}
				var preFlagIndicator	=	false;
				console.clear();
				for(www=0;www<dcArrayFeeAre.length;www++)
				{
					console.log(dcArrayPreIDs[www]);
					if(dcArrayPreIDs[www]==userIsInPRID)
					{
						console.log("Already");
						preFlagIndicator	=	true;
					}

				}
				if(!preFlagIndicator)
				{
					dcArrayFeeAre.push(parseInt(document.getElementById("ttlBill"+userIsInPRID).innerText));
					dcArrayPreIDs.push(userIsInPRID);
					userIsInDcFee	=	parseInt(document.getElementById("ttlBill"+userIsInPRID).innerText);
					console.log("pushed");
				}
				else
				{
					console.log("Not pushed");
				}
				console.log(dcArrayPreIDs);
				console.log(dcArrayFeeAre);
				console.log(userIsInDcFee);
				//console.log(userIsInPRID);
				//console.log(userIsInPTID);
			}
			var userIsInDcFee		=	0;
			var dcArrayFeeAre		=	new Array();
			var dcArrayPreIDs		=	new Array();

			////////////////////////////////////////////////////////////////////////////

			function changeBorderColorQt(idOfMedicineQtTagClicked)
			{
				console.clear();
				var Elemt			=	document.getElementById(idOfMedicineQtTagClicked);
				var ElemtValueIs	=	Elemt.options[Elemt.selectedIndex].value;
				var priceOfMdIs		=	0;
				//console.log(idOfMedicineQtTagClicked+" - "+ElemtValueIs);
				var mOfmdCame		=	false;
				var wOfmdCame		=	false;
				var extractedPtIDFromMedicine	=	"";
				var extractedRwIDFromMedicine	=	"";
				var extractedRwIDFromMddicine	=	"";
				for(i=2;i<idOfMedicineQtTagClicked.length;i++)
				{
					if(idOfMedicineQtTagClicked[i]=="q")
					{	mOfmdCame=true;	}
					if(!mOfmdCame)
					{	extractedPtIDFromMedicine	=	extractedPtIDFromMedicine + idOfMedicineQtTagClicked[i];	}
					if(idOfMedicineQtTagClicked[i]=="w")
					{	wOfmdCame=true;	}
					if(wOfmdCame)
					{	extractedRwIDFromMddicine	=	extractedRwIDFromMddicine + idOfMedicineQtTagClicked[i];	}
				}
				for(j=1;j<extractedRwIDFromMddicine.length;j++)
				{	extractedRwIDFromMedicine	=	extractedRwIDFromMedicine + extractedRwIDFromMddicine[j];	}
				//console.log("extractedPtIDFromMedicine is : "+extractedPtIDFromMedicine);
				//console.log("extractedRwIDFromMedicine is : "+extractedRwIDFromMedicine);
				if(Elemt.options[Elemt.selectedIndex].value==0)
				{
					Elemt.style.border="1px solid YELLOW";
					//console.log("Null selected");
				}
				else
				{
					Elemt.style.border="1px solid #CCCCCC";
					//console.log("Not null selected");
				}
				var priceID			=	"pt" + extractedPtIDFromMedicine + "prrw" + extractedRwIDFromMedicine;
				var qtty			=	"pt" + extractedPtIDFromMedicine + "mdrw" + extractedRwIDFromMedicine;
				var ElemtQtty		=	document.getElementById(qtty);
				var ElemtQuantityIs	=	ElemtQtty.options[ElemtQtty.selectedIndex].value;
				var priceOfMdIs		=	0;
				var crntMedicinesPrice	=	0;
				for(i=0;i<strBldrIDMD.length;i++)
				{
					if(strBldrIDMD[i]==ElemtQuantityIs)
					{
						priceOfMdIs	= strBldrPRMD[i];
						crntMedicinesPrice	=	priceOfMdIs;
					}
				}
				document.getElementById(priceID).innerText	=	ElemtValueIs + " x " + priceOfMdIs;
				var currentBillQt		=	0;
				for(k=1;k<100;k++)
				{
					var IDOfMDTAG	=	"pt" + extractedPtIDFromMedicine + "mdrw" + k;
					var IDOfQTTAG	=	"pt" + extractedPtIDFromMedicine + "qtrw" + k;
					if(document.getElementById(IDOfMDTAG)!=null)
					{
						var Eltm	=	document.getElementById(IDOfMDTAG);
						var EltmVal	=	Eltm.options[Eltm.selectedIndex].value;
						var Eltq	=	document.getElementById(IDOfQTTAG);
						var EltqVal	=	Eltq.options[Eltq.selectedIndex].value;
						//console.log(EltmVal);
						for(l=0;l<strBldrIDMD.length;l++)
						{
							if(strBldrIDMD[l]==EltmVal)
							{	currentBillQt	=	currentBillQt	+	(	parseInt(strBldrPRMD[l]) * parseInt(EltqVal)	);	}
						}
					}
				}
				//212
				//console.log(extractedPtIDFromMedicine);
				var currentQtDcFee		=	0;
				for(cvcv=0;cvcv<dcArrayPreIDs.length;cvcv++)
				{
					if(dcArrayPreIDs[cvcv]==userIsInPRID)
					{
						currentQtDcFee	=	dcArrayFeeAre[cvcv];
					}
				}
				var ttlBillQtmdPlusDcFee	=	currentBillQt + currentQtDcFee;
				document.getElementById("ttlBill"+userIsInPRID).innerText=ttlBillQtmdPlusDcFee;

				var BtnElemtmd	=	document.getElementById("cretBill"+userIsInPRID+"_"+userIsInPTID);
				var paidValemd	=	parseInt(document.getElementById("paidptID"+userIsInPRID+"_"+userIsInPTID).value);
				//console.log(userIsInPRID+" "+userIsInPTID);
				//console.log(paidValemd + " - " + currentBillQt);
				if(paidValemd>ttlBillQtmdPlusDcFee)
				{
					BtnElemtmd.disabled=true;
					document.getElementById("paidptID"+userIsInPRID+"_"+userIsInPTID).style.border="1px solid red";
				}
				else
				{
					BtnElemtmd.disabled=false;
					document.getElementById("paidptID"+userIsInPRID+"_"+userIsInPTID).style.border="none";
				}
				var mmmddd	=	"mdidANDqt"+extractedPtIDFromMedicine;
				var mmmddq	=	"mdqtANDid"+extractedPtIDFromMedicine;
				var mmmddp	=	"mdprANDid"+extractedPtIDFromMedicine;

				window[mmmddd][extractedRwIDFromMedicine-1]	=	ElemtQuantityIs;
				window[mmmddq][extractedRwIDFromMedicine-1]	=	ElemtValueIs;
				window[mmmddp][extractedRwIDFromMedicine-1]	=	crntMedicinesPrice;
				console.log("Info mediciines of Prescription ID("+ extractedPtIDFromMedicine + "): " + window[mmmddd] + " - " + window[mmmddq] + " - " + window[mmmddp]);
			}
			/////////////////////
			function validatePaidIntegerNot(paidInputsIDChangedNow)
			{
				var paidInputsValue	=	document.getElementById(paidInputsIDChangedNow).value;
				var extractedPresID	=	"";
				var extractedPtntID	=	"";
				var undrScoComes	=	false;	var cnt	=	1;
				for(kk=8; kk<paidInputsIDChangedNow.length; kk++)
				{
					if(paidInputsIDChangedNow[kk]=="_")
					{	undrScoComes	=	true;	}
					if(!undrScoComes)
					{	extractedPresID	=	extractedPresID	+	paidInputsIDChangedNow[kk];	}
					else
					{
						if(cnt>1)
						{
							extractedPtntID	=	extractedPtntID	+	paidInputsIDChangedNow[kk];
						}
						cnt++;
					}

				}
				//console.log(extractedPresID);
				//console.log(extractedPtntID);
				var BtnElemt	=	document.getElementById("cretBill"+extractedPresID+"_"+extractedPtntID);
				if((paidInputsValue % 1 === 0)==false)
				{
					//console.log("false is");
					BtnElemt.disabled=true;
					document.getElementById("paidptID"+userIsInPRID+"_"+userIsInPTID).style.border="1px solid red";
				}
				else
				{
					//console.log("true is");
					BtnElemt.disabled=false;
					document.getElementById("paidptID"+userIsInPRID+"_"+userIsInPTID).style.border="none";
					var ttlIntBill	=	parseInt(document.getElementById("ttlBill"+extractedPresID).innerText) + 100;
					console.log(ttlIntBill);
					if(paidInputsValue > ttlIntBill)
					{	BtnElemt.disabled=true;	document.getElementById("paidptID"+userIsInPRID+"_"+userIsInPTID).style.border="1px solid red";	}
				}
				console.log(paidInputsValue+" - "+ ttlIntBill);
			}
		</script>

		<script type="text/javascript">
			function parseScriptBills(strcode)
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
			//schedule Bill and make a request after verifying the request
			function ScheduleCheckBillBefore(btnIDClicked)
			{
				console.clear();
				//console.log("Button ID clicked: " + btnIDClicked);
				//console.log("User ist in PRID : " + userIsInPRID);
				//console.log("User ist in PTID : " + userIsInPTID);
				//console.log(document.getElementById("ttlBill"+userIsInPRID).innerText);
				//console.log(document.getElementById("paidptID"+userIsInPRID+"_"+userIsInPTID).value);

				document.getElementById(btnIDClicked).disabled	=	true;
				var presID		=	userIsInPRID;
				var ptntID		=	userIsInPTID;
				var crntBILL	=	parseInt(document.getElementById("ttlBill"+userIsInPRID).innerText) + 100;
				//console.log(crntBILL);
				var paidBILL	=	parseInt(document.getElementById("paidptID"+userIsInPRID+"_"+userIsInPTID).value);
				if(isNaN(paidBILL)){	paidBILL	=	0;	}
				//console.log(presID + " - " + ptntID + " - " + crntBILL + " - " + paidBILL);
				//xmlhttp request is being created
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
				xmlhttp.onreadystatechange=function()
				{
					if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
						var respOfCreatingBill = document.getElementById("oneoneonetag"+presID).innerHTML=xmlhttp.responseText;
						parseScriptBills(respOfCreatingBill);
						//console.log(xmlhttp);
					}
				}
				console.clear();
				//var LoadingElement	=	document.getElementById
				console.log("loading"+presID);
				var iij= 10;
				var loadingFunction	=	setInterval
				(
					function()
					{
						if(iij<=100)
						{
							iij+=10;
							document.getElementById("loading"+presID).style.width	=	iij+"%";
							console.log("jejeje"+presID+" : "+ iij);
							if(iij==110)
							{
								document.getElementById("loading"+presID).innerText	=	"Created Successfully";
								document.getElementById("loadingClass"+presID).className	=	"span11 progress progress-success progress-striped active";
							}
						}
						else
						{
							clearInterval(loadingFunction);
						}
					}, 100
				);
				var abc	=	window["mdidANDqt"+userIsInPRID];
				var bca	=	window["mdqtANDid"+userIsInPRID];
				var cab	=	window["mdprANDid"+userIsInPRID];
				console.log(abc);
				var medicineIDs_QTs_PRs	=	"";
				for (i=0; i<abc.length;i++)
				{
					medicineIDs_QTs_PRs	=	medicineIDs_QTs_PRs	+	abc[i] + "," + bca[i] + "," + cab[i] + ",";
				}
				medicineIDs_QTs_PRs	=	medicineIDs_QTs_PRs.substring(0, medicineIDs_QTs_PRs.length - 1);

				xmlhttp.open("GET","myFooter_homeBody/phCreateBill.php?prescriptionID="+presID+"&patientID="+ptntID+"&currentTotalBill="+crntBILL+"&paidTotalBill="+paidBILL+"&prptMedicinesAre="+medicineIDs_QTs_PRs,true);
				xmlhttp.send();
			}
			function reomoveLoader(progressBarToBeRemoved)
			{
				//console.log("rowLoading"+progressBarToBeRemoved);
				document.getElementById("rowLoading"+progressBarToBeRemoved).remove();
			}
			function printCreatedBill(idOfBill)
			{
				console.clear();
				console.log("Don't worry, I am going to print the Bill for you buddy");
				var billID	=	"billRecept_" + idOfBill;
				console.log("Bill Id is: " + billID);
				var tableToPrint=document.getElementById(billID);
				newWin= window.open("");
				newWin.document.write(tableToPrint.outerHTML);
				newWin.print();
				newWin.close();
			}
		</script>
		<script type="text/javascript">
			var focusedBackColor	=	"";
			var focusedTextColor	=	"";
			var userIsInTextBox		=	"";
			///////////////////////////////////////////////////////////////////////////////////////////////////////////
			function blockValueOrNot(valueNowIs, idOfCallee, cntrOfRow)
			{
				//console.clear();
				for(pp=1;pp<BillIDsUpTo;pp++)
				{	//console.log(window['allBillIDs'+pp]);	
				}
				console.log(valueNowIs + " Called by: " + idOfCallee);
				var aaa				=	document.getElementById(idOfCallee).placeholder;
				var aaaLength		=	(aaa.length);
				var valueShouldBe	=	"";
				//console.log("16 - " + aaaLength + "----------");
				for(ikl=16; ikl<aaaLength; ikl++)
					valueShouldBe	=	valueShouldBe	+	aaa[ikl];
				//console.log(valueShouldBe);
				valueShouldBe	=	parseInt(valueShouldBe);

				if(valueShouldBe<valueNowIs)
				{
					//console.log(valueShouldBe + " is less than " + valueNowIs + " so Block.");
					document.getElementById(idOfCallee).style.border	=	"1px solid RED";
					focusedBackColor	=	"RED";
					focusedTextColor	=	"WHITE";
					document.getElementById("t1d"+cntrOfRow).style.backgroundColor		=	focusedBackColor;
					document.getElementById("t1d"+cntrOfRow).style.color				=	focusedTextColor;
				}
				else
				{
					//console.log(valueShouldBe + " is greater/equal than " + valueNowIs + " so fine.");
					document.getElementById(idOfCallee).style.border	=	"1px solid #CCCCCC";
					focusedBackColor	=	"#055c8b";
					focusedTextColor	=	"WHITE";
					document.getElementById("t1d"+cntrOfRow).style.backgroundColor		=	focusedBackColor;
					document.getElementById("t1d"+cntrOfRow).style.color				=	focusedTextColor;
				}
			}
			function displayunicode(e, valueIs, ctr, unpaidRs)
			{
				var unicode=e.keyCode? e.keyCode : e.charCode;
				if(unicode	== 13)
				{
					console.clear();
					//alert(unicode + " == 13\nMeans you presses Enter\nValue is: " + valueIs);
					document.getElementById("upTxtBx" + ctr).focus();
					console.log("User is in : " + userIsInTextBox);
					if(valueIs	>	unpaidRs || valueIs	==	0)
					{
						console.log("You are not allowed to enter the value: " + valueIs);
					}
					else
					{
						console.log("You are most welcome: " + valueIs);
						var xmlhttp5;
						if (window.XMLHttpRequest)
						{// code for IE7+, Firefox, Chrome, Opera, Safari
							xmlhttp5=new XMLHttpRequest();
							//console.log("latest versions.");
							//console.log("Request status: " + xmlhttp.status);
							//console.log("Response Text : " + xmlhttp.responseText);
						}
						else
						{// code for IE6, IE5
							xmlhttp5=new ActiveXObject("Microsoft.XMLHTTP");
							//console.log("older versions.");
							//console.log(xmlhttp);
						}
						xmlhttp5.onreadystatechange=function()
						{
							if (xmlhttp5.readyState==4 && xmlhttp5.status==200)
							{
								var respOfUpdatingBill = document.getElementById("txtFrntUpdt"+userIsInTextBox).innerHTML=xmlhttp5.responseText;
								parseScriptBills(respOfUpdatingBill);
								//console.log(xmlhttp);
							}
						}
						xmlhttp5.open("GET","myFooter_homeBody/phUpdateBill.php?billIDPassedIs="+userIsInTextBox+"&billAmountToBeAdded="+valueIs,true);
						xmlhttp5.send();
					}
					document.selection.empty();
				}
				document.selection.empty();
			}
			function highlightTheRow(rowFocusedID)
			{
				userIsInTextBox		=	rowFocusedID;
				console.clear();
				//console.log("User Is in Bill-ID textBox: upTxtBx" + userIsInTextBox);
				focusedBackColor	=	document.getElementById("t1d"+rowFocusedID).style.backgroundColor;
				focusedTextColor	=	document.getElementById("t1d"+rowFocusedID).style.color;

				document.getElementById("t1d"+rowFocusedID).style.backgroundColor	=	"#055c8b"
				document.getElementById("t1d"+rowFocusedID).style.color				=	"WHITE";
			}
			function deHighlightTheRow(rowFocusedID)
			{
				console.clear();
				//console.log("deHigh");
				document.getElementById("t1d"+rowFocusedID).style.backgroundColor	=	focusedBackColor;
				document.getElementById("t1d"+rowFocusedID).style.color				=	focusedTextColor;
				if(focusedBackColor=="#055c8b")
				{
					document.getElementById("t1d"+rowFocusedID).style.backgroundColor	=	"WHITE";
					document.getElementById("t1d"+rowFocusedID).style.color				=	"BLACK";
				}
			}
		</script>

		<script type="text/javascript" src="asfJScript/showViewsFunctionPh.js"></script>

		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	</head>
	<body>

		<?php include('myFooter_homeBody/mySrchListPatients.php') ?>
		<?php  include('myFooter_homeBody/myDate.php') ?>

		<div class="navbar navbar-inverse navbar-static-top">
			<div class="navbar-inner" style="color:WHITE;background-image:linear-gradient(to bottom, #055c8b, #055c8b;">
				<div class="container">
					<a class="btn btn-navbar" id="ulInNav" data-toggle="collapse" data-target=".navbar-inverse-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<?php include('myFooter_homeBody/myBrandLogo.php') ?>
					<div class="nav-collapse navbar-inverse-collapse collapse">
						<ul class="nav" id="ulInNav">
							<li><a href="lgdinPhHome.php">Home</a></li>
							<li class="dropdown">
								<a href="lgdinPhViews.php" class="dropdown-toggle" data-toggle="dropdown" id="clkdMnu">View
									<b class="caret"></b>
								</a>
								<ul class="dropdown-menu">
									<li>
										<a href="lgdinPhViews.php" onclick="showViewsPh(1); return false;">Notification</a>
									</li>
									<li>
										<a href="lgdinPhViews.php" onclick="showViewsPh(3); return false;">Medicines</a>
									</li>
									<li>
										<a href="lgdinPhViews.php" onclick="showViewsPh(5); return false;">Unpaid Bills</a>
									</li>
								</ul>
							</li>
							<li>
								<a href="lgdinPhUpdtst.php">Update settings</a>
							</li>
							
						</ul>
						<form class="navbar-search pull-left" action="" id="srchInNav">
							<?php
								echo "<input type='text' placeholder='Search Patients Here' class='search-query' data-items='11' data-provide='typeahead' data-source='$strBldPt'>";
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
		            	<a href="#view1" onclick="showViewsPh(1); return false;">
		            		<span class="tabsheading">Notifications</span>
		            	</a>
		            </li>
		            <li>
		            	<a href="#view2" onclick="showViewsPh(3); return false;">
		            		<span class="tabsheading">Medicines</span>
		            	</a>
		            </li>
		            <li>
		            	<a href="#view3" onclick="showViewsPh(5); return false;">
		            		<span class="tabsheading">Unpaid Bills</span>
		            	</a>
		            </li>
		        </ul>
		        <div class="row-fluid">
			        <div class="tabcontents" id="tabcontents">
			            <div id="view1">
			            	<!--<br>
			            	<div style="display:block">
			            		<?php	//include('myFooter_homeBody/myPrescribedImagesToBeZoomed.php');	?>
			            	</div>-->
			            	<br>
			            	<div class="row-fluid">
								<div class="span10 offset1" id="VwDocsHdrwthoutForm">
									<?php
										$mydate=getdate(date("U"));
										echo '
											Patient Notifications of: &nbsp;&nbsp;
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
									<script src='asfJScript/elevatezoom-master/jquery-1.8.3.min.js'></script>
									<script src='asfJScript/elevatezoom-master/jquery.elevatezoom.js'></script>
									<table  id="hdrTblDctr" class="table table-striped table-hover table-condensed table-bordered">
										<thead>
											<tr>
												<th style="width:5px;">S.No.</th>
												<th style="text-align:center;">Login ID</th>
												<th style="width:145px;">&emsp;&emsp;&emsp;Patient</th>
												<th style="border-left:none; text-align:center;">-</th>
												<th style="text-align:left; border-left:none; width:125px;">Doctor</th>
												<th style="text-align:right; width:150px;">Time&emsp;</th>
												<th style="border-left:none; text-align:center;">at</th>
												<th style="border-left:none;">Department</th>
											</tr>
										</thead>
										<tbody  id="">
											<?php
												include('myFooter_homeBody/myPrescribedPatients.php');
											?>
										</tbody>
									</table>
									<script>
										$("#zoom_mw").elevateZoom({scrollZoom : true});
									</script>
									<?php
										//echo $strBldMdID;
										//echo "<br>".$strBldMd;
										echo'
											<script type="text/javascript">
												var strBldrMD		=	' . $strBldMd . ';
												var strBldrIDMD		=	' . $strBldMdID . ';
												var strBldrPRMD		=	' . $strBldMdPR . ';
												//console.log(strBldrMD);
												//console.log(strBldrIDMD);
											</script>
										';
									?>
								</div>
							</div>
						</div>
			            <div id="view2">
			            	<br>
			            	<div class="row-fluid">
								<div class="span10 offset1" id="VwPtsHdr">  
									<div class="input-group" style="margin:0px; padding-top:4px;"> 
										<span class="input-group-addon" id="fntWghtSize">Filter Medicines:</span>
										<input id="filter" type="text" class="form-control search-query" style="height:14px; margin-top:0px;" placeholder="By any attribute" >
									</div>
								</div>
							</div>
			            	<div class="row-fluid">
			            		<div align="center" class="span10 offset1">
					            	<table  id="hdrTblPt" class="table table-striped table-hover table-condensed table-bordered">
										<thead>
											<tr>
												<th style="width:5px;">S.No</th>
												<th>&emsp;&emsp;&emsp;Medicine Name</th>
												<th style="text-align:center; width:130px;">Quantity</th>
												<th>&emsp;&emsp;&emsp;Amount</th>
												<th style="text-align:center;">Price (Rs)</th>
												<th>&emsp;&emsp;Bar-Codes</th>
											</tr>
										</thead>
										<!--Body AND Footer of Medicines-Table-->
										<?php
											include('myFooter_homeBody/myMedicinesForPh.php');
										?>
									</table>
								</div>
							</div>
			            </div>
			            <div id="view3">
			            	<br>
			            	<div class="row-fluid">
								<div class="span10 offset1" id="VwPtsHdr">  
									<div class="input-group" style="padding-top:5px;"> 
										<span class="input-group-addon" id="fntWghtSize">Edit the Unpaid Bills here</span>
									</div>
								</div>
							</div>
			            	<div class="row-fluid">
			            		<div align="center" class="span10 offset1">
					            	<table  id="hdrTblPt" class="table table-striped table-hover table-condensed table-bordered">
										<thead style="border:none;">
											<tr style="border:none;">
												<th style="width:5px;">S.No</th>
												<th style=" border:none;">&emsp;&emsp;&emsp;User Name</th>
												<th style="text-align:center; width:180px; border:none;">Login-ID</th>
												<th colspan="4" style="text-align:center; border:none;">Press Enter to update Bill</th>
											</tr>
										</thead>
										<!--Body AND Footer of Unpaid_Bills Table-->
										<?php
											include('myFooter_homeBody/phUnpaidBills.php');
										?>
									</table>
								</div>
							</div>
			            </div>
			        </div>
			    </div>
		    </div>
			<br>
			<br>
		</div>

		<?php include('myFooter_homeBody/myFtr.php') ?>

		<?php
			if(empty($_GET))
				echo'
					<script type="text/javascript">
						showViewsPh(1);
					</script>
				';
			else
				echo'
					<script type="text/javascript">
						showViewsPh(' . $_GET['idPh'] . ');
					</script>
				';
		?>

	</body>
</html>